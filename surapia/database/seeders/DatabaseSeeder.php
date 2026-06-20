<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Tambahkan dummy Faskes untuk uji coba
        $rsud = \App\Models\Faskes::create([
            'nama_faskes' => 'RSUD Lakipadada',
            'kode_faskes' => 'RS-001',
            'tipe' => 'RS',
            'alamat' => 'Jl. Pongtiku No. 2, Makale, Tana Toraja',
        ]);
        
        $pkm = \App\Models\Faskes::create([
            'nama_faskes' => 'Puskesmas Makale',
            'kode_faskes' => 'PKM-001',
            'tipe' => 'Puskesmas',
            'alamat' => 'Kecamatan Makale, Tana Toraja',
        ]);

        // Akun Admin Disdukcapil
        User::create([
            'name' => 'Admin Disdukcapil',
            'email' => 'admin@disdukcapil.com',
            'password' => bcrypt('password'),
            'role' => 'admin_disdukcapil',
        ]);

        // Akun Petugas Faskes RSUD
        User::create([
            'name' => 'Petugas RSUD',
            'email' => 'faskes@rsud.com',
            'password' => bcrypt('password'),
            'role' => 'petugas_faskes',
            'faskes_id' => $rsud->id,
        ]);

        // Akun Petugas Faskes PKM
        User::create([
            'name' => 'Petugas PKM',
            'email' => 'faskes@pkm.com',
            'password' => bcrypt('password'),
            'role' => 'petugas_faskes',
            'faskes_id' => $pkm->id,
        ]);
    }
}
