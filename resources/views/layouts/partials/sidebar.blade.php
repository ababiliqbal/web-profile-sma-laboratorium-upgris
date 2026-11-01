<aside id="sidebar"
    class="bg-surface shadow-soft flex flex-col z-20 fixed inset-y-0 left-0 lg:relative lg:translate-x-0 transform -translate-x-full sidebar-transition-mobile lg:sidebar-transition"
    style="width: 280px;">
    <div class="flex items-center justify-center h-20 border-b border-border flex-shrink-0 px-6">
        <div class="flex items-center gap-4">
            <div class="bg-primary-light p-2 rounded-lg"><i class="fas fa-school text-primary text-2xl"></i>
            </div>
            <h3 class="sidebar-title-text font-bold text-xl text-text-dark whitespace-nowrap">Panel Sekolah</h3>
        </div>
    </div>
    <nav class="flex-grow overflow-y-auto overflow-x-hidden py-4">
        <ul class="flex flex-col py-2 space-y-1">
            <li><a href="{{ route('dashboard') }}"
                    class="relative flex items-center h-12 text-white bg-primary mx-4 px-4 rounded-lg shadow-lg shadow-primary/30"><i
                        class="fas fa-tachometer-alt fa-fw text-lg w-8 text-center"></i><span
                        class="nav-text ml-2 text-sm tracking-wide truncate">Dashboard</span></a></li>
            <li class="px-6 py-3"><span class="nav-text text-xs font-semibold text-text-light uppercase">Konten</span>
            </li>
            <li class="nav-item-has-submenu">
                <a href="#"
                    class="nav-link relative flex items-center h-12 text-text-light hover:bg-primary-light hover:text-primary mx-4 px-4 rounded-lg transition-colors duration-200">
                    <i class="fas fa-file-alt fa-fw text-lg w-8 text-center"></i><span
                        class="nav-text ml-2 text-sm tracking-wide truncate">Manajemen Konten</span>
                    <i
                        class="submenu-arrow fas fa-chevron-down text-xs absolute right-4 transition-transform duration-300"></i>
                </a>
                <ul class="submenu ml-10 pl-2 border-l-2 border-border">
                    <li><a href="{{ route('dashboard.posts.index') }}" class="submenu-link">Berita & Artikel</a></li>
                    <li><a href="{{ route('dashboard.pages.index') }}" class="submenu-link">Halaman Statis</a></li>
                    <li><a href="{{ route('dashboard.categories.index') }}" class="submenu-link">Kategori</a></li>
                    <li><a href="{{ route('dashboard.tags.index') }}" class="submenu-link">Tag</a></li>
                </ul>
            </li>
            <li><a href="{{ route('dashboard.albums.index') }}" class="nav-link"><i
                        class="fas fa-images fa-fw text-lg w-8 text-center"></i><span
                        class="nav-text ml-2">Galeri</span></a></li>
            <li><a href="{{ route('dashboard.achievements.index') }}" class="nav-link"><i
                        class="fas fa-trophy fa-fw text-lg w-8 text-center"></i><span
                        class="nav-text ml-2">Prestasi</span></a></li>
            <li><a href="{{ route('dashboard.alumni-testimonials.index') }}" class="nav-link"><i
                        class="fas fa-comment-dots fa-fw text-lg w-8 text-center"></i><span
                        class="nav-text ml-2">Testimoni</span></a></li>
            <li><a href="{{ route('dashboard.contact-messages.index') }}" class="nav-link">
                    <i class="fas fa-envelope-open-text fa-fw text-lg w-8 text-center"></i>
                    <span class="nav-text ml-2">Pesan Kontak</span>
                </a></li>

            <li class="px-6 py-3"><span
                    class="nav-text text-xs font-semibold text-text-light uppercase">Administrasi</span></li>
            <li class="nav-item-has-submenu">
                <a href="#"
                    class="nav-link relative flex items-center h-12 text-text-light hover:bg-primary-light hover:text-primary mx-4 px-4 rounded-lg transition-colors duration-200">
                    <i class="fas fa-university fa-fw text-lg w-8 text-center"></i><span
                        class="nav-text ml-2 text-sm tracking-wide truncate">Data Akademik</span>
                    <i
                        class="submenu-arrow fas fa-chevron-down text-xs absolute right-4 transition-transform duration-300"></i>
                </a>
                <ul class="submenu ml-10 pl-2 border-l-2 border-border">
                    <li><a href="{{ route('dashboard.staffs.index') }}" class="submenu-link">Guru & Staf</a></li>
                    <li><a href="{{ route('dashboard.subjects.index') }}" class="submenu-link">Mata Pelajaran</a></li>
                    <li><a href="{{ route('dashboard.facilities.index') }}" class="submenu-link">Fasilitas</a></li>
                    <li><a href="{{ route('dashboard.study-programs.index') }}" class="submenu-link">Jurusan</a></li>
                    <li><a href="{{ route('dashboard.extracurriculars.index') }}"
                            class="submenu-link">Ekstrakurikuler</a>
                    </li>
                    <li><a href="{{ route('dashboard.student-organizations.index') }}" class="submenu-link">Organisasi
                            Siswa</a></li>
                    <li><a href="{{ route('dashboard.academic-events.index') }}" class="submenu-link">Agenda
                            Akademik</a>
                    </li>
                </ul>
            </li>
            <li><a href="{{ route('dashboard.users.index') }}" class="nav-link"><i
                        class="fas fa-users-cog fa-fw text-lg w-8 text-center"></i><span class="nav-text ml-2">Manajemen
                        User</span></a></li>
            <li><a href="{{ route('dashboard.settings.index') }}" class="nav-link"><i
                        class="fas fa-cog fa-fw text-lg w-8 text-center"></i><span
                        class="nav-text ml-2">Pengaturan</span></a></li>
        </ul>
    </nav>
</aside>
