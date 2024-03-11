@extends('layouts.admin')

@section('content')
<section class="content-header">
    <h1>
      AddCoopon
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
<div class="box-body">
    <form method="POST" action="{{route('coupons.store') }}">
        @csrf
    
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
        </div>
    
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control">
                <option></option>
                <option value="1"{{old('status')==1?'selected':''}}>Enable</option>
                <option value="2"{{old('status')==2?'selected':''}}>Disable</option>
            </select>
        </div>
    
        <div class="form-group">
            <label for="coupon_code">Coupon Code</label>
            <input type="text" class="form-control" id="coupon_code" name="coupon_code" value="{{ old('coupon_code') }}">
        </div>
    
        <div class="form-group">
            <label for="valid_from">Valid From</label>
            <input type="datetime-local" class="form-control" id="valid_from" name="valid_from" value="{{ old('valid_from') }}">
        </div>
    
        <div class="form-group">
            <label for="valid_to">Valid To</label>
            <input type="datetime-local" class="form-control" id="valid_to" name="valid_to" value="{{ old('valid_to') }}">
        </div>
    
        <div class="form-group">
            <label for="discount_amount">Discount Amount</label>
            <input type="amount" class="form-control" id="discount_amount" name="discount_amount" value="{{ old('discount_amount') }}">
        </div>
    
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

 
@endsection
