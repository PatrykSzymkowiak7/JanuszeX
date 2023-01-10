@extends('layouts.app')

@section('content')
<form method="POST" action="/StoreWorkHour" style="height:500px;width:400px;margin:0px auto;">
    {{ csrf_field() }}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="form-group">
        <label for="data">Data</label>
        <input type="date" class="form-control" value="{{old('data')}}" required="required" id="data" name="data">
      </div>
    <br/>
    <div class="form-group">
      <label for="godziny">Godziny</label>
      <input type="text" class="form-control" value="{{old('godziny')}}" id="godziny" name="godziny" placeholder="Podaj ilość godzin" required>
    </div>
    <br/>
    <div class="form-group">
      <input type="hidden" class="form-control" value="{{$id}}" id="employee_id" name="employee_id">
    </div>
    <br/>
    <div style="text-align:center;">
    <button type="submit" class="btn btn-success">Dodaj czas pracy</button>
    </div>
  </form>
@endsection
