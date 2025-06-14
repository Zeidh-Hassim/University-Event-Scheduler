<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    
    // protected $fillable = ['event_name', 'society', 'date', 'venue', 'time', 'person_id', 'contact', 'email', 'reg_no', 'faculty'];
    protected $fillable = [
    'event_name',
    'event_Type',
    'faculty',
    'date',
    'venue',
    'start_time',
    'end_time',
    'participants',
    'society',
    'applicant',
    'registration_number',
    'contact',
    'email',
    'status',
];


public function universityEventApproval()
{
    return $this->hasOne(UniversityEventApproval::class, 'event_id');
}

public function facultyUnionEventApproval()
{
    return $this->hasOne(FacultyUnionEventApproval::class, 'event_id');
}

}





