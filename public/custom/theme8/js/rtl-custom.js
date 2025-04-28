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
    // gallery-slider
    let isSwiping = false; 

    $('.gallery-slider').on('touchstart mousedown', function () {
        isSwiping = false;
    }).on('touchmove mousemove', function () {
        isSwiping = true; 
    });
    $('.gallery-slider').slick({
        infinite: true,
        autoplay: true,
        arrows: false,
        dots: false,
        speed: 500,
        rtl: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        centerMode: true,
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
    var prevButton = `<div class="slick-prev slick-arrow service-arrow"><svg width="8" height="12" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.29179 12L-0.000312328 6L6.29179 0L7.67969 1.32346L2.77547 6L7.67969 10.6765L6.29179 12Z" fill="white"/></svg></div>`
     var nextButton = `<div class="slick-next slick-arrow service-arrow"><svg width="8" height="12" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.29179 12L-0.000312328 6L6.29179 0L7.67969 1.32346L2.77547 6L7.67969 10.6765L6.29179 12Z" fill="white"/></svg></div>`
    $('.service-slider').slick({
        infinite: true,
        autoplay: true,
        speed: 500,
        dots: false,
        arrows: true,
        rtl: true,
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


     // testimonial-slider
     var prevButton = `<div class="slick-prev slick-arrow testimonial-arrow"><svg width="8" height="12" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.29179 12L-0.000312328 6L6.29179 0L7.67969 1.32346L2.77547 6L7.67969 10.6765L6.29179 12Z" fill="white"/></svg></div>`
     var nextButton = `<div class="slick-next slick-arrow testimonial-arrow"><svg width="8" height="12" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.29179 12L-0.000312328 6L6.29179 0L7.67969 1.32346L2.77547 6L7.67969 10.6765L6.29179 12Z" fill="white"/></svg></div>`
     $('.testimonial-slider').slick({
         infinite: true,
         speed: 500,
         dots: false,
         arrows: true,
         rtl: true,
         slidesToShow: 1,
         slidesToScroll: 1,
         prevArrow: $('.slick-prev.testimonial-arrow'),
         nextArrow: $('.slick-next.testimonial-arrow'),
     });

    // social-link-slider
    var prevButton = `<div class="slick-prev slick-arrow social-link-arrow"><svg width="8" height="12" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.29179 12L-0.000312328 6L6.29179 0L7.67969 1.32346L2.77547 6L7.67969 10.6765L6.29179 12Z" fill="white"/></svg></div>`
    var nextButton = `<div class="slick-next slick-arrow social-link-arrow"><svg width="8" height="12" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.29179 12L-0.000312328 6L6.29179 0L7.67969 1.32346L2.77547 6L7.67969 10.6765L6.29179 12Z" fill="white"/></svg></div>`
    $('.social-link-slider').slick({
        infinite: true,
        speed: 500,
        dots: false,
        arrows: true,
        rtl: true,
        slidesToShow: 5,
        slidesToScroll: 1,
        prevArrow: $('.slick-prev.social-link-arrow'),
        nextArrow: $('.slick-next.social-link-arrow'),
    });

});