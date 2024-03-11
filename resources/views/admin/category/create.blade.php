@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>Category Add</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Category add</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Catrgory Parent id</label>
                                          <select name="category_parent_id" id="">
                                              <option value="" selected >Select</option>
                                            @foreach (getCatgory() as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                                @foreach (getSubCategory($category->id) as $subCategory )
                                                    <option value="{{$subCategory->id}}">--{{$subCategory->name}}</option>
                                                    @foreach (getSubSubCategory($subCategory->id) as $subsubCategory)
                                                        <option value="{{$subsubCategory->id}}">---{{$subsubCategory->name}}</option>
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                          </select>                                      
                                    </div>
                                    <div class="form-group">
                                        <label>Product name</label>
                                        <input type="text" class="form-control" name="name"  value="{{old('name')}}" placeholder="Enter product name">
                                        @error('name')
                                                {{$message}}
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Select status</label>
                                        <select name="status" class="form-control">
                                            <option value="">Select status</option>
                                            <option value="1"{{old("status")==1?"selected":""}}>Enable</option>
                                            <option value="2"{{old("status")==2?"selected":""}}>Disable</option>
                                        </select>
                                        @error('status')
                                                {{$message}}
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Show Menu</label>
                                        <select name="show_in_menu" class="form-control">
                                            <option value="">Select </option>
                                            <option value="1"{{old("show_in_menu")==1?"selected":""}}>Yes</option>
                                            <option value="2"{{old("show_in_menu")==2?"selected":""}}>No</option>
                                        </select>
                                        @error('show_in_menu')
                                                {{$message}}
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>URL Key</label>
                                        <input type="text" name="url_key" class="form-control"
                                            placeholder="Product url key">
                                    </div>


                                    <div class="form-group">
                                        <label>Short description</label>
                                        <textarea name="short_description" class="form-control" cols="10" rows="2">{{old('short_description')}}</textarea>
                                        @error('short_description')
                                                {{$message}}
                                        @enderror
                                    </div>
                                </div> <!-- col-md-6 end -->

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" id="editor" class="form-control" cols="10" rows="4">{{old('description')}}</textarea>
                                        @error('description')
                                                {{$message}}
                                        @enderror
                                    </div>
                          
                                    <div class="form-group">
                                        <label>Meta tag</label>
                                        <input type="text" name="meta_tag" class="form-control"
                                            placeholder="Product meta tag"value="{{old('meta_tag')}}">
                                            @error('meta_tag')
                                                {{$message}}
                                            @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Meta title</label>
                                        <input type="text" name="meta_title" class="form-control"
                                            placeholder="Product meta title" value="{{old('meta_title')}}">
                                            @error('meta_title')
                                                {{$message}}
                                            @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Meta description</label>
                                        <textarea name="meta_description" class="form-control" cols="30" rows="2">{{old('meta_description')}}</textarea>
                                        @error('meta_description')
                                                {{$message}}
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Products</label> 
                                        <select  name="products[]" multiple>
                                        @foreach ($product as $_product )
                                        <option value="{{$_product->id}}">{{$_product->name}}</option>
                                        @endforeach
                                     </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" class="form-control" name="image[]"  value="{{old('image')}}" placeholder="">
                                        
                                    </div>
                                    <div class="form-group">
                                        <label>thumbnail Image</label>
                                        <input type="file" class="form-control" name="thumbnail_image"  value="{{old('thumbnail_image')}}" placeholder="">
                                        
                                    </div>
                                    <div class="box-footer">
                                        <button type="submit" name = "save" value ="save" class="btn btn-primary">Save</button>
                                        <button type="submit" class="btn btn-primary">Save & New</button>
                                    </div>

                                </div>
                            </div> <!-- row end -->

                        </div><!-- /.box-body -->


                    </form>
                </div><!-- /.box -->
            </div>
        </div>
    </section>
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