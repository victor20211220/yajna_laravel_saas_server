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

    // gallery-slider
    $('.gallery-slider').slick({
        infinite: true,
        autoplay: true,
        arrows: false,
        rtl: true,
        dots: false,
        speed: 500,
        slidesToShow: 1,
        slidesToScroll: 1,
    });

    // service-slider
    $('.service-slider').slick({
        infinite: true,
        autoplay: true,
        speed: 500,
        rtl: true,
        dots: false,
        arrows: false,
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

    // product-sec-slider
    $('.product-sec-slider').slick({
        infinite: true,
        autoplay: true,
        speed: 500,
        rtl: true,
        dots: false,
        arrows: false,
        slidesToShow: 1,
        slidesToScroll: 1,
    });

    // testimonial-slider
    $('.testimonial-slider').slick({
        infinite: true,
        autoplay: true,
        speed: 500,
        dots: false,
        rtl: true,
        arrows: false,
        slidesToShow: 1,
        slidesToScroll: 1,
    });

    // social-link-slider
    var prevButton = `<div class="slick-prev slick-arrow social-link-arrow"><svg width="16" height="26" viewBox="0 0 16 26" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.89144 25.7391L16 12.8696L2.89144 0L0 2.83873L10.2171 12.8696L0 22.9004L2.89144 25.7391Z" fill="#222222" /></svg></div>`
    var nextButton = `<div class="slick-next slick-arrow social-link-arrow"><svg width="16" height="26" viewBox="0 0 16 26" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.89144 25.7391L16 12.8696L2.89144 0L0 2.83873L10.2171 12.8696L0 22.9004L2.89144 25.7391Z" fill="#222222" /></svg></div>`
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
