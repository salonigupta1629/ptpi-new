<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\ExamCenter;
use App\Models\User;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;

class ExamCenters extends Component
{
    use WithPagination;

    public $email;
    public $username;
    public $password;
    public $center_name;
    public $area;
    public $pincode;
    public $city;
    public $state;
    public $inactive = false;

    public $search = '';
    public $editMode = false;
    public $editingId = null;
    public $showModal = false;

    protected $rules = [
        'email' => 'required|email|unique:users,email',
        'username' => 'required|unique:users,name',
        'password' => 'required|min:8',
        'center_name' => 'required',
        'area' => 'required',
        'pincode' => 'required',
        'city' => 'required',
        'state' => 'required',
    ];

    public function create()
    {
        $this->resetForm();
        $this->showModal = true;
        $this->editMode = false;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function save()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->username,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => 'center-manager',
            'inactive' => $this->inactive,
        ]);

        ExamCenter::create([
            'center_name' => $this->center_name,
            'area' => $this->area,
            'pincode' => $this->pincode,
            'city' => $this->city,
            'state' => $this->state,
            'manager_id' => $user->id,
            'inactive' => $this->inactive,
        ]);

        session()->flash('message', 'Exam Center created successfully.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $center = ExamCenter::with('manager')->findOrFail($id);
        $this->editingId = $id;
        $this->editMode = true;
        $this->showModal = true;

        $this->email = $center->manager->email;
        $this->username = $center->manager->name;
        $this->center_name = $center->center_name;
        $this->area = $center->area;
        $this->pincode = $center->pincode;
        $this->city = $center->city;
        $this->state = $center->state;
        $this->inactive = $center->inactive;
        
        $this->password = '';
    }

    public function update()
    {
        $center = ExamCenter::findOrFail($this->editingId);
        
        $rules = [
            'email' => 'required|email|unique:users,email,' . $center->manager_id,
            'username' => 'required|unique:users,name,' . $center->manager_id,
            'center_name' => 'required',
            'area' => 'required',
            'pincode' => 'required',
            'city' => 'required',
            'state' => 'required',
        ];

        if (!empty($this->password)) {
            $rules['password'] = 'min:8';
        }

        $this->validate($rules);

        $user = $center->manager;

        $userData = [
            'name' => $this->username,
            'email' => $this->email,
            'inactive' => $this->inactive,
            'role' => 'center-manager',
        ];

        if (!empty($this->password)) {
            $userData['password'] = Hash::make($this->password);
        }

        $user->update($userData);

        $center->update([
            'center_name' => $this->center_name,
            'area' => $this->area,
            'pincode' => $this->pincode,
            'city' => $this->city,
            'state' => $this->state,
            'inactive' => $this->inactive,
        ]);

        session()->flash('message', 'Exam Center updated successfully.');
        $this->closeModal();
    }

    public function delete($id)
    {
        $center = ExamCenter::findOrFail($id);
        $user = $center->manager;
        
        $center->delete();
        $user->delete();

        session()->flash('message', 'Exam Center deleted successfully.');
    }

    public function resetForm()
    {
        $this->reset([
            'email', 'username', 'password', 
            'center_name', 'area', 'pincode', 'city', 'state', 'inactive',
            'editMode', 'editingId'
        ]);
        $this->resetErrorBag();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $centers = ExamCenter::with('manager')
            ->when($this->search, function ($query) {
                $query->where('center_name', 'like', '%' . $this->search . '%')
                    ->orWhere('city', 'like', '%' . $this->search . '%')
                    ->orWhere('state', 'like', '%' . $this->search . '%')
                    ->orWhere('area', 'like', '%' . $this->search . '%')
                    ->orWhere('pincode', 'like', '%' . $this->search . '%')
                    ->orWhereHas('manager', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%')
                          ->orWhere('email', 'like', '%' . $this->search . '%');
                    });
            })
            ->orderBy('center_name')
            ->paginate(10);

        return view('livewire.admin.exam-centers', compact('centers'))->layout('layouts.admin');
    }
}