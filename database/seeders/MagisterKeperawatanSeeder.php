<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MagisterKeperawatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Bersihkan data lama untuk slug ini
        DB::table('academic_programs')->where('slug', 'magister-keperawatan')->delete();

        $now = Carbon::now();

        // 2. Insert ke Tabel Utama (academic_programs)
        $programId = DB::table('academic_programs')->insertGetId([
            'slug' => 'magister-keperawatan',
            'name' => 'Magister Keperawatan',
            'degree' => 'M.Kep.',
            'hero_title' => 'Apa yang Akan Anda Pelajari di Magister Keperawatan?',
            'hero_desc' => 'Tingkatkan kompetensi klinis dan kepemimpinan Anda untuk menjadi perawat spesialis, pendidik, atau manajer keperawatan yang handal di layanan kesehatan modern.',
            'hero_image' => '12533c31510bc1f7d71048a61271e4a3.original.jpg', // Gambar utama (Hero)
            'overview_title' => 'Mengabdi dengan Ilmu Keperawatan Tingkat Lanjut',
            'overview_content' => json_encode([
                'Program Magister Keperawatan (M.Kep.) kami dirancang untuk mencetak perawat profesional yang memiliki keunggulan dalam asuhan keperawatan berbasis bukti ilmiah (Evidence-Based Practice), riset klinis, dan manajemen bangsal.',
                'Dibimbing oleh tenaga pengajar dengan spesialisasi mendalam dan didukung oleh fasilitas laboratorium klinis canggih serta rumah sakit mitra, Anda akan dipersiapkan untuk menghadapi kompleksitas pelayanan keperawatan di era global.'
            ]),
            'overview_image' => 'hero-campus.png', // Menggunakan gambar hero-campus.png untuk variasi visual
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // 3. Insert ke Tabel Prasyarat (program_requirements)
        DB::table('program_requirements')->insert([
            [
                'program_id' => $programId,
                'requirement_text' => 'Lulusan S1 Keperawatan dan lulus Profesi Ners dari Perguruan Tinggi yang terakreditasi.',
                'sort_order' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'program_id' => $programId,
                'requirement_text' => 'Fotokopi Ijazah (S1 & Ners) serta Transkrip Nilai yang telah dilegalisir.',
                'sort_order' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'program_id' => $programId,
                'requirement_text' => 'Memiliki Surat Tanda Registrasi (STR) Perawat yang masih aktif.',
                'sort_order' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'program_id' => $programId,
                'requirement_text' => 'Memiliki pengalaman kerja klinis minimal 1 (satu) tahun di rumah sakit atau institusi pelayanan kesehatan (diutamakan).',
                'sort_order' => 4,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        // 4. Insert ke Tabel Alur Pendaftaran (program_application_steps)
        DB::table('program_application_steps')->insert([
            [
                'program_id' => $programId,
                'step_number' => 1,
                'title' => 'Pendaftaran Akun',
                'description' => 'Membuat akun di portal admisi menggunakan email dan nomor telepon aktif.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'program_id' => $programId,
                'step_number' => 2,
                'title' => 'Pemberkasan & STR',
                'description' => 'Melengkapi formulir pendaftaran dan mengunggah dokumen ijazah, transkrip, serta STR Ners.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'program_id' => $programId,
                'step_number' => 3,
                'title' => 'Ujian & Wawancara Klinis',
                'description' => 'Mengikuti Tes Potensi Akademik (TPA) dan wawancara terkait peminatan spesialisasi klinis.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'program_id' => $programId,
                'step_number' => 4,
                'title' => 'Registrasi Ulang',
                'description' => 'Menerima Letter of Acceptance (LoA) dan melakukan registrasi ulang sebagai mahasiswa baru.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        // 5. Insert ke Tabel Konsentrasi (program_concentrations)
        DB::table('program_concentrations')->insert([
            [
                'program_id' => $programId,
                'name' => 'Keperawatan Medikal Bedah',
                'if_condition' => 'Anda ingin menjadi spesialis perawat klinis dalam asuhan keperawatan dewasa dengan gangguan berbagai sistem tubuh...',
                'then_outcome' => 'konsentrasi ini akan mempertajam keahlian klinis Anda di bangsal perawatan.',
                'curriculum_link' => '#',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'program_id' => $programId,
                'name' => 'Kepemimpinan & Manajemen Keperawatan',
                'if_condition' => 'Anda menargetkan posisi sebagai kepala bidang keperawatan, manajer rumah sakit, atau direktur pelayanan...',
                'then_outcome' => 'pelajari tata kelola manajerial dan sumber daya keperawatan di sini.',
                'curriculum_link' => '#',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'program_id' => $programId,
                'name' => 'Keperawatan Gawat Darurat & Kritis',
                'if_condition' => 'Anda ingin ahli dalam menyelamatkan dan menangani pasien dengan kondisi mengancam nyawa di ICU atau IGD...',
                'then_outcome' => 'jalur peminatan intensif ini adalah pilihan yang paling tepat untuk Anda.',
                'curriculum_link' => '#',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'program_id' => $programId,
                'name' => 'Keperawatan Maternitas',
                'if_condition' => 'Fokus Anda adalah pada peningkatan derajat kesehatan wanita, ibu hamil, ibu bersalin, dan bayi baru lahir...',
                'then_outcome' => 'perdalam ilmu dan skill asuhan keperawatan Anda melalui spesialisasi ini.',
                'curriculum_link' => '#',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
        
        $this->command->info('Data Seeder Magister Keperawatan berhasil dimasukkan!');
    }
}