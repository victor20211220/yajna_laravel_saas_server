$(document).ready(function () {

    var date = new Date();
    $('.datepicker_min').pickadate({
        min: date,
    });
    // copy text from field
    $('.copy-link').on('click', function () {
        const $button = $(this);
        const linkToCopy = $('.qr-link span').text();

        navigator.clipboard.writeText(linkToCopy).then(() => {
        }).catch(err => {
        console.error('Failed to copy: ', err);
        });
    });
    // video-popup
    $('.video-popup-btn').on('click', function (e) {
        $('.video-popup').addClass('active');
        $('body').addClass('no-scroll');
    });
    $('.video-close').on('click', function (e) {
        $('.video-popup').removeClass('active');
        $('body').removeClass('no-scroll');
    });
    // appointment-popup
    $('.appointment-btn').on('click', function (e) {
        $('.appointment-popup').addClass('active');
        $('body').addClass('no-scroll');
    });
    $('.appointment-close').on('click', function (e) {
        $('.appointment-popup').removeClass('active');
        $('body').removeClass('no-scroll');
    });

    // contact-popup
    $('.contact-info').on('click', function (e) {
        $('.contact-popup').addClass('active');
        $('body').addClass('no-scroll');
    });
    $('.contact-close').on('click', function (e) {
        $('.contact-popup').removeClass('active');
        $('body').removeClass('no-scroll');
    });

    // share-card-popup
    $('.share-info').on('click', function (e) {
        $('.share-card-popup').addClass('active');
        $('body').addClass('no-scroll');
    });
    $('.share-card-close').on('click', function (e) {
        $('.share-card-popup').removeClass('active');
        $('body').removeClass('no-scroll');
    });

    // social-link-slider
    $('.social-link-slider').slick({
        autoplay: true,
        speed: 500,
        dots: false,
        arrows: false,
        rtl: true,
        slidesToShow: 9,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 7,
                }
            },
            {
                breakpoint: 481,
                settings: {
                    slidesToShow: 6,
                }
            }
        ]
    });

    // gallery-slider
    let isSwiping = false;
    $('.gallery-slider').on('touchstart mousedown', function () {
        isSwiping = false;
    }).on('touchmove mousemove', function () {
        isSwiping = true;
    });
    var prevButton = `<div class="slick-prev slick-arrow gallery-arrow"><svg width="26" height="12" viewBox="0 0 26 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M26 6L16 11.7735V0.226497L26 6ZM17 7H0V5H17V7Z" fill="#D7AF57" /></svg></div>`;
    var nextButton = `<div class="slick-next slick-arrow gallery-arrow"><svg width="26" height="12" viewBox="0 0 26 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M26 6L16 11.7735V0.226497L26 6ZM17 7H0V5H17V7Z" fill="#D7AF57" /></svg></div>`;
    $('.gallery-slider').slick({
        infinite: true,
        arrows: true,
        dots: false,
        speed: 500,
        rtl: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        prevArrow: $(".slick-prev.gallery-arrow"),
        nextArrow: $(".slick-next.gallery-arrow"),
    });
    $('.gallery-popup-btn').on('click', function (e) {
        if (isSwiping) {
            e.preventDefault();
            return;
        }
        $('.gallery-popup').addClass('active');
        $('body').addClass('no-scroll');
    });

    $('.gallery-close').on('click', function (e) {
        $('.gallery-popup').removeClass('active');
        $('body').removeClass('no-scroll');
    });

    // service-slider
    var prevButton = `<div class="slick-prev slick-arrow service-arrow"><svg width="26" height="12" viewBox="0 0 26 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M26 6L16 11.7735V0.226497L26 6ZM17 7H0V5H17V7Z" fill="#D7AF57" /></svg></div>`;
    var nextButton = `<div class="slick-next slick-arrow service-arrow"><svg width="26" height="12" viewBox="0 0 26 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M26 6L16 11.7735V0.226497L26 6ZM17 7H0V5H17V7Z" fill="#D7AF57" /></svg></div>`;
    $('.service-slider').slick({
        infinite: true,
        speed: 500,
        dots: false,
        arrows: true,
        rtl: true,
        slidesToShow: 2,
        slidesToScroll: 1,
        prevArrow: $(".slick-prev.service-arrow"),
        nextArrow: $(".slick-next.service-arrow"),
        responsive: [
            {
                breakpoint: 481,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });

    // testimonial-slider
    var prevButton = `<div class="slick-prev slick-arrow service-arrow"><svg width="26" height="12" viewBox="0 0 26 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M26 6L16 11.7735V0.226497L26 6ZM17 7H0V5H17V7Z" fill="#D7AF57" /></svg></div>`;
    var nextButton = `<div class="slick-next slick-arrow service-arrow"><svg width="26" height="12" viewBox="0 0 26 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M26 6L16 11.7735V0.226497L26 6ZM17 7H0V5H17V7Z" fill="#D7AF57" /></svg></div>`;
    $('.testimonial-slider').slick({
        infinite: true,
        speed: 500,
        dots: false,
        arrows: true,
        rtl: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        prevArrow: $(".slick-prev.testimonial-arrow"),
        nextArrow: $(".slick-next.testimonial-arrow"),
    });

});