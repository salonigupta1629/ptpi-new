<?php

namespace App\Livewire\Recruiter;

use App\Models\TeacherRequest;
use App\Models\ClassCategory;
use App\Models\Subject;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.recruiter')]
class RequestTeacher extends Component
{
    public $class_id;
    public $subject_ids = [];
    public $pincode;
    public $city;
    public $area;
    public $state;
    public $classCategories = [];
    public $subjects = [];
    public $currentStep = 1;
    public $showModal = false; // Add modal visibility control

    protected $rules = [
        'class_id' => 'required|exists:class_categories,id',
        'subject_ids' => 'required|array|min:1',
        'subject_ids.*' => 'exists:subjects,id',
        'pincode' => 'required|digits:6',
        'state' => 'required|string|max:100',
        'city' => 'required|string|max:100',
        'area' => 'required|string|max:100',
    ];

    protected $messages = [
        'class_id.required' => 'Please select a class range.',
        'subject_ids.required' => 'Please select at least one subject.',
        'pincode.required' => 'Pincode is required.',
        'pincode.digits' => 'Pincode must be exactly 6 digits.',
        'state.required' => 'State is required.',
        'city.required' => 'City is required.',
        'area.required' => 'Area is required.',
    ];

    public function mount()
    {
        $this->classCategories = ClassCategory::all();
        $this->subjects = [];
    }

    // Use debounced updates to prevent excessive re-renders
    public function updatedClassId($value)
    {
        $this->subjects = $value ? Subject::where('category_id', $value)->get()->toArray() : [];
        $this->subject_ids = [];
    }

    public function updatedPincode($value)
    {
        if (strlen($value) !== 6 || !is_numeric($value)) {
            $this->addError('pincode', 'Pincode must be exactly 6 digits.');
        } else {
            $this->resetErrorBag('pincode');
        }
    }

    // Step navigation methods
    public function nextStep()
    {
        if ($this->currentStep === 1) {
            $this->validate([
                'class_id' => 'required|exists:class_categories,id',
                'subject_ids' => 'required|array|min:1',
            ]);
            $this->currentStep = 2;
        }
    }

    public function previousStep()
    {
        if ($this->currentStep === 2) {
            $this->currentStep = 1;
        }
    }

    public function submit()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            TeacherRequest::create([
                'recruiter_id' => Auth::id() ?? 1,
                'class_id' => $this->class_id,
                'subject_ids' => $this->subject_ids,
                'pincode' => $this->pincode,
                'state' => ucwords(strtolower($this->state)),
                'city' => ucwords(strtolower($this->city)),
                'area' => ucwords(strtolower($this->area)),
                'status' => 'pending',
            ]);

            DB::commit();
            $this->resetForm();
            session()->flash('success', 'Teacher request submitted successfully!');
            $this->showModal = false;
        } catch (\Exception $e) {
            DB::rollBack();
            $this->addError('general', 'Failed to submit: ' . $e->getMessage());
            Log::error("Teacher request submission failed: {$e->getMessage()}");
        }
    }

    public function openModal()
    {
        $this->showModal = true;
        $this->currentStep = 1;
        $this->reset(['class_id', 'subject_ids', 'pincode', 'city', 'area', 'state']);
        $this->subjects = [];
        $this->resetErrorBag();
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->currentStep = 1;
        $this->reset(['class_id', 'subject_ids', 'pincode', 'city', 'area', 'state']);
        $this->subjects = [];
        $this->resetErrorBag();
    }

    private function resetForm()
    {
        $this->reset(['class_id', 'subject_ids', 'pincode', 'city', 'area', 'state', 'currentStep']);
        $this->subjects = [];
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.recruiter.request-teacher');
    }
}