@extends('layouts.admin')

@section('content')
<section class="content-header">
    <h1>
      AttributeList
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{route('attribute.create')}}"><i class="fa fa-dashboard"></i> AddAttribute</a></li>
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
                    <th>Is Variant</th>
                    <th>NameKey</th>
                    <th>Actions</th>
                </tr>
            </thead>
            @php
                $i=1;
            @endphp
                @foreach ($attribute as $_attribute)
                <tr>
                    {{-- <td>{{ $category->category_parent_id}}</td> --}}
                    <td>{{ $_attribute->name }}</td>
                    <td>{{ ($_attribute->status=='1')?'enable':'disable' }}</td>
                    <td>{{ ($_attribute->is_variant=='1')?'yes':'no' }}</td>
                    <td>{{ $_attribute->name_key }}</td>
                    
                    <td>
                        @can('attribute_edit')
                            
                        <a href="{{route('attribute.edit',$_attribute->id)}}"class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i>Edit</a>
                        @endcan
                        @can('attribute_delete')
                            
                        <form action="{{route('attribute.destroy',$_attribute->id)}}" method="POST">
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