<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userchategory extends Model
{
    use HasFactory;

    public function account()
    {
        return $this->hasMany(Account::class);
    }
}
