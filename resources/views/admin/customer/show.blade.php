@extends('layouts.admin')

@section('content')
<section class="content-header">
    <h1>
      customerList
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
                    {{-- <th>order Id</th> --}}
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    {{-- <th>Role</th> --}}
                    <th>Action</th>
                </tr>
            </thead>
            @php
                $i = 1;
            @endphp
                @foreach ($orders as $orderAdd)
                <tr>
                    <td>{{$i++}}</td>
                    {{-- <td>{{$orderaddress->order_id}}</td> --}}
                    <td>{{$orderAdd->name}}</td>
                    <td>{{$orderAdd->email}}</td>
                    <td>{{$orderAdd->phone}}</td>
                    
{{--                   
                    <td>
                        <a href="{{ route('customer.view', $orderAdd->id) }}"
                            class="btn btn-primary btn-success">Show</a>
                    </td> --}}
            
                    
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