@extends('layouts.admin')

@section('content')
<form action="{{route('role.store')}}" method="POST">
  @csrf
    <div class="box-body">
      <div class="form-group">
        <label >Role</label>
        <input type="text" class="form-control" id="" name="name" placeholder="Enter role">
        @error('name')
          {{$message}}
        @enderror
      </div>
      <div>
        <label for="">Permissions</label>
        @foreach ($permissions as $_permission )
        <div class="checkbox">
          <input type="checkbox" name="permissions[]" value="{{$_permission->name}}">{{$_permission->name}}
        </div>
        @endforeach
      </div>
   
    </div><!-- /.box-body -->

    <div class="box-footer">
      {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
      <button type="submit">Submit</button>  

    </div>
  </form>




<!-- /. PAGE INNER  -->


@endsection