<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UniversityEventApproval extends Model
{
    protected $fillable = [
        'event_id',
        'ar_status',
        'marshall_status',
        'proctor_status',
        'vc_status',
        'final_status',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}

