@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>Product Edit</h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Product edit</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('product.update',$product->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="box-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Product name</label>
                                        <input type="text" class="form-control" name="name"  value="{{$product->name}}" placeholder="Enter product name">
                                        @error('name')
                                                {{$message}}
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Select status</label>
                                        <select name="status" class="form-control">
                                            <option value="">Select status</option>
                                            <option value="1"{{$product->status==1?"selected":""}}>Enable</option>
                                            <option value="2"{{$product->status==2?"selected":""}}>Disable</option>
                                        </select>
                                        @error('status')
                                                {{$message}}
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Is featured</label>
                                        <select name="is_featured" class="form-control">
                                            <option value="">Select featured</option>
                                            <option value="1"{{$product->is_featured==1?"selected":""}}>Yes</option>
                                            <option value="2"{{$product->is_featured==2?"selected":""}}>No</option>
                                        </select>
                                        @error('is_featured')
                                                {{$message}}
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label>Stock Keeping Unit(sku)</label>
                                        <input type="text" class="form-control" name="sku" step="any"value="{{$product->sku}}" placeholder="Product sku">
                                        @error('sku')
                                                {{$message}}
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Quantity (qty)</label>
                                        <input type="number" class="form-control" step="any" name="qty"value="{{$product->qty}}" placeholder="Product qty">
                                        @error('qty')
                                                {{$message}}
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Stock status</label>
                                        <select name="stock_status" class="form-control">
                                            <option value="">Stock Status</option>
                                            <option value="1"{{$product->stock_status==1?'selected':''}}>In Stock</option>
                                            <option value="2"{{$product->stock_status==2?'selected':''}}>Out of Stock</option>
                                        </select>
                                        @error('stock_status')
                                                {{$message}}
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Weight</label>
                                        <input type="number" class="form-control" step="any" value="{{$product->weight}}" name="weight"
                                            placeholder="Product weight">
                                            @error('weight')
                                                {{$message}}
                                            @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="number" class="form-control" step="any" name="price" value="{{$product->price}}"placeholder="Product price">
                                        @error('price')
                                                {{$message}}
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Special price</label>
                                        <input type="number" class="form-control" step="any" name="special_price"
                                            placeholder="Product special price" value="{{$product->special_price}}">
                                    </div>

                                    <div class="form-group">
                                        <label>URL Key</label>
                                        <input type="text" name="url_key" class="form-control"
                                            placeholder="Product url key" value="{{$product->url_key}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" class="form-control" name="image[]"  value="{{$product->getMedia('image')}}" placeholder="" multiple>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label>thumbnail Image</label>
                                        <input type="file" class="form-control" name="thumbnail_image"  value="{{$product->getFirstMediaUrl('thumbnail_image')}}" placeholder="">
                                        
                                    </div>
                                </div> <!-- col-md-6 end -->

                                <div class="col-md-6">





                                    <div class="form-group">
                                        <label>Special price from</label>
                                        <input type="date" class="form-control" name="special_price_from" value="{{$product->special_price_from}}">
                                    </div>

                                    <div class="form-group">
                                        <label>Special price to</label>
                                        <input type="date" class="form-control" name="special_price_to" value="{{$product->special_price_to}}">
                                    </div>

                                    <div class="form-group">
                                        <label>Short description</label>
                                        <textarea name="short_description" class="form-control" cols="10" rows="2">{{$product->short_description}}</textarea>
                                        @error('short_description')
                                                {{$message}}
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" id="editor" class="form-control" cols="10" rows="4">{{$product->description}}</textarea>
                                        @error('description')
                                                {{$message}}
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Related Product</label>
                                        <select name="related_product[]" class="form-control" multiple>
                                            @foreach ($relatedPdr as $_product)
                                                
                                            <option value="{{$_product->id}}"{{in_array($_product->id,explode(', ', $product->related_product)?? []) ? 'selected' : ''}}>{{$_product->name}}</option>
                                            @endforeach
                                           
                                        </select>
                                            @error('related_product')
                                                {{$message}}
                                            @enderror
                                    </div>



                                    <div class="form-group">
                                        <label>Meta tag</label>
                                        <input type="text" name="meta_tag" class="form-control"
                                            placeholder="Product meta tag"value="{{$product->meta_tag}}">
                                            @error('meta_tag')
                                                {{$message}}
                                            @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Meta title</label>
                                        <input type="text" name="meta_title" class="form-control"
                                            placeholder="Product meta title" value="{{$product->meta_title}}">
                                            @error('meta_title')
                                                {{$message}}
                                            @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Meta description</label>
                                        <textarea name="meta_description" class="form-control" cols="30" rows="2">{{$product->meta_description}}</textarea>
                                        @error('meta_description')
                                                {{$message}}
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Categories</label> 
                                        <select  name="categories[]" multiple>
                                        @foreach ($categories as $_category )
                                        <option value="{{$_category->id}}"{{in_array($_category->id, $product->categories->pluck('id')->toArray() ?? []) ? 'selected' : ''}}>{{$_category->name}}</option>
                                        @endforeach
                                     </select>
                                    </div>
                                    @foreach (getattribute() as $attribute) 
                                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                                        {{-- <label>Categories</label>  --}}
                                        <input type="hidden" name="attribute[]" value="{{$attribute->id}}">{{$attribute->name}}
                                        <select  name="value[{{$attribute->id}}][]" multiple>
                                            @foreach ($attribute->attribute_value as  $_attribute )
                                            <option value="{{$_attribute->id}}">{{$_attribute->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @endforeach
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