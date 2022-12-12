@include('sweetalert::alert')
<header class="header-area header-padding-1 sticky-bar header-res-padding clearfix">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-2 col-lg-2 col-md-6 col-4">
                <div class="/">
                        <h1>Smart Ecommerce</h1>
                    </a>
                </div>
            </div>
            <div class="col-xl-8 col-lg-8 d-none d-lg-block">
                <div class="main-menu">
                    <nav>
                        <ul>
                            <li><a href="/">Home</a></li>
                            {{-- <li><a href="#"> Shop <i class="fa fa-angle-down"></i> </a>
                                <ul class="mega-menu">
                                    <li>
                                        <ul>
                                            <li class="mega-menu-title"><a href="#">Categories</a></li>
                                            <li><a href="shop.html">Non-Food</a></li>
                                            <li><a href="shop.html">Food</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li> --}}
                            <li><a href="about.html"> About </a></li>
                            <li><a href="contact.html"> Contact</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-6 col-8">
                   <div class="header-right-wrap">
                    <div class="same-style header-search">
                        <a class="search-active" href="#"><i class="pe-7s-search"></i></a>
                        <div class="search-content">
                            <form action="#">
                                <input type="text" placeholder="Search" />
                                <button class="button-search"><i class="pe-7s-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="same-style account-satting">
                        <a class="account-satting-active" href="#"><i class="pe-7s-user-female"></i></a>
                        <div class="account-dropdown">
                            <ul>
                                @guest
                                    <li><a href="/login">Login</a></li>
                                    <li><a href="/register">Register</a></li>
                                @endguest
                                @auth
                                    <li><a href="/home">my account</a></li>
                                @endauth
                            </ul>
                        </div>
                    </div>
                    <div class="same-style header-wishlist">
                        <a href="/wishlist"><i class="pe-7s-like"></i></a>
                    </div>
                    <a href="{{route('carts')}}" class="same-style cart-wrap">
                        <button class="icon-cart">
                            <i class="pe-7s-shopbag"></i>
                            @auth
                                <span class="count-style">{{auth()->user()->cartItems()->count() }}</span>
                            @endauth
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <div class="mobile-menu-area">
            <div class="mobile-menu">
                <nav id="mobile-menu-active">
                    <ul class="menu-overflow">
                        <li><a href="/">HOME</a></li>
                        {{-- <li><a href="shop.html">Shop</a>
                            <ul>
                                <li><a href="#">Categories</a>
                                    <ul>
                                        <li><a href="shop.html">Non-Food</a></li>
                                        <li><a href="shop-filter.html">Food</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li> --}}
                        <li><a href="about.html">About us</a></li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
