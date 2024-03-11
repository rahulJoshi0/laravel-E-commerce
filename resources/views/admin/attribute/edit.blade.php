@extends('layouts.admin')

@section('content')
<section class="content-header">
    <h1>Attribute Edit</h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Attribute Edit</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="{{ route('attribute.update',$attribute->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                            
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name"  value="{{$attribute->name}}" placeholder="Enter product name">
                                    @error('name')
                                            {{$message}}
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Select status</label>
                                    <select name="status" class="form-control">
                                        <option value="">Select status</option>
                                        <option value="1"{{$attribute->status==1?"selected":""}}>Enable</option>
                                        <option value="2"{{$attribute->status==2?"selected":""}}>Disable</option>
                                    </select>
                                    @error('status')
                                            {{$message}}
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Is Variant</label>
                                    <select name="is_variant" class="form-control">
                                        <option value="">Select </option>
                                        <option value="1"{{$attribute->is_variant==1?"selected":""}}>Yes</option>
                                        <option value="2"{{$attribute->is_variant==2?"selected":""}}>No</option>
                                    </select>
                                    @error('is_variant')
                                            {{$message}}
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Name Key</label>
                                    <input type="text" name="name_key" class="form-control"
                                        placeholder="Product name key">
                                </div>
                             <!-- col-md-6 end -->
                             <table id="tableData">
                                <div>
                                    <label for="">attributes</label>
                                </div>
                                <div>
                                    <tr>
                                        {{-- <th></th> --}}
                                        <th>name</th>
                                        <th>status</th>
                                        <th><button type="button" class="add_more">+</button></th>
                                    </tr>
                                </div>
                                @foreach ($attribute->attribute_value as $attrValue)
                                <td><input type="hidden" name="aid[]" value="{{$attrValue->id}}"></td>
                                    <tr>
                                        {{-- <td></td> --}}
                                    <td><input type="text" name="attribute_name[]" value="{{$attrValue->name}}"></td>
                                   <td> <select name="attribute_status[]"  value=""class="form-control">
                                        <option value="">Action</option>
                                        <option value="1"{{$attrValue->status==1?'selected':''}}>Enable</option>
                                        <option value="2"{{$attrValue->status==2?'selected':''}}>Disable</option>
                                    </select>
                                </td>
                                    <td><button type="button" class="remove">X</button></td> 

                                </tr>
                                @endforeach

                            </table>
                                <div class="box-footer">
                                    <button type="submit" name ="save" value ="save" class="btn btn-primary">Update</button>
                                    <button type="submit" class="btn btn-primary">Save & New</button>
                                </div>
                            </div>
                        </div> <!-- row end -->
                    </div><!-- /.box-body -->
                </form>
            </div><!-- /.box -->
        </div>
    </div>
</section>
<script>
    $(document).ready(function(){
        $(".add_more").click(function(){
            TableRow = `<tr>
                <td><input type="text" name="attribute_name[]"></td>
                <td> <select name="attribute_status[]" class="form-control">
                     <option value="">Select status</option>
                     <option value="1">Enable</option>
                     <option value="2">Disable</option>
                 </select>
             </td>
             <td><button type="button" class="remove">X</button></td> 
            </tr>`;
            $('#tableData').append(TableRow);
        });
        $("#tableData").delegate(".remove","click",function(){
            $(this).closest("tr").remove();
        });
    });
    </script>
@endsection