@extends('layouts.admin')

@section('content')
<section class="content-header">
    <h1>
      SliderList
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
                    <th>Title</th>
                    <th>Ordering</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            
                @foreach ($sliders as $_slider)
                <tbody>
                <tr>
                    <td>{{$_slider->title}}</td>
                    <td>{{$_slider->ordering}}</td>
                    <td>{{($_slider->status=="1")?"Enable":"Disable"}}</td>
                    <td><img src="{{$_slider->getFirstMediaUrl('image', 'thumb')}}" / width="120px"></td>
                    <td>
                        @can('slider_edit')
                            
                        <a href="{{route('slider.edit',$_slider->id)}}"><button name="edit" class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i>Edit</button></a>
                        @endcan
                        @can('slider_delete')
                            
                        <form action="{{route('slider.destroy',$_slider->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button  type="delete" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i>DELETE</button>
                        </form>
                        @endcan
                    </td>
                </tbody>
                    
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