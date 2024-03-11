@extends('layouts.admin')

@section('content')
<section class="content-header">
    <h1>
      BlockList
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
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
        <table class="table table-striped table-bordered table-hover display" id="myTable">
            <thead>
                <tr>
                    <th>SrNo.</th>
                    <th>Identifier</th>
                    <th>Title</th>
                    <th>Heading</th>
                    <th>Ordering</th>
                    <th>Status</th>
                    {{-- <th>UrlKey</th> --}}
                    <th>Image</th>
                    {{-- <th>description</th>  --}}
                    <th>Action</th>
                </tr>
            </thead>
            @php
                $i=1;
            @endphp
                @foreach ($block as $_block)
                <tr>
                    <td>{{$i++.'.'}}</td>
                    <td>{{$_block->identifier}}</td>
                    <td>{{$_block->title}}</td>
                    <td>{{$_block->heading}}</td>
                    <td>{{$_block->ordering}}</td>
                    <td>{{($_block->status=="1")?"Enable":"Disable"}}</td>
                    {{-- <td>{{$_block->url_key}}</td> --}}
                    <td><img src="{{$_block->getFirstMediaUrl('image', 'thumb')}}" / width="120px"></td>

                    <td>{{$_block->description}}</td>
                    <td>
                        @can('block_edit')
                            
                        <a href="{{route('block.edit',$_block->id)}}"class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i>Edit</a>
                        @endcan
                        @can('block_delete')
                            
                        <form action="{{route('block.destroy',$_block->id)}}" method="POST">
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