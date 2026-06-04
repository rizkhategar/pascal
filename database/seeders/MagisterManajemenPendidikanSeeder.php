<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MagisterManajemenPendidikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Bersihkan data lama untuk slug ini
        DB::table('academic_programs')->where('slug', 'magister-manajemen-pendidikan')->delete();

        $now = Carbon::now();

        // 2. Insert ke Tabel Utama (academic_programs)
        $programId = DB::table('academic_programs')->insertGetId([
            'slug' => 'magister-manajemen-pendidikan',
            'name' => 'Magister Manajemen Pendidikan',
            'degree' => 'M.Pd.',
            'hero_title' => 'Apa yang Akan Anda Pelajari di Manajemen Pendidikan?',
            'hero_desc' => 'Jadilah pemimpin institusi pendidikan yang visioner dengan menguasai strategi kebijakan, manajemen kurikulum, dan tata kelola sekolah yang inovatif.',
            'hero_image' => '12533c31510bc1f7d71048a61271e4a3.original.jpg', // Tetap memakai background hero yang sama atau bisa diganti
            'overview_title' => 'Mencetak Pemimpin Pendidikan Masa Depan',
            'overview_content' => json_encode([
                'Program Magister Manajemen Pendidikan kami berfokus pada pengembangan kapasitas kepemimpinan dan manajerial untuk berbagai tingkatan institusi pendidikan. Lulusan program ini akan mendapatkan gelar Magister Pendidikan (M.Pd.) yang siap membawa perubahan positif di sektor pendidikan nasional.',
                'Melalui pendekatan studi kasus nyata, riset kebijakan, dan simulasi tata kelola, Anda akan belajar dari pakar pendidikan dan praktisi manajemen sekolah terkemuka. Program ini dirancang fleksibel untuk mengakomodasi jadwal para pendidik dan profesional yang masih aktif bekerja.'
            ]),
            'overview_image' => 'hero-campus3.png', // Memanfaatkan aset gambar lain yang ada di folder Anda
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // 3. Insert ke Tabel Prasyarat (program_requirements)
        DB::table('program_requirements')->insert([
            [
                'program_id' => $programId,
                'requirement_text' => 'Lulusan S1 dari program studi Kependidikan atau Non-Kependidikan yang disetujui (lulusan Non-Kependidikan akan dikenakan program matrikulasi).',
                'sort_order' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'program_id' => $programId,
                'requirement_text' => 'Fotokopi Ijazah dan Transkrip Nilai S1 yang telah dilegalisir.',
                'sort_order' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'program_id' => $programId,
                'requirement_text' => 'Surat Rekomendasi dari Kepala Sekolah atau atasan langsung bagi yang sudah bekerja.',
                'sort_order' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'program_id' => $programId,
                'requirement_text' => 'Memiliki pengalaman mengajar atau bekerja di instansi pendidikan (opsional namun diutamakan).',
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
                'description' => 'Lengkapi biodata dan unggah dokumen portofolio serta syarat akademik.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'program_id' => $programId,
                'step_number' => 3,
                'title' => 'Seleksi Masuk',
                'description' => 'Mengikuti Ujian Tulis (TPA) dan Wawancara mengenai visi kepemimpinan pendidikan.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'program_id' => $programId,
                'step_number' => 4,
                'title' => 'Pengumuman & Daftar Ulang',
                'description' => 'Penerimaan Letter of Acceptance (LoA) dan registrasi ulang mahasiswa baru.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        // 5. Insert ke Tabel Konsentrasi (program_concentrations)
        DB::table('program_concentrations')->insert([
            [
                'program_id' => $programId,
                'name' => 'Kepemimpinan & Manajemen Sekolah',
                'if_condition' => 'Anda bercita-cita menjadi kepala sekolah, direktur yayasan, atau manajer operasional institusi pendidikan...',
                'then_outcome' => 'jalur ini membekali Anda dengan skill tata kelola kepemimpinan yang efektif.',
                'curriculum_link' => '#',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'program_id' => $programId,
                'name' => 'Kebijakan Pendidikan',
                'if_condition' => 'Anda tertarik bekerja di kementerian, dinas pendidikan, atau menjadi pengambil keputusan strategis tingkat daerah...',
                'then_outcome' => 'spesialisasi ini tepat untuk memahami dan merumuskan arah kebijakan.',
                'curriculum_link' => '#',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'program_id' => $programId,
                'name' => 'Manajemen Kurikulum',
                'if_condition' => 'Fokus Anda adalah mengembangkan, mengevaluasi, dan menginovasi sistem pembelajaran secara komprehensif...',
                'then_outcome' => 'pilihlah konsentrasi perancangan kurikulum ini.',
                'curriculum_link' => '#',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'program_id' => $programId,
                'name' => 'Manajemen Inovasi EdTech',
                'if_condition' => 'Anda ingin memimpin transformasi digital dan integrasi teknologi di lingkungan sekolah modern...',
                'then_outcome' => 'program ini adalah pilihan yang paling sesuai untuk masa depan.',
                'curriculum_link' => '#',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
        
        $this->command->info('Data Seeder Magister Manajemen Pendidikan berhasil dimasukkan!');
    }
}