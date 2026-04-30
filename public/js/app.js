// SIDEBAR
const toggle = document.getElementById('toggleSidebar');
const sidebar = document.getElementById('sidebar');
const main = document.querySelector('.main');

toggle.addEventListener('click', () => {

    if (window.innerWidth <= 768) {
        sidebar.classList.toggle('show');
    } else {
        sidebar.classList.toggle('hide');
        main.classList.toggle('full');
    }

});

// DROPDOWN
const trigger = document.getElementById('dropdownTrigger');
const menu = document.getElementById('dropdownMenu');

trigger.addEventListener('click', () => {
    menu.classList.toggle('show');
});

window.addEventListener('click', function (e) {
    if (!document.getElementById('userDropdown').contains(e.target)) {
        menu.classList.remove('show');
    }
});
