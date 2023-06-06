@extends('layout')

@section('content')
<h2>Páciens keresése</h2>
<div class="col-sm-6">
    <form>
        <div class="form-group">
            <label for="formGroupExampleInput">Név</label>
            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Név">
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Születési hely</label>
            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Születési hely">
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Születési dátum</label>
            <input type="date" class="form-control" id="formGroupExampleInput" placeholder="Születési dátum">
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Taj</label>
            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Taj">
        </div>
        <button type="submit" class="btn btn-primary">Keresés</button>
    </form>
</div>
<h2>Páciens módosítása</h2>
<div class="col-sm-6">
    <form>
        <div class="form-group col-md-4">
            <label for="inputState">Módosítandó Páciens</label>
            <select id="inputState" class="form-control">
                <option selected>Choose...</option>
                <option>...</option>
                <option>....</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Kiválaszt</button>
    </form>
</div>
<h2>Páciensek</h2>
<table border="1">
<tr>
        <td>Név</td>
        <td>Szül.hely</td>
        <td>Szül.dátum</td>
        <td>Cím</td>
        <td>Taj</td>
    </tr>

    @foreach($data as $d)
    <tr>
        <td>{{$d['name']}}</td>
        <td>{{$d['birthplace']}}</td>
        <td>{{$d['birthdate']}}</td>
        <td>{{$d['address']}}</td>
        <td>{{$d['id']}}</td>
    </tr>
    @endforeach
</table>
@stop