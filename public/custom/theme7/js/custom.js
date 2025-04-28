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

    // social-link-slider
    $('.social-link-slider').slick({
        autoplay: true,
        speed: 500,
        dots: false,
        arrows: false,
        slidesToShow: 7,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 481,
                settings: {
                    slidesToShow: 5,
                }
            }
        ]
    });

    // service-slider
    var prevButton = `<div class="slick-prev slick-arrow service-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="12" viewBox="0 0 18 12" fill="none"><path d="M17.5541 6.13037C17.847 5.83747 17.847 5.3626 17.5541 5.06971L12.7811 0.296736C12.4882 0.00384235 12.0133 0.00384235 11.7204 0.296736C11.4275 0.589629 11.4275 1.0645 11.7204 1.3574L15.9631 5.60004L11.7204 9.84268C11.4275 10.1356 11.4275 10.6104 11.7204 10.9033C12.0133 11.1962 12.4882 11.1962 12.7811 10.9033L17.5541 6.13037ZM0.82373 6.35004H17.0237V4.85004H0.82373V6.35004Z" fill="#7E3AE3" /></svg></div>`
    var nextButton = `<div class="slick-next slick-arrow service-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="12" viewBox="0 0 18 12" fill="none"><path d="M17.5541 6.13037C17.847 5.83747 17.847 5.3626 17.5541 5.06971L12.7811 0.296736C12.4882 0.00384235 12.0133 0.00384235 11.7204 0.296736C11.4275 0.589629 11.4275 1.0645 11.7204 1.3574L15.9631 5.60004L11.7204 9.84268C11.4275 10.1356 11.4275 10.6104 11.7204 10.9033C12.0133 11.1962 12.4882 11.1962 12.7811 10.9033L17.5541 6.13037ZM0.82373 6.35004H17.0237V4.85004H0.82373V6.35004Z" fill="#7E3AE3" /></svg></div>`
    $('.service-slider').slick({
        infinite: true,
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

    // gallery-slider
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
    }).on('beforeChange', function (event, slick, currentSlide, nextSlide) {
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

    var prevButton = `<div class="slick-prev slick-arrow gallery-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="12" viewBox="0 0 18 12" fill="none"><path d="M17.5541 6.13037C17.847 5.83747 17.847 5.3626 17.5541 5.06971L12.7811 0.296736C12.4882 0.00384235 12.0133 0.00384235 11.7204 0.296736C11.4275 0.589629 11.4275 1.0645 11.7204 1.3574L15.9631 5.60004L11.7204 9.84268C11.4275 10.1356 11.4275 10.6104 11.7204 10.9033C12.0133 11.1962 12.4882 11.1962 12.7811 10.9033L17.5541 6.13037ZM0.82373 6.35004H17.0237V4.85004H0.82373V6.35004Z" fill="#7E3AE3" /></svg></div>`
    var nextButton = `<div class="slick-next slick-arrow gallery-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="12" viewBox="0 0 18 12" fill="none"><path d="M17.5541 6.13037C17.847 5.83747 17.847 5.3626 17.5541 5.06971L12.7811 0.296736C12.4882 0.00384235 12.0133 0.00384235 11.7204 0.296736C11.4275 0.589629 11.4275 1.0645 11.7204 1.3574L15.9631 5.60004L11.7204 9.84268C11.4275 10.1356 11.4275 10.6104 11.7204 10.9033C12.0133 11.1962 12.4882 11.1962 12.7811 10.9033L17.5541 6.13037ZM0.82373 6.35004H17.0237V4.85004H0.82373V6.35004Z" fill="#7E3AE3" /></svg></div>`
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

    // testimonial-slider
    var prevButton = `<div class="slick-prev slick-arrow testimonial-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="12" viewBox="0 0 18 12" fill="none"><path d="M17.5541 6.13037C17.847 5.83747 17.847 5.3626 17.5541 5.06971L12.7811 0.296736C12.4882 0.00384235 12.0133 0.00384235 11.7204 0.296736C11.4275 0.589629 11.4275 1.0645 11.7204 1.3574L15.9631 5.60004L11.7204 9.84268C11.4275 10.1356 11.4275 10.6104 11.7204 10.9033C12.0133 11.1962 12.4882 11.1962 12.7811 10.9033L17.5541 6.13037ZM0.82373 6.35004H17.0237V4.85004H0.82373V6.35004Z" fill="#7E3AE3" /></svg></div>`
    var nextButton = `<div class="slick-next slick-arrow testimonial-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="12" viewBox="0 0 18 12" fill="none"><path d="M17.5541 6.13037C17.847 5.83747 17.847 5.3626 17.5541 5.06971L12.7811 0.296736C12.4882 0.00384235 12.0133 0.00384235 11.7204 0.296736C11.4275 0.589629 11.4275 1.0645 11.7204 1.3574L15.9631 5.60004L11.7204 9.84268C11.4275 10.1356 11.4275 10.6104 11.7204 10.9033C12.0133 11.1962 12.4882 11.1962 12.7811 10.9033L17.5541 6.13037ZM0.82373 6.35004H17.0237V4.85004H0.82373V6.35004Z" fill="#7E3AE3" /></svg></div>`
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
