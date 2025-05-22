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
$(document).on('click', '#bodyOverlay', () => {
    $bodyOverlay.hide();
    $sidebar.addClass('sidebar-hidden');
});


$(function () {
    sidebarToggle();
    $('body').fadeIn(300);
    $('[data-bs-toggle="tooltip"]').tooltip();
})
