@extends('layouts.app')

@section('content')
<form method="POST" action="/UpdateUser/{{$user->id}}" style="height:500px;width:400px;margin:0px auto;">
    {{ csrf_field() }}
    @method('PUT')
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
        <label for="name">Imię i nazwisko</label>
        <input type="text" class="form-control" value="{{$user->name}}" required="required" id="name" name="name">
      </div>
    <br/>
    <div class="form-group">
      <label for="email">Adres Email</label>
      <input type="text" class="form-control" value="{{$user->email}}" id="email" name="email" placeholder="Podaj adres email" required>
    </div>
    <br/>
    <div class="form-group">
      <label for="privilege_level">Poziom uprawnień</label>
      <input type="text" class="form-control" value="{{$user->privilege_level}}" id="privilege_level" name="privilege_level" placeholder="Podaj poziom uprawnień" required>
    </div>
    <br/>
    <br/>
    <div style="text-align:center;">
    <button type="submit" class="btn btn-info">Edytuj użytkownika</button>
    </div>
  </form>
@endsection
