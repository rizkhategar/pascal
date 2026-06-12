<x-filament-panels::page>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
    <style>
        .custom-select-dosen {
            background-color: #ffffff;
            color: #030712;
        }

        .custom-select-dosen option {
            background-color: #ffffff;
            color: #030712;
        }

        .custom-btn-secondary {
            background-color: #f3f4f6;
            color: #030712;
            border: 1px solid rgba(156, 163, 175, 0.3);
        }

        .custom-btn-secondary:hover {
            background-color: #e5e7eb;
        }

        .dark .custom-select-dosen {
            background-color: #111827;
            color: #ffffff;
            border-color: rgba(255, 255, 255, 0.1) !important;
        }

        .dark .custom-select-dosen option {
            background-color: #111827;
            color: #ffffff;
        }

        .dark .custom-btn-secondary {
            background-color: #1f2937;
            color: #ffffff;
            border-color: rgba(255, 255, 255, 0.1);
        }

        .dark .custom-btn-secondary:hover {
            background-color: #374151;
        }

        .select2-container .select2-selection--single {
            height: 40px !important;
            border-radius: 0.5rem !important;
            border: 1px solid rgba(156, 163, 175, 0.4) !important;
            display: flex !important;
            align-items: center !important;
            background-color: transparent !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: inherit !important;
            line-height: normal !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 38px !important;
        }

        .dark .select2-container .select2-selection--single {
            background-color: #111827 !important;
            border-color: rgba(255, 255, 255, 0.1) !important;
        }

        .dark .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #ffffff !important;
        }

        .dark .select2-dropdown {
            background-color: #111827 !important;
            border-color: rgba(255, 255, 255, 0.1) !important;
            color: #ffffff !important;
        }

        .dark .select2-search__field {
            background-color: #1f2937 !important;
            border-color: rgba(255, 255, 255, 0.1) !important;
            color: #ffffff !important;
        }

        .dark .select2-results__option[aria-selected="true"] {
            background-color: #374151 !important;
        }

        .dark .select2-results__option--highlighted[aria-selected] {
            background-color: #2563eb !important;
        }

        [x-cloak] { 
            display: none !important; 
        }

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: 99999;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(3, 7, 18, 0.6);
            backdrop-filter: blur(4px);
            padding: 1rem;
            box-sizing: border-box;
        }

        .modal-card {
            background-color: #ffffff;
            color: #030712;
            width: 100%;
            max-width: 460px;
            border-radius: 0.75rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border: 1px solid #e5e7eb;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            box-sizing: border-box;
        }

        .dark .modal-card {
            background-color: #111827;
            color: #ffffff;
            border-color: rgba(255, 255, 255, 0.1);
        }

        .modal-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-sizing: border-box;
        }

        .dark .modal-header {
            border-color: rgba(255, 255, 255, 0.1);
        }

        .modal-body {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
            box-sizing: border-box;
        }

        .modal-input {
            width: 100%;
            padding: 0.625rem 0.875rem;
            border-radius: 0.5rem;
            border: 1px solid #d1d5db;
            background-color: #ffffff;
            color: #030712;
            font-size: 0.875rem;
            outline: none;
            box-sizing: border-box;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .modal-input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2);
        }

        .dark .modal-input {
            border-color: #374151;
            background-color: #1f2937;
            color: #ffffff;
        }

        .dark .modal-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }

        .modal-footer {
            padding: 1rem 1.5rem;
            background-color: #f9fafb;
            border-t: 1px solid #e5e7eb;
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
            box-sizing: border-box;
        }

        .dark .modal-footer {
            background-color: rgba(255, 255, 255, 0.02);
            border-color: rgba(255, 255, 255, 0.1);
        }
    </style>

    <div x-data="{ openModal: false }" style="display: flex; flex-direction: column; gap: 1.5rem;">

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;">

            <div class="bg-white dark:bg-gray-900 shadow-sm ring-1 ring-gray-950/5 dark:ring-white/10"
                style="border-radius: 0.75rem; display: flex; flex-direction: column; overflow: hidden;">
                <div style="padding: 1.5rem; flex-grow: 1;">
                    <h3 class="text-gray-950 dark:text-white"
                        style="font-size: 1rem; font-weight: 600; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                        <svg style="width: 1.25rem; height: 1.25rem; color: #f59e0b;" fill="none" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                        </svg>
                        Langkah 1: Perbarui Daftar
                    </h3>

                    <div style="font-size: 0.875rem;">
                        @if($excelExists)
                        <div style="padding: 0.75rem; border-radius: 0.5rem; background-color: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.2); color: #059669;"
                            class="dark:text-emerald-400">
                            ✅ <b>File tersedia.</b> Silakan lanjut ke Langkah 2.
                        </div>
                        @else
                        <div style="padding: 0.75rem; border-radius: 0.5rem; background-color: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.2); color: #dc2626;"
                            class="dark:text-red-400">
                            ⚠️ <b>Belum ada data.</b> Jalankan scraping.
                        </div>
                        @endif
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-white/5 border-t border-gray-200 dark:border-white/10"
                    style="padding: 1rem 1.5rem;">
                    <button type="button" id="btn-perbarui" class="custom-btn-secondary"
                        style="width: 100%; padding: 0.5rem 1rem; border-radius: 0.5rem; font-weight: 600; font-size: 0.875rem; cursor: pointer; transition: all 0.2s;">
                        Mulai Scraping Dosen
                    </button>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-900 shadow-sm ring-1 ring-gray-950/5 dark:ring-white/10"
                style="border-radius: 0.75rem; display: flex; flex-direction: column; overflow: hidden;">
                <div style="padding: 1.5rem; flex-grow: 1;">
                    <h3 class="text-gray-950 dark:text-white"
                        style="font-size: 1rem; font-weight: 600; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                        <svg style="width: 1.25rem; height: 1.25rem; color: #0ea5e9;" fill="none" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                        Langkah 2: Ambil Detail
                    </h3>

                    <div>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                            <label style="font-size: 0.875rem; font-weight: 500;" class="text-gray-950 dark:text-white">Pilih Dosen SINTA</label>
                            <button type="button" @click="openModal = true" style="color: #2563eb; font-size: 0.75rem; font-weight: 600; cursor: pointer; background: none; border: none;" class="dark:text-blue-400 hover:underline">
                                + Tambah Dosen Manual
                            </button>
                        </div>
                        <div wire:ignore>
                            <select id="sinta_id" class="custom-select-dosen"
                                style="width: 100%; padding: 0.5rem; border-radius: 0.5rem; border: 1px solid rgba(156, 163, 175, 0.4); font-size: 0.875rem; outline: none;">
                                <option value="">-- Silakan Pilih Dosen --</option>
                                @if(count($dosenList) > 0)
                                    @foreach($dosenList as $dosen)
                                        <option value="{{ $dosen->sinta_id }}">
                                            {{ $dosen->nama }} — {{ $dosen->departemen ?? 'Unknown' }} (ID: {{ $dosen->sinta_id }})
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-white/5 border-t border-gray-200 dark:border-white/10"
                    style="padding: 1rem 1.5rem;">
                    <button type="button" id="btn-ambil-detail"
                        style="width: 100%; padding: 0.5rem 1rem; border-radius: 0.5rem; background-color: var(--primary-600, #2563eb); color: #fff; font-weight: 600; font-size: 0.875rem; border: none; cursor: pointer;">
                        Ekstrak Data SINTA
                    </button>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-900 shadow-sm ring-1 ring-gray-950/5 dark:ring-white/10"
                style="border-radius: 0.75rem; display: flex; flex-direction: column; overflow: hidden;">
                <div style="padding: 1.5rem; flex-grow: 1;">
                    <h3 class="text-gray-950 dark:text-white"
                        style="font-size: 1rem; font-weight: 600; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                        <svg style="width: 1.25rem; height: 1.25rem; color: #10b981;" fill="none" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                        </svg>
                        Langkah 3: Database
                    </h3>
                    <p class="text-gray-500 dark:text-gray-400" style="font-size: 0.875rem; margin-bottom: 1rem;">
                        Migrasikan seluruh data kualifikasi dan publikasi dosen dari dokumen Excel ke dalam MySQL.
                    </p>

                    <div>
                        <label style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 0.5rem;"
                            class="text-gray-950 dark:text-white">Pilih Jurusan</label>
                        <div wire:ignore>
                            <select id="jurusan" class="custom-select-dosen"
                                style="width: 100%; padding: 0.5rem; border-radius: 0.5rem; border: 1px solid rgba(156, 163, 175, 0.4); font-size: 0.875rem; outline: none;">
                                <option value="">-- Silakan Pilih Jurusan --</option>
                                @if (!empty($jurusans))
                                    @foreach ($jurusans as $jurusan_item)
                                        <option value="{{ $jurusan_item['slug'] }}">{{ $jurusan_item['display_name'] }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-white/5 border-t border-gray-200 dark:border-white/10"
                    style="padding: 1rem 1.5rem;">
                    <button type="button" id="btn-import"
                        style="width: 100%; padding: 0.5rem 1rem; border-radius: 0.5rem; background-color: #10b981; color: #fff; font-weight: 600; font-size: 0.875rem; border: none; cursor: pointer;">
                        Import ke Database
                    </button>
                </div>
            </div>

        </div>

        <div
            style="background-color: #0a0a0a; border-radius: 0.75rem; border: 1px solid #262626; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); display: flex; flex-direction: column; height: 450px; overflow: hidden; margin-top: 0.5rem;">
            <div
                style="background-color: #171717; padding: 0.75rem 1rem; border-bottom: 1px solid #262626; display: flex; justify-content: space-between; align-items: center;">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="display: flex; gap: 0.375rem;">
                        <div style="width: 0.75rem; height: 0.75rem; border-radius: 9999px; background-color: #ef4444;">
                        </div>
                        <div style="width: 0.75rem; height: 0.75rem; border-radius: 9999px; background-color: #eab308;">
                        </div>
                        <div style="width: 0.75rem; height: 0.75rem; border-radius: 9999px; background-color: #22c55e;">
                        </div>
                    </div>
                    <span
                        style="color: #a3a3a3; font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace; font-size: 0.75rem; letter-spacing: 0.05em;">Terminal
                        Real-time Sync Output</span>
                </div>
                <button type="button"
                    onclick="document.getElementById('output-box').innerHTML='Menunggu perintah...\n'"
                    style="color: #a3a3a3; font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace; font-size: 0.75rem; background: none; border: none; cursor: pointer;">
                    Clear Log
                </button>
            </div>
            <div id="terminal-container"
                style="padding: 1rem; overflow-y: auto; flex-grow: 1; background-color: #0a0a0a;">
                <pre id="output-box"
                    style="color: #4ade80; margin: 0; white-space: pre-wrap; word-break: break-all; font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace; font-size: 0.875rem; line-height: 1.5;">Menunggu perintah...</pre>
            </div>
        </div>

        <div class="modal-overlay" x-show="openModal" x-cloak x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div class="modal-card" @click.away="openModal = false">
                <div class="modal-header">
                    <h3 style="font-size: 1.125rem; font-weight: 700;">Form Tambah Data Dosen</h3>
                    <button type="button" @click="openModal = false" style="background: none; border: none; cursor: pointer;" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg style="width: 1.5rem; height: 1.5rem;" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form id="form-tambah-dosen">
                    <div class="modal-body">
                        <div>
                            <label style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 0.375rem;">SINTA ID</label>
                            <input type="text" id="input_sinta_id" name="sinta_id" required class="modal-input" placeholder="Contoh: 6954305">
                        </div>
                        <div>
                            <label style="display: block; font-size: 0.875rem; font-weight: 500; margin-bottom: 0.375rem;">Nama Lengkap</label>
                            <input type="text" id="input_nama" name="nama" required class="modal-input" placeholder="Nama Lengkap Beserta Gelar">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" @click="openModal = false" class="custom-btn-secondary" style="padding: 0.5rem 1rem; border-radius: 0.5rem; font-weight: 600; font-size: 0.875rem; cursor: pointer;">Batal</button>
                        <button type="submit" style="padding: 0.5rem 1rem; border-radius: 0.5rem; background-color: var(--primary-600, #2563eb); color: #fff; font-weight: 600; font-size: 0.875rem; border: none; cursor: pointer;">Simpan Dosen</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#sinta_id').select2({
                placeholder: "-- Silakan Pilih Dosen --",
                allowClear: true,
                width: '100%'
            });

            $('#jurusan').select2({
                placeholder: "-- Silakan Pilih Jurusan --",
                allowClear: true,
                width: '100%'
            });
        });

        document.getElementById('form-tambah-dosen').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const sintaId = document.getElementById('input_sinta_id').value;
            const nama = document.getElementById('input_nama').value;

            const payload = new FormData();
            payload.append('sinta_id', sintaId);
            payload.append('nama', nama);
            payload.append('_token', "{{ csrf_token() }}");

            fetch("/admin/scrap/tambah-dosen-manual", {
                method: "POST",
                body: payload
            })
            .then(response => {
                if (response.ok) return response.json();
                if (response.status === 422) throw new Error('Gagal: SINTA ID ini sudah terdaftar di database.');
                throw new Error('Terjadi kesalahan server saat menyimpan data.');
            })
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    window.location.reload();
                }
            })
            .catch(error => {
                alert(error.message);
            });
        });

        const outputBox = document.getElementById('output-box');
        const terminalContainer = document.getElementById('terminal-container');
        const btnPerbarui = document.getElementById('btn-perbarui');
        const btnAmbilDetail = document.getElementById('btn-ambil-detail');
        const btnImport = document.getElementById('btn-import');
        const selectSinta = document.getElementById('sinta_id');

        function appendTerminal(text) {
            outputBox.innerHTML += text;
            terminalContainer.scrollTop = terminalContainer.scrollHeight;
        }

        function toggleLoading(button, isLoading, originalText) {
            if (isLoading) {
                button.disabled = true;
                button.innerText = `⏳ Memproses...`;
                button.style.opacity = '0.5';
            } else {
                button.disabled = false;
                button.innerText = originalText;
                button.style.opacity = '1';
            }
        }

        btnPerbarui.addEventListener('click', function() {
            outputBox.innerHTML = '>>> Memulai pembaruan data master dosen (dosen.py)...\n';
            toggleLoading(btnPerbarui, true, 'Mulai Scraping Dosen');
            btnAmbilDetail.disabled = true;
            btnAmbilDetail.style.opacity = '0.5';
            btnImport.disabled = true;
            btnImport.style.opacity = '0.5';

            const eventSource = new EventSource("{{ route('scrap.perbaruiDosen') }}");

            eventSource.onmessage = function(event) {
                const data = JSON.parse(event.data);
                if (data.output) appendTerminal(data.output);
                if (data.done) {
                    eventSource.close();
                    appendTerminal('\n[SUKSES] Daftar dosen berhasil diperbarui. Memuat ulang...\n');
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                }
            };
            eventSource.onerror = function() {
                eventSource.close();
                appendTerminal('\n[ERROR] Koneksi diputus server.\n');
                toggleLoading(btnPerbarui, false, 'Mulai Scraping Dosen');
            };
        });

        btnAmbilDetail.addEventListener('click', function() {
            const sintaId = selectSinta.value;
            if (!sintaId) return alert('Silakan pilih dosen terlebih dahulu!');

            outputBox.innerHTML = `>>> Mengekstrak detail modul SINTA untuk ID: ${sintaId}...\n\n`;
            toggleLoading(btnAmbilDetail, true, 'Ekstrak Data SINTA');
            btnPerbarui.disabled = true;
            btnPerbarui.style.opacity = '0.5';
            btnImport.disabled = true;

            let targetUrl = "{{ route('scrap.ambilDetail', ':id') }}";
            targetUrl = targetUrl.replace(':id', sintaId);

            const eventSource = new EventSource(targetUrl);

            eventSource.onmessage = function(event) {
                const data = JSON.parse(event.data);
                if (data.output) appendTerminal(data.output);
                if (data.done) {
                    eventSource.close();
                    appendTerminal(`\n[SUKSES] Seluruh modul & file gabungan berhasil dibuat.\n`);
                    toggleLoading(btnAmbilDetail, false, 'Ekstrak Data SINTA');
                    btnPerbarui.disabled = false;
                    btnPerbarui.style.opacity = '1';
                    btnImport.disabled = false;
                    btnImport.style.opacity = '1';
                }
            };
            eventSource.onerror = function() {
                eventSource.close();
                appendTerminal('\n[ERROR] Ekstraksi terputus.\n');
                toggleLoading(btnAmbilDetail, false, 'Ekstrak Data SINTA');
            };
        });

        btnImport.addEventListener('click', function() {
            const sintaId = selectSinta.value;
            const jurusan = document.getElementById('jurusan').value; 

            if (!sintaId) return alert('SINTA ID tidak ditemukan.');
            if (!jurusan) return alert('Silakan pilih Jurusan terlebih dahulu!'); 

            appendTerminal(
                `\n>>> Memulai migrasi streaming data Excel ke MySQL untuk SINTA ID: ${sintaId} (Jurusan: ${jurusan})...\n`
                );
            toggleLoading(btnImport, true, 'Tambah ke Database');
            btnAmbilDetail.disabled = true;
            btnAmbilDetail.style.opacity = '0.5';

            let targetUrl = "{{ route('scrap.importData', ':id') }}";
            targetUrl = targetUrl.replace(':id', sintaId);

            targetUrl += "?jurusan=" + encodeURIComponent(jurusan);

            const eventSource = new EventSource(targetUrl);

            eventSource.onmessage = function(event) {
                const data = JSON.parse(event.data);
                if (data.output) appendTerminal(data.output);
                if (data.done) {
                    eventSource.close();
                    toggleLoading(btnImport, false, 'Import ke Database');
                    btnAmbilDetail.disabled = false;
                    btnAmbilDetail.style.opacity = '1';
                }
            };
            eventSource.onerror = function() {
                eventSource.close();
                appendTerminal('\n[ERROR] Gangguan pada proses stream database.\n');
                toggleLoading(btnImport, false, 'Import ke Database');
                btnAmbilDetail.disabled = false;
                btnAmbilDetail.style.opacity = '1';
            };
        });
    </script>
</x-filament-panels::page>