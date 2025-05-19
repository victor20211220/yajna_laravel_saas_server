const $sidebar = $('#sidebar');
const $mainContent = $('#mainContent');
const $openSidebar = $('#openSidebar');
const $closeSidebar = $('#closeSidebar');
const $bodyOverlay = $('#bodyOverlay');

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
    sidebarToggle();
});
$(document).on('click', '#mainContentOverlay', () => {
    $bodyOverlay.hide();
    $sidebar.addClass('sidebar-hidden');
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
