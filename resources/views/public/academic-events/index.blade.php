@extends('layouts.template')

{{-- Meta tags SEO --}}
@section('title', 'Kalender Akademik - ' . ($settings['school_name'] ?? 'Website Sekolah'))
@section('description', 'Rencanakan kegiatan Anda dengan melihat jadwal akademik dan acara penting sekolah kami.')

@section('content')
    <main id="main-content" class="py-16 sm:py-24" x-data="calendar" x-init="init()">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header Halaman --}}
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="text-yellow-500 font-semibold uppercase tracking-wider">Agenda Sekolah</span>
                <h1 class="text-4xl font-extrabold text-blue-900 mt-2 break-words">Kalender Akademik</h1>
                <p class="mt-4 text-gray-600 max-w-2xl mx-auto">Rencanakan kegiatan Anda dengan melihat jadwal akademik
                    dan
                    acara penting sekolah kami.</p>
            </div>

            {{-- Komponen Kalender Alpine.js --}}
            <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-lg" data-aos="fade-up" data-aos-delay="100">

                <div class="flex flex-col sm:flex-row justify-between items-center mb-6">
                    <div class="flex items-center space-x-2 md:space-x-4">
                        <button @click="changeMonth('prev')" aria-label="Bulan sebelumnya"
                            class="p-2 rounded-full text-gray-500 hover:bg-gray-100 hover:text-blue-700 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                                </path>
                            </svg>
                        </button>
                        <h2 class="text-xl md:text-2xl font-bold text-blue-900 w-48 text-center"
                            x-text="`${monthName} ${year}`"></h2>
                        <button @click="changeMonth('next')" aria-label="Bulan berikutnya"
                            class="p-2 rounded-full text-gray-500 hover:bg-gray-100 hover:text-blue-700 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </button>
                    </div>
                    <div class="mt-4 sm:mt-0 flex flex-wrap justify-center gap-x-4 gap-y-2 text-xs">
                        <div class="flex items-center space-x-2">
                            <span class="w-3 h-3 rounded-full bg-blue-500"></span>
                            <span>Akademik</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="w-3 h-3 rounded-full bg-yellow-500"></span>
                            <span>PPDB</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="w-3 h-3 rounded-full bg-green-500"></span>
                            <span>Acara Umum</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="w-3 h-3 rounded-full bg-red-500"></span>
                            <span>Libur</span>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-7 gap-2 text-center font-semibold text-gray-500 text-sm">
                    <div>Sen</div>
                    <div>Sel</div>
                    <div>Rab</div>
                    <div>Kam</div>
                    <div>Jum</div>
                    <div>Sab</div>
                    <div>Min</div>
                </div>

                {{-- Grid Kalender --}}
                <div class="grid grid-cols-7 gap-2 mt-4 transition-opacity duration-200"
                    :class="{ 'opacity-0': isLoading }">

                    <template x-for="(day, index) in daysInMonth" :key="day.date ?? 'empty-' + index">
                        <div @click="openDayModal(day)"
                            class="border border-gray-200 rounded-lg p-2 h-28 flex flex-col transition-colors"
                            :class="{
                                'bg-gray-50 text-gray-400': !day.isCurrentMonth,
                                'font-bold': day.isToday,
                                'cursor-pointer hover:bg-blue-50': day.events.length > 0 && day.isCurrentMonth
                            }">

                            <!-- Nomor Tanggal -->
                            <div class="text-sm" x-text="day.dayOfMonth"></div>

                            <!-- Daftar Event -->
                            <div class="mt-1 space-y-1 overflow-y-auto">
                                <template x-for="(event, i) in day.events" :key="event.id ?? i">
                                    <div class="text-xs text-white rounded px-1 truncate" :class="event.categoryColor"
                                        x-text="event.title">
                                    </div>
                                </template>
                            </div>

                        </div>
                    </template>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div id="day-detail-modal" x-show="isDayModalOpen" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm p-4" role="dialog"
            aria-modal="true" style="display: none;">

            <div @click.away="isDayModalOpen = false"
                class="relative bg-white rounded-2xl shadow-xl w-full max-w-2xl max-h-[90vh] flex flex-col overflow-hidden">

                <div class="flex justify-between items-center p-6 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-blue-900" x-show="selectedDay"
                        x-text="`Acara pada ${new Date(selectedDay?.date).toLocaleDateString('id-ID', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' })}`">
                    </h2>
                    <button @click="isDayModalOpen = false" class="text-gray-400 hover:text-gray-800">
                        <span class="sr-only">Tutup modal</span>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>

                <div class="p-6 overflow-y-auto space-y-6">
                    <template x-for="event in selectedDay.events" :key="event.id">
                        <div class="flex items-start space-x-4">

                            <div class="flex-shrink-0 w-1.5 rounded bg-opacity-80" :class="event.categoryColor"
                                style="min-height: 2rem; align-self: stretch;">
                            </div>


                            <div class="flex-grow">
                                <h3 class="text-lg font-bold text-gray-800" x-text="event.title"></h3>

                                <p class="text-sm text-gray-500" x-show="event.startDate !== event.endDate"
                                    x-text="`Berlangsung: ${new Date(event.startDate).toLocaleDateString('id-ID')} - ${new Date(event.endDate).toLocaleDateString('id-ID')}`">
                                </p>

                                <p class="text-base text-gray-600 mt-1" x-text="event.description"></p>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </main>


    <script>
        function calendar() {
            return {
                currentDate: new Date(),
                daysInMonth: [],
                isLoading: false,
                isDayModalOpen: false,
                selectedDay: null,

                // Data
                events: @json($eventData),

                get monthName() {
                    return this.currentDate.toLocaleString('id-ID', {
                        month: 'long'
                    });
                },
                get year() {
                    return this.currentDate.getFullYear();
                },

                // Fungsi utama untuk membuat grid kalender
                generateCalendar() {
                    this.daysInMonth = [];
                    const year = this.currentDate.getFullYear();
                    const month = this.currentDate.getMonth();

                    const firstDayOfMonth = new Date(year, month, 1);
                    const lastDayOfMonth = new Date(year, month + 1, 0);

                    const startDayOfWeek = (firstDayOfMonth.getDay() + 6) % 7; // 0 = Senin
                    const daysInMonthCount = lastDayOfMonth.getDate();

                    // Tambahkan hari dari bulan sebelumnya
                    const lastDayOfPrevMonth = new Date(year, month, 0).getDate();
                    for (let i = startDayOfWeek - 1; i >= 0; i--) {
                        this.daysInMonth.push({
                            date: null,
                            dayOfMonth: lastDayOfPrevMonth - i,
                            isCurrentMonth: false,
                            events: []
                        });
                    }

                    // Tambahkan hari dari bulan ini
                    for (let i = 1; i <= daysInMonthCount; i++) {
                        const date = new Date(year, month, i);
                        const dayEvents = this.events.filter(e => {
                            const startDate = new Date(e.startDate);
                            const endDate = new Date(e.endDate);
                            startDate.setHours(0, 0, 0, 0);
                            endDate.setHours(23, 59, 59, 999);
                            return date >= startDate && date <= endDate;
                        });
                        this.daysInMonth.push({
                            date: date,
                            dayOfMonth: i,
                            isCurrentMonth: true,
                            isToday: date.toDateString() === new Date().toDateString(),
                            events: dayEvents
                        });
                    }

                    // Tambahkan hari dari bulan berikutnya untuk melengkapi grid
                    const remainingCells = 42 - this.daysInMonth.length; // 6 baris * 7 hari
                    for (let i = 1; i <= remainingCells; i++) {
                        this.daysInMonth.push({
                            date: null,
                            dayOfMonth: i,
                            isCurrentMonth: false,
                            events: []
                        });
                    }
                },

                openDayModal(day) {
                    if (day.events.length === 0 || !day.isCurrentMonth) return;
                    this.selectedDay = day;
                    this.isDayModalOpen = true;
                },

                changeMonth(direction) {
                    this.isLoading = true;
                    setTimeout(() => {
                        if (direction === 'prev') {
                            this.currentDate.setMonth(this.currentDate.getMonth() - 1);
                        } else {
                            this.currentDate.setMonth(this.currentDate.getMonth() + 1);
                        }
                        this.currentDate = new Date(this.currentDate); // Memicu reaktivitas
                        this.generateCalendar();
                        this.$nextTick(() => {
                            this.isLoading = false;
                        });
                    }, 200); // Jeda ini harus cocok dengan durasi transisi fade-out
                },

                // Fungsi navigasi
                prevMonth() {
                    this.currentDate = new Date(this.currentDate.setMonth(this.currentDate.getMonth() -
                        1));
                    this.generateCalendar();
                },
                nextMonth() {
                    this.currentDate = new Date(this.currentDate.setMonth(this.currentDate.getMonth() +
                        1));
                    this.generateCalendar();
                },

                // Inisialisasi
                init() {
                    this.generateCalendar();
                }
            }
        }

        // Inisialisasi Alpine.js setelah data tersedia
        document.addEventListener('alpine:init', () => {
            Alpine.data('calendar', calendar);
        });
    </script>
@endsection
