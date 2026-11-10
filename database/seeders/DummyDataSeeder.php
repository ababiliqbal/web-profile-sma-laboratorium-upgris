<?php

namespace Database\Seeders;

use App\Models\AcademicEvent;
use App\Models\Achievement;
use App\Models\Album;
use App\Models\AlumniTestimonial;
use App\Models\Category;
use App\Models\Extracurricular;
use App\Models\Facility;
use App\Models\Page;
use App\Models\Photo;
use App\Models\Post;
use App\Models\Staff;
use App\Models\StudentOrganization;
use App\Models\StudyProgram;
use App\Models\Subject;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DummyDataSeeder extends Seeder
{
    /**
     * Jalankan database seeder dummy untuk seluruh konten website publik.
     */
    public function run(): void
    {
        $admin = User::first() ?? User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@mail.com',
        ]);

        $this->command->info('Membuat dummy Pages (Profil & Kurikulum)...');
        $this->seedPages();

        $this->command->info('Membuat dummy Guru, Staf & Mata Pelajaran...');
        $staffs = $this->seedStaffsAndSubjects();

        $this->command->info('Membuat dummy Program Studi...');
        $this->seedStudyPrograms($staffs);

        $this->command->info('Membuat dummy Berita, Kategori & Tag...');
        $this->seedPosts($admin);

        $this->command->info('Membuat dummy Agenda Akademik...');
        $this->seedAcademicEvents();

        $this->command->info('Membuat dummy Prestasi...');
        $this->seedAchievements();

        $this->command->info('Membuat dummy Sarana & Fasilitas...');
        $this->seedFacilities();

        $this->command->info('Membuat dummy Organisasi Siswa & Ekstrakurikuler...');
        $this->seedOrganizationsAndEkskul($staffs);

        $this->command->info('Membuat dummy Testimoni Alumni...');
        $this->seedAlumniTestimonials();

        $this->command->info('Membuat dummy Galeri Album & Foto...');
        $this->seedGalleries();

        $this->command->info('✅ Dummy data berhasil dibuat!');
    }

    /**
     * 1. Halaman Statis Profil & Navigasi
     */
    private function seedPages(): void
    {
        $pages = [
            [
                'title' => 'Visi Misi',
                'slug' => 'visi-misi',
                'content' => '<h3>Visi SMA Laboratorium UPGRIS</h3><p>Membentuk insan yang berakhlak mulia, cerdas, kompetitif, mandiri, dan berkarakter Profil Pelajar Pancasila berwawasan global.</p><h3>Misi SMA Laboratorium UPGRIS</h3><ol><li>Menyelenggarakan proses pembelajaran yang inovatif, inspiratif, dan berpusat pada peserta didik.</li><li>Mengembangkan potensi minat dan bakat peserta didik melalui kegiatan akademik dan non-akademik yang adaptif.</li><li>Menanamkan nilai-nilai keagamaan, budi pekerti luhur, dan integritas dalam kehidupan sehari-hari.</li><li>Mewujudkan lingkungan sekolah yang ramah anak, bersih, inklusif, dan berwawasan lingkungan berkelanjutan.</li></ol>',
                'status' => 'published',
                'meta_description' => 'Visi dan Misi resmi SMA Laboratorium Universitas PGRI Semarang.',
                'image_path' => $this->getSampleImage('pages', 'page-visi-misi.jpg', 'https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=1200&q=80'),
            ],
            [
                'title' => 'Sejarah Sekolah',
                'slug' => 'sejarah-sekolah',
                'content' => '<p>SMA Laboratorium UPGRIS didirikan sebagai wujud komitmen Universitas PGRI Semarang dalam menghadirkan laboratorium pembelajaran pendidikan menengah yang unggul di Kota Semarang. Sejak awal pendiriannya, sekolah ini terus berinovasi dalam memadukan kurikulum nasional dengan metode pembelajaran mutakhir serta pembinaan karakter yang kuat.</p><p>Hingga saat ini, SMA Laboratorium UPGRIS telah melahirkan ribuan alumni yang sukses melanjutkan studi di perguruan tinggi terkemuka dan berkiprah di berbagai sektor pembangunan nasional.</p>',
                'status' => 'published',
                'meta_description' => 'Sejarah perjalanan dan perkembangan SMA Laboratorium UPGRIS Semarang.',
                'image_path' => $this->getSampleImage('pages', 'page-sejarah.jpg', 'https://images.unsplash.com/photo-1541829070764-84a7d30dd3f3?w=1200&q=80'),
            ],
            [
                'title' => 'Program Kerja Sekolah',
                'slug' => 'program-kerja-sekolah',
                'content' => '<p>Program kerja SMA Laboratorium UPGRIS berfokus pada empat pilar utama: peningkatan mutu akademik melalui digitalisasi pembelajaran, penguatan karakter Profil Pelajar Pancasila, pengembangan kemitraan dengan perguruan tinggi dan dunia industri, serta perluasan fasilitas sarana dan prasarana modern.</p>',
                'status' => 'published',
                'meta_description' => 'Rencana strategis dan program kerja unggulan SMA Laboratorium UPGRIS.',
                'image_path' => $this->getSampleImage('pages', 'page-proker.jpg', 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=1200&q=80'),
            ],
            [
                'title' => 'Kurikulum',
                'slug' => 'kurikulum',
                'content' => '<p>SMA Laboratorium UPGRIS menerapkan Kurikulum Merdeka yang memberikan keleluasaan bagi pendidik untuk menciptakan pembelajaran berkualitas yang sesuai dengan kebutuhan dan lingkungan belajar peserta didik.</p>',
                'status' => 'published',
                'meta_description' => 'Implementasi struktur Kurikulum Merdeka di SMA Laboratorium UPGRIS.',
                'image_path' => $this->getSampleImage('pages', 'page-kurikulum.jpg', 'https://images.unsplash.com/photo-1509062522246-3755977927d7?w=1200&q=80'),
            ],
            [
                'title' => 'Kegiatan Intrakurikuler',
                'slug' => 'kegiatan-intrakurikuler',
                'content' => '<p>Kegiatan intrakurikuler mencakup proses belajar mengajar tatap muka, praktikum di laboratorium sains dan komputer, serta evaluasi berbasis asesmen kompetensi minimum yang mendorong literasi dan numerasi siswa.</p>',
                'status' => 'published',
                'meta_description' => 'Program dan jadwal kegiatan intrakurikuler SMA Lab UPGRIS.',
                'image_path' => null,
            ],
            [
                'title' => 'Kegiatan Kokurikuler',
                'slug' => 'kegiatan-kokurikuler',
                'content' => '<p>Kegiatan kokurikuler diwujudkan melalui Projek Penguatan Profil Pelajar Pancasila (P5), studi lapangan, literasi perpustakaan digital, serta kegiatan keagamaan terpadu.</p>',
                'status' => 'published',
                'meta_description' => 'Program penguatan kegiatan kokurikuler dan P5 di SMA Lab UPGRIS.',
                'image_path' => null,
            ],
            [
                'title' => 'Informasi Penerimaan Peserta Didik Baru',
                'slug' => 'informasi-penerimaan-peserta-didik-baru',
                'content' => '<h3>Penerimaan Peserta Didik Baru (PPDB) 2026/2027</h3><p>SMA Laboratorium UPGRIS membuka pendaftaran peserta didik baru melalui beberapa jalur masuk: Jalur Prestasi Akademik & Non-Akademik, Jalur Afirmasi, dan Jalur Reguler. Dapatkan beasiswa pendidikan bagi siswa berprestasi di tingkat Kota/Kabupaten, Provinsi, maupun Nasional.</p>',
                'status' => 'published',
                'meta_description' => 'Syarat, jadwal, dan alur pendaftaran siswa baru SMA Laboratorium UPGRIS.',
                'image_path' => $this->getSampleImage('pages', 'page-ppdb.jpg', 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=1200&q=80'),
            ],
        ];

        foreach ($pages as $data) {
            Page::updateOrCreate(['slug' => $data['slug']], $data);
        }
    }

    /**
     * 2. Guru, Staf & Mata Pelajaran
     */
    private function seedStaffsAndSubjects(): array
    {
        $subjects = [
            'Fisika' => Subject::updateOrCreate(['name' => 'Fisika']),
            'Matematika' => Subject::updateOrCreate(['name' => 'Matematika Peminatan']),
            'Informatika' => Subject::updateOrCreate(['name' => 'Informatika & TIK']),
        ];

        $staff1 = Staff::updateOrCreate(
            ['identity_number' => '197508122005011002'],
            [
                'name' => 'Drs. Bambang Sudarsono, M.Pd.',
                'position' => 'Kepala Sekolah & Guru Fisika',
                'type' => 'teacher',
                'employment_status' => 'tetap_yayasan',
                'biography' => 'Berpengalaman lebih dari 20 tahun dalam dunia pendidikan dan kepemimpinan sekolah berwawasan sains dan teknologi.',
                'email' => 'bambang.s@smalabupgris.sch.id',
                'display_order' => 1,
                'image_path' => $this->getSampleImage('staffs', 'staff-kepsek.jpg', 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&q=80'),
                'image_alt' => 'Foto Drs. Bambang Sudarsono, M.Pd.',
            ]
        );
        $staff1->subjects()->sync([$subjects['Fisika']->id]);

        $staff2 = Staff::updateOrCreate(
            ['identity_number' => '198204152010012004'],
            [
                'name' => 'Siti Nurhaliza, S.Pd., M.Si.',
                'position' => 'Wakil Kepala Kurikulum & Guru Matematika',
                'type' => 'teacher',
                'employment_status' => 'tetap_yayasan',
                'biography' => 'Aktif membina tim olimpiade matematika sekolah serta pelatih asesmen numerasi nasional.',
                'email' => 'siti.nurhaliza@smalabupgris.sch.id',
                'display_order' => 2,
                'image_path' => $this->getSampleImage('staffs', 'staff-guru-mat.jpg', 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=600&q=80'),
                'image_alt' => 'Foto Siti Nurhaliza, S.Pd., M.Si.',
            ]
        );
        $staff2->subjects()->sync([$subjects['Matematika']->id]);

        $staff3 = Staff::updateOrCreate(
            ['identity_number' => '199011202018011005'],
            [
                'name' => 'Ahmad Fauzi, S.Kom., M.T.',
                'position' => 'Guru Informatika & Koordinator IT',
                'type' => 'teacher',
                'employment_status' => 'honorer',
                'biography' => 'Praktisi teknologi informasi dan pembina klub robotika serta coding siswa SMA Lab UPGRIS.',
                'email' => 'ahmad.fauzi@smalabupgris.sch.id',
                'display_order' => 3,
                'image_path' => $this->getSampleImage('staffs', 'staff-guru-it.jpg', 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=600&q=80'),
                'image_alt' => 'Foto Ahmad Fauzi, S.Kom.',
            ]
        );
        $staff3->subjects()->sync([$subjects['Informatika']->id]);

        return [$staff1, $staff2, $staff3];
    }

    /**
     * 3. Program Studi (Peminatan)
     */
    private function seedStudyPrograms(array $staffs): void
    {
        $programs = [
            [
                'name' => 'MIPA (Matematika & Ilmu Pengetahuan Alam)',
                'description' => 'Fokus pada penguasaan penalaran analitis, metode ilmiah, dan riset sains terapan di bidang Biologi, Fisika, Kimia, dan Matematika tingkat lanjut.',
                'head_staff_id' => $staffs[0]->id,
                'image_path' => $this->getSampleImage('study-programs', 'prog-mipa.jpg', 'https://images.unsplash.com/photo-1532094349884-543bc11b234d?w=800&q=80'),
            ],
            [
                'name' => 'IPS (Ilmu Pengetahuan Sosial)',
                'description' => 'Membekali siswa dengan pemahaman mendalam tentang ekonomi, sosiologi, geografi, kepemimpinan publik, dan wirausaha sosial.',
                'head_staff_id' => $staffs[1]->id,
                'image_path' => $this->getSampleImage('study-programs', 'prog-ips.jpg', 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=800&q=80'),
            ],
            [
                'name' => 'Bahasa & Budaya',
                'description' => 'Mengembangkan kompetensi komunikasi multibahasa (Bahasa Indonesia, Inggris, dan Bahasa Asing Pilihan) serta pemahaman lintas budaya global.',
                'head_staff_id' => $staffs[2]->id,
                'image_path' => $this->getSampleImage('study-programs', 'prog-bahasa.jpg', 'https://images.unsplash.com/photo-1455390582262-044cdead277a?w=800&q=80'),
            ],
        ];

        foreach ($programs as $prog) {
            StudyProgram::updateOrCreate(['name' => $prog['name']], $prog);
        }
    }

    /**
     * 4. Kategori, Tag, dan Berita (Posts)
     */
    private function seedPosts(User $admin): void
    {
        $catAkademik = Category::updateOrCreate(['name' => 'Akademik'], ['slug' => 'akademik']);
        $catPrestasi = Category::updateOrCreate(['name' => 'Prestasi & Kegiatan'], ['slug' => 'prestasi-dan-kegiatan']);
        $catPengumuman = Category::updateOrCreate(['name' => 'Pengumuman'], ['slug' => 'pengumuman']);

        $tagMerdeka = Tag::updateOrCreate(['name' => 'Kurikulum Merdeka'], ['slug' => 'kurikulum-merdeka']);
        $tagPrestasi = Tag::updateOrCreate(['name' => 'Prestasi Siswa'], ['slug' => 'prestasi-siswa']);
        $tagPPDB = Tag::updateOrCreate(['name' => 'PPDB 2026'], ['slug' => 'ppdb-2026']);

        $postsData = [
            [
                'title' => 'Siswa SMA Laboratorium UPGRIS Raih Juara 1 Lomba Karya Ilmiah Remaja Tingkat Provinsi',
                'slug' => 'siswa-sma-lab-upgris-raih-juara-1-lkir-provinsi',
                'category_id' => $catPrestasi->id,
                'user_id' => $admin->id,
                'content' => '<p>Prestasi membanggakan kembali ditorehkan oleh kontingen riset SMA Laboratorium UPGRIS dalam ajang Lomba Karya Ilmiah Remaja (LKIR) Tingkat Provinsi Jawa Tengah. Dengan mengangkat penelitian mengenai pemanfaatan limbah organik sebagai bioenergi ramah lingkungan, tim sekolah berhasil meraih nilai tertinggi dan menyabet Juara Pertama.</p><p>Kepala Sekolah menyampaikan apresiasi setinggi-tingginya kepada para siswa dan guru pembimbing yang telah bekerja keras mengharumkan nama sekolah di kancah regional.</p>',
                'image_path' => $this->getSampleImage('posts', 'post-prestasi-lkir.jpg', 'https://images.unsplash.com/photo-1577896851231-70ef18881754?w=1000&q=80'),
                'image_alt' => 'Pemberian penghargaan juara lomba karya ilmiah remaja',
                'status' => 'published',
                'published_at' => now()->subDays(2),
                'tags' => [$tagPrestasi->id, $tagMerdeka->id],
            ],
            [
                'title' => 'Gelar Karya P5: Kolaborasi Kreatif Siswa dalam Penguatan Profil Pelajar Pancasila',
                'slug' => 'gelar-karya-p5-kolaborasi-kreatif-siswa-upgris',
                'category_id' => $catAkademik->id,
                'user_id' => $admin->id,
                'content' => '<p>Sebagai implementasi Kurikulum Merdeka, SMA Laboratorium UPGRIS sukses menyelenggarakan Gelar Karya Projek Penguatan Profil Pelajar Pancasila (P5). Beragam inovasi produk ramah lingkungan, pertunjukan teater tradisi nusantara, serta instalasi karya seni daur ulang dipamerkan secara terbuka untuk orang tua dan masyarakat umum.</p><p>Kegiatan ini bertujuan mengasah daya nalar kritis, gotong royong, dan kemandirian siswa secara kontekstual.</p>',
                'image_path' => $this->getSampleImage('posts', 'post-p5-karya.jpg', 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=1000&q=80'),
                'image_alt' => 'Suasana pameran dan gelar karya P5 siswa',
                'status' => 'published',
                'published_at' => now()->subDays(5),
                'tags' => [$tagMerdeka->id],
            ],
            [
                'title' => 'Sosialisasi dan Pembukaan Jalur Unggulan PPDB SMA Lab UPGRIS Tahun 2026/2027',
                'slug' => 'sosialisasi-pembukaan-ppdb-sma-lab-upgris-2026',
                'category_id' => $catPengumuman->id,
                'user_id' => $admin->id,
                'content' => '<p>Penerimaan Peserta Didik Baru (PPDB) SMA Laboratorium UPGRIS resmi dibuka untuk Jalur Prestasi dan Jalur Minat Bakat. Calon siswa lulusan SMP/MTs sederajat dapat mendaftarkan diri secara langsung ke sekretariat PPDB sekolah atau mengakses panduan berkas persyaratan secara online.</p><p>Sekolah menyediakan beasiswa khusus pembebasan biaya pengembangan bagi peraih medali kejuaraan tingkat kota, provinsi, dan nasional.</p>',
                'image_path' => $this->getSampleImage('posts', 'post-ppdb-info.jpg', 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=1000&q=80'),
                'image_alt' => 'Informasi pembukaan penerimaan siswa baru',
                'status' => 'published',
                'published_at' => now()->subDays(10),
                'tags' => [$tagPPDB->id],
            ],
        ];

        foreach ($postsData as $pData) {
            $tags = $pData['tags'];
            unset($pData['tags']);

            $post = Post::updateOrCreate(['slug' => $pData['slug']], $pData);
            $post->tags()->sync($tags);
        }
    }

    /**
     * 5. Agenda Kalender Akademik (Tampil di Home & Kalender)
     */
    private function seedAcademicEvents(): void
    {
        $events = [
            [
                'title' => 'Penilaian Akhir Semester (PAS) Gasal',
                'description' => 'Pelaksanaan evaluasi akhir semester berbasis komputer untuk kelas X, XI, dan XII.',
                'start_date' => now()->addDays(7)->format('Y-m-d'),
                'end_date' => now()->addDays(14)->format('Y-m-d'),
                'category' => 'academic',
            ],
            [
                'title' => 'Pentas Seni & Gelar Karya Budaya Siswa',
                'description' => 'Ajang unjuk kebolehan bakat seni tari, musik band, teater, dan kuliner tradisional antar kelas.',
                'start_date' => now()->addDays(20)->format('Y-m-d'),
                'end_date' => now()->addDays(21)->format('Y-m-d'),
                'category' => 'event',
            ],
            [
                'title' => 'Sosialisasi Masuk Perguruan Tinggi (SNBP & UTBK-SNBT)',
                'description' => 'Pembekalan strategi pemilihan jurusan kuliah dan kampus negeri bersama narasumber akademisi UPGRIS.',
                'start_date' => now()->addDays(35)->format('Y-m-d'),
                'end_date' => now()->addDays(35)->format('Y-m-d'),
                'category' => 'academic',
            ],
        ];

        foreach ($events as $ev) {
            AcademicEvent::updateOrCreate(['title' => $ev['title']], $ev);
        }
    }

    /**
     * 6. Prestasi Sekolah & Siswa
     */
    private function seedAchievements(): void
    {
        $achievements = [
            [
                'title' => 'Juara 1 Olimpiade Sains Nasional (OSN) Bidang Fisika',
                'description' => 'Diraih oleh ananda Muhammad Zidan (Kelas XI MIPA 1) pada kompetisi OSN tingkat Kota Semarang tahun 2025.',
                'date' => now()->subMonths(1)->format('Y-m-d'),
                'level' => 'city',
                'type' => 'student',
                'image_path' => $this->getSampleImage('achievements', 'prestasi-osn.jpg', 'https://images.unsplash.com/photo-1567427017947-545c5f8d16ad?w=800&q=80'),
                'image_alt' => 'Penyerahan medali juara 1 OSN Fisika',
            ],
            [
                'title' => 'Medali Emas Kejuaraan Pencak Silat Pelajar Se-Jawa Tengah',
                'description' => 'Diraih oleh ananda Rayhan Saputra pada nomor tanding kelas C putra mewakili kontingen Kota Semarang.',
                'date' => now()->subMonths(2)->format('Y-m-d'),
                'level' => 'province',
                'type' => 'student',
                'image_path' => $this->getSampleImage('achievements', 'prestasi-silat.jpg', 'https://images.unsplash.com/photo-1555597673-b21d5c935865?w=800&q=80'),
                'image_alt' => 'Atlet silat berpose dengan medali emas kejuaraan',
            ],
            [
                'title' => 'Penghargaan Sekolah Adiwiyata Berkelanjutan',
                'description' => 'Apresiasi Dinas Lingkungan Hidup Provinsi Jawa Tengah atas komitmen SMA Lab UPGRIS dalam menjaga kelestarian lingkungan dan sanitasi hijau terpadu.',
                'date' => now()->subMonths(4)->format('Y-m-d'),
                'level' => 'province',
                'type' => 'school',
                'image_path' => $this->getSampleImage('achievements', 'prestasi-adiwiyata.jpg', 'https://images.unsplash.com/photo-1513542789411-b6a5d4f31634?w=800&q=80'),
                'image_alt' => 'Penghargaan Sekolah Adiwiyata Tingkat Provinsi',
            ],
        ];

        foreach ($achievements as $ach) {
            Achievement::updateOrCreate(['title' => $ach['title']], $ach);
        }
    }

    /**
     * 7. Sarana & Prasarana (Fasilitas)
     */
    private function seedFacilities(): void
    {
        $facilities = [
            [
                'name' => 'Laboratorium Komputer & Multimedia',
                'description' => 'Dilengkapi 40 unit PC modern dengan spesifikasi tinggi, jaringan internet fiber optic kecepatan tinggi, dan perangkat lunak desain serta pemrograman.',
                'image_path' => $this->getSampleImage('facilities', 'fasilitas-lab-komputer.jpg', 'https://images.unsplash.com/photo-1562774053-701939374585?w=800&q=80'),
                'image_alt' => 'Ruang Laboratorium Komputer SMA Lab UPGRIS',
                'display_order' => 1,
            ],
            [
                'name' => 'Perpustakaan Digital & Ruang Baca',
                'description' => 'Menyediakan ribuan koleksi buku referensi, novel sastra, e-book reader, dan ruang belajar kelompok yang nyaman berpendingin udara (AC).',
                'image_path' => $this->getSampleImage('facilities', 'fasilitas-perpustakaan.jpg', 'https://images.unsplash.com/photo-1521587760476-6c12a4b040da?w=800&q=80'),
                'image_alt' => 'Perpustakaan sekolah yang rapi dan nyaman',
                'display_order' => 2,
            ],
            [
                'name' => 'Laboratorium Sains Terpadu (Fisika, Kimia, Biologi)',
                'description' => 'Sarana praktikum sains berstandar laboratorium perguruan tinggi dengan instrumen mikroskop digital, alat peraga optik, dan lemari asam aman.',
                'image_path' => $this->getSampleImage('facilities', 'fasilitas-lab-sains.jpg', 'https://images.unsplash.com/photo-1532094349884-543bc11b234d?w=800&q=80'),
                'image_alt' => 'Laboratorium Sains Terpadu',
                'display_order' => 3,
            ],
        ];

        foreach ($facilities as $fac) {
            Facility::updateOrCreate(['name' => $fac['name']], $fac);
        }
    }

    /**
     * 8. Organisasi Siswa & Ekstrakurikuler
     */
    private function seedOrganizationsAndEkskul(array $staffs): void
    {
        $organizations = [
            [
                'name' => 'OSIS (Organisasi Siswa Intra Sekolah)',
                'description' => 'Wadah utama kepemimpinan siswa yang menggerakkan roda kegiatan kesiswaan, keagamaan, kedisiplinan, dan kreasi seni di lingkungan sekolah.',
                'logo_path' => $this->getSampleImage('student-organizations', 'org-osis.png', 'https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?w=500&q=80'),
                'image_alt' => 'Logo Pengurus OSIS SMA Lab UPGRIS',
                'supervisor_staff_id' => $staffs[1]->id,
            ],
            [
                'name' => 'MPK (Majelis Perwakilan Kelas)',
                'description' => 'Lembaga legislatif perwakilan siswa yang berfungsi mengawasi kinerja OSIS, menampung aspirasi kelas, dan menyusun musyawarah siswa.',
                'logo_path' => $this->getSampleImage('student-organizations', 'org-mpk.png', 'https://images.unsplash.com/photo-1531482615713-2afd69097998?w=500&q=80'),
                'image_alt' => 'Logo Pengurus MPK SMA Lab UPGRIS',
                'supervisor_staff_id' => $staffs[0]->id,
            ],
            [
                'name' => 'PMR (Palang Merah Remaja) Unit Wira',
                'description' => 'Organisasi kepalangmerahan yang melatih keterampilan pertolongan pertama, donor darah sukarela, dan kesiapsiagaan tanggap darurat bencana.',
                'logo_path' => $this->getSampleImage('student-organizations', 'org-pmr.png', 'https://images.unsplash.com/photo-1584515979956-d9f6e5d09982?w=500&q=80'),
                'image_alt' => 'Logo PMR Wira SMA Lab UPGRIS',
                'supervisor_staff_id' => $staffs[2]->id,
            ],
        ];

        foreach ($organizations as $org) {
            StudentOrganization::updateOrCreate(['name' => $org['name']], $org);
        }

        $ekskuls = [
            [
                'name' => 'Pramuka Gugus Depan SMA Lab UPGRIS',
                'description' => 'Ekstrakurikuler wajib pembentuk kedisiplinan, kepanduan, survival, dan jiwa sosial patriotik.',
                'logo_path' => $this->getSampleImage('extracurriculars', 'ekskul-pramuka.png', 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?w=500&q=80'),
                'schedule' => 'Setiap Jumat, Pukul 14.30 - 16.30 WIB',
                'coach_staff_id' => $staffs[2]->id,
            ],
            [
                'name' => 'Bola Basket & Futsal',
                'description' => 'Pembinaan olahraga bola basket dan futsal untuk menjaga kebugaran jasmani dan persiapan kejuaraan antarsekolah (DBL & Invitasi).',
                'logo_path' => $this->getSampleImage('extracurriculars', 'ekskul-basket.png', 'https://images.unsplash.com/photo-1546519638-68e109498ffc?w=500&q=80'),
                'schedule' => 'Setiap Selasa & Kamis, Pukul 15.30 - 17.30 WIB',
                'coach_staff_id' => $staffs[0]->id,
            ],
            [
                'name' => 'English Club & Debating Society',
                'description' => 'Klub percakapan, public speaking, dan kompetisi debat Bahasa Inggris untuk mengasah rasa percaya diri dan wawasan global.',
                'logo_path' => $this->getSampleImage('extracurriculars', 'ekskul-english.png', 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=500&q=80'),
                'schedule' => 'Setiap Rabu, Pukul 15.00 - 16.30 WIB',
                'coach_staff_id' => $staffs[1]->id,
            ],
        ];

        foreach ($ekskuls as $eks) {
            Extracurricular::updateOrCreate(['name' => $eks['name']], $eks);
        }
    }

    /**
     * 9. Testimoni Alumni (Tampil di Home)
     */
    private function seedAlumniTestimonials(): void
    {
        $testimonials = [
            [
                'name' => 'Rian Pratama, S.T.',
                'graduation_year' => '2020',
                'current_occupation' => 'Software Engineer di Tech Company Jakarta',
                'testimonial' => 'Belajar di SMA Laboratorium UPGRIS memberikan fondasi kedisiplinan dan rasa ingin tahu yang sangat besar. Dukungan fasilitas laboratorium komputer dan guru-guru yang inspiratif sangat menentukan langkah karir saya saat ini.',
                'image_path' => $this->getSampleImage('alumni-testimonials', 'alumni-rian.jpg', 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=500&q=80'),
                'image_alt' => 'Foto Rian Pratama alumni SMA Lab UPGRIS',
            ],
            [
                'name' => 'dr. Amanda Putri Wijaya',
                'graduation_year' => '2019',
                'current_occupation' => 'Dokter Muda RSUP Dr. Kariadi Semarang',
                'testimonial' => 'Bimbingan intensif para guru sains di SMA Lab UPGRIS membantu saya menembus Fakultas Kedokteran impian. Budaya sekolah yang hangat dan berkarakter membuat masa SMA menjadi momen paling berharga.',
                'image_path' => $this->getSampleImage('alumni-testimonials', 'alumni-amanda.jpg', 'https://images.unsplash.com/photo-1594824813575-2964b4131669?w=500&q=80'),
                'image_alt' => 'Foto dr. Amanda Putri alumni SMA Lab UPGRIS',
            ],
            [
                'name' => 'Dimas Arya Wicaksana, S.E.',
                'graduation_year' => '2021',
                'current_occupation' => 'Founder Startup Edukasi & Mahasiswa Berprestasi',
                'testimonial' => 'Pengalaman berorganisasi di OSIS dan ragam kegiatan sekolah membentuk kepemimpinan serta jejaring relasi saya. SMA Lab UPGRIS adalah tempat terbaik untuk bertumbuh.',
                'image_path' => $this->getSampleImage('alumni-testimonials', 'alumni-dimas.jpg', 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=500&q=80'),
                'image_alt' => 'Foto Dimas Arya alumni SMA Lab UPGRIS',
            ],
        ];

        foreach ($testimonials as $t) {
            AlumniTestimonial::updateOrCreate(['name' => $t['name']], $t);
        }
    }

    /**
     * 10. Album & Galeri Dokumentasi Foto
     */
    private function seedGalleries(): void
    {
        $album1 = Album::updateOrCreate(
            ['name' => 'Dokumentasi Peringatan Hari Kemerdekaan RI & Classmeeting'],
            ['description' => 'Keseruan upacara bendera, perlombaan tradisional antar kelas, dan turnamen olahraga antar siswa.']
        );

        Photo::updateOrCreate(
            ['album_id' => $album1->id, 'title' => 'Upacara Bendera HUT RI'],
            [
                'description' => 'Pasukan pengibar bendera SMA Lab UPGRIS melaksanakan tugas dengan khidmat.',
                'image_path' => $this->getSampleImage('photos', 'photo-upacara.jpg', 'https://images.unsplash.com/photo-1541829070764-84a7d30dd3f3?w=1000&q=80'),
                'image_alt' => 'Upacara bendera HUT RI',
            ]
        );

        Photo::updateOrCreate(
            ['album_id' => $album1->id, 'title' => 'Pertandingan Futsal Antar Kelas'],
            [
                'description' => 'Final turnamen futsal classmeeting antar kelas berlangsung meriah.',
                'image_path' => $this->getSampleImage('photos', 'photo-futsal.jpg', 'https://images.unsplash.com/photo-1546519638-68e109498ffc?w=1000&q=80'),
                'image_alt' => 'Suasana turnamen futsal siswa',
            ]
        );

        $album2 = Album::updateOrCreate(
            ['name' => 'Pentas Seni & Gelar Karya P5 Siswa'],
            ['description' => 'Apresiasi karya kreatif, tari kreasi nusantara, dan instalasi produk inovasi daur ulang.']
        );

        Photo::updateOrCreate(
            ['album_id' => $album2->id, 'title' => 'Tari Kreasi Nusantara Siswa'],
            [
                'description' => 'Penampilan tari kolosal gabungan siswa kelas X dan XI.',
                'image_path' => $this->getSampleImage('photos', 'photo-tari.jpg', 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?w=1000&q=80'),
                'image_alt' => 'Tari kreasi nusantara di panggung pentas seni',
            ]
        );
    }

    /**
     * Unduh atau duplikat gambar legal bebas lisensi (Unsplash) ke direktori storage publik.
     */
    private function getSampleImage(string $folder, string $filename, string $unsplashUrl): string
    {
        $targetDir = storage_path('app/public/'.$folder);
        if (! File::exists($targetDir)) {
            File::makeDirectory($targetDir, 0755, true);
        }

        $targetPath = $targetDir.'/'.$filename;
        $relativePath = $folder.'/'.$filename;

        // Jika file sudah pernah dibuat/diunduh, gunakan langsung
        if (File::exists($targetPath)) {
            return $relativePath;
        }

        // Coba unduh gambar legal dari Unsplash
        try {
            $context = stream_context_create([
                'http' => [
                    'timeout' => 3,
                    'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) WebBrowser/1.0',
                ],
            ]);
            $contents = @file_get_contents($unsplashUrl, false, $context);
            if ($contents !== false && strlen($contents) > 2000) {
                File::put($targetPath, $contents);

                return $relativePath;
            }
        } catch (\Throwable $e) {
            // Lanjutkan ke fallback offline
        }

        // Fallback offline: gunakan gambar lokal yang sudah ada di folder public
        $fallbackSample = public_path('img/Gedung-sma-lab-upgris.jpg');
        if (File::exists($fallbackSample)) {
            File::copy($fallbackSample, $targetPath);

            return $relativePath;
        }

        return $relativePath;
    }
}
