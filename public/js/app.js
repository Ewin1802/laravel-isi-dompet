
// ================= SIDEBAR =================
const toggle = document.getElementById('toggleSidebar');
const sidebar = document.getElementById('sidebar');
const main = document.querySelector('.main');
const overlay = document.getElementById('sidebarOverlay');

if (toggle && sidebar) {

    toggle.addEventListener('click', () => {

        if (window.innerWidth <= 768) {
            // MOBILE MODE
            sidebar.classList.toggle('show');

            if (overlay) {
                overlay.classList.toggle('show');
            }

        } else {
            // DESKTOP MODE
            sidebar.classList.toggle('hide');

            if (main) {
                main.classList.toggle('full');
            }
        }

    });

}

/* CLOSE SIDEBAR (MOBILE) */
if (overlay && sidebar) {
    overlay.addEventListener('click', () => {
        sidebar.classList.remove('show');
        overlay.classList.remove('show');
    });
}

/* AUTO CLOSE SIDEBAR SAAT KLIK MENU (MOBILE) */
document.querySelectorAll('.sidebar a').forEach(link => {
    link.addEventListener('click', () => {
        if (window.innerWidth <= 768) {
            sidebar.classList.remove('show');
            if (overlay) overlay.classList.remove('show');
        }
    });
});


// ================= DROPDOWN USER =================
const trigger = document.getElementById('dropdownTrigger');
const menu = document.getElementById('dropdownMenu');
const dropdown = document.getElementById('userDropdown');

if (trigger && menu) {

    trigger.addEventListener('click', (e) => {
        e.stopPropagation(); // biar tidak langsung close
        menu.classList.toggle('show');
    });

    window.addEventListener('click', function (e) {
        if (dropdown && !dropdown.contains(e.target)) {
            menu.classList.remove('show');
        }
    });

}


// ================= OPTIONAL (ESC KEY CLOSE) =================
window.addEventListener('keydown', function (e) {

    if (e.key === 'Escape') {

        // close dropdown
        if (menu) menu.classList.remove('show');

        // close sidebar mobile
        if (sidebar && overlay) {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        }

    }

});
