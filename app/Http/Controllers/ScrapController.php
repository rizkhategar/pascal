<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

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
            // Mencegah Timeout Server
            set_time_limit(0);
            ignore_user_abort(true);

            $scriptPath = base_path('scripts/dosen.py');
            $command = "{$this->pythonExe} -u \"{$scriptPath}\" 2>&1";

            $handle = popen($command, 'r');
            if ($handle) {
                while (!feof($handle)) {
                    $buffer = fgets($handle);
                    if ($buffer !== false) {
                        // Bersihkan karakter ilegal/aneh agar json_encode tidak gagal/crash
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
            // Mencegah Timeout Server
            set_time_limit(0);
            ignore_user_abort(true);

            $scripts = [
                "books.py",
                "garuda.py",
                "pengabdian.py",
                "profildosen.py",
                "riset.py",
                "sc.py"
            ];

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
                            // Bersihkan karakter ilegal/aneh agar json_encode tidak gagal/crash
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

            // Jalankan Proses Merge terakhir
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
}