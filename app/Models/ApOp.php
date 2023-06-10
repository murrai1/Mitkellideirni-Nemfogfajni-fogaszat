<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApOp extends Model
{
    use HasFactory;

    
    // Assuming the table name is 'ap_ops'
    protected $table = 'ap_ops';

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointmentid', 'id');
    }

    public function operation()
    {
        return $this->belongsTo(Operation::class, 'operationid', 'id');
    }

    /*
    public function appointment()
    {
        return $this->belongsToMany(Appointment::class);
    }
    
    public function operation()
    {
        return $this->belongsToMany(Operation::class);
    }
    */
}
