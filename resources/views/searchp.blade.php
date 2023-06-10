@extends('layout')

@section('content')
<h2>Páciens keresése</h2>
<div class="col-sm-6">
    <form method="post" action="">
        @csrf
        <div class="form-group">
            <label for="formGroupExampleInput">Név</label>
            <input type="text" class="form-control" id="név" name="név">
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Születési hely</label>
            <input type="text" class="form-control" id="szülhely" name="szülhely">
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Születési dátum</label>
            <input type="date" class="form-control" id="szüldátum" name="szüldátum">
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Taj</label>
            <input type="text" class="form-control" id="taj" name="taj">
        </div>
        <button type="submit" class="btn btn-primary">Keresés</button>
    </form>
</div>
<h2>Páciensek</h2>
@if(Session::get('Állapot'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{Session::get('Állapot')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
<table class="table">
    <thead>
        <tr>
            <th>Taj</th>
            <th>Név</td>
            <th>Szül.hely</th>
            <th>Szül.dátum</th>
            <th>Cím</th>
            <th>Módosítás</th>
            <th>További információk</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $d)
        <tr>
            <th scope="col">{{$d['id']}}</th>
            <td>{{$d['name']}}</td>
            <td>{{$d['birthplace']}}</td>
            <td>{{$d['birthdate']}}</td>
            <td>{{$d['address']}}</td>
            <td>
            <a href="/edp/{{$d->id}}"><i class="fa fa-edit"></i></a>
            </td>
            <td>
            <a href="/infp/{{$d->id}}"><i class="fa fa-arrow-right"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop