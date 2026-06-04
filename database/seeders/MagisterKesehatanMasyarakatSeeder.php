<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MagisterKesehatanMasyarakatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Bersihkan data lama untuk slug ini
        DB::table('academic_programs')->where('slug', 'magister-kesehatan-masyarakat')->delete();

        $now = Carbon::now();

        // 2. Insert ke Tabel Utama (academic_programs)
        $programId = DB::table('academic_programs')->insertGetId([
            'slug' => 'magister-kesehatan-masyarakat',
            'name' => 'Magister Kesehatan Masyarakat',
            'degree' => 'M.K.M.',
            'hero_title' => 'Apa yang Akan Anda Pelajari di Kesehatan Masyarakat?',
            'hero_desc' => 'Jadilah agen perubahan kesehatan global dengan mendalami ilmu epidemiologi, manajemen rumah sakit, dan promosi kesehatan untuk menciptakan masyarakat yang lebih sehat.',
            'hero_image' => '12533c31510bc1f7d71048a61271e4a3.original.jpg', // Gambar utama (Hero)
            'overview_title' => 'Solusi Nyata untuk Tantangan Kesehatan Global',
            'overview_content' => json_encode([
                'Program Magister Kesehatan Masyarakat (M.K.M.) membekali Anda dengan kompetensi analitis dan manajerial yang tajam untuk merumuskan, mengimplementasikan, dan mengevaluasi program kesehatan berskala luas.',
                'Dengan kurikulum yang responsif terhadap isu kesehatan terkini, Anda akan dididik langsung oleh pakar kesehatan masyarakat, epidemiolog, dan praktisi medis. Tersedia pilihan jadwal reguler dan akhir pekan yang dirancang khusus untuk memfasilitasi para tenaga kesehatan yang masih aktif bekerja.'
            ]),
            'overview_image' => 'hero-campus4.png', // Memanfaatkan aset gambar lain agar bervariasi
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // 3. Insert ke Tabel Prasyarat (program_requirements)
        DB::table('program_requirements')->insert([
            [
                'program_id' => $programId,
                'requirement_text' => 'Lulusan S1 dari rumpun Ilmu Kesehatan (Kedokteran, Keperawatan, Kebidanan, Kesehatan Masyarakat, dll) atau linier.',
                'sort_order' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'program_id' => $programId,
                'requirement_text' => 'Fotokopi Ijazah dan Transkrip Nilai S1 yang telah dilegalisir basah.',
                'sort_order' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'program_id' => $programId,
                'requirement_text' => 'Memiliki Surat Tanda Registrasi (STR) yang masih aktif (diutamakan bagi praktisi klinis).',
                'sort_order' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'program_id' => $programId,
                'requirement_text' => 'Surat Izin Belajar dari institusi/instansi tempat bekerja (bagi calon mahasiswa yang sudah bekerja).',
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
                'title' => 'Pembuatan Akun & Registrasi',
                'description' => 'Mendaftar di portal admisi online menggunakan email aktif.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'program_id' => $programId,
                'step_number' => 2,
                'title' => 'Pengisian Data Lengkap',
                'description' => 'Melengkapi formulir biodata dan mengunggah dokumen prasyarat akademik serta STR.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'program_id' => $programId,
                'step_number' => 3,
                'title' => 'Seleksi & Wawancara',
                'description' => 'Mengikuti Tes Potensi Akademik (TPA) dan Wawancara motivasi Program Studi.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'program_id' => $programId,
                'step_number' => 4,
                'title' => 'Pengumuman Kelulusan',
                'description' => 'Penerimaan Letter of Acceptance (LoA) dan pembayaran UKT semester awal.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        // 5. Insert ke Tabel Konsentrasi (program_concentrations)
        DB::table('program_concentrations')->insert([
            [
                'program_id' => $programId,
                'name' => 'Epidemiologi',
                'if_condition' => 'Anda ingin menjadi ahli dalam melacak, menganalisis, dan mengendalikan wabah penyakit di populasi...',
                'then_outcome' => 'pilih konsentrasi ini untuk menguasai mitigasi risiko kesehatan.',
                'curriculum_link' => '#',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'program_id' => $programId,
                'name' => 'Manajemen Rumah Sakit',
                'if_condition' => 'Target Anda adalah memimpin administrasi, operasional, dan penjaminan mutu fasilitas medis...',
                'then_outcome' => 'ini adalah jalur yang tepat untuk memajukan karir manajerial Anda.',
                'curriculum_link' => '#',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'program_id' => $programId,
                'name' => 'Promosi Kesehatan',
                'if_condition' => 'Anda fokus pada kampanye perubahan perilaku, pemberdayaan, dan edukasi kesehatan masyarakat...',
                'then_outcome' => 'pelajari kurikulum preventif ini untuk dampak yang lebih luas.',
                'curriculum_link' => '#',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'program_id' => $programId,
                'name' => 'Kebijakan Kesehatan',
                'if_condition' => 'Anda ingin berkontribusi merumuskan regulasi dan sistem kesehatan di tingkat daerah maupun nasional...',
                'then_outcome' => 'ambil spesialisasi ini untuk mendalami advokasi medis.',
                'curriculum_link' => '#',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
        
        $this->command->info('Data Seeder Magister Kesehatan Masyarakat berhasil dimasukkan!');
    }
}