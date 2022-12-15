$(document).ready(() => {
    $(window).scroll(() => {

        if (this.scrollY > 20) {
            $('.header-container').addClass("sticky")
            $('.header-container ul a').css("padding", "10px 15px")
            $('.menu-btn').css('text-shadow', 'none')
            $('.menu-btn').css('color', '#000')
            $('.header-container').css("background", "#fff")
            $('.header-container ul .active').css("color", "#fff")
            $('.header-container ul .active').css("background", "maroon")
        } else {
            $('.header-container').removeClass("sticky")
            $('.header-container ul a').css("padding", "15px 15px")
            $('.menu-btn').css('text-shadow', '-1px 1px rgba(32, 32, 32, 0.795)')
            $('.menu-btn').css('color', '#fff')
            $('.header-container').css("background", "rgba(128, 0, 0, 0.479)")
            $('.header-container ul .active').css("color", "#000")
            $('.header-container ul .active').css("background", "rgb(243, 203, 26)")
        }

        this.scrollY > 500 ? $('.scroll-up-btn').addClass("show") : $('.scroll-up-btn').removeClass("show")

    })
})