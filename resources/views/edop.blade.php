@extends('layout')

@section('content')
<h1>Beavatkozás módosítása</h1>
<div class="col-sm-6">
    <form method="post" action="/edop">
    @csrf
        <div class="form-group">
            <label for="formGroupExampleInput">Név</label>
            <input type="hidden" name="id" value="{{$data->id}}">
            <input type="text" class="form-control" id="név" name="név" value="{{$data->name}}">
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Időtartam(perc)</label>
            <input type="text" class="form-control" id="idő" name="idő" value="{{$data->duration}}">
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Ár</label>
            <input type="text" class="form-control" id="ár" name="ár" value="{{$data->price}}">
        </div>
        <button type="submit" class="btn btn-primary">Módosítás</button>
    </form>
</div>
@stop