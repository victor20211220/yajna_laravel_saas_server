
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
    

     // social-link-slider
     $('.social-link-slider').slick({  
        infinite: true,
        autoplay: true,
        speed: 500,
        slidesToShow: 7,
        rtl: true,
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

    // gallery-slider
    var prevButton = `<div class="slick-prev slick-arrow gallery-arrow"><svg width="20" height="10" viewBox="0 0 20 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.7709 5.55301L19.7702 5.55375L15.688 9.61625C15.3821 9.92059 14.8875 9.91946 14.5831 9.6136C14.2787 9.30778 14.2799 8.81313 14.5857 8.50875L17.3265 5.78125L0.78125 5.78125C0.349766 5.78125 3.85732e-07 5.43149 4.23454e-07 5C4.61175e-07 4.56852 0.349766 4.21875 0.78125 4.21875L17.3264 4.21875L14.5857 1.49125C14.2799 1.18688 14.2788 0.69223 14.5831 0.386409C14.8875 0.0805114 15.3822 0.0794567 15.688 0.383753L19.7702 4.44625L19.7709 4.447C20.0769 4.75239 20.0759 5.24864 19.7709 5.55301Z" fill="white"/></svg></div>`
    var nextButton = `<div class="slick-next slick-arrow gallery-arrow"><svg width="20" height="10" viewBox="0 0 20 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.7709 5.55301L19.7702 5.55375L15.688 9.61625C15.3821 9.92059 14.8875 9.91946 14.5831 9.6136C14.2787 9.30778 14.2799 8.81313 14.5857 8.50875L17.3265 5.78125L0.78125 5.78125C0.349766 5.78125 3.85732e-07 5.43149 4.23454e-07 5C4.61175e-07 4.56852 0.349766 4.21875 0.78125 4.21875L17.3264 4.21875L14.5857 1.49125C14.2799 1.18688 14.2788 0.69223 14.5831 0.386409C14.8875 0.0805114 15.3822 0.0794567 15.688 0.383753L19.7702 4.44625L19.7709 4.447C20.0769 4.75239 20.0759 5.24864 19.7709 5.55301Z" fill="white"/></svg></div>`
    $('.gallery-slider').slick({
        speed: 500,
        arrows: true,
        slidesToShow: 3,
        centerMode: true, 
        rtl: true,
        slidesToScroll: 1,
        prevArrow: $('.slick-prev.gallery-arrow'),
        nextArrow: $('.slick-next.gallery-arrow'),
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
    var prevButton = `<div class="slick-prev slick-arrow product-arrow"><svg width="20" height="10" viewBox="0 0 20 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.7709 5.55301L19.7702 5.55375L15.688 9.61625C15.3821 9.92059 14.8875 9.91946 14.5831 9.6136C14.2787 9.30778 14.2799 8.81313 14.5857 8.50875L17.3265 5.78125L0.78125 5.78125C0.349766 5.78125 3.85732e-07 5.43149 4.23454e-07 5C4.61175e-07 4.56852 0.349766 4.21875 0.78125 4.21875L17.3264 4.21875L14.5857 1.49125C14.2799 1.18688 14.2788 0.69223 14.5831 0.386409C14.8875 0.0805114 15.3822 0.0794567 15.688 0.383753L19.7702 4.44625L19.7709 4.447C20.0769 4.75239 20.0759 5.24864 19.7709 5.55301Z" fill="white"/></svg></div>`
    var nextButton = `<div class="slick-next slick-arrow product-arrow"><svg width="20" height="10" viewBox="0 0 20 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.7709 5.55301L19.7702 5.55375L15.688 9.61625C15.3821 9.92059 14.8875 9.91946 14.5831 9.6136C14.2787 9.30778 14.2799 8.81313 14.5857 8.50875L17.3265 5.78125L0.78125 5.78125C0.349766 5.78125 3.85732e-07 5.43149 4.23454e-07 5C4.61175e-07 4.56852 0.349766 4.21875 0.78125 4.21875L17.3264 4.21875L14.5857 1.49125C14.2799 1.18688 14.2788 0.69223 14.5831 0.386409C14.8875 0.0805114 15.3822 0.0794567 15.688 0.383753L19.7702 4.44625L19.7709 4.447C20.0769 4.75239 20.0759 5.24864 19.7709 5.55301Z" fill="white"/></svg></div>`
     $('.product-sec-slider').slick({
        infinite: false,
        speed: 500,
        arrows: true,
        slidesToShow: 1,
        rtl: true,
        slidesToScroll: 1,
        prevArrow: $('.slick-prev.product-arrow'),
        nextArrow: $('.slick-next.product-arrow')
    });

    // service-slider
    var prevButton = `<div class="slick-prev slick-arrow service-arrow"><svg width="20" height="10" viewBox="0 0 20 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.7709 5.55301L19.7702 5.55375L15.688 9.61625C15.3821 9.92059 14.8875 9.91946 14.5831 9.6136C14.2787 9.30778 14.2799 8.81313 14.5857 8.50875L17.3265 5.78125L0.78125 5.78125C0.349766 5.78125 3.85732e-07 5.43149 4.23454e-07 5C4.61175e-07 4.56852 0.349766 4.21875 0.78125 4.21875L17.3264 4.21875L14.5857 1.49125C14.2799 1.18688 14.2788 0.69223 14.5831 0.386409C14.8875 0.0805114 15.3822 0.0794567 15.688 0.383753L19.7702 4.44625L19.7709 4.447C20.0769 4.75239 20.0759 5.24864 19.7709 5.55301Z" fill="white"/></svg></div>`
    var nextButton = `<div class="slick-next slick-arrow service-arrow"><svg width="20" height="10" viewBox="0 0 20 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.7709 5.55301L19.7702 5.55375L15.688 9.61625C15.3821 9.92059 14.8875 9.91946 14.5831 9.6136C14.2787 9.30778 14.2799 8.81313 14.5857 8.50875L17.3265 5.78125L0.78125 5.78125C0.349766 5.78125 3.85732e-07 5.43149 4.23454e-07 5C4.61175e-07 4.56852 0.349766 4.21875 0.78125 4.21875L17.3264 4.21875L14.5857 1.49125C14.2799 1.18688 14.2788 0.69223 14.5831 0.386409C14.8875 0.0805114 15.3822 0.0794567 15.688 0.383753L19.7702 4.44625L19.7709 4.447C20.0769 4.75239 20.0759 5.24864 19.7709 5.55301Z" fill="white"/></svg></div>`
    $('.service-slider').slick({
        infinite: false,
        speed: 500,
        arrows: true,
        slidesToShow: 2,
        rtl: true,
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
     var prevButton = `<div class="slick-prev slick-arrow testimonial-arrow"><svg width="20" height="10" viewBox="0 0 20 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.7709 5.55301L19.7702 5.55375L15.688 9.61625C15.3821 9.92059 14.8875 9.91946 14.5831 9.6136C14.2787 9.30778 14.2799 8.81313 14.5857 8.50875L17.3265 5.78125L0.78125 5.78125C0.349766 5.78125 3.85732e-07 5.43149 4.23454e-07 5C4.61175e-07 4.56852 0.349766 4.21875 0.78125 4.21875L17.3264 4.21875L14.5857 1.49125C14.2799 1.18688 14.2788 0.69223 14.5831 0.386409C14.8875 0.0805114 15.3822 0.0794567 15.688 0.383753L19.7702 4.44625L19.7709 4.447C20.0769 4.75239 20.0759 5.24864 19.7709 5.55301Z" fill="white"/></svg></div>`
    var nextButton = `<div class="slick-next slick-arrow testimonial-arrow"><svg width="20" height="10" viewBox="0 0 20 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.7709 5.55301L19.7702 5.55375L15.688 9.61625C15.3821 9.92059 14.8875 9.91946 14.5831 9.6136C14.2787 9.30778 14.2799 8.81313 14.5857 8.50875L17.3265 5.78125L0.78125 5.78125C0.349766 5.78125 3.85732e-07 5.43149 4.23454e-07 5C4.61175e-07 4.56852 0.349766 4.21875 0.78125 4.21875L17.3264 4.21875L14.5857 1.49125C14.2799 1.18688 14.2788 0.69223 14.5831 0.386409C14.8875 0.0805114 15.3822 0.0794567 15.688 0.383753L19.7702 4.44625L19.7709 4.447C20.0769 4.75239 20.0759 5.24864 19.7709 5.55301Z" fill="white"/></svg></div>`
    $('.testimonial-slider').slick({
        infinite: false,
        speed: 500,
        arrows: true,
        rtl: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        prevArrow: $('.slick-prev.testimonial-arrow'),
        nextArrow: $('.slick-next.testimonial-arrow'),
    });

   

});