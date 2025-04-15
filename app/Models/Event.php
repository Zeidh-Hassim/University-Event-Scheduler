<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    
    protected $fillable = ['event_name', 'society', 'date', 'venue', 'time', 'person_id', 'contact', 'email', 'reg_no', 'faculty'];
}