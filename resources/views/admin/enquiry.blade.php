@extends('layouts.admin')

@section('content')
<section class="content-header">
    <h1>
      EnquiryList
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
                    <th>Sr.No.</th>
                    <th>name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Message</th>
                    <th>Status</th>
                </tr>
            </thead>
            @php
                $i = 1;
            @endphp
                @foreach ($enquiry as $_enq)
                <tbody>
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$_enq->name}}</td>
                    <td>{{$_enq->email}}</td>
                    <td>{{$_enq->phone}}</td>
                    <td>{{$_enq->message}}</td>
                    {{-- <td><img src="{{$_enq->getFirstMediaUrl('image', 'thumb')}}" / width="120px"></td> --}}
                    {{-- <td>
                        <a href="{{route('slider.edit',$_slider->id)}}"><button name="edit" class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i>Edit</button></a>
                        <form action="{{route('slider.destroy',$_slider->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button  type="delete" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i>DELETE</button>
                        </form>
                    </td> --}}
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