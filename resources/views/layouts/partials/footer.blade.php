<footer class="bg-maroon text-white relative overflow-hidden">

    <div class="absolute inset-0 bg-repeat bg-center opacity-5"
        style="background-image: url('data:image/svg+xml,%3Csvg width=%2260%22 height=%2260%22 viewBox=%220 0 60 60%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cg fill=%22none%22 fill-rule=%22evenodd%22%3E%3Cg fill=%22%23ffffff%22 fill-opacity=%220.4%22%3E%3Cpath d=%22M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z%22/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">

            <!-- Bagian 1: Identitas Sekolah -->
            <div class="space-y-4" data-aos="fade-up">
                <div class="flex items-center space-x-3">
                    <img class="h-20 w-auto p-1 rounded-md"
                        src="{{ isset($settings['school_logo']) ? asset('storage/' . $settings['school_logo']) : 'https://placehold.co/128x128/1E3A8A/FFFFFF?text=LOGO' }}"
                        alt="Logo {{ $settings['school_name'] ?? 'Sekolah' }}">
                    <div>
                        <p class="text-lg text-yellow-400 font-semibold">SMA Laboratorium</p>
                        <h2 class="font-bold text-2xl -mt-1">UPGRIS</h2>
                    </div>
                </div>
                <p class="text-white text-sm leading-relaxed">
                    Mewujudkan peserta didik yang unggul dan berjati diri.
                </p>
                <!-- Ikon Media Sosial -->
                <div class="flex space-x-3 pt-2">

                    <a href="#"
                        class="w-10 h-10 flex items-center justify-center bg-gray-700/50 rounded-full text-gray-300 hover:bg-yellow-400 hover:text-blue-900 transform hover:scale-110 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                        aria-label="Facebook">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#"
                        class="w-10 h-10 flex items-center justify-center bg-gray-700/50 rounded-full text-gray-300 hover:bg-yellow-400 hover:text-blue-900 transform hover:scale-110 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                        aria-label="Instagram">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 012.153 1.272A4.902 4.902 0 0122 8.51c.247.636.416 1.363.465 2.427.048 1.024.06 1.378.06 3.808s-.012 2.784-.06 3.808c-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.272 2.153 4.902 4.902 0 01-2.153 1.272c-.636.247-1.363.416-2.427.465-1.024.048-1.378.06-3.808.06s-2.784-.012-3.808-.06c-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-2.153-1.272A4.902 4.902 0 012 15.49c-.247-.636-.416-1.363-.465-2.427-.048-1.024-.06-1.378-.06-3.808s.012-2.784.06-3.808c.049 1.064.218 1.791.465 2.427a4.902 4.902 0 011.272-2.153A4.902 4.902 0 018.51 2c.636-.247 1.363.416 2.427.465C11.97.01 12.315 0 12.315 2zM12 7a5 5 0 100 10 5 5 0 000-10zm0 8a3 3 0 110-6 3 3 0 010 6zm5.25-9.25a1.25 1.25 0 100-2.5 1.25 1.25 0 000 2.5z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#"
                        class="w-10 h-10 flex items-center justify-center bg-gray-700/50 rounded-full text-gray-300 hover:bg-yellow-400 hover:text-blue-900 transform hover:scale-110 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-yellow-400"
                        aria-label="YouTube">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M19.812 5.418c.861.23 1.538.907 1.768 1.768C21.998 8.78 22 12 22 12s0 3.22-.42 4.814a2.506 2.506 0 01-1.768 1.768c-1.594.42-7.812.42-7.812.42s-6.218 0-7.812-.42a2.506 2.506 0 01-1.768-1.768C2 15.22 2 12 2 12s0-3.22.42-4.814a2.506 2.506 0 011.768-1.768C5.782 5 12 5 12 5s6.218 0 7.812.418zM9.57 15.57l4.572-3.57-4.572-3.57v7.14z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Bagian 2: Tautan Cepat -->
            <div class="md:col-span-1" data-aos="fade-up" data-aos-delay="100">
                <h3 class="font-bold text-lg text-white mb-6 pb-4 border-b border-white tracking-wider">Tautan
                    Cepat</h3>
                <ul class="space-y-4 text-sm">

                    <li><a href="#"
                            class="flex items-center text-white hover:text-yellow-400 hover:translate-x-1 transition-all duration-300 focus:text-yellow-400 focus:outline-none">
                            <svg class="w-3 h-3 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Profil Sekolah
                        </a></li>
                    <li><a href="#"
                            class="flex items-center text-white hover:text-yellow-400 hover:translate-x-1 transition-all duration-300 focus:text-yellow-400 focus:outline-none">
                            <svg class="w-3 h-3 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            PPDB Online
                        </a></li>
                    <li><a href="#"
                            class="flex items-center text-white hover:text-yellow-400 hover:translate-x-1 transition-all duration-300 focus:text-yellow-400 focus:outline-none">
                            <svg class="w-3 h-3 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Berita Terbaru
                        </a></li>
                </ul>
            </div>

            <!-- Bagian 3: Kontak Kami -->
            <div data-aos="fade-up" data-aos-delay="200">
                <h3 class="font-bold text-lg text-white mb-6 pb-4 border-b border-white tracking-wider">Kontak
                    Kami</h3>
                <ul class="space-y-4 text-sm">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 mr-3 mt-1 flex-shrink-0 text-yellow-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="text-white">{{ $settings['school_address'] ?? 'Jl. Sidodadi Timur No. 24, Karangtempel, Semarang' }}</span>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0 text-yellow-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                            </path>
                        </svg>
                        <a href="tel:{{ $settings['school_phone'] ?? '(024) 8448332' }}"
                            class="text-white hover:text-yellow-400 transition-colors duration-300 focus:text-yellow-400 focus:outline-none">{{ $settings['school_phone'] ?? '(024) 8448332' }}</a>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0 text-yellow-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                        <a href="mailto:{{ $settings['school_email'] ?? 'info@smalabupgris.sch.id' }}"
                            class="text-white hover:text-yellow-400 transition-colors duration-300 focus:text-yellow-400 focus:outline-none">{{ $settings['school_email'] ?? 'info@smalabupgris.sch.id' }}</a>
                    </li>
                </ul>
            </div>

            <!-- Bagian 4: Lokasi Peta -->
            <div data-aos="fade-up" data-aos-delay="300">
                <h3 class="font-bold text-lg text-white mb-6 pb-4 border-b border-white tracking-wider">Lokasi
                    Sekolah</h3>
                <div class="rounded-lg overflow-hidden shadow-lg">
                    <iframe src="{{ $settings['gmaps_url'] ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.2223078491854!2d110.4357!3d-6.983!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwNTgnNTguOCJTIDExMMKwMjYnMDguNSJF!5e0!3m2!1sid!2sid!4v1600000000000!5m2!1sid!2sid' }}" width="100%" height="150" style="border:0;"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                        title="Peta Lokasi SMA Laboratorium UPGRIS">
                    </iframe>
                </div>
            </div>

        </div>
    </div>

    <!-- Bagian Bawah Footer: Hak Cipta -->
    <div class="bg-black/20">
        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5 text-center text-sm text-white flex justify-between items-center">
            <span>&copy; <span id="copyright-year"></span> SMA Laboratorium UPGRIS. Semua Hak Dilindungi.</span>
        </div>
    </div>
</footer>

<div x-data="{
    showButton: false
}" x-init="window.addEventListener('scroll', () => { showButton = window.scrollY > 400 })" class="fixed bottom-5 right-5 z-50">

    <a href="#" x-show="showButton" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-y-2"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform translate-y-2"
        class="w-12 h-12 flex items-center justify-center bg-yellow-400 text-blue-900 rounded-full shadow-lg hover:bg-yellow-500 hover:scale-110 transform transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2 focus:ring-offset-gray-100"
        aria-label="Kembali ke atas">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
        </svg>
    </a>
</div>
