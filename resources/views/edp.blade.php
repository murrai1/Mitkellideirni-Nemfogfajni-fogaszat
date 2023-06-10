@extends('layout')

@section('content')
<h1>Pciens adatainak módosítása</h1>
<div class = "col-sm-6">
  <form method="post" action = "/edp">
    @csrf
    <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Taj szám</label>
      <input type="text" class="form-control" id="taj" name = "taj" value="{{$data->id}}">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Páciens neve</label>
      <input type="text" class="form-control" id="név" name ="név" value="{{$data->name}}">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Páciens születési helye</label>
    <input type="text" class="form-control" id="szülhely" name="szülhely" value="{{$data->birthplace}}">
  </div>
  <div class="form-group">
    <label for="inputAddress2">Páciens születési dátuma</label>
    <input type="date" class="form-control" id="szüldátum" name="szüldátum" value="{{$data->birthdate}}">
  </div>
  <div class="form-group">
    <label for="inputAddress">Páciens Címe</label>
    <input type="text" class="form-control" id="cím" name="cím" value="{{$data->address}}">
  </div>
  <button type="submit" class="btn btn-primary">Módosítás</button>
</form>
</div>
@stop