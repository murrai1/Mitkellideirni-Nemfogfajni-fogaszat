<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Crypt;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Account;
use App\Models\Appointment;
use App\Models\Patients;
use App\Models\Operation;
use App\Models\ApOp;

class MainController extends Controller
{
    
    //főoldal
    public function index(Request $req){
        
        if(session('user')){
            view()->share('userId', Session::get('user')['id']);
        }
        
        $now = Carbon::now()->format('Y-m-d');
        $data = Appointment::whereDate('date', $now)->where('dentistid', Session::get('user')['id'])->get();

        return view('main', ['data'=>$data]);
    }
    //____________________________________________________________________________________________________________________________________________________
    //időpontok
    public function appointments(){
        if(session('user')){
            view()->share('userId', Session::get('user')['id']);
        }
        
        $data = Appointment::where('dentistid', Session::get('user')['id'])->get();
        return view('searchap', ['data'=>$data]);
    }

    public function infap($id){
        if(session('user')){
            view()->share('userId', Session::get('user')['id']);
        }
        $p = DB::table('appointments')
        ->join('patients', 'patients.id', 'appointments.patientid')
        ->select('patients.id as patient_id', 'appointments.id as appointment_id', 'patients.name', 'patients.birthdate', 'patients.birthplace', 'patients.address')
        ->where('appointments.id', $id)
        ->get();

        $op = DB::table('appointments')
        ->join('ap_ops', 'appointments.id', 'ap_ops.appointmentid')
        ->join('operations', 'ap_ops.operationid', 'operations.id')
        ->where('ap_ops.appointmentid', $id)
        ->get();

        $oname = Operation::all();
        return view('appointment', ['data'=>$p,'opdata'=>$op, 'oname'=>$oname, 'id'=>$id]);
    }

    public function pay($id){
        $op = DB::table('appointments')
        ->join('ap_ops', 'appointments.id', 'ap_ops.appointmentid')
        ->join('operations', 'ap_ops.operationid', 'operations.id')
        ->where('ap_ops.appointmentid', $id)
        ->get();
        
        $pay=0;
        foreach($op as $p){
            $pay+= $p->price; 
        }
        session()->flash('Állapot', $pay);
        return redirect()->route('infap', ['id' => $id]);
    }

    public function otoa($id, Request $req)
    {
        if (session('user')) {
            view()->share('userId', Session::get('user')['id']);
        }
        
        $currentAppointment = Appointment::find($id);
        
        $currentAppointmentDate = Carbon::parse($currentAppointment->date);
        
        $currentAppointmentEndTime = $currentAppointmentDate->copy();
        $assignedOperations = ApOp::where('appointmentid', $id)->pluck('operationid');
        foreach ($assignedOperations as $operationId) {
            $operationDuration = Operation::where('id', $operationId)->value('duration');
            $currentAppointmentEndTime->addMinutes($operationDuration);
        }
        
        $selectedOperation = $req->input('op');
        $selectedOperationDuration = Operation::where('name', $selectedOperation)->value('duration');
        
        $nextAppointmentStartTime = Appointment::where('dentistid', $currentAppointment->dentistid)
        ->where('date', '>', $currentAppointment->date)
        ->min('date');
        
        $opStartTime = $nextAppointmentStartTime
        ? Carbon::parse($nextAppointmentStartTime)->subMinutes($selectedOperationDuration + 9)
        : Carbon::parse('17:00')->subMinutes($selectedOperationDuration + 9);
        
        if ($opStartTime->gte($currentAppointmentEndTime)) {
            $opid = Operation::where('name', $selectedOperation)->value('id');
            $apop = new ApOp;
            $apop->appointmentid = $id;
            $apop->operationid = $opid;
            $apop->save();
            $req->session()->flash('success', 'Beavatkozás sikeresen hozzáadva');
        } else {
            $req->session()->flash('fail', 'A beavatkozás ütközik az aktuális időponttal vagy meghaladja a maximális időtartamot.');
        }
        
        return redirect()->route('infap', ['id' => $id]);
    }
    /**/
    public function app(){
        if(session('user')){
            view()->share('userId', Session::get('user')['id']);
        }
        
        $pid = Patients::all();
        $oname = Operation::all();

        return view('newap', ['pid'=>$pid], ['oname'=>$oname]);
    }

    public function searchap(Request $req){
        if(session('user')){
            view()->share('userId', Session::get('user')['id']);
        }
        
        if($req->input('date')==null){
            return redirect('searchap');
        }
        else{
            $d = $req->input('date');
            $data = Appointment::whereDate('date', $d)->where('dentistid', Session::get('user')['id'])->get();
            
            return view('searchap', ['data'=> $data]);
        }
    }

    public function newap(Request $req)
    {
        if (session('user')) {
            view()->share('userId', Session::get('user')['id']);
        }
        
        $apStartTime = Carbon::parse($req->input('idő'));
        $selectedOperation = $req->input('op');
        $selectedOperationDuration = Operation::where('name', $selectedOperation)->value('duration');
        $selectedOperationId = Operation::where('name', $selectedOperation)->value('id');
        $userId = Session::get('user')['id'];
        
        $appointmentEndTime = $apStartTime->copy()->addMinutes($selectedOperationDuration);
        
        if ($appointmentEndTime->gte($apStartTime->copy()->setHour(17)->setMinute(0)->setSecond(0))) {
            $req->session()->flash('Állapot', 'Az időpont meghaladja a maximális időtartamot.');
            return redirect('addap');
        }
        
        $appointments = Appointment::where('dentistid', $userId)->get();
        
        foreach ($appointments as $appointment) {
            $existingStartTime = Carbon::parse($appointment->date);
            
            $existingEndTime = $existingStartTime->copy()->addMinutes($appointment->duration)->addMinutes(10);
            
            if (
                ($apStartTime >= $existingStartTime && $apStartTime < $existingEndTime) ||
                ($appointmentEndTime > $existingStartTime && $appointmentEndTime <= $existingEndTime) ||
                ($apStartTime <= $existingStartTime && $appointmentEndTime >= $existingEndTime)
                ) {
                    $req->session()->flash('Állapot', 'Az időpont ütközik egy másik időponttal.');
                    return redirect('addap');
            }
        }

        $ap = new Appointment;
        $ap->date = $apStartTime;
        $ap->patientid = $req->input('taj');
        $ap->dentistid = $req->input('dent');
        $ap->save();
            
        $ao = new ApOp;
        $ao->operationid = $selectedOperationId;
        $ao->appointmentid = $ap->id;
        $ao->save();        
        $req->session()->flash('Állapot', 'Időpont sikeresen rögzítve');
        return redirect('searchap');
    }
        

    //____________________________________________________________________________________________________________________________________________________
    //beavatkozások
    public function op(){
        if(session('user')){
            view()->share('userId', Session::get('user')['id']);
        }
        
        $data = Operation::all();

        return view('operation', ['data'=>$data]);
    }

    public function newo(Request $req){
        if(session('user')){
            view()->share('userId', Session::get('user')['id']);
        }
        if($req->input('név')==null || $req->input('idő')==null || $req->input('ár')==null){
            return redirect('addo');
        }
        else{
            $op = new Operation;
            $op->name=$req->input('név');
            $op->duration=$req->input('idő');
            $op->price=$req->input('ár');
            $op->save();
            $req->session()->flash('Állapot', 'Beavatkozás felvétele sikeresen megtörtént');
            return redirect('op');
        }
    }

    public function delop($id){
        if(session('user')){
            view()->share('userId', Session::get('user')['id']);
        }

        Operation::find($id)->delete();
        Session()->flash('Állapot', 'Beavatkozás törölve');
        return redirect('op');
    }

    public function edop($id){
        if(session('user')){
            view()->share('userId', Session::get('user')['id']);
        }

        $op = Operation::find($id);
        return view('edop', ['data'=> $op]);
    }

    public function upop(Request $req){
        if(session('user')){
            view()->share('userId', Session::get('user')['id']);
        }

        $op = Operation::find($req->input('id'));
        $op->name=$req->input('név');
        $op->duration=$req->input('idő');
        $op->price=$req->input('ár');
        $op->save();
        $req->session()->flash('Állapot', 'Beavatkozás módosítása sikeresen megtörtént');
        return redirect('op');
    }
    //____________________________________________________________________________________________________________________________________________________
    //páciensek
    public function patients(){
        if(session('user')){
            view()->share('userId', Session::get('user')['id']);
        }
        
        $data = Patients::all();

        return view('searchp', ['data'=>$data]);
    }

    public function searchp(Request $req){
        if(session('user')){
            view()->share('userId', Session::get('user')['id']);
        }
        
        $date = $req->input('szüldátum');
        $name = $req->input('név');
        $id = $req->input('taj');
        $place = $req->input('szülhely');
        if($name==null && $id==null && $date==null && $place==null){
            return redirect('searchp');
        }
        else{
            
            if($id!=null && $name!=null && $place!=null && $date!=null){
                $data = Patients::where('id', $id)->get();
                return view('searchp', ['data'=> $data]);
            }
            else if($name!=null && $place!=null && $date!=null){
                $data = Patients::whereDate('birthdate', $date)->where('name', $name)->where('birthplace', $place)->get();
                return view('searchp', ['data'=> $data]);
            }
            else if($name!=null && $place!=null){
                $data = Patients::where('name', $name)->where('birthplace', $place)->get();
                return view('searchp', ['data'=> $data]);
            }
            else if($name!=null && $date!=null){
                $data = Patients::whereDate('birthdate', $date)->where('name', $name)->get();
                return view('searchp', ['data'=> $data]);
            }
            else if($date!=null && $place!=null){
                $data = Patients::whereDate('birthdate', $date)->where('birthplace', $place)->get();
                return view('searchp', ['data'=> $data]);
            }
            else if($id==null && $place==null && $date==null){
                $data = Patients::where('name', $name)->get();
                return view('searchp', ['data'=> $data]);
            }
            else if($id==null && $name==null && $date==null){
                $data = Patients::where('birthplace', $place)->get();
                return view('searchp', ['data'=> $data]);
            }
            else if($id==null && $place==null && $name==null){
                $data = Patients::whereDate('birthdate', $date)->get();
                return view('searchp', ['data'=> $data]);
            }
        }
    }

    public function newp(Request $req){
        if(session('user')){
            view()->share('userId', Session::get('user')['id']);
        }

        if($req->input('taj')==null || $req->input('név')==null || $req->input('szülhely')==null || $req->input('szüldátum')==null || $req->input('cím')==null){
            return redirect('addp');
        }
        else{
            $id = Patients::find($req->input('taj'));
            if($id!=null){
                return redirect('addp');
            }
            else{
                $patient = new Patients;
                $patient->id=$req->input('taj');
                $patient->name=$req->input('név');
                $patient->birthplace=$req->input('szülhely');
                $patient->birthdate=$req->input('szüldátum');
                $patient->address=$req->input('cím');
                $patient->save();
                $req->session()->flash('Állapot', 'Páciens felvétele sikeresen megtörtént');
                return redirect('searchp');
            }  
        } 
    }

    public function infp($id){
        if(session('user')){
            view()->share('userId', Session::get('user')['id']);
        }
        $p = Patients::find($id);
        $dent = DB::table('appointments')
        ->join('dentists', 'dentists.id', 'appointments.dentistid')
        ->where('patientid', $id)
        ->pluck('dentists.name')
        ->toArray();
        $ap = Appointment::where('patientid', $id)->get();
        return view('patient', ['dent'=>$dent, 'data'=>$p, 'apdata'=>$ap]);
    }

    public function edp($id){
        if(session('user')){
            view()->share('userId', Session::get('user')['id']);
        }

        $p = Patients::find($id);
        return view('edp', ['data'=> $p]);
    }

    public function upp(Request $req){
        if(session('user')){
            view()->share('userId', Session::get('user')['id']);
        }

        $patient = Patients::find($req->input('taj'));
        $patient->id=$req->input('taj');
        $patient->name=$req->input('név');
        $patient->birthplace=$req->input('szülhely');
        $patient->birthdate=$req->input('szüldátum');
        $patient->address=$req->input('cím');
        $patient->save();
        $req->session()->flash('Állapot', 'Páciens adatainak módosítása sikeresen megtörtént');
        return redirect('searchp');
    }
    //____________________________________________________________________________________________________________________________________________________
    //Regisztráció
    /*
    public function reg(Request $req){
        if(session('user')){
            view()->share('userId', Session::get('user')['id']);
        }
        
        $user = new Account;
        $user->username=$req->input('név');
        $user->password=Crypt::encrypt($req->input('password'));
        $user->chategoryid=$req->input('cat');
        $user->save();
        $req->session()->flash('user', $req->input('név'));
        return redirect('home');
    }
    */
    //____________________________________________________________________________________________________________________________________________________
    //login
    public function login(Request $req){
        $now = Carbon::now()->format('Y-m-d');
        $user = Account::where('accounts.username', $req->input('név'))->get();
        
        if($user->isNotEmpty()){
            
            $dent = DB::table('accounts')
            ->join('dentists', 'accounts.id', 'dentists.accountid')
            ->where('dentists.accountid', $user[0]->id)->get();
            if($dent->isNotEmpty()){
                if(Crypt::decrypt($user[0]->password) == $req->input('password')){
                    $data = Appointment::whereDate('date', $now)->where('dentistid', $dent[0]->id)->get();
                    $req->session()->put('user', ['id' => $dent[0]->id, 'name' => $dent[0]->name]);
                    view()->share('userId', $dent[0]->id);
                    return view('main', ['data'=>$data]);
                }
                else{
                    return redirect('login');
                }
            }
            else{
                $assist = DB::table('accounts')
                ->join('assistants', 'accounts.id', 'assistants.accountid')
                ->where('assistants.accountid', $user[0]->id)->get();
                if($assist->isNotEmpty()){
                    if(Crypt::decrypt($user[0]->password) == $req->input('password')){
                        $data = Appointment::whereDate('date', $now)->where('dentistid', $assist[0]->dentistid)->get();
                        $req->session()->put('user', ['id' => $assist[0]->dentistid, 'name' => $assist[0]->name]);
                        view()->share('userId', $assist[0]->dentistid);
                        return view('main', ['data'=>$data]);
                    }
                    else{
                        return redirect('login');
                    }
                }
                else{
                    return redirect('login');
                }
            }
        }
        else{
            return redirect('login');
        }
        
    }
    
    public function logout(){
        Session::flush();
        return redirect('login');
    }
}
