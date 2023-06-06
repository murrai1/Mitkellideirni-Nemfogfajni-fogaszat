<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Appointment;
use App\Models\Patients;
use App\Models\Operation;


class MainController extends Controller
{
    
    public function index(){
        return view('main');
    }

    public function appointments(){
        $data = Appointment::all();

        return view('searchap', ['data'=>$data]);
    }

    public function patients(){
        $data = Patients::all();

        return view('searchp', ['data'=>$data]);
    }

    public function operation(){
        $data = Operation::all();

        return view('operation', ['data'=>$data]);
    }

    public function newap(Request $req){
        return $req->input();
    }

    public function login(Request $req){
        return Account::where('username', $req->input('username'))->get();
    }

}
