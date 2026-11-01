<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Mendefinisikan semua permissions dalam array yang terstruktur
        $permissions = [
            // Manajemen Konten & Halaman
            'view-pages',
            'create-pages',
            'edit-pages',
            'delete-pages',
            'view-posts',
            'create-posts',
            'edit-posts',
            'delete-posts',
            'manage-categories',
            'manage-tags',
            'manage-galleries',

            // Manajemen Profil Sekolah & Akademik
            'manage-staffs',
            'manage-facilities',
            'manage-study-programs',
            'manage-extracurriculars',
            'manage-subjects',

            // Manajemen Kesiswaan & Alumni
            'manage-achievements',
            'manage-student-organizations',
            'manage-alumni-testimonials',
            'manage-academic-events',

            // Manajemen Interaksi
            'view-registrations',
            'update-registration-status',
            'view-contact-messages',
            'delete-contact-messages',

            // Manajemen Sistem
            'manage-users',
            'manage-settings',

            // Hak Akses Personal
            'edit-own-profile',
        ];

        // Buat permissions dari array menggunakan loop
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Buat Roles
        $superAdminRole = Role::create(['name' => 'Super Admin']);
        $editorRole = Role::create(['name' => 'Editor Konten']);
        $ppdbRole = Role::create(['name' => 'Staf PPDB']);
        $guruRole = Role::create(['name' => 'Guru']);

        // Berikan permissions yang sesuai ke setiap role (kecuali Super Admin)
        $editorRole->givePermissionTo([
            'view-pages',
            'create-pages',
            'edit-pages',
            'delete-pages',
            'view-posts',
            'create-posts',
            'edit-posts',
            'delete-posts',
            'manage-categories',
            'manage-tags',
            'manage-galleries',
            'manage-achievements',
            'manage-alumni-testimonials',
            'edit-own-profile',
        ]);

        $ppdbRole->givePermissionTo([
            'view-registrations',
            'update-registration-status',
            'edit-own-profile',
            // Mungkin perlu izin untuk membuat post pengumuman PPDB
            'create-posts',
            'edit-posts'
        ]);

        $guruRole->givePermissionTo([
            'edit-own-profile',
        ]);

        // Catatan: Super Admin tidak perlu diberi permission di sini.
    }
}
