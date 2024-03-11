@extends('layouts.admin')

@section('content')
<section class="content-header">
    <h1>
        Edit Coupon
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Coupon</li>
    </ol>
</section>
<div class="box-body">
    <form method="POST" action="{{ route('coupons.update', $coupon->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{$coupon->title }}">
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control">
                <option value="1"{{ $coupon->status == 1 ? 'selected' : '' }}>Enable</option>
                <option value="2"{{ $coupon->status == 2 ? 'selected' : '' }}>Disable</option>
            </select>
        </div>

        <div class="form-group">
            <label for="coupon_code">Coupon Code</label>
            <input type="text" class="form-control" id="coupon_code" name="coupon_code" value="{{$coupon->coupon_code}}">
        </div>

        <div class="form-group">
            <label for="valid_from">Valid From</label>
            <input type="datetime-local" class="form-control" id="valid_from" name="valid_from" value="{{  $coupon->valid_from  }}">
        </div>

        <div class="form-group">
            <label for="valid_to">Valid To</label>
            <input type="datetime-local" class="form-control" id="valid_to" name="valid_to" value="{{  $coupon->valid_to }}">
        </div>

        <div class="form-group">
            <label for="discount_amount">Discount Amount</label>
            <input type="text" class="form-control" id="discount_amount" name="discount_amount" value="{{ $coupon->discount_amount }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection