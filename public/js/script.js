$(document).ready(() => {
    $(window).scroll(() => {

        if (this.scrollY > 20) {
            $('.navbar').addClass("sticky")
            $('.navbar').css("padding", "10px")
            $('.navbar').css("background", "maroon")
            $('.header-container ul .active').css("color", "#fff")
            $('.header-container ul .active').css("background", "maroon")
            $('.hamburger').css("color", "#fff")
        } else {
            $('.header-container').removeClass("sticky")
            $('.navbar').css("padding", "20px")
            $('.menu-btn').css('text-shadow', '-1px 1px rgba(32, 32, 32, 0.795)')
            $('.menu-btn').css('color', '#fff')
            $('.navbar').css("background", "rgba(128, 0, 0, 0.479)")
            $('.header-container ul .active').css("color", "#000")
            $('.header-container ul .active').css("background", "rgb(243, 203, 26)")
            $('.hamburger').css("color", "#fff")
        }

        this.scrollY > 500 ? $('.scroll-up-btn').addClass("show") : $('.scroll-up-btn').removeClass("show")

    })

    $('.owl-carousel').owlCarousel({
        loop: true,
        nav: true,
        autoplay: true,
        autoplayTimeout: 2000,
        autoplayHoverPause: true,
        dots: true,
        merge:true,
        animateOut: 'fadeOut',
        responsive:{
            678:{
                mergeFit:true,
                dots: true
            },
            1000:{
                mergeFit:false,
                dots: true
            }
        }
    });
    
})

