<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
</head>
<body>

    <!-- <div class="header-container">
        <ul>
            <a href="#" class="active"><li>HOME</li></a>
            <a href="#" class="menu-btn"><li>ABOUT</li></a>
            <a href="#" class="menu-btn"><li>ANNOUNCEMENTS</li></a>
            <a href="#" class="menu-btn"><li>BAC SCHEDULES</li></a>
            <a href="#" class="menu-btn"><li>BID RESULTS</li></a>
            <a href="#" class="menu-btn"><li>REGISTER</li></a>
        </ul>
    </div> -->

    <x-navbar></x-navbar>

    <div class="landing-image"></div>

    <!-- <div class="announcement-container" id="announcement-carousel">
        <h1>Announcements</h1>
        <center>
            <a href="#">
                <div class="announcement-1">
                    <div class="tag"><span>Announcement</span></div>
                    <div class="announcement-content">
                        <div class="date-posted">
                            <i class="fa-solid fa-calendar-days"></i> Dec 13 2022
                        </div>
                        <div class="announcement-title">
                            <h2>Announcement Test 3</h2>
                        </div>
                    </div>
                </div>
            </a>
        </center>
        <center>
            <a href="#">
                <div class="announcement-2">
                    <div class="tag"><span>Announcement</span></div>
                    <div class="announcement-content">
                        <div class="date-posted">
                            <i class="fa-solid fa-calendar-days"></i> Nov 11 2022
                        </div>
                        <div class="announcement-title">
                            <h2>Announcement Test 2</h2>
                        </div>
                    </div>
                </div>
            </a>
        </center>
        <center>
            <a href="#">
                <div class="announcement-3">
                    <div class="tag"><span>Announcement</span></div>
                    <div class="announcement-content">
                        <div class="date-posted">
                            <i class="fa-solid fa-calendar-days"></i> Jun 05 2022
                        </div>
                        <div class="announcement-title">
                            <h2>Announcement Test 1</h2>
                        </div>
                    </div>
                </div>
            </a>
        </center>
        <center>
            <div class="load-more-announcement">
                <a href="#"><i class="fa-solid fa-angles-down"></i> See more...</a>
            </div>
        </center>
    </div> -->
    <div class="announcement-section announcement-container">
        <h1>Announcements</h1>
        <div class="owl-carousel owl-theme owl-loaded">
            @foreach (\App\Models\Announcement::latest()->take(5)->get() as $item)
                <div>
                    <center data-merge="6">
                        <a href="/app/resources/announcements">
                            <div class="announcement-1" style="background: linear-gradient(to bottom, rgba(245, 246, 252, 0.52), rgba(117, 26, 19, 0.73)),
                            url(/storage/{{$item->image}}) center/cover no-repeat;">
                                <div class="tag"><span>Announcement</span></div>
                                <!-- <img src="img/announcement1.jpg" width="70%" height="400" alt=""> -->
                                <div class="announcement-content">
                                    <div class="date-posted">
                                        <i class="fa-solid fa-calendar-days"></i> {{$item->created_at->format('M d, Y')}}
                                    </div>
                                    <div class="announcement-title">
                                        <h2>{{$item->title}}</h2>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </center>
                </div>
            @endforeach
        </div>
        <center>
            <div class="load-more-announcement">
                <a href="/app/resources/announcements"><i class="fa-solid fa-angles-down"></i> See more...</a>
            </div>
        </center>
    </div>

    <div class="upcoming-schedule">
        <div class="schedule-header">
            <h1>UPCOMING SCHEDULE</h1>
            <a href="/app/dashboards/calendar"><i class="fa-regular fa-calendar-days"></i> View Calendar</a>
        </div>
        @foreach (\App\Models\Event::latest('datetime')->take(10)->get() as $item)
            <a style="text-decoration: none" class="upcoming-container" href="/app/resources/events/{{$item->id}}">
                <div class="calendar-card">
                    <div class="upcoming-card-header">
                        {{$item->datetime->format('d')}}
                    </div>
                    <div class="upcoming-card-body">
                        {{ $item->datetime->format('M Y') }}
                    </div>
                </div>
                <div class="upcoming-title">
                    <h3>{{$item->name}}</h3>
                    <h5>{{$item->category ?? '-'}}</h5>
                </div>
            </a>
        @endforeach
    </div>

    <div class="background background-filter">
        <h1 class="u-non-blurred">About Us</h1>
        <p class="p-non-blurred">
            {{ \Str::limit(conf('about'), 300) }}
        </p>
        <div class="p-non-blurred div">
            <a href="/about">Read More <i class="fa-solid fa-arrow-right"></i></a>
        </div>
    </div>


    <div class="footer">
        <div class="footer-section">
            <h4>CNSC Bids and Awards Committee</h4>
            <span><i class="fa-solid fa-house"></i> {{conf('address')}}</span>
            <span><i class="fa-solid fa-phone"></i> {{conf('phone')}}</span>
            <span><i class="fa-solid fa-envelope"></i> {{conf('email')}}</span>
        </div>
        <div class="footer-section">
            <h4>Resources</h4>
            <span><li>
                <a href="{{conf('link_1')}}">
                    {{conf('link_1', 'label')}}
                </a>
                </li></span>
            <span><li>
                <a href="{{conf('link_2')}}">
                    {{conf('link_2', 'label')}}
                </a>
                </li></span>
            <span><li>
                <a href="{{conf('link_3')}}">
                    {{conf('link_3', 'label')}}
                </a>
                </li></span>
        </div>
        <div class="footer-section">
            <h4>Networks</h4>
            <span><a href="{{conf('facebook')}}" class="fb"><i class="fa-brands fa-facebook"></i> Facebook</a></span>
            <span><a href="{{conf('twiter')}}" class="tw"><i class="fa-brands fa-twitter"></i> Twitter</a></span>
            <span><a href="{{conf('instragram')}}" class="ig"><i class="fa-brands fa-instagram"></i> Instagram</a></span>
        </div>
        <div class="footer-section">
            <center><img src="img/seal.png" alt="" height="100" width="100"></center>
        </div>
    </div>

    <script src="js/script.js"></script>
</body>
</html>
