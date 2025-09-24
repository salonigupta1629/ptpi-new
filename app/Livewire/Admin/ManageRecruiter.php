<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;

class ManageRecruiter extends Component
{
       use WithPagination;

    public $search = '';
    public $statusFilter = '';
    public $genderFilter = '';

    // Sample data - replace with your actual data source
    protected $recruiters = [
        [
            'id' => 'S1M',
            'name' => 'SAULANYA MAGARDE',
            'email' => 'saulanyamagardx23@gmail.com',
            'contact' => 'ujanyamagardx23@gmail.cc',
            'company' => 'N/A',
            'location' => 'N/A',
            'status' => 'Verified'
        ],
        [
            'id' => 'S1R',
            'name' => 'sonu kumari',
            'email' => 'jayvants847@gmail.com',
            'contact' => 'jayvants847@gmail.com',
            'company' => 'N/A',
            'location' => 'N/A',
            'status' => 'Verified'
        ]
    ];

    public function render()
    {
        // Filter recruiters based on search and filters
        $filteredRecruiters = collect($this->recruiters)
            ->filter(function ($recruiter) {
                $searchMatch = empty($this->search) || 
                    stripos($recruiter['name'], $this->search) !== false ||
                    stripos($recruiter['email'], $this->search) !== false ||
                    stripos($recruiter['contact'], $this->search) !== false;
                
                $statusMatch = empty($this->statusFilter) || 
                    $recruiter['status'] === $this->statusFilter;
                
                $genderMatch = empty($this->genderFilter) || 
                    $recruiter['gender'] ?? '' === $this->genderFilter;

                return $searchMatch && $statusMatch && $genderMatch;
            });

        return view('livewire.admin.manage-recruiter', [
            'recruiters' => $filteredRecruiters->values(),
            'totalRecruiters' => count($this->recruiters),
            'filteredCount' => count($filteredRecruiters)
        ])->layout('layouts.admin');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
