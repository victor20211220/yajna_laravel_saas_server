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
        slidesToShow: 9,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 6,
                }
            },
            {
                breakpoint: 481,
                settings: {
                    slidesToShow: 5,
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
    var prevButton = `<div class="slick-prev slick-arrow gallery-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="12" viewBox="0 0 26 12" fill="none"> <path d="M0 6L10 11.7735V0.226497L0 6ZM9 7H26V5H9V7Z" fill="#E63946"/></svg></div>`
    var nextButton = `<div class="slick-next slick-arrow gallery-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="12" viewBox="0 0 26 12" fill="none"><path d="M0 6L10 11.7735V0.226497L0 6ZM9 7H26V5H9V7Z" fill="#E63946"/> </svg></div>`
    $('.gallery-slider').slick({
        infinite: true,
        speed: 500,
        dots: false,
        arrows: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        prevArrow: $('.slick-prev.gallery-arrow'),
        nextArrow: $('.slick-next.gallery-arrow'),
       
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
    var prevButton = `<div class="slick-prev slick-arrow service-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="12" viewBox="0 0 26 12" fill="none"> <path d="M0 6L10 11.7735V0.226497L0 6ZM9 7H26V5H9V7Z" fill="#E63946"/></svg></div>`
    var nextButton = `<div class="slick-next slick-arrow service-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="12" viewBox="0 0 26 12" fill="none"><path d="M0 6L10 11.7735V0.226497L0 6ZM9 7H26V5H9V7Z" fill="#E63946"/> </svg></div>`
    $('.service-slider').slick({
        infinite: false,
        speed: 500,
        dots: false,
        arrows: true,
        slidesToShow: 2,
        slidesToScroll: 1,
        prevArrow: $('.slick-prev.service-arrow'),
        nextArrow: $('.slick-next.service-arrow'),
        responsive: [
            {
                breakpoint: 481,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });
    // product-sec-slider
     var prevButton = `<div class="slick-prev slick-arrow product-sec-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="12" viewBox="0 0 26 12" fill="none"> <path d="M0 6L10 11.7735V0.226497L0 6ZM9 7H26V5H9V7Z" fill="#E63946"/></svg></div>`
    var nextButton = `<div class="slick-next slick-arrow product-sec-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="12" viewBox="0 0 26 12" fill="none"><path d="M0 6L10 11.7735V0.226497L0 6ZM9 7H26V5H9V7Z" fill="#E63946"/> </svg></div>`
    $('.product-sec-slider').slick({
        infinite: false,
        speed: 500,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        slidesToScroll: 1,
        prevArrow: $('.slick-prev.product-sec-arrow'),
        nextArrow: $('.slick-next.product-sec-arrow'),

    });
    // testimonial-slider
    var prevButton = `<div class="slick-prev slick-arrow testimonial-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="12" viewBox="0 0 26 12" fill="none"> <path d="M0 6L10 11.7735V0.226497L0 6ZM9 7H26V5H9V7Z" fill="#E63946"/></svg></div>`
    var nextButton = `<div class="slick-next slick-arrow testimonial-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="12" viewBox="0 0 26 12" fill="none"><path d="M0 6L10 11.7735V0.226497L0 6ZM9 7H26V5H9V7Z" fill="#E63946"/> </svg></div>`
    $('.testimonial-slider').slick({
        infinite: true,
        speed: 500,
        dots: false,
        arrows: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        prevArrow: $('.slick-prev.testimonial-arrow'),
        nextArrow: $('.slick-next.testimonial-arrow'),
    });
});