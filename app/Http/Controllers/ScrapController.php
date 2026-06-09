<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Rap2hpoutre\FastExcel\FastExcel;

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
    public function importData($sinta_id)
    {
        $sintaId = preg_replace('/[^0-9]/', '', $sinta_id);

        return new \Symfony\Component\HttpFoundation\StreamedResponse(function () use ($sintaId) {
            set_time_limit(0);
            ignore_user_abort(true);

            $filePath = base_path("scripts/output/merged_data_{$sintaId}.xlsx");

            if (!file_exists($filePath)) {
                echo "data: " . json_encode(['output' => "<span class='text-danger-500'>[ERROR] File Excel tidak ditemukan.</span>\n"]) . "\n\n";
                echo "data: " . json_encode(['done' => true]) . "\n\n";
                ob_flush(); flush();
                return;
            }

            try {
                echo "data: " . json_encode(['output' => "Membaca file Excel: merged_data_{$sintaId}.xlsx...\n"]) . "\n\n";
                ob_flush(); flush();

                $sheets = (new \Rap2hpoutre\FastExcel\FastExcel)->importSheets($filePath);

                // PERBAIKAN UTAMA: Peta Urutan Sheet dari skrip Python merge_excel.py
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
                    // Menerjemahkan angka urut menjadi nama tabel aslinya
                    $actualSheetName = $expectedSheets[$sheetIndex] ?? "SHEET_{$sheetIndex}";
                    $sheetNameUpper = strtoupper($actualSheetName);
                    
                    echo "data: " . json_encode(['output' => "----------------------------------------\n"]) . "\n\n";
                    echo "data: " . json_encode(['output' => "Memproses Sheet: <span class='text-primary-400 font-bold'>{$sheetNameUpper}</span>...\n"]) . "\n\n";
                    ob_flush(); flush();

                    if (empty($rows) || count($rows) === 0) {
                        echo "data: " . json_encode(['output' => "<span class='text-gray-400'>--> Sheet kosong, dilewati.</span>\n"]) . "\n\n";
                        ob_flush(); flush();
                        continue;
                    }

                    $firstRow = collect($rows)->first();
                    if (!$firstRow) {
                        echo "data: " . json_encode(['output' => "<span class='text-gray-400'>--> Sheet kosong, dilewati.</span>\n"]) . "\n\n";
                        ob_flush(); flush();
                        continue;
                    }

                    // FITUR IGNORE "NONE"
                    $values = array_map('strtolower', array_map('trim', array_values((array)$firstRow)));
                    if (in_array('none', $values)) {
                        echo "data: " . json_encode(['output' => "<span class='text-gray-400'>--> Sheet berisi 'none', dilewati.</span>\n"]) . "\n\n";
                        ob_flush(); flush();
                        continue;
                    }

                    \Illuminate\Support\Facades\DB::beginTransaction();
                    $insertedCount = 0;

                    foreach ($rows as $row) {
                        $r = array_change_key_case((array)$row, CASE_LOWER);

                        if ($sheetNameUpper === 'DATA_DOSEN') {
                            \App\Models\DetailDosen::updateOrCreate(['sinta_id' => $sintaId], [
                                'nama' => $r['nama'] ?? null, 'institusi' => $r['institusi'] ?? $r['afiliasi'] ?? null, 'program_studi' => $r['program studi'] ?? null, 'profile_photo' => $r['profile photo'] ?? null, 'bidang_minat' => $r['bidang minat'] ?? null, 'sinta_score_overall' => isset($r['sinta score overall']) ? (int)$r['sinta score overall'] : 0, 'sinta_score_3yr' => isset($r['sinta score 3yr']) ? (int)$r['sinta score 3yr'] : 0, 'affil_score' => isset($r['affil score']) ? (int)$r['affil score'] : 0, 'affil_score_3yr' => isset($r['affil score 3yr']) ? (int)$r['affil score 3yr'] : 0,
                            ]);
                            $insertedCount++;
                        }
                        elseif ($sheetNameUpper === 'SCOPUS_PUBLICATIONS') {
                            if (empty($r['judul']) && empty($r['title'])) continue;
                            \App\Models\ScopusPublication::updateOrCreate(['sinta_id' => $sintaId, 'judul' => $r['judul'] ?? $r['title']], [
                                'tahun' => $r['tahun'] ?? $r['year'] ?? null, 'citation' => isset($r['citation']) ? (int)$r['citation'] : (isset($r['sitasi']) ? (int)$r['sitasi'] : 0), 'quartile' => $r['quartile'] ?? null, 'journal' => $r['journal'] ?? $r['jurnal'] ?? null, 'author_order' => $r['author order'] ?? null, 'creator' => $r['creator'] ?? null, 'url_artikel' => $r['url artikel'] ?? null, 'url_journal' => $r['url journal'] ?? null,
                            ]);
                            $insertedCount++;
                        }
                        elseif ($sheetNameUpper === 'SCOPUS_YEARLY_STATS') {
                            if (empty($r['tahun']) && empty($r['year'])) continue;
                            \App\Models\ScopusYearlyStat::updateOrCreate(['sinta_id' => $sintaId, 'tahun' => $r['tahun'] ?? $r['year']], ['jumlah' => isset($r['jumlah']) ? (int)$r['jumlah'] : (isset($r['count']) ? (int)$r['count'] : 0)]);
                            $insertedCount++;
                        }
                        elseif ($sheetNameUpper === 'SCHOLAR_PUBLICATIONS') {
                            if (empty($r['judul']) && empty($r['title'])) continue;
                            \App\Models\ScholarPublication::updateOrCreate(['sinta_id' => $sintaId, 'judul' => $r['judul'] ?? $r['title']], [
                                'url_scholar' => $r['url scholar'] ?? null, 'authors' => $r['authors'] ?? $r['penulis'] ?? null, 'source' => $r['source'] ?? $r['sumber'] ?? null, 'tahun' => $r['tahun'] ?? $r['year'] ?? null, 'citation' => isset($r['citation']) ? (int)$r['citation'] : (isset($r['sitasi']) ? (int)$r['sitasi'] : 0),
                            ]);
                            $insertedCount++;
                        }
                        elseif ($sheetNameUpper === 'SCHOLAR_YEARLY_STATS') {
                            if (empty($r['tahun']) && empty($r['year'])) continue;
                            \App\Models\ScholarYearlyStat::updateOrCreate(['sinta_id' => $sintaId, 'tahun' => $r['tahun'] ?? $r['year']], ['publications' => isset($r['publications']) ? (int)$r['publications'] : 0, 'citations' => isset($r['citations']) ? (int)$r['citations'] : 0]);
                            $insertedCount++;
                        }
                        elseif ($sheetNameUpper === 'GARUDA_PUBLICATIONS') {
                            if (empty($r['judul']) && empty($r['title'])) continue;
                            \App\Models\GarudaPublication::updateOrCreate(['sinta_id' => $sintaId, 'judul' => $r['judul'] ?? $r['title']], [
                                'url_artikel' => $r['url_artikel'] ?? $r['url artikel'] ?? null, 'publisher' => $r['publisher'] ?? $r['penerbit'] ?? null, 'journal' => $r['journal'] ?? $r['jurnal'] ?? null, 'url_journal' => $r['url_journal'] ?? $r['url journal'] ?? null, 'author_order' => $r['author_order'] ?? $r['author order'] ?? null, 'authors' => $r['authors'] ?? $r['penulis'] ?? null, 'tahun' => $r['tahun'] ?? $r['year'] ?? null, 'doi' => $r['doi'] ?? null, 'accreditation' => $r['accreditation'] ?? $r['akreditasi'] ?? null,
                            ]);
                            $insertedCount++;
                        }
                        elseif ($sheetNameUpper === 'GARUDA_YEARLY_STATS') {
                            if (empty($r['tahun']) && empty($r['year'])) continue;
                            \App\Models\GarudaYearlyStat::updateOrCreate(['sinta_id' => $sintaId, 'tahun' => $r['tahun'] ?? $r['year']], ['articles' => isset($r['articles']) ? (int)$r['articles'] : (isset($r['jumlah']) ? (int)$r['jumlah'] : 0)]);
                            $insertedCount++;
                        }
                        elseif ($sheetNameUpper === 'BOOKS') {
                            if (empty($r['judul']) && empty($r['title'])) continue;
                            \App\Models\Book::updateOrCreate(['sinta_id' => $sintaId, 'judul' => $r['judul'] ?? $r['title']], [
                                'kategori' => $r['kategori'] ?? $r['category'] ?? null, 'penulis' => $r['penulis'] ?? $r['authors'] ?? null, 'penerbit' => $r['penerbit'] ?? $r['publisher'] ?? null, 'tahun' => $r['tahun'] ?? $r['year'] ?? null, 'kota' => $r['kota'] ?? $r['city'] ?? null, 'isbn' => $r['isbn'] ?? null,
                            ]);
                            $insertedCount++;
                        }
                        elseif ($sheetNameUpper === 'RESEARCHES') {
                            if (empty($r['judul']) && empty($r['title'])) continue;
                            \App\Models\Research::updateOrCreate(['sinta_id' => $sintaId, 'judul' => $r['judul'] ?? $r['title']], [
                                'leader' => $r['leader'] ?? null, 'skema' => $r['skema'] ?? null, 'personils' => $r['personils'] ?? null, 'tahun' => $r['tahun'] ?? $r['year'] ?? null, 'dana' => $r['dana'] ?? null, 'status' => $r['status'] ?? null, 'source' => $r['source'] ?? null,
                            ]);
                            $insertedCount++;
                        }
                        elseif ($sheetNameUpper === 'RESEARCH_YEARLY') {
                            if (empty($r['tahun']) && empty($r['year'])) continue;
                            \App\Models\ResearchYearly::updateOrCreate(['sinta_id' => $sintaId, 'tahun' => $r['tahun'] ?? $r['year']], ['jumlah' => isset($r['jumlah']) ? (int)$r['jumlah'] : 0]);
                            $insertedCount++;
                        }
                        elseif ($sheetNameUpper === 'SERVICES') {
                            if (empty($r['judul']) && empty($r['title'])) continue;
                            \App\Models\Service::updateOrCreate(['sinta_id' => $sintaId, 'judul' => $r['judul'] ?? $r['title']], [
                                'leader' => $r['leader'] ?? null, 'skema' => $r['skema'] ?? null, 'personils' => $r['personils'] ?? null, 'tahun' => $r['tahun'] ?? $r['year'] ?? null, 'dana' => $r['dana'] ?? null, 'status' => $r['status'] ?? null, 'source' => $r['source'] ?? null,
                            ]);
                            $insertedCount++;
                        }
                        elseif ($sheetNameUpper === 'SERVICE_YEARLY') {
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
                    ob_flush(); flush();
                }

                echo "data: " . json_encode(['output' => "----------------------------------------\n<span class='text-success-400 font-bold'>[SUKSES IMPORT]</span> Seluruh sheet selesai diimpor!\n"]) . "\n\n";
                echo "data: " . json_encode(['done' => true]) . "\n\n";
                ob_flush(); flush();

            } catch (\Throwable $e) { 
                \Illuminate\Support\Facades\DB::rollBack();
                $errMsg = addslashes($e->getMessage());
                echo "data: " . json_encode(['output' => "\n<span class='text-danger-500 font-bold'>[ERROR FATAL]</span> {$errMsg} (Baris: {$e->getLine()})\n"]) . "\n\n";
                echo "data: " . json_encode(['done' => true]) . "\n\n";
                ob_flush(); flush();
            }
        }, 200, [
            'Cache-Control' => 'no-cache',
            'Content-Type' => 'text/event-stream',
            'X-Accel-Buffering' => 'no',
        ]);
    }
}
