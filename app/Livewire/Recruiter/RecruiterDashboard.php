<?php

namespace App\Livewire\Recruiter;

use App\Models\Subject;
use App\Models\Teacher;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.recruiter')]
class RecruiterDashboard extends Component
{
    use WithPagination;

    #[Url(as: 'q', history: true)]
    public string $search = '';

    public string $view = 'card';
    public string $subjectFilter = '';
    public string $locationFilter = '';
    public string $availabilityFilter = '';
    
    // Sidebar filter properties
    public $pincodeFilter = '';
    public $districtFilter = '';
    public $blockFilter = '';
    public $villageFilter = '';
    public $educationFilter = [];
    public $classCategoryFilter = [];
    public $subjectsFilter = [];
    public $skillsFilter = [];
    

    public function changeView($viewType)
    {
        $this->view = $viewType;
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->subjectFilter = '';
        $this->locationFilter = '';
        $this->availabilityFilter = '';
        $this->pincodeFilter = '';
        $this->districtFilter = '';
        $this->blockFilter = '';
        $this->villageFilter = '';
        $this->educationFilter = [];
        $this->classCategoryFilter = [];
        $this->subjectsFilter = [];
        $this->skillsFilter = [];
        $this->resetPage();

        // Clear the header search input
        $this->dispatch('clear-global-search');
    }

    #[On('searching-teachers')]
    public function updateSearch(string $query)
    {
        $this->search = trim($query);
        $this->resetPage();
    }
    
    #[On('apply-sidebar-filters')]
    public function applySidebarFilters($filters)
    {
        $this->pincodeFilter = $filters['pincode'];
        $this->districtFilter = $filters['district'];
        $this->blockFilter = $filters['block'];
        $this->villageFilter = $filters['village'];
        $this->educationFilter = $filters['education'];
        $this->classCategoryFilter = $filters['classCategory'];
        $this->subjectsFilter = $filters['subjects'];
        $this->skillsFilter = $filters['skills'];
        
        $this->resetPage();
    }
    
    #[On('clear-sidebar-filters')]
    public function clearSidebarFilters()
    {
        $this->pincodeFilter = '';
        $this->districtFilter = '';
        $this->blockFilter = '';
        $this->villageFilter = '';
        $this->educationFilter = [];
        $this->classCategoryFilter = [];
        $this->subjectsFilter = [];
        $this->skillsFilter = [];
        
        $this->resetPage();
    }

    public function render()
    {
        
        $teachers = Teacher::with(['user', 'addresses', 'subjects.subject', 'qualifications.qualification', 'skills.skill'])
            ->when($this->search, function ($query) {
                $s = '%' . $this->search . '%';
                $query->whereHas('user', fn($q) => $q->where('name', 'like', $s))
                      ->orWhereHas('subjects.subject', fn($q) => $q->where('subject_name', 'like', $s))
                      ->orWhereHas('addresses', fn($q) => $q->where('district', 'like', $s)->orWhere('division', 'like', $s));
            })
            ->when($this->subjectFilter, function ($query) {
                $query->whereHas('subjects.subject', function ($q) {
                    $q->where('subject_name', 'like', '%' . $this->subjectFilter . '%');
                });
            })
            ->when($this->locationFilter, function ($query) {
                $query->whereHas('addresses', function ($q) {
                    $q->where('district', 'like', '%' . $this->locationFilter . '%')
                      ->orWhere('division', 'like', '%' . $this->locationFilter . '%');
                });
            })
            ->when($this->availabilityFilter, function ($query) {
                $query->where('availability_status', $this->availabilityFilter);
            })
            // Sidebar filters
            ->when($this->pincodeFilter, function ($query) {
                $query->whereHas('addresses', function ($q) {
                    $q->where('pincode', 'like', '%' . $this->pincodeFilter . '%');
                });
            })
            ->when($this->districtFilter, function ($query) {
                $query->whereHas('addresses', function ($q) {
                    $q->where('district', 'like', '%' . $this->districtFilter . '%');
                });
            })
            ->when($this->blockFilter, function ($query) {
                $query->whereHas('addresses', function ($q) {
                    $q->where('block', 'like', '%' . $this->blockFilter . '%');
                });
            })
            ->when($this->villageFilter, function ($query) {
                $query->whereHas('addresses', function ($q) {
                    $q->where('village', 'like', '%' . $this->villageFilter . '%');
                });
            })
            ->when(!empty($this->educationFilter), function ($query) {
                $query->whereHas('qualifications.qualification', function ($q) {
                    $q->whereIn('name', $this->educationFilter);
                });
            })
            ->when(!empty($this->subjectsFilter), function ($query) {
                $query->whereHas('subjects.subject', function ($q) {
                    $q->whereIn('subject_name', $this->subjectsFilter);
                });
            })
            ->when(!empty($this->skillsFilter), function ($query) {
                $query->whereHas('skills.skill', function ($q) {
                    $q->whereIn('name', $this->skillsFilter);
                });
            })
            ->where('verified', true)
            ->orderBy('rating', 'desc')
            ->paginate($this->view === 'card' ? 9 : 15);

        $subjects = Subject::all();
        

        return view('livewire.recruiter.recruiter-dashboard', [
            'teachers' => $teachers,
            'subjects' => $subjects,
        ]);
    }
}