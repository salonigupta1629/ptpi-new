<?php

namespace App\Livewire\Teacher;

use App\Models\Teacher;
use App\Models\TeachersAddress;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class PersonalDetails extends Component
{
    public $image, $name, $email, $phone, $language, $gender, $marital_status, $religion;
    public $current_address = [
        'pincode' => '', 'village' => '', 'area' => '', 'block' => '', 'district' => '', 'state' => ''
    ];
    public $permanent_address = [
        'pincode' => '', 'village' => '', 'area' => '', 'block' => '', 'district' => '', 'state' => ''
    ];
    public $same_as_current = false;

    public $languages = ['English', 'Hindi', 'Other'];
    public $genders = ['Male', 'Female', 'Other'];
    public $marital_statuses = ['Single', 'Married', 'Divorced', 'Widowed'];
    public $religions = ['Hindu', 'Muslim', 'Christian', 'Sikh', 'Other'];

    public function mount()
    {
        $user = Auth::user();
        $teacher = Teacher::where('user_id', $user->id)->first();

        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $teacher?->phone;
        $this->language = $teacher?->language;
        $this->gender = $teacher?->gender;
        $this->marital_status = $teacher?->marital_status;
        $this->religion = $teacher?->religion;
        $this->image = $teacher?->image;

        // Load addresses from teacher_addresses table
        $current = TeachersAddress::where('user_id', $user->id)->where('address_type', 'current')->first();
        $permanent = TeachersAddress::where('user_id', $user->id)->where('address_type', 'permanent')->first();

        $this->current_address = [
            'pincode' => $current?->pincode,
            'village' => $current?->village,
            'area' => $current?->area,
            'block' => $current?->block,
            'district' => $current?->district,
            'state' => $current?->state,
            'division' => $current?->division,
        ];
        $this->permanent_address = [
            'pincode' => $permanent?->pincode,
            'village' => $permanent?->village,
            'area' => $permanent?->area,
            'block' => $permanent?->block,
            'district' => $permanent?->district,
            'state' => $permanent?->state,
            'division' => $permanent?->division,
        ];
    }

    public function updatedSameAsCurrent($value)
    {
        if ($value) {
            $this->permanent_address = $this->current_address;
        }
    }

    public function save()
    {
        $this->validate([
            'phone' => 'required|string|max:15',
            'language' => 'required',
            'gender' => 'required',
            'marital_status' => 'required',
            'religion' => 'required',
            'pincode' => 'required',
            'current_address.village' => 'required',
            'current_address.area' => 'required',
            'current_address.block' => 'required',
            'current_address.district' => 'required',
            'current_address.state' => 'required',
            'permanent_address.pincode' => 'required',
            'permanent_address.village' => 'required',
            'permanent_address.area' => 'required',
            'permanent_address.block' => 'required',
            'permanent_address.district' => 'required',
            'permanent_address.state' => 'required',
        ]);

        $teacher = Teacher::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'phone' => $this->phone,
                'language' => $this->language,
                'gender' => $this->gender,
                'marital_status' => $this->marital_status,
                'religion' => $this->religion,
                'pincode' => $this->current_address['pincode'],
                'current_village' => $this->current_address['village'],
                'current_area' => $this->current_address['area'],
                'current_block' => $this->current_address['block'],
                'current_district' => $this->current_address['district'],
                'current_state' => $this->current_address['state'],
                'permanent_pincode' => $this->permanent_address['pincode'],
                'permanent_village' => $this->permanent_address['village'],
                'permanent_area' => $this->permanent_address['area'],
                'permanent_block' => $this->permanent_address['block'],
                'permanent_district' => $this->permanent_address['district'],
                'permanent_state' => $this->permanent_address['state'],
            ]
        );

        $this->dispatch('notify', message: 'Personal details updated successfully!');
    }

    public function saveField($field)
    {
        $rules = [
            'phone' => 'required|string|max:15',
            'language' => 'required',
            'gender' => 'required',
            'marital_status' => 'required',
            'religion' => 'required',
            'current_address.pincode' => 'required',
            'current_address.village' => 'required',
            'current_address.area' => 'required',
            'current_address.block' => 'required',
            'current_address.district' => 'required',
            'current_address.state' => 'required',
            'permanent_address.pincode' => 'required',
            'permanent_address.village' => 'required',
            'permanent_address.area' => 'required',
            'permanent_address.block' => 'required',
            'permanent_address.district' => 'required',
            'permanent_address.state' => 'required',
        ];

        if ($field === 'current_address') {
            $this->validate([
                'current_address.pincode' => $rules['current_address.pincode'],
                'current_address.village' => $rules['current_address.village'],
                'current_address.area' => $rules['current_address.area'],
                'current_address.block' => $rules['current_address.block'],
                'current_address.district' => $rules['current_address.district'],
                'current_address.state' => $rules['current_address.state'],
            ]);
            TeachersAddress::updateOrCreate(
                ['user_id' => Auth::id(), 'address_type' => 'current'],
                [
                    'state' => $this->current_address['state'],
                    'division' => $this->current_address['division'] ?? null,
                    'district' => $this->current_address['district'],
                    'block' => $this->current_address['block'],
                    'village' => $this->current_address['village'],
                    'area' => $this->current_address['area'],
                    'pincode' => $this->current_address['pincode'],
                ]
            );
        } elseif ($field === 'permanent_address') {
            $this->validate([
                'permanent_address.pincode' => $rules['permanent_address.pincode'],
                'permanent_address.village' => $rules['permanent_address.village'],
                'permanent_address.area' => $rules['permanent_address.area'],
                'permanent_address.block' => $rules['permanent_address.block'],
                'permanent_address.district' => $rules['permanent_address.district'],
                'permanent_address.state' => $rules['permanent_address.state'],
            ]);
            TeachersAddress::updateOrCreate(
                ['user_id' => Auth::id(), 'address_type' => 'permanent'],
                [
                    'state' => $this->permanent_address['state'],
                    'division' => $this->permanent_address['division'] ?? null,
                    'district' => $this->permanent_address['district'],
                    'block' => $this->permanent_address['block'],
                    'village' => $this->permanent_address['village'],
                    'area' => $this->permanent_address['area'],
                    'pincode' => $this->permanent_address['pincode'],
                ]
            );
        } else {
            $this->validate([$field => $rules[$field]]);
            Teacher::updateOrCreate(
                ['user_id' => Auth::id()],
                [$field => $this->$field]
            );
        }

        $this->dispatch('notify', message: ucfirst(str_replace('_', ' ', $field)) . ' updated successfully!');
    }

    #[Layout('layouts.teacher')]
    public function render()
    {
        return view('livewire.teacher.personal-details');
    }
}
