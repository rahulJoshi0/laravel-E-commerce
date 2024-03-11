@extends('layouts.admin')

@section('content')
<section class="content-header">
    <h1>
      AddSlider
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
<div class="box-body">
    <form role="form" action="{{route('slider.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label> Title</label>
            <input class="form-control" name="title" type="text" >
        </div>
        <div class="form-group">
            <label> Ordering</label>
            <input class="form-control" name="ordering" type="number" >
        </div>
     
        <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="status">
                    <option value="">select</option>
                    <option value="1">enable</option>
                    <option value="2">disable</option>                                                
                </select>
            </div>
        {{-- <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;"></div> --}}
        <div class="form-group">
            <label class="control-label col-lg-4"></label>
            <div class="">
                <div class="fileupload fileupload-new" data-provides="fileupload">
                    <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;"></div>
                        <div>
                            <span class="btn btn-file btn-success">
                                <span class="fileupload-new">Select image</span>
                                <span class="fileupload-exists">Change</span>
                                <input  type="file" name="image">
                            </span>
                            <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="btn btn-info">Save</button>
    </form>
</div>



 
@endsection
