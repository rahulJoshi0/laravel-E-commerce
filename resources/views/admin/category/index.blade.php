@extends('layouts.admin')

@section('content')
<section class="content-header">
    <h1>
      CategoryList
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{route('category.create')}}"><i class="fa fa-bicycle"></i> AddCategory</a></li>
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
                    {{-- <th>Category Parent Id</th> --}}
                    <th>Name</th>
                    <th>Status</th>
                    <th>Show Menu</th>
                    <th>Short Description</th>
                    <th>Description</th>
                    <th>urlKey</th>
                    <th>Meta Tag</th>
                    <th>Meta Title</th>
                    <th>Meta Description</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            @php
                $i=1;
            @endphp
                @foreach ($categorys as $category)
                <tr>
                    {{-- <td>{{ $category->category_parent_id}}</td> --}}
                    <td>{{ $category->name }}</td>
                    <td>{{ ($category->status=='1')?'enable':'disable' }}</td>
                    <td>{{ ($category->show_in_menu=='1')?'yes':'no' }}</td>
                    <td>{{ $category->short_description }}</td>
                    <td>{{ $category->description }}</td>
                    <td>{{ $category->url_key }}</td>
                    <td>{{ $category->meta_tag }}</td>
                    <td>{{ $category->meta_title }}</td>
                    <td>{{ $category->meta_description }}</td>
                    <td><img src="{{$category->getFirstMediaUrl('image', 'thumb')}}" / width="120px"></td>
                    <td>
                        @can('category_edit')
                            
                        <a href="{{route('category.edit',$category->id)}}"class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i>Edit</a>
                        @endcan
                        @can('category_delete')
                            
                        <form action="{{route('category.destroy',$category->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button  type="delete" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i>DELETE</button>
                        </form>
                        @endcan
                    </td>
            
                    
                </tr>                                                       
                @endforeach    
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>
@endsection