<!DOCTYPE html>
<html lang="en">

<head>
  <!--====== Required meta tags ======-->
  <meta charset="utf-8" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!--====== Title ======-->
  <title>Dormifind</title>

  <!--====== Favicon Icon ======-->
  <link rel="shortcut icon" href="../assets/images/favicon.svg" type="image/svg" />

  <!--====== Bootstrap css ======-->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" />

  <!--====== Line Icons css ======-->
  <link rel="stylesheet" href="assets/css/lineicons.css" />

  <!--====== Tiny Slider css ======-->
  <link rel="stylesheet" href="assets/css/tiny-slider.css" />

  <!--====== gLightBox css ======-->
  <link rel="stylesheet" href="assets/css/glightbox.min.css" />

  <link rel="stylesheet" href="style.css" />
</head>

<body>
    @include('sweetalert::alert')

<x-navbar></x-navbar>



  <!-- Start header Area -->
  <section id="hero-area" class="header-area header-eight">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 col-md-12 col-12">
          <div class="header-content">
            <h1>DORMIFIND</h1>
            <h4 style="color:white">
                A secure and comfy dorm with reasonably priced.
            </h4>
            <div class="button">
              <a href="#register" class="btn primary-btn">Register now</a>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-12 col-12">
          <div class="header-image">
            <img src="/logo_req.jpg" alt="#" />
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End header Area -->

 <x-about></x-about>



{{--
  <!-- Start Cta Area -->
  <section id="call-action" class="call-action">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xxl-6 col-xl-7 col-lg-8 col-md-9">
          <div class="inner-content">
            <h2>We love to make perfect <br />solutions for your business</h2>
            <p>
              Why I say old chap that is, spiffing off his nut cor blimey
              guvnords geeza<br />
              bloke knees up bobby, sloshed arse William cack Richard. Bloke
              fanny around chesed of bum bag old lost the pilot say there
              spiffing off his nut.
            </p>
            <div class="light-rounded-buttons">
              <a href="javascript:void(0)" class="btn primary-btn-outline">Get Started</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Cta Area --> --}}



  {{-- <!-- Start Latest News Area -->
  <div id="blog" class="latest-news-area section">
    <!--======  Start Section Title Five ======-->
    <div class="section-title-five">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="content">
              <h6>latest news</h6>
              <h2 class="fw-bold">Latest News & Blog</h2>
              <p>
                There are many variations of passages of Lorem Ipsum available,
                but the majority have suffered alteration in some form.
              </p>
            </div>
          </div>
        </div>
        <!-- row -->
      </div>
      <!-- container -->
    </div>
    <!--======  End Section Title Five ======-->
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6 col-12">
          <!-- Single News -->
          <div class="single-news">
            <div class="image">
              <a href="javascript:void(0)"><img class="thumb" src="assets/images/blog/1.jpg" alt="Blog" /></a>
              <div class="meta-details">
                <img class="thumb" src="assets/images/blog/b6.jpg" alt="Author" />
                <span>BY TIM NORTON</span>
              </div>
            </div>
            <div class="content-body">
              <h4 class="title">
                <a href="javascript:void(0)"> Make your team a Design driven company </a>
              </h4>
              <p>
                Lorem Ipsum is simply dummy text of the printing and
                typesetting industry. Lorem Ipsum has been the industry's
                standard.
              </p>
            </div>
          </div>
          <!-- End Single News -->
        </div>
        <div class="col-lg-4 col-md-6 col-12">
          <!-- Single News -->
          <div class="single-news">
            <div class="image">
              <a href="javascript:void(0)"><img class="thumb" src="assets/images/blog/2.jpg" alt="Blog" /></a>
              <div class="meta-details">
                <img class="thumb" src="assets/images/blog/b6.jpg" alt="Author" />
                <span>BY TIM NORTON</span>
              </div>
            </div>
            <div class="content-body">
              <h4 class="title">
                <a href="javascript:void(0)">
                  The newest web framework that changed the world
                </a>
              </h4>
              <p>
                Lorem Ipsum is simply dummy text of the printing and
                typesetting industry. Lorem Ipsum has been the industry's
                standard.
              </p>
            </div>
          </div>
          <!-- End Single News -->
        </div>
        <div class="col-lg-4 col-md-6 col-12">
          <!-- Single News -->
          <div class="single-news">
            <div class="image">
              <a href="javascript:void(0)"><img class="thumb" src="assets/images/blog/3.jpg" alt="Blog" /></a>
              <div class="meta-details">
                <img class="thumb" src="assets/images/blog/b6.jpg" alt="Author" />
                <span>BY TIM NORTON</span>
              </div>
            </div>
            <div class="content-body">
              <h4 class="title">
                <a href="javascript:void(0)">
                  5 ways to improve user retention for your startup
                </a>
              </h4>
              <p>
                Lorem Ipsum is simply dummy text of the printing and
                typesetting industry. Lorem Ipsum has been the industry's
                standard.
              </p>
            </div>
          </div>
          <!-- End Single News -->
        </div>
      </div>
    </div>
  </div>
  <!-- End Latest News Area --> --}}

  {{-- <!-- Start Brand Area -->
  <div id="clients" class="brand-area section">
    <!--======  Start Section Title Five ======-->
    <div class="section-title-five">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="content">
              <h6>Meet our Clients</h6>
              <h2 class="fw-bold">Our Awesome Clients</h2>
              <p>
                There are many variations of passages of Lorem Ipsum available,
                but the majority have suffered alteration in some form.
              </p>
            </div>
          </div>
        </div>
        <!-- row -->
      </div>
      <!-- container -->
    </div>
    <!--======  End Section Title Five ======-->
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2 col-12">
          <div class="clients-logos">
            <div class="single-image">
              <img src="assets/images/client-logo/graygrids.svg" alt="Brand Logo Images" />
            </div>
            <div class="single-image">
              <img src="assets/images/client-logo/uideck.svg" alt="Brand Logo Images" />
            </div>
            <div class="single-image">
              <img src="assets/images/client-logo/ayroui.svg" alt="Brand Logo Images" />
            </div>
            <div class="single-image">
              <img src="assets/images/client-logo/lineicons.svg" alt="Brand Logo Images" />
            </div>
            <div class="single-image">
              <img src="assets/images/client-logo/tailwindtemplates.svg" alt="Brand Logo Images" />
            </div>
            <div class="single-image">
              <img src="assets/images/client-logo/ecomhtml.svg" alt="Brand Logo Images" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Brand Area --> --}}

<x-contact-register></x-contact-register>

  <!-- ========================= map-section end ========================= -->
  <section class="map-section map-style-9">
    <div class="map-container">
      <object style="border:0; height: 500px; width: 100%;"
        data="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3102.7887109309127!2d-77.44196278417968!3d38.95165507956235!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzjCsDU3JzA2LjAiTiA3N8KwMjYnMjMuMiJX!5e0!3m2!1sen!2sbd!4v1545420879707"></object>
    </div>
    </div>
  </section>
  <!-- ========================= map-section end ========================= -->

 <x-footer></x-footer>

   <!--Start of Tawk.to Script-->
   <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/63a1a862b0d6371309d54ecf/1gknnjhd0';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
</script>
<!--End of Tawk.to Script-->

  <a href="#" class="scroll-top btn-hover">
    <i class="lni lni-chevron-up"></i>
  </a>

  <!--====== js ======-->
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/glightbox.min.js"></script>
  <script src="assets/js/main.js"></script>
  <script src="assets/js/tiny-slider.js"></script>



  <script>

    //===== close navbar-collapse when a  clicked
    let navbarTogglerNine = document.querySelector(
      ".navbar-nine .navbar-toggler"
    );
    navbarTogglerNine.addEventListener("click", function () {
      navbarTogglerNine.classList.toggle("active");
    });

    // ==== left sidebar toggle
    let sidebarLeft = document.querySelector(".sidebar-left");
    let overlayLeft = document.querySelector(".overlay-left");
    let sidebarClose = document.querySelector(".sidebar-close .close");

    overlayLeft.addEventListener("click", function () {
      sidebarLeft.classList.toggle("open");
      overlayLeft.classList.toggle("open");
    });
    sidebarClose.addEventListener("click", function () {
      sidebarLeft.classList.remove("open");
      overlayLeft.classList.remove("open");
    });

    // ===== navbar nine sideMenu
    let sideMenuLeftNine = document.querySelector(".navbar-nine .menu-bar");

    sideMenuLeftNine.addEventListener("click", function () {
      sidebarLeft.classList.add("open");
      overlayLeft.classList.add("open");
    });

    //========= glightbox
    GLightbox({
      'href': 'https://www.youtube.com/watch?v=r44RKWyfcFw&fbclid=IwAR21beSJORalzmzokxDRcGfkZA1AtRTE__l5N4r09HcGS5Y6vOluyouM9EM',
      'type': 'video',
      'source': 'youtube', //vimeo, youtube or local
      'width': 900,
      'autoplayVideos': true,
    });

  </script>
</body>

</html>
