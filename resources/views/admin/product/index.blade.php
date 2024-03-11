@extends('layouts.admin')

@section('content')
<section class="content-header">
    <h1>
      ProductList
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{route('product.create')}}"><i class="fa fa-dashboard"></i> AddProduct</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
<div class="panel-body">
    <div class="table-responsive">
        @if (session()->has('success'))
         <div id="msg" class="alert alert-success">
             {{session()->get('success')}}
         </div>   
        @endif
        <table class="table table-bordered  display" id="myTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Is Featured</th>
                    <th>SKU</th>
                    <th>Quantity</th>
                    <th>Stock Status</th>
                    <th>Weight</th>
                    <th>Price</th>
                    {{-- <th>Special Price</th>
                    <th>Special Price From</th>
                    <th>Special Price To</th>
                    <th>Short Description</th>
                    <th>Description</th> --}}
                    {{-- <th>Meta Description</th> --}}
                    <th>Related Product</th>
                    {{-- <th>urlKey</th> --}}
                    {{-- <th>urlKey</th> --}}
                    <th>Meta Title</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            @php
                $i=1;
            @endphp
                @foreach ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ ($product->status=='1')?'enable':'disable' }}</td>
                    <td>{{ $product->is_featured ? 'Yes' : 'No' }}</td>
                    <td>{{ $product->sku }}</td>
                    <td>{{ $product->qty }}</td>
                    <td>{{ $product->stock_status ?'instock':'out of stock' }}</td>
                    <td>{{ $product->weight }}</td>
                    <td>${{ $product->price }}</td>
                    {{-- <td>${{ $product->special_price ?? '-' }}</td>
                    <td>{{ $product->special_price_from  }}</td>
                    <td>{{ $product->special_price_to  }}</td>
                    <td>{{ $product->short_description }}</td>
                    <td>{{ $product->description }}</td> --}}
                    {{-- <td>{{ $product->meta_description }}</td> --}}
                    <td>{{ $product->related_product }}</td>
                    {{-- <td>{{ $product->url_key }}</td>
                    <td>{{ $product->meta_tag }}</td> --}}
                    <td>{{ $product->meta_title }}</td>
                    <td><img src="{{$product->getFirstMediaUrl('image', 'thumb')}}" / width="120px"></td>
                    
                    <td>
                        @can('product_edit')
                            
                        <a href="{{route('product.edit',$product->id)}}"class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i>Edit</a>
                        @endcan
                        @can('product_delete')
                            
                        <form action="{{route('product.destroy',$product->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button  type="delete" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i>DELETE</button>
                        </form>
                        @endcan
                    </td>
            
                    
                @endforeach    
            </tr>                                                       
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>
@endsection