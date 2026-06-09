<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}"> <title>Sistem Pengambilan Data Dosen - Filament Style</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'ui-sans-serif', 'system-ui', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto', 'Helvetica Neue', 'Arial', 'sans-serif'] },
                    colors: {
                        primary: { 50: '#fffbeb', 100: '#fef3c7', 200: '#fde68a', 300: '#fcd34d', 400: '#fbbf24', 500: '#f59e0b', 600: '#d97706', 700: '#b45309', 800: '#92400e', 900: '#78350f', 950: '#451a03' },
                        danger: { 500: '#ef4444', 600: '#dc2626' },
                        success: { 500: '#10b981', 600: '#059669' }
                    }
                }
            }
        }
    </script>
    <style>
        #terminal-container::-webkit-scrollbar { width: 8px; }
        #terminal-container::-webkit-scrollbar-track { background: #111827; border-radius: 8px; }
        #terminal-container::-webkit-scrollbar-thumb { background: #374151; border-radius: 8px; }
        #terminal-container::-webkit-scrollbar-thumb:hover { background: #4b5563; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50 text-gray-950 font-sans antialiased min-h-screen selection:bg-primary-500/30">

<div class="max-w-6xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    
    <header class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-gray-950">Panel Sinkronisasi SINTA</h1>
            <p class="mt-1 text-sm text-gray-500">Ekstrak dan gabungkan data publikasi dosen secara real-time.</p>
        </div>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        
        <div class="bg-white rounded-xl shadow-sm ring-1 ring-gray-950/5 flex flex-col overflow-hidden">
            <div class="p-6 flex-grow">
                <div class="flex items-center gap-x-3 mb-4">
                    <div class="bg-primary-500/10 text-primary-600 rounded-lg p-2">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                        </svg>
                    </div>
                    <h2 class="text-base font-semibold leading-6 text-gray-950">Langkah 1: Perbarui Daftar</h2>
                </div>
                
                <div class="text-sm text-gray-600 mb-6" id="status-excel">
                    @if($excelExists)
                        <div class="flex items-start gap-2 bg-success-500/10 p-3 rounded-lg border border-success-500/20">
                            <svg class="w-5 h-5 text-success-600 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                            <p><span class="font-semibold text-success-700">File tersedia.</span> Anda dapat lanjut ke Langkah 2.</p>
                        </div>
                    @else
                        <div class="flex items-start gap-2 bg-danger-500/10 p-3 rounded-lg border border-danger-500/20">
                            <svg class="w-5 h-5 text-danger-600 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3Z" /></svg>
                            <p><span class="font-semibold text-danger-700">Belum ada data.</span> Mulai scraping.</p>
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="bg-gray-50/50 px-6 py-4 border-t border-gray-100">
                <button type="button" id="btn-perbarui" class="w-full inline-flex items-center justify-center gap-2 rounded-lg bg-white px-4 py-2.5 text-sm font-semibold text-gray-950 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 transition">
                    🔄 Mulai Scraping Dosen
                </button>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm ring-1 ring-gray-950/5 flex flex-col overflow-hidden">
            <div class="p-6 flex-grow">
                <div class="flex items-center gap-x-3 mb-4">
                    <div class="bg-blue-500/10 text-blue-600 rounded-lg p-2">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                    </div>
                    <h2 class="text-base font-semibold leading-6 text-gray-950">Langkah 2: Ambil Detail</h2>
                </div>
                
                <div>
                    <label for="sinta_id" class="block text-sm font-medium leading-6 text-gray-950 mb-1">Pilih Dosen</label>
                    <select id="sinta_id" class="block w-full rounded-lg border-0 py-2.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-950/10 focus:ring-2 focus:ring-inset focus:ring-primary-600 sm:text-sm sm:leading-6 shadow-sm bg-white" required @if(!$excelExists || empty($dosenList)) disabled @endif>
                        <option value="">-- Silakan Pilih --</option>
                        @if(!empty($dosenList) && !isset($dosenList[0]['error']))
                            @foreach($dosenList as $dosen)
                                @if(!empty($dosen['SINTA ID']))
                                    <option value="{{ $dosen['SINTA ID'] }}">{{ $dosen['Nama'] }}</option>
                                @endif
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            
            <div class="bg-gray-50/50 px-6 py-4 border-t border-gray-100">
                <button type="button" id="btn-ambil-detail" class="w-full inline-flex items-center justify-center gap-2 rounded-lg bg-primary-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-primary-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600 transition disabled:opacity-50 disabled:cursor-not-allowed" @if(!$excelExists || empty($dosenList)) disabled @endif>
                    📥 Ekstrak Data SINTA
                </button>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm ring-1 ring-gray-950/5 flex flex-col overflow-hidden">
            <div class="p-6 flex-grow">
                <div class="flex items-center gap-x-3 mb-4">
                    <div class="bg-success-500/10 text-success-600 rounded-lg p-2">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                        </svg>
                    </div>
                    <h2 class="text-base font-semibold leading-6 text-gray-950">Langkah 3: Database</h2>
                </div>
                
                <p class="text-sm text-gray-600 mb-4">Masukkan data Excel dosen yang baru saja diekstrak ke dalam database (Migrasi).</p>
            </div>
            
            <div class="bg-gray-50/50 px-6 py-4 border-t border-gray-100">
                <button type="button" id="btn-import" class="w-full inline-flex items-center justify-center gap-2 rounded-lg bg-success-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-success-500 transition disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                    💾 Import ke Database
                </button>
            </div>
        </div>

    </div>

    <div class="bg-gray-900 rounded-xl shadow-lg ring-1 ring-white/10 overflow-hidden flex flex-col h-[500px]">
        <div class="bg-gray-950 px-4 py-3 flex items-center justify-between border-b border-gray-800">
            <div class="flex items-center gap-2">
                <div class="flex gap-1.5">
                    <div class="w-3 h-3 rounded-full bg-danger-500"></div>
                    <div class="w-3 h-3 rounded-full bg-primary-400"></div>
                    <div class="w-3 h-3 rounded-full bg-success-500"></div>
                </div>
                <span class="ml-2 text-xs font-medium text-gray-400 tracking-wide">Terminal Output Stream</span>
            </div>
            <button type="button" class="text-xs text-gray-400 hover:text-white transition flex items-center gap-1" onclick="document.getElementById('output-box').innerHTML='Menunggu perintah...\n'">
                Bersihkan
            </button>
        </div>
        <div id="terminal-container" class="p-4 overflow-y-auto flex-grow font-mono text-sm leading-relaxed">
            <pre id="output-box" class="text-green-400 m-0 whitespace-pre-wrap word-wrap break-word">Menunggu perintah...</pre>
        </div>
    </div>
</div>

<script>
    const outputBox = document.getElementById('output-box');
    const terminalContainer = document.getElementById('terminal-container');
    const btnPerbarui = document.getElementById('btn-perbarui');
    const btnAmbilDetail = document.getElementById('btn-ambil-detail');
    const btnImport = document.getElementById('btn-import');
    const selectSinta = document.getElementById('sinta_id');

    // Mendapatkan CSRF Token
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    function appendTerminal(text) {
        outputBox.innerHTML += text;
        terminalContainer.scrollTop = terminalContainer.scrollHeight;
    }

    function toggleLoading(button, isLoading, originalText) {
        if (isLoading) {
            button.disabled = true;
            button.classList.add('opacity-70', 'cursor-not-allowed');
            button.innerHTML = `<svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-current inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Memproses...`;
        } else {
            button.disabled = false;
            button.classList.remove('opacity-70', 'cursor-not-allowed');
            button.innerHTML = originalText;
        }
    }

    // --- LANGKAH 1 ---
    btnPerbarui.addEventListener('click', function() {
        outputBox.innerHTML = '<span class="text-white">>>> Memulai pembaruan data dosen (dosen.py)...</span>\n<span class="text-gray-400">Proses ini berjalan real-time. Harap tunggu...</span>\n\n';
        toggleLoading(btnPerbarui, true);
        btnAmbilDetail.disabled = true;
        btnImport.disabled = true;
        selectSinta.disabled = true;

        const eventSource = new EventSource("{{ route('scrap.perbaruiDosen') }}");

        eventSource.onmessage = function(event) {
            const data = JSON.parse(event.data);
            if (data.output) appendTerminal(data.output);
            if (data.done) {
                eventSource.close();
                appendTerminal('\n<span class="text-blue-400 font-bold">[SUKSES]</span> Pembaruan selesai. Memuat ulang halaman otomatis dalam 3 detik...\n');
                setTimeout(() => { window.location.reload(); }, 3000);
            }
        };

        eventSource.onerror = function() {
            eventSource.close();
            appendTerminal('\n<span class="text-danger-500 font-bold">[-] Terjadi kesalahan koneksi jaringan.</span>\n');
            toggleLoading(btnPerbarui, false, '🔄 Mulai Scraping Dosen');
            selectSinta.disabled = false;
            if(selectSinta.options.length > 1) btnAmbilDetail.disabled = false;
        };
    });

    // --- LANGKAH 2 ---
    btnAmbilDetail.addEventListener('click', function() {
        const sintaId = selectSinta.value;
        if (!sintaId) return alert('Silakan pilih nama dosen terlebih dahulu!');

        outputBox.innerHTML = `<span class="text-white">>>> Memulai ekstraksi detail 6 modul SINTA untuk ID: </span><span class="text-primary-400 font-bold">${sintaId}</span><span class="text-white"> ...</span>\n\n`;
        toggleLoading(btnAmbilDetail, true);
        btnPerbarui.disabled = true;
        btnImport.disabled = true;
        selectSinta.disabled = true;

        let targetUrl = "{{ route('scrap.ambilDetail', ':id') }}";
        targetUrl = targetUrl.replace(':id', sintaId);

        const eventSource = new EventSource(targetUrl);

        eventSource.onmessage = function(event) {
            const data = JSON.parse(event.data);
            if (data.output) appendTerminal(data.output);
            if (data.done) {
                eventSource.close();
                appendTerminal(`\n<span class="text-blue-400 font-bold">[SUKSES] SEMUA PROSES BERHASIL DIJALANKAN.</span>\n`);
                appendTerminal(`Silakan lanjutkan ke <span class="text-success-400 font-bold">Langkah 3</span> untuk Import.\n`);
                
                toggleLoading(btnAmbilDetail, false, '📥 Ekstrak Data SINTA');
                btnPerbarui.disabled = false;
                selectSinta.disabled = false;
                
                // MENGAKTIFKAN TOMBOL IMPORT
                btnImport.disabled = false; 
            }
        };

        eventSource.onerror = function() {
            eventSource.close();
            appendTerminal('\n<span class="text-danger-500 font-bold">[-] Terjadi gangguan komunikasi data dengan server Laravel.</span>\n');
            toggleLoading(btnAmbilDetail, false, '📥 Ekstrak Data SINTA');
            btnPerbarui.disabled = false;
            selectSinta.disabled = false;
        };
    });

   // --- LANGKAH 3 (BARU) ---
    btnImport.addEventListener('click', function() {
        const sintaId = selectSinta.value;
        if (!sintaId) return alert('SINTA ID tidak ditemukan. Lakukan Langkah 2 terlebih dahulu.');

        appendTerminal(`\n<span class="text-white">>>> Memulai proses migrasi data Excel ke Database untuk SINTA ID: </span><span class="text-success-400 font-bold">${sintaId}</span><span class="text-white"> ...</span>\n\n`);
        toggleLoading(btnImport, true);
        btnAmbilDetail.disabled = true;
        selectSinta.disabled = true;

        let targetUrl = "{{ route('scrap.importData', ':id') }}";
        targetUrl = targetUrl.replace(':id', sintaId);

        // Memulai koneksi Streaming (SSE)
        const eventSource = new EventSource(targetUrl);

        eventSource.onmessage = function(event) {
            const data = JSON.parse(event.data);
            if (data.output) appendTerminal(data.output);
            
            // Jika proses selesai atau ada error fatal dari server
            if (data.done) {
                eventSource.close();
                toggleLoading(btnImport, false, '💾 Import ke Database');
                btnAmbilDetail.disabled = false;
                selectSinta.disabled = false;
            }
        };

        eventSource.onerror = function() {
            eventSource.close();
            appendTerminal('\n<span class="text-danger-500 font-bold">[-] Terjadi gangguan koneksi internet saat proses import berjalan.</span>\n');
            toggleLoading(btnImport, false, '💾 Import ke Database');
            btnAmbilDetail.disabled = false;
            selectSinta.disabled = false;
        };
    });

</script>
</body>
</html>