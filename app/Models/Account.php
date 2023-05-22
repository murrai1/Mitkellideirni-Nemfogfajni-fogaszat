<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Account extends Model
{
    use HasFactory;

    protected $fillable=[
        'id',
        'felhnev',
        'password',
        'chategoryid',
    ];
    protected $primaryKey='id';

    public function userchategory()
    {
        return $this->belongsTo(Userchategory::class);
    }

    public function dentist()
    {
        return $this->hasOne(Dentist::class);
    }

    public function assistant()
    {
        return $this->hasOne(Assistant::class);
    }
}
