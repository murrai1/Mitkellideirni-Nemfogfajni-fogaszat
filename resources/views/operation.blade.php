@extends('layout')

@section('content')
<h2>Beavatkozás hozzáadása</h2>
<div class="col-sm-6">
    <form>
        <div class="form-group">
            <label for="formGroupExampleInput">Név</label>
            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Név">
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Időtartam(perc)</label>
            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Születési hely">
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Ár</label>
            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Születési dátum">
        </div>
        <button type="submit" class="btn btn-primary">Felvétel</button>
    </form>
</div>
<h2>Beavatkozás törlése</h2>
<div class="col-sm-6">
    <form>
        <div class="form-group col-md-4">
            <label for="inputState">Törölni kívánt beavatkozás</label>
            <select id="inputState" class="form-control">
                <option selected>Choose...</option>
                <option>...</option>
                <option>....</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Törlés</button>
    </form>
</div>
<h2>Beavatkozás módosítása</h2>
<div class="col-sm-6">
    <form>
        <div class="form-group col-md-4">
            <label for="inputState">Módosítandó beavatkozás</label>
            <select id="inputState" class="form-control">
                <option selected>Choose...</option>
                <option>...</option>
                <option>....</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Kiválaszt</button>
    </form>
</div>
<h2>Beavatkozások</h2>
<table border="1">
<tr>
        <td>Név</td>
        <td>Időtartam</td>
        <td>Ár</td>
    </tr>

    @foreach($data as $d)
    <tr>
        <td>{{$d['name']}}</td>
        <td>{{$d['duration']}}</td>
        <td>{{$d['price']}}</td>
    </tr>
    @endforeach
</table>
@stop