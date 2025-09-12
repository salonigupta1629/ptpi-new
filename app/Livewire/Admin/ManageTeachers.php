<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Teacher;
use Livewire\WithPagination;
use App\Models\TeacherQualification;
use App\Models\TeacherSubject;
use App\Models\TeachersAddress;
use App\Models\EducationalQualification;
use App\Models\Subject;

class ManageTeachers extends Component
{
    use WithPagination;

    public $search = '';
    public $qualificationFilter = '';
    public $subjectFilter = '';
    public $locationFilter = '';
    public $statusFilter = '';
    public $perPage = 15;
    public $showFilters = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'qualificationFilter' => ['except' => ''],
        'subjectFilter' => ['except' => ''],
        'locationFilter' => ['except' => ''],
        'statusFilter' => ['except' => ''],
        'perPage' => ['except' => 15],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingQualificationFilter()
    {
        $this->resetPage();
    }

    public function updatingSubjectFilter()
    {
        $this->resetPage();
    }

    public function updatingLocationFilter()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->qualificationFilter = '';
        $this->subjectFilter = '';
        $this->locationFilter = '';
        $this->statusFilter = '';
        $this->resetPage();
    }

    public function render()
    {
        $teachers = Teacher::with(['user', 'qualifications.qualification', 'subjects.subject', 'addresses'])
            ->when($this->search, function ($query) {
                $query->whereHas('user', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
                })->orWhere('id', 'like', '%' . $this->search . '%');
            })
            ->when($this->qualificationFilter, function ($query) {
                $query->whereHas('qualifications', function ($q) {
                    $q->where('qualification_id', $this->qualificationFilter);
                });
            })
            ->when($this->subjectFilter, function ($query) {
                $query->whereHas('subjects', function ($q) {
                    $q->where('subject_id', $this->subjectFilter);
                });
            })
            ->when($this->locationFilter, function ($query) {
                $query->whereHas('addresses', function ($q) {
                    $q->where('district', $this->locationFilter);
                });
            })
            ->when($this->statusFilter, function ($query) {
                $query->where('availability_status', $this->statusFilter);
            })
            ->orderBy('id', 'desc')
            ->paginate($this->perPage);

        $stats = [
            'total' => Teacher::count(),
            'active' => Teacher::where('availability_status', 'Available')->count(),
            'inactive' => Teacher::where('availability_status', '!=', 'Available')->count(),
        ];

        $qualifications = EducationalQualification::pluck('name', 'id');
      $subjects = Subject::pluck('subject_name', 'id');
        $locations = TeachersAddress::distinct()->pluck('district', 'district');
        $statuses = Teacher::distinct()->pluck('availability_status', 'availability_status');

        return view('livewire.admin.manage-teachers', [
            'teachers' => $teachers,
            'stats' => $stats,
            'qualifications' => $qualifications,
            'subjects' => $subjects,
            'locations' => $locations,
            'statuses' => $statuses,
        ])->layout('layouts.admin');
    }
}