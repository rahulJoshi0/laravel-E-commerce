@extends('layouts.admin')

@section('content')
<section class="content-header">
    <h1>
      PageList
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
        <table class="table table-bordered  display" id="myTable">
            <thead>
                <tr>
                    <th>SrNo.</th>
                    <th>Title</th>
                    <th>Heading</th>
                    <th>Ordering</th>
                    <th>Status</th>
                    <th>UrlKey</th>
                    <th>Image</th>
                    {{-- <th>description</th>  --}}
                    <th>Action</th>
                </tr>
            </thead>
            @php
                $i=1;
            @endphp
                @foreach ($pages as $_page)
                <tr>
                    <td>{{$i++.'.'}}</td>
                    <td>{{$_page->title}}</td>
                    <td>{{$_page->heading}}</td>
                    <td>{{$_page->ordering}}</td>
                    <td>{{($_page->status=="1")?"Enable":"Disable"}}</td>
                    <td>{{$_page->url_key}}</td>
                    <td><img src="{{$_page->getFirstMediaUrl('image', 'thumb')}}" / width="120px"></td>

                    {{-- <td>{{$_page->description}}</td> --}}
                    <td>
                        @can('page_edit')
                            
                        <a href="{{route('page.edit',$_page->id)}}"class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i>Edit</a>
                        @endcan
                        @can('page_delete')
                            
                        <form action="{{route('page.destroy',$_page->id)}}" method="POST">
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