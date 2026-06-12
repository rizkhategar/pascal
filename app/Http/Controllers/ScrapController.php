<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Models\DaftarDosen;
use App\Models\DetailDosen;

class ScrapController extends Controller
{
    private $pythonExe = 'python'; // Sesuaikan jika perlu, misal: 'C:\\Python310\\python.exe'

    /**
     * Menampilkan halaman utama panel dan membaca data untuk dropdown
     */
    public function index()
    {
        $scriptPath = base_path('scripts/baca_dosen.py');
        $dosenList = [];

        if (file_exists($scriptPath)) {
            $command = escapeshellcmd("{$this->pythonExe} \"{$scriptPath}\"");
            $jsonData = shell_exec($command);
            if ($jsonData) {
                $dosenList = json_decode($jsonData, true);
            }
        }

        $excelExists = file_exists(base_path('scripts/output/dosen_universitas_ngudi_waluyo.xlsx'));

        return view('scrap.ambildatadosen', compact('dosenList', 'excelExists'));
    }

    /**
     * SSE Stream: Menjalankan dosen.py (Langkah 1)
     */
    public function perbaruiDosen()
    {
        return new StreamedResponse(function () {
            set_time_limit(0);
            ignore_user_abort(true);

            $scriptPath = base_path('scripts/dosen.py');
            $command = "{$this->pythonExe} -u \"{$scriptPath}\" 2>&1";

            $handle = popen($command, 'r');
            if ($handle) {
                while (!feof($handle)) {
                    $buffer = fgets($handle);
                    if ($buffer !== false) {
                        $cleanBuffer = mb_convert_encoding($buffer, 'UTF-8', 'UTF-8');
                        echo "data: " . json_encode(['output' => $cleanBuffer]) . "\n\n";
                        ob_flush();
                        flush();
                    }
                }
                pclose($handle);
            }

            // =========================================================================
            // FITUR OTOMATIS: IMPORT dosen_universitas_ngudi_waluyo.xlsx KE DATABASE
            // =========================================================================
            $excelPath = base_path('scripts/output/dosen_universitas_ngudi_waluyo.xlsx');

            if (file_exists($excelPath)) {
                echo "data: " . json_encode(['output' => "\n----------------------------------------\n"]) . "\n\n";
                echo "data: " . json_encode(['output' => "<span class='text-primary-400 font-bold'>[AUTO-IMPORT]</span> Berkas Excel ditemukan. Memulai proses simpan ke tabel daftar_dosen...\n"]) . "\n\n";
                ob_flush();
                flush();

                try {
                    // Membaca baris data dari file Excel utama
                    $rows = (new FastExcel)->import($excelPath);
                    $insertedCount = 0;

                    DB::beginTransaction();

                    foreach ($rows as $row) {
                        // Mengubah semua key header Excel menjadi lowercase agar cocok (nama, sinta id, dll.)
                        $r = array_change_key_case((array)$row, CASE_LOWER);

                        // Ambil dan bersihkan sinta_id dari karakter non-angka
                        $sintaId = isset($r['sinta id']) ? preg_replace('/[^0-9]/', '', $r['sinta id']) : null;

                        // Validasi minimal: SINTA ID dan Nama tidak boleh kosong sesuai aturan migrasi Anda
                        if (empty($sintaId) || empty($r['nama'])) {
                            continue;
                        }

                        // Lakukan simpan atau perbarui data dosen
                        DaftarDosen::updateOrCreate(
                            ['sinta_id' => $sintaId],
                            [
                                'nama'                    => $r['nama'],
                                'departemen'              => $r['departemen'] ?? null,
                                'scopus_h_index'          => $r['scopus h-index'] ?? null,
                                'google_scholar_h_index'  => $r['google scholar h-index'] ?? null,
                                'sinta_score_3yr'         => isset($r['sinta score 3yr']) ? (int) str_replace('.', '', $r['sinta score 3yr']) : null,
                                'sinta_score'             => isset($r['sinta score']) ? (int) str_replace('.', '', $r['sinta score']) : null,
                                'affiliation_score_3yr'   => isset($r['affiliation score 3yr']) ? (int) str_replace('.', '', $r['affiliation score 3yr']) : null,
                                'affiliation_score'       => isset($r['affiliation score']) ? (int) str_replace('.', '', $r['affiliation score']) : null,
                                'profile_url'             => $r['profile url'] ?? null,
                            ]
                        );

                        $insertedCount++;
                    }

                    DB::commit();

                    echo "data: " . json_encode(['output' => "<span class='text-success-400 font-bold'>[OK] Auto-Import Berhasil!</span> Menyimpan {$insertedCount} dosen ke tabel daftar_dosen.\n----------------------------------------\n"]) . "\n\n";
                } catch (\Throwable $importError) {
                    DB::rollBack();
                    $errMsg = addslashes($importError->getMessage());
                    echo "data: " . json_encode(['output' => "\n<span class='text-danger-500 font-bold'>[AUTO-IMPORT ERROR]</span> Gagal menyimpan data: {$errMsg}\n----------------------------------------\n"]) . "\n\n";
                }
                ob_flush();
                flush();
            } else {
                echo "data: " . json_encode(['output' => "\n<span class='text-warning-500'>[WARN] File dosen_universitas_ngudi_waluyo.xlsx tidak ditemukan di folder output. Auto-import dibatalkan.</span>\n----------------------------------------\n"]) . "\n\n";
                ob_flush();
                flush();
            }
            // =========================================================================

            echo "data: " . json_encode(['done' => true]) . "\n\n";
            ob_flush();
            flush();
        }, 200, [
            'Cache-Control' => 'no-cache',
            'Content-Type' => 'text/event-stream',
            'X-Accel-Buffering' => 'no',
        ]);
    }

    public function tambahDosenManual(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'sinta_id' => 'required|unique:daftar_dosen,sinta_id',
            'nama'     => 'required|string|max:255',
        ]);

        // Hilangkan karakter non-angka pada SINTA ID untuk keamanan database
        $cleanSintaId = preg_replace('/[^0-9]/', '', $request->sinta_id);

        DaftarDosen::create([
            'sinta_id' => $cleanSintaId,
            'nama'     => $request->nama,
            'departemen' => 'Pendaftaran Manual',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Dosen baru berhasil didaftarkan ke dalam database master!'
        ]);
    }

    /**
     * SSE Stream: Menjalankan 6 script detail publikasi + merge (Langkah 2)
     */
    public function ambilDetail($sinta_id)
    {
        $sintaId = preg_replace('/[^0-9]/', '', $sinta_id);

        return new StreamedResponse(function () use ($sintaId) {
            set_time_limit(0);
            ignore_user_abort(true);

            $scripts = ["books.py", "garuda.py", "pengabdian.py", "profildosen.py", "riset.py", "sc.py"];

            foreach ($scripts as $scriptName) {
                echo "data: " . json_encode(['output' => "-------------------------------------------------\nMenjalankan {$scriptName}...\n-------------------------------------------------\n"]) . "\n\n";
                ob_flush();
                flush();

                $scriptPath = base_path("scripts/{$scriptName}");
                $command = "{$this->pythonExe} -u \"{$scriptPath}\" {$sintaId} 2>&1";

                $handle = popen($command, 'r');
                if ($handle) {
                    while (!feof($handle)) {
                        $buffer = fgets($handle);
                        if ($buffer !== false) {
                            $cleanBuffer = mb_convert_encoding($buffer, 'UTF-8', 'UTF-8');
                            echo "data: " . json_encode(['output' => $cleanBuffer]) . "\n\n";
                            ob_flush();
                            flush();
                        }
                    }
                    pclose($handle);
                }
                echo "data: " . json_encode(['output' => "\n"]) . "\n\n";
                ob_flush();
                flush();
            }

            echo "data: " . json_encode(['output' => "-------------------------------------------------\nMenjalankan merge_excel.py...\n-------------------------------------------------\n"]) . "\n\n";
            ob_flush();
            flush();

            $mergeScriptPath = base_path("scripts/merge_excel.py");
            $mergeCommand = "{$this->pythonExe} -u \"{$mergeScriptPath}\" {$sintaId} 2>&1";
            $handle = popen($mergeCommand, 'r');
            if ($handle) {
                while (!feof($handle)) {
                    $buffer = fgets($handle);
                    if ($buffer !== false) {
                        $cleanBuffer = mb_convert_encoding($buffer, 'UTF-8', 'UTF-8');
                        echo "data: " . json_encode(['output' => $cleanBuffer]) . "\n\n";
                        ob_flush();
                        flush();
                    }
                }
                pclose($handle);
            }

            echo "data: " . json_encode(['done' => true]) . "\n\n";
            ob_flush();
            flush();
        }, 200, [
            'Cache-Control' => 'no-cache',
            'Content-Type' => 'text/event-stream',
            'X-Accel-Buffering' => 'no',
        ]);
    }

    /**
     * Import Excel ke Database dengan SSE (Real-time Stream per Sheet)
     */
    public function importData(\Illuminate\Http\Request $request, $sinta_id)
    {
        $jurusan = $request->query('jurusan');
        $sintaId = preg_replace('/[^0-9]/', '', $sinta_id);

        return new \Symfony\Component\HttpFoundation\StreamedResponse(function () use ($sintaId, $jurusan) {
            set_time_limit(0);
            ignore_user_abort(true);

            $filePath = base_path("scripts/output/merged_data_{$sintaId}.xlsx");

            if (!file_exists($filePath)) {
                echo "data: " . json_encode(['output' => "<span class='text-danger-500'>[ERROR] File Excel tidak ditemukan.</span>\n"]) . "\n\n";
                echo "data: " . json_encode(['done' => true]) . "\n\n";
                ob_flush();
                flush();
                return;
            }

            try {
                echo "data: " . json_encode(['output' => "Membaca file Excel: merged_data_{$sintaId}.xlsx...\n"]) . "\n\n";
                ob_flush();
                flush();

                $sheets = (new \Rap2hpoutre\FastExcel\FastExcel)->importSheets($filePath);

                $expectedSheets = [
                    0 => 'DATA_DOSEN',
                    1 => 'SCOPUS_PUBLICATIONS',
                    2 => 'SCOPUS_YEARLY_STATS',
                    3 => 'SCHOLAR_PUBLICATIONS',
                    4 => 'SCHOLAR_YEARLY_STATS',
                    5 => 'GARUDA_PUBLICATIONS',
                    6 => 'GARUDA_YEARLY_STATS',
                    7 => 'BOOKS',
                    8 => 'SERVICES',
                    9 => 'SERVICE_YEARLY',
                    10 => 'RESEARCHES',
                    11 => 'RESEARCH_YEARLY'
                ];

                foreach ($sheets as $sheetIndex => $rows) {
                    $actualSheetName = $expectedSheets[$sheetIndex] ?? "SHEET_{$sheetIndex}";
                    $sheetNameUpper = strtoupper($actualSheetName);

                    echo "data: " . json_encode(['output' => "----------------------------------------\n"]) . "\n\n";
                    echo "data: " . json_encode(['output' => "Memproses Sheet: <span class='text-primary-400 font-bold'>{$sheetNameUpper}</span>...\n"]) . "\n\n";
                    ob_flush();
                    flush();

                    if (empty($rows) || count($rows) === 0) {
                        echo "data: " . json_encode(['output' => "<span class='text-gray-400'>--> Sheet kosong, dilewati.</span>\n"]) . "\n\n";
                        ob_flush();
                        flush();
                        continue;
                    }

                    $firstRow = collect($rows)->first();
                    if (!$firstRow) {
                        echo "data: " . json_encode(['output' => "<span class='text-gray-400'>--> Sheet kosong, dilewati.</span>\n"]) . "\n\n";
                        ob_flush();
                        flush();
                        continue;
                    }

                    $values = array_map('strtolower', array_map('trim', array_values((array)$firstRow)));
                    if (in_array('none', $values)) {
                        echo "data: " . json_encode(['output' => "<span class='text-gray-400'>--> Sheet berisi 'none', dilewati.</span>\n"]) . "\n\n";
                        ob_flush();
                        flush();
                        continue;
                    }

                    \Illuminate\Support\Facades\DB::beginTransaction();
                    $insertedCount = 0;

                    foreach ($rows as $row) {
                        $r = array_change_key_case((array)$row, CASE_LOWER);

                        if ($sheetNameUpper === 'DATA_DOSEN') {
                            $photoValue = $r['profile photo'] ?? null;

                            // FITUR UNDUH FOTO PROFIL DENGAN LOG TERMINAL DETAIL
                            if (!empty($photoValue) && filter_var($photoValue, FILTER_VALIDATE_URL)) {
                                try {
                                    // 1. Log Menemukan URL
                                    echo "data: " . json_encode(['output' => "<span style='color: #0ea5e9;'>[FOTO]</span> URL foto ditemukan: {$photoValue}\n"]) . "\n\n";
                                    echo "data: " . json_encode(['output' => "<span style='color: #0ea5e9;'>[FOTO]</span> Memulai proses unduh (download)...\n"]) . "\n\n";
                                    ob_flush();
                                    flush();

                                    $response = \Illuminate\Support\Facades\Http::withoutVerifying()->timeout(15)->get($photoValue);

                                    if ($response->successful()) {
                                        // 2. Log Unduhan Berhasil
                                        echo "data: " . json_encode(['output' => "<span class='text-success-400'>[FOTO]</span> ✔ File foto berhasil diunduh dari server SINTA.\n"]) . "\n\n";
                                        ob_flush();
                                        flush();

                                        $photoName = $sintaId . '.jpg';
                                        $destinationFolder = public_path('assets/images');

                                        if (!file_exists($destinationFolder)) {
                                            mkdir($destinationFolder, 0755, true);
                                        }

                                        // 3. Log Rename
                                        echo "data: " . json_encode(['output' => "<span style='color: #0ea5e9;'>[FOTO]</span> Melakukan rename file menjadi: <b>{$photoName}</b>\n"]) . "\n\n";
                                        ob_flush();
                                        flush();

                                        // Simpan Gambar
                                        file_put_contents($destinationFolder . '/' . $photoName, $response->body());
                                        $photoValue = $photoName;

                                        // 4. Log Sukses Tersimpan
                                        echo "data: " . json_encode(['output' => "<span class='text-success-400'>[FOTO]</span> ✔ Foto profil berhasil disimpan ke direktori: public/assets/images/{$photoName}\n"]) . "\n\n";
                                    } else {
                                        echo "data: " . json_encode(['output' => "<span class='text-warning-500'>[FOTO - WARN] Gagal mengunduh foto (Status HTTP: " . $response->status() . "). Tetap menggunakan URL asli.</span>\n"]) . "\n\n";
                                    }
                                    ob_flush();
                                    flush();
                                } catch (\Throwable $photoError) {
                                    echo "data: " . json_encode(['output' => "<span class='text-warning-500'>[FOTO - ERROR] Request Timeout / Gagal: " . addslashes($photoError->getMessage()) . "</span>\n"]) . "\n\n";
                                    ob_flush();
                                    flush();
                                }
                            }

                            // KODE BARU YANG BENAR (Ganti bagian skor menjadi seperti ini)
                            \App\Models\DetailDosen::updateOrCreate(['sinta_id' => $sintaId], [
                                'nama' => $r['nama'] ?? null,
                                'institusi' => $r['institusi'] ?? $r['afiliasi'] ?? null,
                                'program_studi' => $r['program studi'] ?? null,
                                'profile_photo' => $photoValue,
                                'bidang_minat' => $r['bidang minat'] ?? null,

                                // PEMBERSIHAN TITIK:
                                'sinta_score_overall' => isset($r['sinta score overall']) ? (int) str_replace('.', '', $r['sinta score overall']) : 0,
                                'sinta_score_3yr'     => isset($r['sinta score 3yr']) ? (int) str_replace('.', '', $r['sinta score 3yr']) : 0,
                                'affil_score'         => isset($r['affil score']) ? (int) str_replace('.', '', $r['affil score']) : 0,
                                'affil_score_3yr'     => isset($r['affil score 3yr']) ? (int) str_replace('.', '', $r['affil score 3yr']) : 0,

                                'jurusan' => $jurusan,
                            ]);
                            $insertedCount++;
                        } elseif ($sheetNameUpper === 'SCOPUS_PUBLICATIONS') {
                            if (empty($r['judul']) && empty($r['title'])) continue;
                            \App\Models\ScopusPublication::updateOrCreate(['sinta_id' => $sintaId, 'judul' => $r['judul'] ?? $r['title']], [
                                'tahun' => $r['tahun'] ?? $r['year'] ?? null,
                                'citation' => isset($r['citation']) ? (int)$r['citation'] : (isset($r['sitasi']) ? (int)$r['sitasi'] : 0),
                                'quartile' => $r['quartile'] ?? null,
                                'journal' => $r['journal'] ?? $r['jurnal'] ?? null,
                                'author_order' => $r['author order'] ?? null,
                                'creator' => $r['creator'] ?? null,
                                'url_artikel' => $r['url artikel'] ?? null,
                                'url_journal' => $r['url journal'] ?? null,
                            ]);
                            $insertedCount++;
                        } elseif ($sheetNameUpper === 'SCOPUS_YEARLY_STATS') {
                            if (empty($r['tahun']) && empty($r['year'])) continue;
                            \App\Models\ScopusYearlyStat::updateOrCreate(['sinta_id' => $sintaId, 'tahun' => $r['tahun'] ?? $r['year']], ['jumlah' => isset($r['jumlah']) ? (int)$r['jumlah'] : (isset($r['count']) ? (int)$r['count'] : 0)]);
                            $insertedCount++;
                        } elseif ($sheetNameUpper === 'SCHOLAR_PUBLICATIONS') {
                            if (empty($r['judul']) && empty($r['title'])) continue;
                            \App\Models\ScholarPublication::updateOrCreate(['sinta_id' => $sintaId, 'judul' => $r['judul'] ?? $r['title']], [
                                'url_scholar' => $r['url scholar'] ?? null,
                                'authors' => $r['authors'] ?? $r['penulis'] ?? null,
                                'source' => $r['source'] ?? $r['sumber'] ?? null,
                                'tahun' => $r['tahun'] ?? $r['year'] ?? null,
                                'citation' => isset($r['citation']) ? (int)$r['citation'] : (isset($r['sitasi']) ? (int)$r['sitasi'] : 0),
                            ]);
                            $insertedCount++;
                        } elseif ($sheetNameUpper === 'SCHOLAR_YEARLY_STATS') {
                            if (empty($r['tahun']) && empty($r['year'])) continue;
                            \App\Models\ScholarYearlyStat::updateOrCreate(['sinta_id' => $sintaId, 'tahun' => $r['tahun'] ?? $r['year']], ['publications' => isset($r['publications']) ? (int)$r['publications'] : 0, 'citations' => isset($r['citations']) ? (int)$r['citations'] : 0]);
                            $insertedCount++;
                        } elseif ($sheetNameUpper === 'GARUDA_PUBLICATIONS') {
                            if (empty($r['judul']) && empty($r['title'])) continue;
                            \App\Models\GarudaPublication::updateOrCreate(['sinta_id' => $sintaId, 'judul' => $r['judul'] ?? $r['title']], [
                                'url_artikel' => $r['url_artikel'] ?? $r['url artikel'] ?? null,
                                'publisher' => $r['publisher'] ?? $r['penerbit'] ?? null,
                                'journal' => $r['journal'] ?? $r['jurnal'] ?? null,
                                'url_journal' => $r['url_journal'] ?? $r['url journal'] ?? null,
                                'author_order' => $r['author_order'] ?? $r['author order'] ?? null,
                                'authors' => $r['authors'] ?? $r['penulis'] ?? null,
                                'tahun' => $r['tahun'] ?? $r['year'] ?? null,
                                'doi' => $r['doi'] ?? null,
                                'accreditation' => $r['accreditation'] ?? $r['akreditasi'] ?? null,
                            ]);
                            $insertedCount++;
                        } elseif ($sheetNameUpper === 'GARUDA_YEARLY_STATS') {
                            if (empty($r['tahun']) && empty($r['year'])) continue;
                            \App\Models\GarudaYearlyStat::updateOrCreate(['sinta_id' => $sintaId, 'tahun' => $r['tahun'] ?? $r['year']], ['articles' => isset($r['articles']) ? (int)$r['articles'] : (isset($r['jumlah']) ? (int)$r['jumlah'] : 0)]);
                            $insertedCount++;
                        } elseif ($sheetNameUpper === 'BOOKS') {
                            if (empty($r['judul']) && empty($r['title'])) continue;
                            \App\Models\Book::updateOrCreate(['sinta_id' => $sintaId, 'judul' => $r['judul'] ?? $r['title']], [
                                'kategori' => $r['kategori'] ?? $r['category'] ?? null,
                                'penulis' => $r['penulis'] ?? $r['authors'] ?? null,
                                'penerbit' => $r['penerbit'] ?? $r['publisher'] ?? null,
                                'tahun' => $r['tahun'] ?? $r['year'] ?? null,
                                'kota' => $r['kota'] ?? $r['city'] ?? null,
                                'isbn' => $r['isbn'] ?? null,
                            ]);
                            $insertedCount++;
                        } elseif ($sheetNameUpper === 'RESEARCHES') {
                            if (empty($r['judul']) && empty($r['title'])) continue;
                            \App\Models\Research::updateOrCreate(['sinta_id' => $sintaId, 'judul' => $r['judul'] ?? $r['title']], [
                                'leader' => $r['leader'] ?? null,
                                'skema' => $r['skema'] ?? null,
                                'personils' => $r['personils'] ?? null,
                                'tahun' => $r['tahun'] ?? $r['year'] ?? null,
                                'dana' => $r['dana'] ?? null,
                                'status' => $r['status'] ?? null,
                                'source' => $r['source'] ?? null,
                            ]);
                            $insertedCount++;
                        } elseif ($sheetNameUpper === 'RESEARCH_YEARLY') {
                            if (empty($r['tahun']) && empty($r['year'])) continue;
                            \App\Models\ResearchYearly::updateOrCreate(['sinta_id' => $sintaId, 'tahun' => $r['tahun'] ?? $r['year']], ['jumlah' => isset($r['jumlah']) ? (int)$r['jumlah'] : 0]);
                            $insertedCount++;
                        } elseif ($sheetNameUpper === 'SERVICES') {
                            if (empty($r['judul']) && empty($r['title'])) continue;
                            \App\Models\Service::updateOrCreate(['sinta_id' => $sintaId, 'judul' => $r['judul'] ?? $r['title']], [
                                'leader' => $r['leader'] ?? null,
                                'skema' => $r['skema'] ?? null,
                                'personils' => $r['personils'] ?? null,
                                'tahun' => $r['tahun'] ?? $r['year'] ?? null,
                                'dana' => $r['dana'] ?? null,
                                'status' => $r['status'] ?? null,
                                'source' => $r['source'] ?? null,
                            ]);
                            $insertedCount++;
                        } elseif ($sheetNameUpper === 'SERVICE_YEARLY') {
                            if (empty($r['tahun']) && empty($r['year'])) continue;
                            \App\Models\ServiceYearly::updateOrCreate(['sinta_id' => $sintaId, 'tahun' => $r['tahun'] ?? $r['year']], ['jumlah' => isset($r['jumlah']) ? (int)$r['jumlah'] : 0]);
                            $insertedCount++;
                        }
                    }

                    \Illuminate\Support\Facades\DB::commit();

                    if ($insertedCount > 0) {
                        echo "data: " . json_encode(['output' => "<span class='text-success-400'>[OK] Berhasil menyimpan {$insertedCount} baris ke database.</span>\n"]) . "\n\n";
                    } else {
                        echo "data: " . json_encode(['output' => "<span class='text-gray-400'>--> Tidak ada data valid yang diproses. (Mungkin bukan tabel utama)</span>\n"]) . "\n\n";
                    }
                    ob_flush();
                    flush();
                }

                echo "data: " . json_encode(['output' => "----------------------------------------\n<span class='text-success-400 font-bold'>[SUKSES IMPORT]</span> Seluruh sheet selesai diimpor!\n"]) . "\n\n";
                echo "data: " . json_encode(['done' => true]) . "\n\n";
                ob_flush();
                flush();
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\DB::rollBack();
                $errMsg = addslashes($e->getMessage());
                echo "data: " . json_encode(['output' => "\n<span class='text-danger-500 font-bold'>[ERROR FATAL]</span> {$errMsg} (Baris: {$e->getLine()})\n"]) . "\n\n";
                echo "data: " . json_encode(['done' => true]) . "\n\n";
                ob_flush();
                flush();
            }
        }, 200, [
            'Cache-Control' => 'no-cache',
            'Content-Type' => 'text/event-stream',
            'X-Accel-Buffering' => 'no',
        ]);
    }
}
