@extends('layouts.admin')

@section('content')
<div class="box-body">
    <form action="{{route('user.update',$_user->id)}}" method="POST">
        @method('PUT')
        @csrf
      <div class="form-group">
        <input type="text" class="form-control" name="name" value="{{$_user->name}}" placeholder="name to:"/>
        @error('name')
            {{$message}}
        @enderror
      </div>
      <div class="form-group">
        <input type="email" class="form-control" name="email" value="{{$_user->email}}" placeholder="email to"/>
        @error('email')
            {{$message}}
        @enderror
      </div>
      <div>
        @foreach ($roles as $_role)
        <div class ="checkbox">
        <input type="checkbox" class="form-control" name="roles[]" value="{{$_role->name}}" {{(in_Array($_role->name,$roleName)?'checked':'')}} placeholder="role to">{{$_role->name}}
          </div>
        @endforeach
      </div>
      <div class="form-group">
        <input type="password" class="form-control" name="password" value="" placeholder="password to"/> 
        @error('password')
            {{$message}}
        @enderror  
      </div>
      <div class="form-group">
        <input type="password" class="form-control" name="confirm_password" value="" placeholder="confirm-password to"/>   
        @error('confirm_password')
            {{$message}}
        @enderror
      </div>
      <div class="form-group">
        <button type="submit">Submit</button>  
      </div>

    </form>
  </div>



 
@endsection
