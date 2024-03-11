<div class="main-top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="text-slid-box">
                    <div id="offer-box" class="carouselTicker">
                        <ul class="offer-box">
                            <li>
                                <i class="fab fa-opencart"></i> Off 10%! Shop Now Man
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> 50% - 80% off on Fashion
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> 20% off Entire Purchase Promo code: offT20
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> Off 50%! Shop Now
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> Off 10%! Shop Now Man
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> 50% - 80% off on Fashion
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> 20% off Entire Purchase Promo code: offT20
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> Off 50%! Shop Now
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="custom-select-box">
                    <select id="basic" class="selectpicker show-tick form-control" data-placeholder="$ USD">
                    <option>¥ JPY</option>
                    <option>$ USD</option>
                    <option>€ EUR</option>
                </select>
                </div>
                <div class="right-phone-box">
                    <p>Call US :- <a href="#"> +11 900 800 100</a></p>
                </div>
                <div class="our-link">
                    <ul>
                        @guest
                        <li class="dropdown megamenu-fw">                         
                            
                                <a href="#" class="" data-toggle="dropdown">My Account</a>
                                <ul class="dropdown-menu" style="background-color:#212529">
                                    {{-- <span style="color:black;"></span> --}}
                                    
                                    <li><a href="{{route('customer.create')}}">Sign UP</a></li>
                                    <li><a href="{{route('customer.login')}}">Sign In</a></li>
                                </ul>  
                            </li>
                        @endguest
                        @auth
                        <li class="dropdown">
                            <a href="#" class="" data-toggle="dropdown">My Account</a>
                            <ul class="dropdown-menu" style="background-color:#212529">
                                <li><a href="{{route('customer.profile')}}">Profile</a></li>
                                <li><a href="{{route('customer.logout')}}">logout</a></li>                              
                            </ul>
                        </li>                  
                        @endauth
                        <li><a href="#">Our location</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>