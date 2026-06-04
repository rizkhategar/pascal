<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MagisterHukumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Bersihkan data lama (jika ada) agar tidak terjadi error duplicate slug
        // Karena kita memakai onDelete('cascade') di migrasi, tabel relasinya akan otomatis terhapus juga
        DB::table('academic_programs')->where('slug', 'magister-hukum')->delete();

        $now = Carbon::now();

        // 2. Insert ke Tabel Utama (academic_programs) dan ambil ID-nya
        $programId = DB::table('academic_programs')->insertGetId([
            'slug' => 'magister-hukum',
            'name' => 'Magister Hukum',
            'degree' => 'M.H.',
            'hero_title' => 'Apa yang Akan Anda Pelajari di Magister Hukum?',
            'hero_desc' => 'Tingkatkan karir hukum Anda melalui pemahaman mendalam tentang perancangan regulasi korporasi, penyelesaian sengketa, dan dinamika hukum nasional maupun internasional.',
            'hero_image' => '12533c31510bc1f7d71048a61271e4a3.original.jpg',
            'overview_title' => 'Merancang Solusi Nyata Keadilan',
            // Gunakan json_encode untuk mengubah array menjadi string JSON
            'overview_content' => json_encode([
                'Program Magister Hukum kami dirancang untuk mencetak praktisi dan akademisi hukum yang unggul. Setelah lulus, Anda akan menyandang gelar Magister Hukum (M.H.) dengan kurikulum yang relevan dengan tantangan hukum modern saat ini.',
                'Perkuliahan dilakukan secara interaktif dengan metode bedah kasus, didampingi langsung oleh dosen pakar, praktisi hukum, dan hakim. Kami juga menawarkan fleksibilitas jadwal melalui kelas reguler maupun kelas pekerja (akhir pekan), sehingga cocok untuk menyeimbangkan karir profesional Anda.'
            ]),
            'overview_image' => 'hero-campus2.png',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // 3. Insert ke Tabel Prasyarat (program_requirements)
        DB::table('program_requirements')->insert([
            [
                'program_id' => $programId,
                'requirement_text' => 'Lulusan S1 dari program studi Ilmu Hukum atau bidang studi lain yang disetujui (dikenakan matrikulasi).',
                'sort_order' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'program_id' => $programId,
                'requirement_text' => 'Fotokopi Ijazah dan Transkrip Nilai S1 yang telah dilegalisir oleh pihak berwenang.',
                'sort_order' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'program_id' => $programId,
                'requirement_text' => 'Surat Rekomendasi Akademik dari dosen S1 atau atasan di tempat kerja.',
                'sort_order' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'program_id' => $programId,
                'requirement_text' => 'Sertifikat TPA dan kemampuan Bahasa Inggris (TOEFL/IELTS) jika dipersyaratkan.',
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
                'title' => 'Pembuatan Akun',
                'description' => 'Registrasi di portal pendaftaran pascasarjana menggunakan email aktif.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'program_id' => $programId,
                'step_number' => 2,
                'title' => 'Pengisian Data & Unggah',
                'description' => 'Lengkapi biodata dan unggah dokumen prasyarat yang dibutuhkan.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'program_id' => $programId,
                'step_number' => 3,
                'title' => 'Seleksi Masuk',
                'description' => 'Mengikuti Ujian Tulis (TPA) dan tahapan Wawancara Program Studi.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'program_id' => $programId,
                'step_number' => 4,
                'title' => 'Pengumuman & Daftar Ulang',
                'description' => 'Penerimaan Letter of Acceptance (LoA) dan pembayaran UKT semester awal.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        // 5. Insert ke Tabel Konsentrasi (program_concentrations)
        DB::table('program_concentrations')->insert([
            [
                'program_id' => $programId,
                'name' => 'Hukum Pidana',
                'if_condition' => 'Anda berambisi menjadi jaksa, hakim, atau advokat yang ahli menangani kejahatan korporasi, pidana cyber, dan litigasi kriminal...',
                'then_outcome' => 'konsentrasi ini dirancang khusus untuk Anda.',
                'curriculum_link' => '#',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'program_id' => $programId,
                'name' => 'Hukum Perdata & Bisnis',
                'if_condition' => 'Target Anda mendampingi perusahaan, menyusun draf kontrak komersial, atau memenangkan sengketa bisnis...',
                'then_outcome' => 'tingkatkan kompetensi Anda di konsentrasi ini.',
                'curriculum_link' => '#',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'program_id' => $programId,
                'name' => 'Hukum Tata Negara',
                'if_condition' => 'Anda tertarik merumuskan regulasi, kebijakan publik daerah/pusat, atau berkarir di instansi pemerintahan strategis...',
                'then_outcome' => 'pilih jalur peminatan krusial ini.',
                'curriculum_link' => '#',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'program_id' => $programId,
                'name' => 'Hukum Internasional',
                'if_condition' => 'Minat Anda adalah diplomasi, perdagangan lintas negara, resolusi sengketa global, atau bekerja di NGO...',
                'then_outcome' => 'program ini adalah batu loncatan tepat.',
                'curriculum_link' => '#',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
        
        $this->command->info('Data Seeder Magister Hukum berhasil dimasukkan ke semua tabel!');
    }
}