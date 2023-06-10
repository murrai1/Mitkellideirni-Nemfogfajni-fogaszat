@extends('layout')

@section('content')
<h3>Páciens adatai</h3>
<div class="col-sm-6">
    <form method="post" action="{{ route('otoa', ['id' => $id]) }}">
        @csrf
        <div>
            <div class="form-group">
                <label for="formGroupExampleInput">Páciens neve: {{$data[0]->name}}</label>
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput">Páciens születési dátuma: {{$data[0]->birthdate}}</label>
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput">Páciens születési helye: {{$data[0]->birthplace}}</label>
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput">Páciens címe: {{$data[0]->address}}</label>
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput">Páciens tajszáma: {{$data[0]->patient_id}}</label>
            </div>
        </div>
        <div>
        <h4>Új beavatkozás hozzáadása</h4>
        <div class="form-group col-md-4">
            <label for="inputState">Eljárás</label>
            <select id="op" name="op" class="form-control">
                <option selected></option>
                @foreach($oname as $o)
                <option>{{$o['name']}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Felvétel</button>
        <h4>Időpont során elvégzendő beavatkozások</h4>
        @if(Session::get('succes'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{Session::get('succes')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @elseif(Session::get('fail'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{Session::get('fail')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>Beavatkozás</th>
                    <th>Becsült időtartam</th>
                </tr> 
            </thead>
            <tbody>
                @foreach($opdata as $d)
                <tr>
                    <td>{{$d->name}}</td>
                    <td>{{$d->duration}} perc</td>
                </tr>
                @endforeach        
            </tbody>    
        </table>
    </form>
    <form method="post" action="{{ route('pay', ['id' => $id]) }}">
        <h4>Fizetés</h4>
        @csrf
        <div>
            <button type="submit" class="btn btn-primary">Végösszeg</button>
        </div>
    </form>
    @if(Session::get('Állapot'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{Session::get('Állapot')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
</div>
@stop