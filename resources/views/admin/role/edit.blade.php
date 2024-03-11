@extends('layouts.admin')

@section('content')
<form action="{{route('role.update',$_role->id)}}" method="POST">
    @method('PUT')
  @csrf
    <div class="box-body">
      <div class="form-group">
        <label >Role</label>
        <input type="text" class="form-control" id="" value="{{$_role->name}}" name="name" placeholder="Enter role">
        @error('name')
          {{$message}}
        @enderror
      </div>
      <div>
        <label for="">Permissions</label>
        @foreach ( $permissions as $_permission )
        <div class="checkbox">
    <input class="form-control" type="checkbox" name="permissions[]"  value="{{$_permission->name}}" {{in_Array($_permission->name,$permissionName)?'checked':''}}>{{$_permission->name}}
        </div>
    @endforeach
      </div>
    </div><!-- /.box-body -->

    <div class="box-footer">
      {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
      <button type="submit">Update</button>  

    </div>
  </form>




<!-- /. PAGE INNER  -->


@endsection