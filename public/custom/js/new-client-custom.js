const $sidebar = $('#sidebar');
const $mainContent = $('#mainContent');
const $openSidebar = $('#openSidebar');
const $closeSidebar = $('#closeSidebar');
const $mainContentOverlay = $('#mainContentOverlay');

const sidebarToggle = () => {
    if ($(window).width() < 768) {
        $sidebar.addClass('sidebar-hidden');
        $mainContent.addClass('collapsed');
    } else {
        $sidebar.removeClass('show');
    }
}

$closeSidebar.on('click', () => {
    $sidebar.addClass('sidebar-hidden');
    $mainContent.addClass('collapsed');
    $mainContentOverlay.hide();
});

$openSidebar.on('click', () => {
    $sidebar.removeClass('sidebar-hidden');
    $mainContent.removeClass('collapsed');
    $mainContentOverlay.show();
});

// Optional: Handle resizing (auto close on small screens)
$(window).on('resize', () => {
    sidebarToggle();
});


$(function () {
    sidebarToggle();
    $('body').fadeIn(300);
    $('[data-bs-toggle="tooltip"]').tooltip();
})

// Adjustment for the username dropdown on sidebar
$(document).on('click', '#myDropdown', function (e) {
    e.preventDefault();
    console.log('clicked');
    const $this = $(this);
    $this.toggleClass('show');
    const ariaExpanded = $this.attr('aria-expanded')
    $this.attr('aria-expanded', ariaExpanded === "false" ? "true" : "false");
    const $dropdownMenu = $(this).closest('.dropdown').find('.dropdown-menu')
    $dropdownMenu.toggleClass('show');
})
