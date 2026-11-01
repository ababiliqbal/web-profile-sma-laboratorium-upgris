document.addEventListener('DOMContentLoaded', function () {
    // --- Elemen-elemen DOM ---
    const sidebar = document.getElementById('sidebar');
    const menuToggle = document.getElementById('menu-toggle');
    const sidebarOverlay = document.getElementById('sidebar-overlay');
    const submenuToggles = document.querySelectorAll('.nav-item-has-submenu > a');

    // PERUBAHAN DI SINI: Elemen untuk Dropdown Profil yang Ditingkatkan
    const profileDropdownToggle = document.getElementById('profile-dropdown-toggle');
    const profileDropdownMenu = document.getElementById('profile-dropdown-menu');
    const profileDropdownArrow = profileDropdownToggle.querySelector('.fa-chevron-down');

    // --- State ---
    let isSidebarCollapsed = false;

    // --- Fungsi-fungsi (Sama seperti sebelumnya) ---
    const toggleDesktopSidebar = () => {
        isSidebarCollapsed = !isSidebarCollapsed;
        sidebar.classList.toggle('sidebar-collapsed');
        sidebar.style.width = isSidebarCollapsed ? '90px' : '280px';
        if (isSidebarCollapsed) closeAllSubmenus();
    };
    const toggleMobileSidebar = () => {
        sidebar.classList.toggle('-translate-x-full');
        sidebarOverlay.classList.toggle('hidden');
    };
    const closeAllSubmenus = (except = null) => {
        document.querySelectorAll('.nav-item-has-submenu.open').forEach(item => {
            if (item !== except) {
                item.classList.remove('open');
                item.querySelector('.submenu').classList.remove('submenu-open');
                item.querySelector('.submenu-arrow').classList.remove('rotate-180');
            }
        });
    };

    // --- Event Listener (Sama seperti sebelumnya) ---
    menuToggle.addEventListener('click', () => {
        window.innerWidth >= 1024 ? toggleDesktopSidebar() : toggleMobileSidebar();
    });
    sidebarOverlay.addEventListener('click', toggleMobileSidebar);
    submenuToggles.forEach(toggle => {
        toggle.addEventListener('click', (e) => {
            e.preventDefault();
            const parent = toggle.parentElement;

            // Jika sidebar diciutkan di desktop, buka sidebar dulu.
            if (isSidebarCollapsed && window.innerWidth >= 1024) {
                toggleDesktopSidebar();
                setTimeout(() => {
                    parent.classList.add('open');
                    parent.querySelector('.submenu').classList.add('submenu-open');
                    parent.querySelector('.submenu-arrow').classList.add('rotate-180');
                }, 300); // Tunggu animasi sidebar selesai
                return;
            }

            const isOpen = parent.classList.contains('open');

            // Selalu tutup semua submenu lain terlebih dahulu.
            closeAllSubmenus(parent);

            // Hanya buka submenu jika sebelumnya tertutup.
            if (!isOpen) {
                parent.classList.add('open');
                parent.querySelector('.submenu').classList.add('submenu-open');
                parent.querySelector('.submenu-arrow').classList.add('rotate-180');
            }
            // Jika sudah terbuka (isOpen), fungsi closeAllSubmenus(parent) akan menghapusnya
            // dan kita tidak melakukan apa-apa lagi, sehingga submenu tetap tertutup.
            // Namun, closeAllSubmenus akan mengecualikan parent, jadi kita harus menghapusnya secara manual.
            else {
                parent.classList.remove('open');
                parent.querySelector('.submenu').classList.remove('submenu-open');
                parent.querySelector('.submenu-arrow').classList.remove('rotate-180');
            }
        });
    });

    // PERUBAHAN DI SINI: Logika untuk Dropdown Profil yang Ditingkatkan
    profileDropdownToggle.addEventListener('click', (e) => {
        e.stopPropagation();
        const isShown = profileDropdownMenu.classList.toggle('show');
        profileDropdownArrow.classList.toggle('rotate-180', isShown);
    });
    window.addEventListener('click', () => {
        if (profileDropdownMenu.classList.contains('show')) {
            profileDropdownMenu.classList.remove('show');
            profileDropdownArrow.classList.remove('rotate-180');
        }
    });

    // --- Menyesuaikan tampilan CSS (Sama seperti sebelumnya) ---
    document.querySelectorAll('.nav-link').forEach(link => {
        link.classList.add('relative', 'flex', 'items-center', 'h-12', 'text-text-light',
            'hover:bg-primary-light', 'hover:text-primary', 'mx-4', 'px-4', 'rounded-lg',
            'transition-colors', 'duration-200');
        const span = link.querySelector('span');
        if (span) span.classList.add('text-sm', 'tracking-wide', 'truncate');
    });
    document.querySelectorAll('.submenu-link').forEach(link => {
        link.classList.add('block', 'py-2', 'px-3', 'text-sm', 'text-text-light',
            'hover:text-primary', 'rounded-md', 'transition-colors', 'duration-200');
    });
});