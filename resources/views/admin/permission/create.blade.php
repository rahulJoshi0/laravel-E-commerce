@extends('layouts.admin')

@section('content')
<form action="{{route('permission.store')}}" method="POST">
  @csrf
    <div class="box-body">
      <div class="form-group">
        <label >Permission</label>
        <input type="text" class="form-control" id="" name="name" placeholder="Enter permission">
        @error('name')
          {{$message}}
        @enderror
      </div>
   
    </div><!-- /.box-body -->

    <div class="box-footer">
      {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
      <button type="submit">Submit</button>  

    </div>
  </form>




<!-- /. PAGE INNER  -->


@endsection