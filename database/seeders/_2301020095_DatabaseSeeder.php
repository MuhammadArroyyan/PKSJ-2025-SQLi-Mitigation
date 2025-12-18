<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class _2301020095_DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        \App\Models\_2301020109_User::create([
            'nama_user' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Create Kaprodi Users
        $kaprodi1 = \App\Models\_2301020109_User::create([
            'nama_user' => 'Kaprodi Teknik Informatika',
            'email' => 'kaprodi.ti@umrah.co.id',
            'password' => bcrypt('password'),
            'role' => 'kaprodi',
        ]);

        $kaprodi2 = \App\Models\_2301020109_User::create([
            'nama_user' => 'Kaprodi Teknik Perkapalan',
            'email' => 'kaprodi.tp@umrah.co.id',
            'password' => bcrypt('password'),
            'role' => 'kaprodi',
        ]);

        // Create Pimpinan User
        \App\Models\_2301020109_User::create([
            'nama_user' => 'Pimpinan Fakultas',
            'email' => 'pimpinan@umrah.co.id',
            'password' => bcrypt('password'),
            'role' => 'pimpinan',
        ]);

        // Create Fakultas
        $fakultas = \App\Models\_2301020002_Fakultas::create([
            'nama_fakultas' => 'FTTK (Fakultas Teknik dan Teknologi Kematiriman)',
        ]);

        // Create Jurusan
        $jurusan1 = \App\Models\_2301020002_Jurusan::create([
            'nama_jurusan' => 'Jurusan Teknik Elektro dan Informatika',
            'id_fakultas' => $fakultas->id_fakultas,
        ]);

        $jurusan2 = \App\Models\_2301020002_Jurusan::create([
            'nama_jurusan' => 'Jurusan Teknik Industri Maritim',
            'id_fakultas' => $fakultas->id_fakultas,
        ]);

        $jurusan3 = \App\Models\_2301020002_Jurusan::create([
            'nama_jurusan' => 'Jurusan Teknik Sipil dan Arsitektur',
            'id_fakultas' => $fakultas->id_fakultas,
        ]);

        // Create Prodi
        $prodi1 = \App\Models\_2301020109_Prodi::create([
            'nama_prodi' => 'Teknik Informatika',
            'id_user_kaprodi' => $kaprodi1->id_user,
            'id_jurusan' => $jurusan1->id_jurusan,
        ]);

        $prodi2 = \App\Models\_2301020109_Prodi::create([
            'nama_prodi' => 'Teknik Perkapalan',
            'id_user_kaprodi' => $kaprodi2->id_user,
            'id_jurusan' => $jurusan2->id_jurusan,
        ]);

        $prodi3 = \App\Models\_2301020109_Prodi::create([
            'nama_prodi' => 'Teknik Elektro',
            'id_user_kaprodi' => $kaprodi1->id_user,
            'id_jurusan' => $jurusan1->id_jurusan,
        ]);

        $prodi4 = \App\Models\_2301020109_Prodi::create([
            'nama_prodi' => 'Teknik Industri',
            'id_user_kaprodi' => $kaprodi2->id_user,
            'id_jurusan' => $jurusan2->id_jurusan,
        ]);

        $prodi5 = \App\Models\_2301020109_Prodi::create([
            'nama_prodi' => 'Teknik Kimia',
            'id_user_kaprodi' => $kaprodi1->id_user,
            'id_jurusan' => $jurusan3->id_jurusan,
        ]);

        $prodi6 = \App\Models\_2301020109_Prodi::create([
            'nama_prodi' => 'Teknik Perancangan Wilayah Kota',
            'id_user_kaprodi' => $kaprodi2->id_user,
            'id_jurusan' => $jurusan3->id_jurusan,
        ]);

        $prodi7 = \App\Models\_2301020109_Prodi::create([
            'nama_prodi' => 'Teknik Sipil',
            'id_user_kaprodi' => $kaprodi1->id_user,
            'id_jurusan' => $jurusan3->id_jurusan,
        ]);

        // Create Periode Kuisioner
        $periode1 = \App\Models\_2301020106_PeriodeKuisioner::create([
            'keterangan' => 'Periode Semester Ganjil 2024',
            'status_periode' => 'active',
        ]);

        $periode2 = \App\Models\_2301020106_PeriodeKuisioner::create([
            'keterangan' => 'Periode Semester Genap 2024',
            'status_periode' => 'draft',
        ]);

        // Create Pertanyaan untuk Prodi 1 (Teknik Informatika)
        $pertanyaan1 = \App\Models\_2301020106_Pertanyaan::create([
            'pertanyaan' => 'Seberapa puas Anda dengan kualitas pengajaran dosen?',
            'id_prodi' => $prodi1->id_prodi,
        ]);

        $pertanyaan2 = \App\Models\_2301020106_Pertanyaan::create([
            'pertanyaan' => 'Apakah materi kuliah relevan dengan industri?',
            'id_prodi' => $prodi1->id_prodi,
        ]);

        $pertanyaan3 = \App\Models\_2301020106_Pertanyaan::create([
            'pertanyaan' => 'Bagaimana fasilitas laboratorium yang tersedia?',
            'id_prodi' => $prodi1->id_prodi,
        ]);

        // Create Pertanyaan untuk Prodi 2 (Teknik Perkapalan)
        $pertanyaan4 = \App\Models\_2301020106_Pertanyaan::create([
            'pertanyaan' => 'Apakah kurikulum sesuai dengan kebutuhan industri maritim?',
            'id_prodi' => $prodi2->id_prodi,
        ]);

        $pertanyaan5 = \App\Models\_2301020106_Pertanyaan::create([
            'pertanyaan' => 'Seberapa efektif praktikum perkapalan?',
            'id_prodi' => $prodi2->id_prodi,
        ]);

        // Create Pilihan Jawaban untuk Pertanyaan 1
        \App\Models\_2301020106_PilihanJawabanPertanyaan::create([
            'deskripsi_pilihan' => 'Sangat Puas',
            'id_pertanyaan' => $pertanyaan1->id_pertanyaan,
        ]);

        \App\Models\_2301020106_PilihanJawabanPertanyaan::create([
            'deskripsi_pilihan' => 'Puas',
            'id_pertanyaan' => $pertanyaan1->id_pertanyaan,
        ]);

        \App\Models\_2301020106_PilihanJawabanPertanyaan::create([
            'deskripsi_pilihan' => 'Cukup Puas',
            'id_pertanyaan' => $pertanyaan1->id_pertanyaan,
        ]);

        \App\Models\_2301020106_PilihanJawabanPertanyaan::create([
            'deskripsi_pilihan' => 'Kurang Puas',
            'id_pertanyaan' => $pertanyaan1->id_pertanyaan,
        ]);

        \App\Models\_2301020106_PilihanJawabanPertanyaan::create([
            'deskripsi_pilihan' => 'Sangat Tidak Puas',
            'id_pertanyaan' => $pertanyaan1->id_pertanyaan,
        ]);

        // Create Pilihan Jawaban untuk Pertanyaan 2
        \App\Models\_2301020106_PilihanJawabanPertanyaan::create([
            'deskripsi_pilihan' => 'Sangat Relevan',
            'id_pertanyaan' => $pertanyaan2->id_pertanyaan,
        ]);

        \App\Models\_2301020106_PilihanJawabanPertanyaan::create([
            'deskripsi_pilihan' => 'Relevan',
            'id_pertanyaan' => $pertanyaan2->id_pertanyaan,
        ]);

        \App\Models\_2301020106_PilihanJawabanPertanyaan::create([
            'deskripsi_pilihan' => 'Cukup Relevan',
            'id_pertanyaan' => $pertanyaan2->id_pertanyaan,
        ]);

        \App\Models\_2301020106_PilihanJawabanPertanyaan::create([
            'deskripsi_pilihan' => 'Kurang Relevan',
            'id_pertanyaan' => $pertanyaan2->id_pertanyaan,
        ]);

        \App\Models\_2301020106_PilihanJawabanPertanyaan::create([
            'deskripsi_pilihan' => 'Tidak Relevan',
            'id_pertanyaan' => $pertanyaan2->id_pertanyaan,
        ]);

        // Create Pilihan Jawaban untuk Pertanyaan 3
        \App\Models\_2301020106_PilihanJawabanPertanyaan::create([
            'deskripsi_pilihan' => 'Sangat Baik',
            'id_pertanyaan' => $pertanyaan3->id_pertanyaan,
        ]);

        \App\Models\_2301020106_PilihanJawabanPertanyaan::create([
            'deskripsi_pilihan' => 'Baik',
            'id_pertanyaan' => $pertanyaan3->id_pertanyaan,
        ]);

        \App\Models\_2301020106_PilihanJawabanPertanyaan::create([
            'deskripsi_pilihan' => 'Cukup',
            'id_pertanyaan' => $pertanyaan3->id_pertanyaan,
        ]);

        \App\Models\_2301020106_PilihanJawabanPertanyaan::create([
            'deskripsi_pilihan' => 'Kurang',
            'id_pertanyaan' => $pertanyaan3->id_pertanyaan,
        ]);

        // Create Pilihan Jawaban untuk Pertanyaan 4
        \App\Models\_2301020106_PilihanJawabanPertanyaan::create([
            'deskripsi_pilihan' => 'Sangat Sesuai',
            'id_pertanyaan' => $pertanyaan4->id_pertanyaan,
        ]);

        \App\Models\_2301020106_PilihanJawabanPertanyaan::create([
            'deskripsi_pilihan' => 'Sesuai',
            'id_pertanyaan' => $pertanyaan4->id_pertanyaan,
        ]);

        \App\Models\_2301020106_PilihanJawabanPertanyaan::create([
            'deskripsi_pilihan' => 'Cukup Sesuai',
            'id_pertanyaan' => $pertanyaan4->id_pertanyaan,
        ]);

        \App\Models\_2301020106_PilihanJawabanPertanyaan::create([
            'deskripsi_pilihan' => 'Kurang Sesuai',
            'id_pertanyaan' => $pertanyaan4->id_pertanyaan,
        ]);

        // Create Pilihan Jawaban untuk Pertanyaan 5
        \App\Models\_2301020106_PilihanJawabanPertanyaan::create([
            'deskripsi_pilihan' => 'Sangat Efektif',
            'id_pertanyaan' => $pertanyaan5->id_pertanyaan,
        ]);

        \App\Models\_2301020106_PilihanJawabanPertanyaan::create([
            'deskripsi_pilihan' => 'Efektif',
            'id_pertanyaan' => $pertanyaan5->id_pertanyaan,
        ]);

        \App\Models\_2301020106_PilihanJawabanPertanyaan::create([
            'deskripsi_pilihan' => 'Cukup Efektif',
            'id_pertanyaan' => $pertanyaan5->id_pertanyaan,
        ]);

        \App\Models\_2301020106_PilihanJawabanPertanyaan::create([
            'deskripsi_pilihan' => 'Kurang Efektif',
            'id_pertanyaan' => $pertanyaan5->id_pertanyaan,
        ]);

        // Create Pertanyaan Periode Kuisioner untuk Periode 1
        \App\Models\PertanyaanPeriodeKuisioner::create([
            'id_periode_kuisioner' => $periode1->id_periode,
            'id_pertanyaan' => $pertanyaan1->id_pertanyaan,
        ]);

        \App\Models\PertanyaanPeriodeKuisioner::create([
            'id_periode_kuisioner' => $periode1->id_periode,
            'id_pertanyaan' => $pertanyaan2->id_pertanyaan,
        ]);

        \App\Models\PertanyaanPeriodeKuisioner::create([
            'id_periode_kuisioner' => $periode1->id_periode,
            'id_pertanyaan' => $pertanyaan3->id_pertanyaan,
        ]);

        \App\Models\PertanyaanPeriodeKuisioner::create([
            'id_periode_kuisioner' => $periode1->id_periode,
            'id_pertanyaan' => $pertanyaan4->id_pertanyaan,
        ]);

        \App\Models\PertanyaanPeriodeKuisioner::create([
            'id_periode_kuisioner' => $periode1->id_periode,
            'id_pertanyaan' => $pertanyaan5->id_pertanyaan,
        ]);
    }
}

