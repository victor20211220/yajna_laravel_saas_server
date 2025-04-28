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

    // gallery-popup
    $('.gallery-popup-btn').on('click', function (e) {
        $('.gallery-popup').addClass('active');
        $('body').addClass('no-scroll');
    });
    $('.gallery-close').on('click', function (e) {
        $('.gallery-popup').removeClass('active');
        $('body').removeClass('no-scroll');
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

    // service-slider
    $('.service-slider').slick({
        infinite: false,
        speed: 500,
        dots: true,
        arrows: false,
        slidesToShow: 1,
        slidesToScroll: 1,
    });

    // social-link-slider
    $('.social-link-slider').slick({
        infinite: false,
        speed: 500,
        dots: true,
        arrows: false,
        slidesToShow: 5,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 481,
                settings: {
                    slidesToShow: 5
                }
            }
        ]
    });

    // product-sec-slider
    $('.product-sec-slider').slick({
        infinite: false,
        speed: 500,
        dots: true,
        arrows: false,
        slidesToShow: 1,
        slidesToScroll: 1,
    });

    // gallery-slider
    $('.gallery-slider').slick({
        infinite: false,
        speed: 500,
        dots: true,
        arrows: false,
        slidesToShow: 1,
        slidesToScroll: 1,
    });

    // testimonial-slider
    $('.testimonial-slider').slick({
        infinite: false,
        speed: 500,
        dots: true,
        arrows: false,
        slidesToShow: 1,
        slidesToScroll: 1,
    });

});