import pandas as pd
import sys
import os

if len(sys.argv) < 2:
    print("SINTA ID tidak diberikan!")
    sys.exit(1)

sinta_id = sys.argv[1]

# Set folder root input & output secara dinamis menuju folder scripts/output
base_dir = os.path.join(os.path.dirname(__file__), 'output')

# Membuat folder output otomatis jika belum ada
if not os.path.exists(base_dir):
    os.makedirs(base_dir)

expected_files = {
    os.path.join(base_dir, f"scopus_{sinta_id}.xlsx"): "SCOPUS",
    os.path.join(base_dir, f"scholar_{sinta_id}.xlsx"): "SCHOLAR",
    os.path.join(base_dir, f"garuda_{sinta_id}.xlsx"): "GARUDA",
    os.path.join(base_dir, f"books_{sinta_id}.xlsx"): "BOOKS",
    os.path.join(base_dir, f"service_{sinta_id}.xlsx"): "SERVICES",
    os.path.join(base_dir, f"research_{sinta_id}.xlsx"): "RESEARCHES",
}

output_filename = os.path.join(base_dir, f"merged_data_{sinta_id}.xlsx")

try:
    with pd.ExcelWriter(output_filename, engine="openpyxl") as writer:
        for file_path, default_sheet in expected_files.items():
            
            if os.path.exists(file_path):
                try:
                    # PERBAIKAN: Menggunakan 'with' agar file otomatis di-close setelah dibaca
                    with pd.ExcelFile(file_path) as xl:
                        sheet_names = xl.sheet_names
                        
                        if not sheet_names: 
                            df_kosong = pd.DataFrame({'Data': ['none']})
                            df_kosong.to_excel(writer, sheet_name=default_sheet, index=False)
                        else:
                            for sheet_name in sheet_names:
                                # Mengambil dari 'xl' (file memori yang sedang terbuka) bukan dari path lagi
                                df = pd.read_excel(xl, sheet_name=sheet_name)
                                if df.empty:
                                    df = pd.DataFrame({'Data': ['none']})
                                safe_sheet_name = sheet_name[:31]
                                df.to_excel(writer, sheet_name=safe_sheet_name, index=False)
                                
                except Exception as e:
                    print(f"[-] Gagal membaca sheet dari {os.path.basename(file_path)}. Error: {e}")
                    df_kosong = pd.DataFrame({'Data': ['none']})
                    df_kosong.to_excel(writer, sheet_name=default_sheet, index=False)
            else:
                print(f"[-] Data {default_sheet} kosong/tidak ditemukan, membuat sheet berisi 'none'.")
                df_kosong = pd.DataFrame({'Data': ['none']})
                df_kosong.to_excel(writer, sheet_name=default_sheet, index=False)
                
    print(f"\n[+] PROSES MERGE SELESAI!")
    print(f"[+] Berhasil menggabungkan seluruh sheet ke: {output_filename}")
    
    # --- PROSES CLEANUP / PENGHAPUSAN FILE SISA ---
    print("\n[+] Membersihkan file Excel sisa...")
    for file_path in expected_files.keys():
        if os.path.exists(file_path):
            try:
                os.remove(file_path)
                print(f"    -> Berhasil dihapus: {os.path.basename(file_path)}")
            except Exception as e:
                print(f"    -> Gagal menghapus {os.path.basename(file_path)}: {e}")
                
except Exception as e:
    print(f"\n[-] Terjadi kesalahan fatal saat proses penggabungan: {e}")