$(document).ready(function () {
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
        over_sticky_header();
    });
    $('.gallery-close').on('click', function (e) {
        $('.gallery-popup').removeClass('active');
        $('body').removeClass('no-scroll');
        over_sticky_header(false);
    });

    // video-popup
    $('.video-popup-btn').on('click', function (e) {
        $('.video-popup').addClass('active');
        $('body').addClass('no-scroll');
        over_sticky_header();
    });
    $('.video-close').on('click', function (e) {
        $('.video-popup').removeClass('active');
        $('body').removeClass('no-scroll');
        over_sticky_header(false);
    });

    // contact-popup
    $('.contact-info').on('click', function (e) {
        $('.contact-popup').addClass('active');
        $('body').addClass('no-scroll');
        over_sticky_header();
    });

    $('.contact-close').on('click', function (e) {
        $('.contact-popup').removeClass('active');
        $('body').removeClass('no-scroll');
        over_sticky_header(false);
    });

    // share-card-popup
    $('.share-info').on('click', function (e) {
        $('.share-card-popup').addClass('active');
        $('body').addClass('no-scroll');
        over_sticky_header();
    });
    $('.share-card-close').on('click', function (e) {
        $('.share-card-popup').removeClass('active');
        $('body').removeClass('no-scroll');
        over_sticky_header(false);
    });


    // gallery-slider
    $('.gallery-slider').slick({
        infinite: true,
        speed: 500,
        slidesToShow: 1,
        slidesToScroll: 1,
        prevArrow: $('#galleryOnCard .slick-prev.gallery-arrow'),
        nextArrow: $('#galleryOnCard .slick-next.gallery-arrow'),
        responsive: [
            {
                breakpoint: 481,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });

    $('.featured-video-slider').slick({
        infinite: true,
        speed: 500,
        slidesToShow: 1,
        slidesToScroll: 1,
        prevArrow: $('#featuredVideosOnCard .slick-prev.gallery-arrow'),
        nextArrow: $('#featuredVideosOnCard .slick-next.gallery-arrow'),
        responsive: [
            {
                breakpoint: 481,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });

    // social-link-slider
    $('.social-link-slider').slick({
        infinite: true,
        autoplay: true,
        speed: 500,
        slidesToShow: 7,
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

});

function over_sticky_header(over = true){
    $edit_form_header = $(`.card-header.sticky-top`);
    if(!$edit_form_header.length) return;
    if(over) $edit_form_header.removeClass('z-1');
    else $edit_form_header.addClass('z-1');
}
