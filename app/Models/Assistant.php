<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assistant extends Model
{
    use HasFactory;

    public function dentist()
    {
        return $this->belongsTo(Dentist::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
