@extends('layouts.admin')

@section('content')
<section class="content-header">
    <h1>
      UserList
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
                    <th>Name</th>
                    <th>Email</th>
                    {{-- <th>password</th> --}}
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            @php
                $i = 1;
            @endphp
                @foreach ($user as $_user)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$_user->name}}</td>
                    <td>{{$_user->email}}</td>
                    <td>{{implode(',',$_user->roles->pluck('name')->toArray())}}</td>
                  
                    <td>
                       @can('user_edit')
                           
                       <a href="{{route('user.edit',$_user->id)}}"><button  name="edit" class="btn btn-primary"><i class="">Edit</button></a>
                        @endcan
                       @can('user_delete')
                           
                       
                       <form action="{{route('user.destroy',$_user->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="dlt" type="delete" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i>DELETE</button>
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