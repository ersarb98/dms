import './bootstrap';
document.getElementById('sidebarCollapse').addEventListener('click', function() {
    var sidebar = document.getElementById('sidebar');
    var toggleIcon = document.getElementById('sidebarToggleIcon');
    sidebar.classList.toggle('sidebar-hidden');
    toggleIcon.style.display = sidebar.classList.contains('sidebar-hidden') ? 'block' : 'none';
});

function sidebarToggle() {
    var sidebar = document.getElementById('sidebar');
    var toggleIcon = document.getElementById('sidebarToggleIcon');
    
    if (sidebar.classList.contains('sidebar-hidden')) {
        sidebar.classList.remove('sidebar-hidden');
        toggleIcon.style.display = 'none';
    } else {
        sidebar.classList.add('sidebar-hidden');
        toggleIcon.style.display = 'block';
    }
}
window.sidebarToggle = sidebarToggle;