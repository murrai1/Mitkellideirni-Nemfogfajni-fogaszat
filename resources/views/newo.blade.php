@extends('layout')

@section('content')
<h1>Beavatkozás hozzáadása</h1>
<div class="col-sm-6">
    <form method="post" action="">
    @csrf
        <div class="form-group">
            <label for="formGroupExampleInput">Név</label>
            <input type="text" class="form-control" id="név" name="név">
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Időtartam(perc)</label>
            <input type="text" class="form-control" id="idő" name="idő">
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Ár</label>
            <input type="text" class="form-control" id="ár" name="ár">
        </div>
        <button type="submit" class="btn btn-primary">Felvétel</button>
    </form>
</div>
@stop