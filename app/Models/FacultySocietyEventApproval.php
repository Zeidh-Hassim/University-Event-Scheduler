<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacultySocietyEventApproval extends Model
{
    use HasFactory;

    protected $table = 'faculty_society_event_approval';

    protected $fillable = [
        'event_id',
        'fasar_status',
        'fbsar_status',
        'ftsar_status',
        'fashod_status',
        'fbshod_status',
        'ftshod_status',
        'fasdean_status',
        'fbsdean_status',
        'ftsdean_status',
        'final_status',
        'rejection_reason',
    ];

    // Optional: Relationship to Event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
