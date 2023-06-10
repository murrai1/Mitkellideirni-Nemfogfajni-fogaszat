@extends('layout')

@section('content')
<h3>Páciens adatai</h3>
<div class="col-sm-6">
    <form>
        <div>

            <div class="form-group">
                <label for="formGroupExampleInput">Páciens neve: {{$data['name']}}</label>
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput">Páciens születési dátuma: {{$data['birthdate']}}</label>
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput">Páciens születési helye: {{$data['birthplace']}}</label>
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput">Páciens címe: {{$data['address']}}</label>
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput">Páciens tajszáma:  {{$data['id']}}</label>
            </div>
        </div>
        <div>
        <h4>Páciens időpontjai</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>Dátum</th>
                    <th>Orvos</th>
                    <th>Időpont részletei</th>
                </tr> 
            </thead>
            <tbody>
                @foreach($apdata as $index=>$d)
                <tr>
                    <td>{{$d['date']}}</td>
                    <td>{{$dent[$index]}}</td>
                    <td>
                        @if($d->dentistid === $userId)
                            <a href="/infap/{{$d->id}}"><i class="fa fa-arrow-right"></i></a>
                        @else
                            <a href="#"><i class="fa fa-arrow-right" style='color: red'></i></a>
                        @endif
                    </td>
                </tr>
                @endforeach        
            </tbody>    
        </table>
    </form>
</div>
@stop