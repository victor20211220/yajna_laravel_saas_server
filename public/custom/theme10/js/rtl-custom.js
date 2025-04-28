$(document).ready(function () {

    var date = new Date();
    $('.datepicker_min').pickadate({
        min: date,
    });
    // convert color js
    function convertThemeColor() {

        const rootElement = document.querySelector(`:root`);

        const themeColor = getComputedStyle(rootElement).getPropertyValue('--theme-color').trim();

        const hexColor = themeColor.replace(/^#/, '');

        const r = parseInt(hexColor.substring(0, 2), 16);
        const g = parseInt(hexColor.substring(2, 4), 16);
        const b = parseInt(hexColor.substring(4, 6), 16);

        const secondColor = `rgba(${r}, ${g}, ${b}, 0.08)`;

        rootElement.style.setProperty('--second-color', secondColor);
    }

    convertThemeColor();
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
        rtl: true,
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

    // service-slider
      $('.service-slider').slick({
        infinite: true,
        speed: 500,
        dots: true,
        arrows: false,
        rtl: true,
        autoplay: true,
        slidesToShow: 2,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 481,
                settings: {
                    slidesToShow: 1,
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
        arrows: false,
        slidesToShow: 1,
        centerMode: true,
        slidesToScroll: 1,
        dots: true,
        rtl: true,
        autoplay: true,
        responsive: [
            {
                breakpoint: 481,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
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


    // testimonial-slider
    $('.testimonial-content-slider').slick({
        dots: false,
        arrows: false,
        infinite: true,
        loop: true,
        speed: 500,
        rtl: true,
        autoplay: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        asNavFor: '.testimonial-image-slider',
    });
    $('.testimonial-image-slider').slick({
        dots: false,
        arrows: false,
        speed: 500,
        touchMove: true,
        focusOnSelect: true,
        loop: true,
        infinite: true,
        rtl: true,
        centerMode: true,
        centerPadding: 0,
        slidesToScroll: 1,
        slidesToShow: 5,
        autoplay: true,
        asNavFor: '.testimonial-content-slider',
        responsive: [
            {
                breakpoint: 481,
                settings: {
                    slidesToShow: 3,
                }
            }
        ]
    });

});
