@extends('layout')

@section('content')
<h1>Páciens felvétele</h1>
<div class = "col-sm-6">
  <form method="post" action = "">
    @csrf
    <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Taj szám</label>
      <input type="text" class="form-control" id="taj" name = "taj">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Páciens neve</label>
      <input type="text" class="form-control" id="név" name ="név">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Páciens születési helye</label>
    <input type="text" class="form-control" id="szülhely" name="szülhely">
  </div>
  <div class="form-group">
    <label for="inputAddress2">Páciens születési dátuma</label>
    <input type="date" class="form-control" id="szüldátum" name="szüldátum">
  </div>
  <div class="form-group">
    <label for="inputAddress">Páciens Címe</label>
    <input type="text" class="form-control" id="cím" name="cím">
  </div>
  <button type="submit" class="btn btn-primary">Rögzítés</button>
</form>
</div>
@stop