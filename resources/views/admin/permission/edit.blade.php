@extends('layouts.admin')

@section('content')
<form action="{{route('permission.update',$_permission->id)}}" method="POST">
    @method('PUT')
  @csrf
    <div class="box-body">
      <div class="form-group">
        <label >Permission</label>
        <input type="text" class="form-control" id="" name="name" value="{{$_permission->name}}" placeholder="Enter permission">
        @error('name')
            {{$message}}
        @enderror
      </div>
   
    </div><!-- /.box-body -->

    <div class="box-footer">
      {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
      <button type="submit">Update</button>  

    </div>
  </form>




<!-- /. PAGE INNER  -->


@endsection