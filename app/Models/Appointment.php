<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;


    public function apop()
    {
        return $this->hasMany(ApOp::class);
    }


    public function patient()
    {
        return $this->belongsTo(Patients::class);
    }



    public function dentist()
    {
        return $this->belongsTo(Dentist::class);
    }
}
