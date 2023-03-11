<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApOp extends Model
{
    use HasFactory;

    public function appointment()
    {
        return $this->belongsToMany(Appointment::class);
    }

    public function operation()
    {
        return $this->belongsToMany(Operation::class);
    }
}
