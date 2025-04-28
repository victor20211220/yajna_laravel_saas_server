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
        infinite: true,
        autoplay: true,
        speed: 500,
        arrows: false,
        slidesToShow: 9,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 575,
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
    $('.gallery-slider').slick({
        speed: 500,
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: true,
            arrows: false,
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
    // product-sec-slider
     $('.product-sec-slider').slick({
        infinite: false,
        speed: 500,
        slidesToShow: 2,
        slidesToScroll: 1,
        dots:true,
        arrows: false,
        responsive: [
            {
                breakpoint: 481,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });
    // service-slider
   $('.service-slider').slick({
        infinite: false,
        speed: 500,
        dots:true,
        arrows: false,
        slidesToShow: 1,
        slidesToScroll: 1,
    });
    // testimonial-slider
    $('.testimonial-content-slider').slick({
        dots: true,
        arrows: false,
        infinite: true,
        loop: true,
        speed: 500,
        slidesToShow: 1,
        slidesToScroll: 1,
        asNavFor: '.testimonial-image-slider',
    });
    $('.testimonial-image-slider').slick({
        arrows: false,
        speed: 500,
        touchMove: true,
        focusOnSelect: true,
        loop: true,
        infinite: true,
        slidesToScroll: 1,
        slidesToShow: 2,
        asNavFor: '.testimonial-content-slider',
        responsive: [
            {
                breakpoint: 481,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });
});