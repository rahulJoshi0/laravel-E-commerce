@extends('layouts.admin')

@section('content')
<section class="content-header">
  <h1>
    Add User
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>
<div class="col-md-6">
    <form action="{{route('user.store')}}" method="post">
        @csrf
      <div class="form-group">
        <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="name to:"/>
        @error('name')
            {{$message}}
        @enderror
      </div>
      <div class="form-group">
        <input type="email" class="form-control" name="email" value="{{old('email')}}" placeholder="email to"/>
        @error('email')
            {{$message}}
        @enderror
      </div>
      <div>
        @foreach ($roles as $_role)
        <div class ="checkbox">
        <input type="checkbox" class="form-control" name="roles[]" value="{{$_role->name}}" placeholder="role to">{{$_role->name}}
          </div>
        @endforeach
      </div>
      <div class="form-group">
        <input type="password" class="form-control" name="password" value="{{old('password')}}" placeholder="password to"/> 
        @error('password')
            {{$message}}
        @enderror  
      </div>
      <div class="form-group">
        <input type="password" class="form-control" name="confirm_password" value="{{old('confirm_password')}}" placeholder="confirm-password to"/>   
        @error('confirm_password')
            {{$message}}
        @enderror
      </div>
      <div class="form-group">
        <button type="submit">Submit</button>  
      </div>
      <div class="form-group">
        <button value="save & new" type="submit" name="save_new">save & new</button>
      </div>

    </form>
  </div>



 
@endsection
