<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dentist extends Model
{
    use HasFactory;

    public function appoimntment()
    {
        return $this->hasMany(Appointment::class);
    }

    public function assistant()
    {
        return $this->hasMany(Assistant::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
