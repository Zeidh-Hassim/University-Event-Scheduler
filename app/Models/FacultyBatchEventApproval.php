<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacultyBatchEventApproval extends Model
{
    use HasFactory;

    protected $table = 'faculty_batch_event_approval';

    protected $fillable = [
        'event_id',
        'fasar_status',
        'fbsar_status',
        'ftsar_status',
        'fasdp_status',
        'fbsdp_status',
        'ftsdp_status',
        'marshall_status',
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
