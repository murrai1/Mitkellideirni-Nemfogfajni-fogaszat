@extends('layout')

@section('content')
<h1>Páciens felvétele</h1>
<form method="post" action = "">
@csrf
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Taj szám</label>
      <input type="text" class="form-control" id="inputEmail4" placeholder="Dátum">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Páciens neve</label>
      <input type="text" class="form-control" id="inputPassword4" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Páciens születési helye</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
  </div>
  <div class="form-group">
    <label for="inputAddress2">Páciens születési dátuma</label>
    <input type="date" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
  </div>
  <div class="form-group">
    <label for="inputAddress">Páciens Címe</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
  </div>
  <button type="submit" class="btn btn-primary">Rögzítés</button>
</form>
@stop