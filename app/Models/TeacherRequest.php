<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeacherRequest extends Model
{
    protected $guarded = [];


    protected $casts = [
        'subject_ids' => 'array',
    ];

    // Relationship with class category
    public function classCategory(): BelongsTo
    {
        return $this->belongsTo(ClassCategory::class, 'class_id');
    }

    // Relationship with recruiter
    public function recruiter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recruiter_id');
    }

    // Method to get subject names
    public function getSubjectNamesAttribute()
    {
        if (empty($this->subject_ids)) {
            return [];
        }

        return Subject::whereIn('id', $this->subject_ids)
            ->pluck('subject_name')
            ->toArray();
    }

    // Relationship to get subject models
    public function subjects()
    {
        return Subject::whereIn('id', $this->subject_ids);
    }

    // Accessor for formatted notes
    public function getFormattedNotesAttribute()
    {
        if (empty($this->admin_notes)) {
            return [];
        }

        return array_filter(array_map('trim', explode("\n", $this->admin_notes)));
    }

    // Add a new note
    public function addNote($note)
    {
        $currentNotes = $this->admin_notes ?: '';
        $timestamp = now()->format('Y-m-d H:i:s');
        $newNote = "[{$timestamp}] {$note}";

        $this->admin_notes = $currentNotes ? $currentNotes . "\n" . $newNote : $newNote;
        return $this->save();
    }
}
