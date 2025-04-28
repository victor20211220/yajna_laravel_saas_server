$(document).ready(function () {
    var date = new Date();
    $(".datepicker_min").pickadate({
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
    $(".appointment-btn").on("click", function (e) {
        $(".appointment-popup").addClass("active");
        $("body").addClass("no-scroll");
    });
    $(".appointment-close").on("click", function (e) {
        $(".appointment-popup").removeClass("active");
        $("body").removeClass("no-scroll");
    });
    // contact-popup
    $(".contact-info").on("click", function (e) {
        $(".contact-popup").addClass("active");
        $("body").addClass("no-scroll");
    });
    $(".contact-close").on("click", function (e) {
        $(".contact-popup").removeClass("active");
        $("body").removeClass("no-scroll");
    });
    // share-card-popup
    $(".share-info").on("click", function (e) {
        $(".share-card-popup").addClass("active");
        $("body").addClass("no-scroll");
    });
    $(".share-card-close").on("click", function (e) {
        $(".share-card-popup").removeClass("active");
        $("body").removeClass("no-scroll");
    });
    // social-link-slider
    $(".social-link-slider").slick({
        autoplay: true,
        speed: 500,
        dots: false,
        arrows: false,
        slidesToShow: 9,
        rtl: true,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 7,
                },
            },
            {
                breakpoint: 481,
                settings: {
                    slidesToShow: 6,
                },
            },
        ],
    });


        // service-slider
        var prevButton = `<div class="slick-prev slick-arrow service-arrow"><svg width="32" height="12" viewBox="0 0 32 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.226497 6L6 11.7735L11.7735 6L6 0.226497L0.226497 6ZM6 7H32V5H6V7Z" fill="#8B4513"/></svg></div>`;
        var nextButton = `<div class="slick-next slick-arrow service-arrow"><svg width="32" height="12" viewBox="0 0 32 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M31.7735 6L26 11.7735L20.2265 6L26 0.226497L31.7735 6ZM26 7H0V5H26V7Z" fill="#8B4513"/></svg></div>`;
        $(".service-slider").slick({
            infinite: false,
            speed: 500,
            slidesToShow: 2,
            slidesToScroll: 1,
            rtl: true,
            dots: false,
            prevArrow: $(".slick-prev.service-arrow"),
            nextArrow: $(".slick-next.service-arrow"),
            responsive: [
                {
                    breakpoint: 481,
                    settings: {
                        slidesToShow: 1,
                    },
                },
            ],
        });
    

    // gallery-slider
    var prevButton = `<div class="slick-prev slick-arrow gallery-arrow"><svg width="32" height="12" viewBox="0 0 32 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.226497 6L6 11.7735L11.7735 6L6 0.226497L0.226497 6ZM6 7H32V5H6V7Z" fill="#8B4513"/></svg></div>`;
    var nextButton = `<div class="slick-next slick-arrow gallery-arrow"><svg width="32" height="12" viewBox="0 0 32 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M31.7735 6L26 11.7735L20.2265 6L26 0.226497L31.7735 6ZM26 7H0V5H26V7Z" fill="#8B4513"/></svg></div>`;
    let isSwiping = false;
    $(".gallery-slider")
        .on("touchstart mousedown", function () {
            isSwiping = false;
        })
        .on("touchmove mousemove", function () {
            isSwiping = true;
        });
    $(".gallery-slider").slick({
        speed: 500,
        slidesToShow: 2,
        slidesToScroll: 1,
        dots: false,
        rtl: true,
        arrows: true,
        prevArrow: $(".slick-prev.gallery-arrow"),
        nextArrow: $(".slick-next.gallery-arrow"),
        responsive: [
            {
                breakpoint: 481,
                settings: {
                    slidesToShow: 1,
                },
            },
        ]
    });
    $(".gallery-popup-btn").on("click", function (e) {
        if (isSwiping) {
            e.preventDefault();
            return;
        }
        $(".gallery-popup").addClass("active");
        $("body").addClass("no-scroll");
    });
    $(".gallery-close").on("click", function (e) {
        $(".gallery-popup").removeClass("active");
        $("body").removeClass("no-scroll");
    });


    // product-sec-slider
    var prevButton = `<div class="slick-prev slick-arrow product-sec-arrow"><svg width="20" height="10" viewBox="0 0 20 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.7709 5.55301L19.7702 5.55375L15.688 9.61625C15.3821 9.92059 14.8875 9.91946 14.5831 9.6136C14.2787 9.30778 14.2799 8.81313 14.5857 8.50875L17.3265 5.78125L0.78125 5.78125C0.349766 5.78125 3.85732e-07 5.43149 4.23454e-07 5C4.61175e-07 4.56852 0.349766 4.21875 0.78125 4.21875L17.3264 4.21875L14.5857 1.49125C14.2799 1.18688 14.2788 0.69223 14.5831 0.386409C14.8875 0.0805114 15.3822 0.0794567 15.688 0.383753L19.7702 4.44625L19.7709 4.447C20.0769 4.75239 20.0759 5.24864 19.7709 5.55301Z" fill="white"/></svg></div>`
    var nextButton = `<div class="slick-next slick-arrow product-sec-arrow"><svg width="20" height="10" viewBox="0 0 20 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.7709 5.55301L19.7702 5.55375L15.688 9.61625C15.3821 9.92059 14.8875 9.91946 14.5831 9.6136C14.2787 9.30778 14.2799 8.81313 14.5857 8.50875L17.3265 5.78125L0.78125 5.78125C0.349766 5.78125 3.85732e-07 5.43149 4.23454e-07 5C4.61175e-07 4.56852 0.349766 4.21875 0.78125 4.21875L17.3264 4.21875L14.5857 1.49125C14.2799 1.18688 14.2788 0.69223 14.5831 0.386409C14.8875 0.0805114 15.3822 0.0794567 15.688 0.383753L19.7702 4.44625L19.7709 4.447C20.0769 4.75239 20.0759 5.24864 19.7709 5.55301Z" fill="white"/></svg></div>`
    $('.product-sec-slider').slick({
        infinite: true,
        speed: 500,
        arrows: true,
        rtl: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        prevArrow: $('.slick-prev.product-sec-arrow'),
        nextArrow: $('.slick-next.product-sec-arrow'),
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
});

