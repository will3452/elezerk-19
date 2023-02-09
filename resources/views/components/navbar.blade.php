<nav class="navbar">
    <img src="img/logo.png" height="50" alt="">
    <ul class="nav-links">
        <input type="checkbox" id="checkbox_toggle" />
        <label for="checkbox_toggle" class="hamburger">&#9776;</label>
        <div class="menu">
            <li><a href="/" class="active">HOME</a></li>
            <li><a href="/about">ABOUT</a></li>
            <li class="announcements"><a href="app/resources/announcements">ANNOUNCEMENTS</a></li>
            <li><a href="/app/dashboards/calendar">BAC SCHEDULES</a></li>
            <li><a href="/">BID RESULTS</a></li>
            @guest
            <li><a href="/register">REGISTER</a></li>
            <li><a href="/app/login">LOGIN</a></li>
            @else
            <li><a href="/app">DASHBOARD</a></li>
            @endguest
        </div>
    </ul>
</nav>
