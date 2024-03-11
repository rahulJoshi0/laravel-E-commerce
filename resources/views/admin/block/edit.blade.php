@extends('layouts.admin')

@section('content')
<section class="content-header">
    <h1>
      EditBlock
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
<div class="box-body">
    <form action="{{route('block.update',$blocks->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        {{-- <div class="form-group">
            <label>parent page</label>
            <select name="parent_id" class="form-control">
                <option value="" selected disabled >select</option>
                @foreach ($_page as $page)
                <option value="{{$page->id}}">{{$page->title}}</option>
                    
                @endforeach
            </select>
        </div> --}}
        <div class="form-group">
            <label>Enter identifier</label>
            <input class="form-control" name="identifier" type="text"value="{{$blocks->identifier}}">
        </div>
        <div class="form-group">
            <label>Title</label>
            <input class="form-control" name="title" type="text"value="{{$blocks->title}}">
            
        </div>
        <div class="form-group">
            <label> Heading</label>
            <input class="form-control" name="heading" type="text"value="{{$blocks->heading}}">
        </div>
        <div class="form-group">
            <label> Ordering</label>
            <input class="form-control" name="ordering" type="number"value="{{$blocks->ordering}}">
        </div>


        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control">
                <option></option>
                <option value="1"{{($blocks->status=="1")?"selected":""}}>Enable</option>
                <option value="2"{{($blocks->status=="2")?"selected":""}}>Disable</option>
            </select>
        </div>
        {{-- <div class="form-group">
            <label> UrlKey </label>
            <input class="form-control" name="url_key" type="text" value="{{$blocks->urk_key}}">
        </div> --}}
        <div class="form-group">
            <label>Description </label>
            <textarea name="description" id="editor" cols="30" rows="10">{{$blocks->description}}</textarea>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="form-group">
                            <label class="control-label col-lg-4"><strong>Banner Image</strong></label>
                            <div class="">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <span class="fileupload-preview"></span>
                                    <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-4"></label>
                            <div class="">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;"><img src="{{$blocks->getFirstMediaUrl('image')}}" alt=""></div>
                                    <div>
                                        <span class="btn btn-file btn-success">
                                            <span class="fileupload-new">Select image</span>
                                            <span class="fileupload-exists">Change</span>
                                            <input name="image" type="file" name="image" value="{{$blocks->image}}">
                                        </span>
                                        <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload">Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        
        
        <button class="btn btn-info">Submit </button>

    </form>
</div>
<script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ),{
            ckfinder: {
                uploadUrl: '{{route('ckeditor.upload').'?_token='.csrf_token()}}',
            }
        })
        .catch( error => {
              
        } );
</script>
@endsection
