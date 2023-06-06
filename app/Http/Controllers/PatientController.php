<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patients;


class PatientController extends Controller
{
    public function show(){
        $data = Patients::all();

        return view('welcome', ['data'=>$data]);

    }
}
