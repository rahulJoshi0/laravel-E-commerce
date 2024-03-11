@extends('layouts.admin')

@section('content')

<div class="panel-body">
    <div class="table-responsive">
        @if(session()->has('success'))
         <div id="msg" class="alert alert-success">
             {{session()->get('success')}}
         </div>   
        @endif
        <table class="table table-striped table-bordered table-hover display" id="myTable">
            <thead>
                <tr>
                    <th>sr.no.</th>
                    <th>name</th>
                    <th>Action</th>
                </tr>
            </thead>
            @php
                $i = 1;
            @endphp
                @foreach ($permission as $_perm)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$_perm->name}}</td>
                    <td>
                       @can('permission_edit')
                           
                       <a href="{{route('permission.edit',$_perm->id)}}"><button  name="edit" class="btn btn-primary"><i class="">Edit</button></a>
                        @endcan
                       @can('permission_delete')
                           
                       
                       <form action="{{route('permission.destroy',$_perm->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="dlt" type="delete"  onclick="return confirm('Are you sure?')" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i>DELETE</button>
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