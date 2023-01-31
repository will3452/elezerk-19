<header class="header-area header-in-container clearfix">
    <div class="header-bottom sticky-bar header-res-padding">
        <div class="container">
            <div class="row">
                <div class="col-xl-2 col-lg-2 col-md-6 col-4">
                    <div class="logo">
                        <a href="/">
                            <img alt="" style="max-width:200px" src="/logo.png">
                        </a>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-8 d-none d-lg-block">
                    <div class="main-menu">
                        <nav>
                            <ul>
                                <li><a href="/home">Dashboard</a></li>
                                <li><a href="/bookings"> Bookings </a></li>
                                <li><a href="#"> FAQ</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-6 col-8">
                       <div class="header-right-wrap">
                        <div class="same-style header-search">
                            <a class="search-active" href="#"><i class="pe-7s-search"></i></a>
                            <div class="search-content">
                                <form action="/">
                                    <input type="text"  name="keyword" placeholder="Search" />
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
                                    <li><a href="/logout">Logout</a></li>
                                    @endauth
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mobile-menu-area">
                <div class="mobile-menu">
                    <nav id="mobile-menu-active">
                        <ul class="menu-overflow">
                            <li><a href="/home">Dashboard</a></li>
                            <li><a href="/bookings"> Bookings </a></li>
                            <li><a href="contact.html">FAQ</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
