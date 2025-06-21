<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UniversityEventApproval extends Model
{
    protected $fillable = [
        'event_id',
        'fasar_status',
        'fbsar_status',
        'ftsar_status',
        'marshall_status',
        'proctor_status',
        'vc_status',
        'final_status',
        'rejection_reason',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}

