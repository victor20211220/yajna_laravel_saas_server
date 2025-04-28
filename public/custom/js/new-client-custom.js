const toggleBtn = document.getElementById('toggleSidebar');
const sidebar = document.getElementById('sidebar');
const mainContent = document.getElementById('mainContent');
const toggleIcon = document.getElementById('toggleIcon');

toggleBtn.addEventListener('click', () => {
    if (window.innerWidth < 768) {
        sidebar.classList.toggle('show'); // On mobile, toggle Bootstrap class
        sidebar.classList.toggle('sidebar-hidden');
    } else {
        sidebar.classList.toggle('sidebar-hidden');
        mainContent.classList.toggle('collapsed');
    }

    // Change arrow direction
    if (sidebar.classList.contains('sidebar-hidden')) {
        toggleIcon.classList.remove('bi-arrow-left');
        toggleIcon.classList.add('bi-arrow-right');
    } else {
        toggleIcon.classList.remove('bi-arrow-right');
        toggleIcon.classList.add('bi-arrow-left');
    }
});

// Make sure sidebar auto-hides when resizing to mobile
window.addEventListener('resize', () => {
    if (window.innerWidth < 768) {
        sidebar.classList.add('sidebar-hidden');
        mainContent.classList.add('collapsed');
        toggleIcon.classList.remove('bi-arrow-left');
        toggleIcon.classList.add('bi-arrow-right');
    } else {
        sidebar.classList.remove('show');
    }
});
