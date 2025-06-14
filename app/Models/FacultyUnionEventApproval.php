<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacultyUnionEventApproval extends Model
{
    use HasFactory;

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
    ];

    // Define the relationship to the Event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
