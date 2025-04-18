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

    var gallery = $('.gallery-slider');
    gallery.on('init', function (event, slick, currentSlide) {
        var
            cur = $(slick.$slides[slick.currentSlide]),
            next = cur.next(),
            prev = cur.prev();
        prev.addClass('slick-sprev');
        next.addClass('slick-snext');
        cur.removeClass('slick-snext').removeClass('slick-sprev');
        slick.$prev = prev;
        slick.$next = next;
    })
    .on('beforeChange', function (event, slick, currentSlide, nextSlide) {
        console.log('beforeChange');
        var
            cur = $(slick.$slides[nextSlide]);
        console.log(slick.$prev, slick.$next);
        slick.$prev.removeClass('slick-sprev');
        slick.$next.removeClass('slick-snext');
        next = cur.next(),
            prev = cur.prev();
        prev.prev();
        prev.next();
        prev.addClass('slick-sprev');
        next.addClass('slick-snext');
        slick.$prev = prev;
        slick.$next = next;
        cur.removeClass('slick-next').removeClass('slick-sprev');
    });

    var prevButton = `<div class="slick-prev slick-arrow gallery-arrow"><svg width="11" height="18" viewBox="0 0 11 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.02075 9.00381L0.286996 2.26976C0.101581 2.08478 -0.000418663 1.83746 -0.000418663 1.57376C-0.000418663 1.3099 0.101581 1.06273 0.286996 0.877463L0.877044 0.287707C1.06217 0.102146 1.30963 0 1.57334 0C1.83704 0 2.08421 0.102146 2.26948 0.287707L10.2871 8.30517C10.4731 8.49102 10.5749 8.73937 10.5742 9.00337C10.5749 9.26854 10.4732 9.51659 10.2871 9.70259L2.27695 17.7123C2.09168 17.8979 1.84451 18 1.58065 18C1.31695 18 1.06978 17.8979 0.884361 17.7123L0.294459 17.1225C-0.0893946 16.7387 -0.0893946 16.1138 0.294459 15.7301L7.02075 9.00381Z" fill="#68C8D8"/></svg></div>`
    var nextButton = `<div class="slick-next slick-arrow gallery-arrow"><svg width="11" height="18" viewBox="0 0 11 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.02075 9.00381L0.286996 2.26976C0.101581 2.08478 -0.000418663 1.83746 -0.000418663 1.57376C-0.000418663 1.3099 0.101581 1.06273 0.286996 0.877463L0.877044 0.287707C1.06217 0.102146 1.30963 0 1.57334 0C1.83704 0 2.08421 0.102146 2.26948 0.287707L10.2871 8.30517C10.4731 8.49102 10.5749 8.73937 10.5742 9.00337C10.5749 9.26854 10.4732 9.51659 10.2871 9.70259L2.27695 17.7123C2.09168 17.8979 1.84451 18 1.58065 18C1.31695 18 1.06978 17.8979 0.884361 17.7123L0.294459 17.1225C-0.0893946 16.7387 -0.0893946 16.1138 0.294459 15.7301L7.02075 9.00381Z" fill="#68C8D8"/></svg></div>`
    gallery.slick({
        speed: 500,
        arrows: true,
        dots: false,
        focusOnSelect: true,
        infinite: true,
        centerMode: true,
        slidesPerRow: 1,
        slidesToShow: 1,
        slidesToScroll: 1,
        centerPadding: '0',
        swipe: true,
        prevArrow: $('.slick-prev.gallery-arrow'),
        nextArrow: $('.slick-next.gallery-arrow'),
        customPaging: function (slider, i) {
            return '';
        },
    });


    // service-slider
    var prevButton = `<div class="slick-prev slick-arrow service-arrow"><svg width="11" height="18" viewBox="0 0 11 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.02075 9.00381L0.286996 2.26976C0.101581 2.08478 -0.000418663 1.83746 -0.000418663 1.57376C-0.000418663 1.3099 0.101581 1.06273 0.286996 0.877463L0.877044 0.287707C1.06217 0.102146 1.30963 0 1.57334 0C1.83704 0 2.08421 0.102146 2.26948 0.287707L10.2871 8.30517C10.4731 8.49102 10.5749 8.73937 10.5742 9.00337C10.5749 9.26854 10.4732 9.51659 10.2871 9.70259L2.27695 17.7123C2.09168 17.8979 1.84451 18 1.58065 18C1.31695 18 1.06978 17.8979 0.884361 17.7123L0.294459 17.1225C-0.0893946 16.7387 -0.0893946 16.1138 0.294459 15.7301L7.02075 9.00381Z" fill="#68C8D8"/></svg></div>`
    var nextButton = `<div class="slick-next slick-arrow service-arrow"><svg width="11" height="18" viewBox="0 0 11 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.02075 9.00381L0.286996 2.26976C0.101581 2.08478 -0.000418663 1.83746 -0.000418663 1.57376C-0.000418663 1.3099 0.101581 1.06273 0.286996 0.877463L0.877044 0.287707C1.06217 0.102146 1.30963 0 1.57334 0C1.83704 0 2.08421 0.102146 2.26948 0.287707L10.2871 8.30517C10.4731 8.49102 10.5749 8.73937 10.5742 9.00337C10.5749 9.26854 10.4732 9.51659 10.2871 9.70259L2.27695 17.7123C2.09168 17.8979 1.84451 18 1.58065 18C1.31695 18 1.06978 17.8979 0.884361 17.7123L0.294459 17.1225C-0.0893946 16.7387 -0.0893946 16.1138 0.294459 15.7301L7.02075 9.00381Z" fill="#68C8D8"/></svg></div>`
    $('.service-slider').slick({
        infinite: false,
        autoplay: true,
        speed: 500,
        dots: false,
        arrows: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        prevArrow: $('.slick-prev.service-arrow'),
        nextArrow: $('.slick-next.service-arrow'),
      
    });


     // testimonial-slider
     var prevButton = `<div class="slick-prev slick-arrow testimonial-arrow"><svg width="11" height="18" viewBox="0 0 11 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.02075 9.00381L0.286996 2.26976C0.101581 2.08478 -0.000418663 1.83746 -0.000418663 1.57376C-0.000418663 1.3099 0.101581 1.06273 0.286996 0.877463L0.877044 0.287707C1.06217 0.102146 1.30963 0 1.57334 0C1.83704 0 2.08421 0.102146 2.26948 0.287707L10.2871 8.30517C10.4731 8.49102 10.5749 8.73937 10.5742 9.00337C10.5749 9.26854 10.4732 9.51659 10.2871 9.70259L2.27695 17.7123C2.09168 17.8979 1.84451 18 1.58065 18C1.31695 18 1.06978 17.8979 0.884361 17.7123L0.294459 17.1225C-0.0893946 16.7387 -0.0893946 16.1138 0.294459 15.7301L7.02075 9.00381Z" fill="#68C8D8"/></svg></div>`
     var nextButton = `<div class="slick-next slick-arrow testimonial-arrow"><svg width="11" height="18" viewBox="0 0 11 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.02075 9.00381L0.286996 2.26976C0.101581 2.08478 -0.000418663 1.83746 -0.000418663 1.57376C-0.000418663 1.3099 0.101581 1.06273 0.286996 0.877463L0.877044 0.287707C1.06217 0.102146 1.30963 0 1.57334 0C1.83704 0 2.08421 0.102146 2.26948 0.287707L10.2871 8.30517C10.4731 8.49102 10.5749 8.73937 10.5742 9.00337C10.5749 9.26854 10.4732 9.51659 10.2871 9.70259L2.27695 17.7123C2.09168 17.8979 1.84451 18 1.58065 18C1.31695 18 1.06978 17.8979 0.884361 17.7123L0.294459 17.1225C-0.0893946 16.7387 -0.0893946 16.1138 0.294459 15.7301L7.02075 9.00381Z" fill="#68C8D8"/></svg></div>`
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

});