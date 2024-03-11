@extends('layouts.front')

@section('content')
    <div class="row">
        <div class="col-xl-5 col-lg-5 col-md-6">
            <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
                @php
                    $i = 1;
                @endphp
                <div class="carousel-inner" role="listbox">
                    @foreach ($products->getMedia('image') as $_product)
                        <div class="carousel-item {{ $i ? 'active' : '' }}"{{ $i = 0 }}> <img class="d-block w-100"
                                src="{{ $_product->geturl() }}" alt="First slide" >
                        </div>
                        {{-- <div class="carousel-item"> <img class="d-block w-100" src="{{asset('images/big-img-02.jpg')}}" alt="Second slide"> </div>
                <div class="carousel-item"> <img class="d-block w-100" src="{{asset('images/big-img-03.jpg')}}" alt="Third slide"> </div> --}}
                    @endforeach

                </div>

                <a class="carousel-control-prev" href="#carousel-example-1" role="button" data-slide="prev">
                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel-example-1" role="button" data-slide="next">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                    <span class="sr-only">Next</span>
                </a>
                <ol class="carousel-indicators">
                    @foreach ($products->getMedia('image') as $_product)
                        <li data-target="#carousel-example-1" data-slide-to="0" class="active">
                            <img class="d-block w-100 img-fluid" src="{{ $_product->geturl() }}" alt="" style="height:100px" />
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
        <div class="col-xl-7 col-lg-7 col-md-6">
            <div class="single-product-details">
                <h2>{{ $products->name }}</h2>
                @if ($products->special_price)
                    <h5>{{ $products->price }}</h5>
                    <del>{{ $products->special_price }}</del>
                @else
                    <h5>{{ $products->price }}</h5>
                @endif

                <p class="available-stock"><span> More than {{ $products->qty }}+ available / <a href="#">8 sold
                        </a></span>
                <p>
                <h4>Short Description:</h4>
                <p>Nam sagittis a augue eget scelerisque. Nullam lacinia consectetur sagittis. Nam sed neque id eros
                    fermentum dignissim quis at tortor. Nullam ultricies urna quis sem sagittis pharetra. Nam erat turpis,
                    cursus in ipsum at,
                    tempor imperdiet metus. In interdum id nulla tristique accumsan. Ut semper in quam nec pretium. Donec
                    egestas finibus suscipit. Curabitur tincidunt convallis arcu. </p>
                <ul>
              
                    <form action="{{ route('cart.store', $products->id) }}" method="post">
                        <ul>
                            @csrf
                            @foreach ($attributes as $key => $attribute)
                                <li>
                                    <div class="form-group size-st">
                                        <label class="size-label bold"><strong><b>{{ $key }}</b></strong></label>
                                        <select id="basic" name="attribute_value[{{ $key }}]"
                                            class="selectpicker show-tick form-control">
                                            @foreach ($attribute as $value)
                                                <option value="{{ $value->name }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </li>
                            @endforeach
                            <li>
                                <div class="form-group quantity-box">
                                    <label class="control-label">Quantity</label>
                                    <input class="form-control" value="1" min="0" max="20" type="number"
                                        name="cart_item">
                                </div>
                            </li>
                        </ul>

                        <div class="price-box-bar">
                            <div class="cart-and-bay-btn">
                                <button type="submit" style="color: #ffff" class="btn hvr-hover" data-fancybox-close="">Add
                                    to cart</button>
                            </div>
                        </div>
                    </form>
                </ul>

                    <div class="add-to-btn">
                        <div class="add-comp">
                            <div class="cart-and-bay-btn">
                                <form action="{{ route('wishlist.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id ?? '' }}">
                                    <input type="hidden" name="product_id" value="{{ $products->id }}">
                                    <button type="submit" class="btn hvr-hover" style="color: #fff" id="wishlist_btn"
                                        data-toggle="tooltip" data-placement="right"><i class="far fa-heart"></i> Add to
                                        wishlist</button>
                                </form>
                            </div>
                            <a class="btn hvr-hover" href="#"><i class="fas fa-sync-alt"></i> Add to Compare</a>
                        </div>
                        <div class="share-bar">
                            <a class="btn hvr-hover" href="#"><i class="fab fa-facebook" aria-hidden="true"></i></a>
                            <a class="btn hvr-hover" href="#"><i class="fab fa-google-plus"
                                    aria-hidden="true"></i></a>
                            <a class="btn hvr-hover" href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                            <a class="btn hvr-hover" href="#"><i class="fab fa-pinterest-p"
                                    aria-hidden="true"></i></a>
                            <a class="btn hvr-hover" href="#"><i class="fab fa-whatsapp" aria-hidden="true"></i></a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <div class="products-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>Featured Products</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet lacus enim.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="special-menu text-center">
                        <div class="button-group filter-button-group">
                            <button class="active" data-filter="*">All</button>
                            <button data-filter=".top-featured">Top featured</button>
                            <button data-filter=".best-seller">Best seller</button>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="row special-list">
                @foreach (getRelatedProduct($products->related_product) as $relatdproduct)

                    
                <div class="col-lg-3 col-md-6 special-grid best-seller">
                    <div class="products-single fix">
                        <div class="box-img-hover">
                            <div class="type-lb">
                                <p class="sale">Sale</p>
                            </div>
                            <img src="{{ $relatdproduct->getFirstMediaUrl('thumbnail_image') }}" class="img-fluid" alt="Image" style="height:250px">
                            <div class="mask-icon">
                                <ul>
                                    <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                                    <li>
                                        <form action="{{ route('wishlist.store') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="user_id"
                                                value="{{ Auth::user()->id ?? '' }}">
                                            <input type="hidden" name="product_id" value="{{ $products->id }}">
                                            <button type="submit" class="btn hvr-hover" style="color: #fff"
                                                id="wishlist_btn" data-toggle="tooltip" data-placement="right"><i
                                                    class="far fa-heart"></i> Add to wishlist</button>
                                        </form>
                                    </li>
                                </ul>
                                <a class="cart" href="#">Add to Cart</a>
                            </div>
                        </div>
                        <div class="why-text">
                            <h4>{{ getProductSpecialPrice($relatdproduct->id) }}</h4>
                        </div>
                    </div>
                </div>
                @endforeach
    
            </div>
        </div>
    </div>
    </div>
@endsection
