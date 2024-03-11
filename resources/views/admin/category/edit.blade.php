@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>Category Edit</h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Category edit</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('category.update',$category->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="box-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>parent Name</label>
                                        <select name="parent_id" class="form-control">
                                            <option value="" selected  >select</option>
                                            @foreach (getCatgory() as $_catgory)
                                            <option value="{{$_catgory->category_parent_id}}"{{$_catgory==$category?'selected':''}} >{{$_catgory->name}}</option>
                                                
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Product name</label>
                                        <input type="text" class="form-control" name="name"  value="{{$category->name}}" placeholder="Enter product name">
                                        @error('name')
                                                {{$message}}
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Select status</label>
                                        <select name="status" class="form-control">
                                            <option value="">Select status</option>
                                            <option value="1"{{$category->status==1?"selected":""}}>Enable</option>
                                            <option value="2"{{$category->status==2?"selected":""}}>Disable</option>
                                        </select>
                                        @error('status')
                                                {{$message}}
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Show Menu</label>
                                        <select name="show_in_menu" class="form-control">
                                            <option value="">Select </option>
                                            <option value="1"{{$category->show_in_menu==1?"selected":""}}>Yes</option>
                                            <option value="2"{{$category->show_in_menu==2?"selected":""}}>No</option>
                                        </select>
                                        @error('status')
                                                {{$message}}
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>URL Key</label>
                                        <input type="text" name="url_key" class="form-control"
                                            placeholder="Product url key" value="{{$category->url_key}}">
                                    </div>

                                </div> <!-- col-md-6 end -->

                                <div class="col-md-6">


                                    <div class="form-group">
                                        <label>Short description</label>
                                        <textarea name="short_description" class="form-control" cols="10" rows="2">{{$category->short_description}}</textarea>
                                        @error('short_description')
                                                {{$message}}
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" id="editor" class="form-control" cols="10" rows="4">{{$category->description}}</textarea>
                                        @error('description')
                                                {{$message}}
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Meta tag</label>
                                        <input type="text" name="meta_tag" class="form-control"
                                            placeholder="Product meta tag"value="{{$category->meta_tag}}">
                                            @error('meta_tag')
                                                {{$message}}
                                            @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Meta title</label>
                                        <input type="text" name="meta_title" class="form-control"
                                            placeholder="Product meta title" value="{{$category->meta_title}}">
                                            @error('meta_title')
                                                {{$message}}
                                            @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Meta description</label>
                                        <textarea name="meta_description" class="form-control" cols="30" rows="2">{{$category->meta_description}}</textarea>
                                        @error('meta_description')
                                                {{$message}}
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Products</label> 
                                        <select  name="products[]" multiple>
                                        @foreach ($products as $_product )
                                        <option value="{{$_product->id}}"{{in_array($_product->id, $category->products->pluck('id')->toArray() ?? []) ? 'selected' : ''}}>{{$_product->name}}</option>
                                        @endforeach
                                     </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" class="form-control" name="image[]"  value="{{$category->getMedia('image')}}" placeholder="" multiple>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label>thumbnail Image</label>
                                        <input type="file" class="form-control" name="thumbnail_image"  value="{{$category->getFirstMediaUrl('thumbnail_image')}}" placeholder="">
                                        
                                    </div>
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Save</button>
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
@endsection