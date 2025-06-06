const $sidebar = $('#sidebar');
const $mainContent = $('#mainContent');
const $openSidebar = $('#openSidebar');
const $closeSidebar = $('#closeSidebar');
const $bodyOverlay = $('#bodyOverlay');

const $scrollWrap = $('.nav-scroll');
const $left = $('.scroll-left');
const $right = $('.scroll-right');

const sidebarToggle = () => {
    if ($(window).width() < 1500) { //on smaller screens, hide sidebar and expand mainContent
        $sidebar.addClass('sidebar-hidden');
        $mainContent.addClass('expanded');
    } else { // on bigger screens, show sidebar and collapse mainContent
        $sidebar.removeClass('sidebar-hidden');
        $mainContent.removeClass('expanded');
    }
    $bodyOverlay.hide();
}


const adjustMinHeightFromTop = () => {
    const $element = $(`#updateBusinessForm > .card`);
    if ($element.length === 0) return;

    // const offsetTop = $element[0].getBoundingClientRect().top;
    let offsetTop;
    const screenWidth = window.innerWidth;
    if (screenWidth <= 1499.89) {
        offsetTop = 79;
    } else if (screenWidth <= 1600) {
        offsetTop = 86;
    } else {
        offsetTop = 94;
    }

    $element.css('min-height', `calc(100dvh - ${offsetTop}px)`);
    $('.custom-box').css('max-height', `calc(100dvh - ${offsetTop + 32}px)`);
}

$openSidebar.on('click', () => { // when click open button, opens the sidebar and overlay
    $sidebar.removeClass('sidebar-hidden');
    $bodyOverlay.show();
});

$closeSidebar.on('click', () => { // when click close button, close the sidebar and remove overlay
    $sidebar.addClass('sidebar-hidden');
    $bodyOverlay.hide();
});
// Optional: Handle resizing (auto close on small screens)
$(window).on('resize', () => {
    console.log('resizing');
    sidebarToggle();
    adjustMinHeightFromTop();
    updateArrows();
});
$(document).on('click', '#bodyOverlay', () => {
    $bodyOverlay.hide();
    $sidebar.addClass('sidebar-hidden');
});


$(function () {
    sidebarToggle();
    $('body').fadeIn(300, function () {
        adjustMinHeightFromTop();
    });
    $('[data-bs-toggle="tooltip"]').tooltip();

    window.Swal = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-white me-3',
            popup: 'rounded-3',
            title: 'fs-5 fw-bold text-primary mt-4',
            htmlContainer: 'text-center'
        },
        buttonsStyling: false,
        showCloseButton: true,
        focusConfirm: false,
        reverseButtons: true
    });


    $scrollWrap.on('scroll', updateArrows);
    updateArrows();

    $left.on('click', () => {
        $scrollWrap[0].scrollTo({left: 0, behavior: 'smooth'});
    });

    $right.on('click', () => {
        const maxScroll = $scrollWrap[0].scrollWidth - $scrollWrap[0].clientWidth;
        $scrollWrap[0].scrollTo({left: maxScroll, behavior: 'smooth'});
    });

})


function updateArrows() {
    if(!$scrollWrap.length) return;
    const scrollLeft = $scrollWrap.scrollLeft();
    const scrollWidth = $scrollWrap[0].scrollWidth;
    const clientWidth = $scrollWrap[0].clientWidth;

    $left.toggleClass('d-none', scrollLeft <= 0);
    $right.toggleClass('d-none', scrollLeft + clientWidth >= scrollWidth - 1);
}

function setLoadingState($el, enable = true) {
    if (enable) {
        if ($el.find('.loading-spinner').length) return;

        const $spinner = $(`
      <div class="spinner-border spinner-border-sm loading-spinner me-2" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    `);

        $el.prepend($spinner).css('pointer-events', 'none');
    } else {
        $el.find('.loading-spinner').remove();
        $el.css({pointerEvents: ''});
    }
}
