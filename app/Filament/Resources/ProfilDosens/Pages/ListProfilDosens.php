<?php

namespace App\Filament\Resources\ProfilDosenResource\Pages;

use App\Filament\Resources\ProfilDosens\ProfilDosenResource;
use App\Models\Dosen; // Pastikan import Model Dosen (Tabel Master)
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Process;
use Filament\Notifications\Notification;
use Rap2hpoutre\FastExcel\FastExcel;

class ListProfilDosens extends ListRecords
{
    protected static string $resource = ProfilDosenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(), // Tombol bawaan "New Profil Dosen"

            // Tombol Custom "Perbarui Data Dosen"
            Actions\Action::make('perbarui_data_dosen')
                ->label('Perbarui Data Dosen')
                ->icon('heroicon-o-arrow-path')
                ->color('success')
                ->requiresConfirmation()
                ->modalHeading('Tarik Data Master Dosen dari SINTA')
                ->modalDescription('Aksi ini akan menjalankan script Python (Scraping) untuk menarik data terbaru. Proses ini mungkin memakan waktu beberapa menit. Lanjutkan?')
                ->action(function () {
                    
                    // 1. Tentukan path file python dan tempat menyimpan excel
                    $scriptPath = base_path('scripts/dosen.py');
                    $storagePath = storage_path('app/public'); 
                    $fileName = 'dosen_universitas_ngudi_waluyo.xlsx';
                    $fullFilePath = $storagePath . '/' . $fileName;

                    // 2. Jika file excel versi lama ada, hapus terlebih dahulu
                    if (file_exists($fullFilePath)) {
                        unlink($fullFilePath);
                    }

                    // 3. Jalankan Script Python
                    // Kita set direktori eksekusinya (path) ke $storagePath agar output
                    // file dosen_universitas_ngudi_waluyo.xlsx tersimpan langsung di sana.
                    $result = Process::path($storagePath)
                        ->timeout(600) // Batas waktu maksimal 10 menit
                        ->run('python "' . $scriptPath . '"');

                    // 4. Cek apakah eksekusi Python berhasil dan file excel tercipta
                    if ($result->successful() && file_exists($fullFilePath)) {
                        
                        // Baca file Excel
                        $koleksiDosen = (new FastExcel)->import($fullFilePath);

                        // Masukkan / Perbarui ke tabel database `dosen`
                        foreach ($koleksiDosen as $row) {
                            
                            // Logika: Jika SINTA ID ada isinya, kita update berdasarkan SINTA ID.
                            // Jika kosong, kita jadikan Nama sebagai acuan (mencegah bentrok data null).
                            $matchAttributes = !empty($row['SINTA ID'])
                                ? ['sinta_id' => $row['SINTA ID']]
                                : ['nama' => $row['Nama']];

                            Dosen::updateOrCreate(
                                $matchAttributes, // Kondisi pencarian
                                [
                                    // Data yang diperbarui / diisi
                                    'nama' => $row['Nama'],
                                    'sinta_id' => !empty($row['SINTA ID']) ? $row['SINTA ID'] : null,
                                    'departemen' => $row['Departemen'] ?? null,
                                    'scopus_h_index' => $row['Scopus H-Index'] ?? null,
                                    'google_scholar_h_index' => $row['Google Scholar H-Index'] ?? null,
                                    'sinta_score_3yr' => $row['SINTA Score 3Yr'] ?? null,
                                    'sinta_score' => $row['SINTA Score'] ?? null,
                                    'affiliation_score_3yr' => $row['Affiliation Score 3Yr'] ?? null,
                                    'affiliation_score' => $row['Affiliation Score'] ?? null,
                                    'profile_url' => $row['Profile URL'] ?? null,
                                ]
                            );
                        }

                        Notification::make()
                            ->title('Proses Berhasil!')
                            ->body('Data dosen berhasil diperbarui dari SINTA ke tabel master.')
                            ->success()
                            ->send();

                    } else {
                        // Munculkan notifikasi error jika script python gagal / error
                        Notification::make()
                            ->title('Gagal Memperbarui Data')
                            ->body($result->errorOutput() ?: 'Terjadi kesalahan saat menjalankan script Python atau file Excel tidak terbuat.')
                            ->danger()
                            ->send();
                    }
                }),
        ];
    }
}