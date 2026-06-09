import requests
from bs4 import BeautifulSoup
import pandas as pd
import re
import sys
import os
# =====================================================
# CONFIG
# =====================================================

if len(sys.argv) > 1:
    SINTA_ID = sys.argv[1]
else:
    SINTA_ID = "6803382"

URL = f"https://sinta.kemdiktisaintek.go.id/authors/profile/{SINTA_ID}/?view=books"

HEADERS = {
    "User-Agent": "Mozilla/5.0"
}

# =====================================================
# REQUEST
# =====================================================

print("Mengambil halaman books...")

response = requests.get(URL, headers=HEADERS)

if response.status_code != 200:
    raise Exception(f"Gagal membuka halaman : {response.status_code}")

soup = BeautifulSoup(response.text, "html.parser")

# =====================================================
# DATA
# =====================================================

data = {
    "books": []
}

# =====================================================
# BOOK LIST
# =====================================================

for item in soup.select("div.ar-list-item"):

    book = {}

    title = item.select_one("div.ar-title a")
    if title:
        book["judul"] = title.get_text(" ", strip=True)

    metas = item.select("div.ar-meta")

    # Category
    if len(metas) >= 1:
        category = metas[0].get_text(" ", strip=True)
        book["kategori"] = category.replace("Category :", "").strip()

    # Author + Publisher
    if len(metas) >= 2:

        authors = metas[1].find_all("a")

        if len(authors) >= 1:
            book["penulis"] = authors[0].get_text(" ", strip=True)

        publisher = metas[1].select_one("a.ar-pub")

        if publisher:
            book["penerbit"] = publisher.get_text(" ", strip=True)

    # Year + City + ISBN
    if len(metas) >= 3:

        year = metas[2].select_one("a.ar-year")
        if year:
            m = re.search(r"20\d{2}", year.get_text())
            if m:
                book["tahun"] = m.group()

        city = metas[2].select_one("a.ar-cited")
        if city:
            book["kota"] = city.get_text(" ", strip=True)

        isbn = metas[2].select_one("a.ar-quartile")
        if isbn:
            book["isbn"] = (
                isbn.get_text(" ", strip=True)
                .replace("ISBN :", "")
                .strip()
            )

    data["books"].append(book)

# =====================================================
# OUTPUT
# =====================================================

print("\n=== BOOK LIST ===")
for i, b in enumerate(data["books"], start=1):
    print(f"\n[{i}]")
    for k, v in b.items():
        print(f"{k}: {v}")

# =====================================================
# EXCEL
# =====================================================

# 1. Tentukan folder tujuan (scripts/output) secara dinamis
output_dir = os.path.join(os.path.dirname(os.path.abspath(__file__)), 'output')

# 2. Buat foldernya otomatis jika belum ada
if not os.path.exists(output_dir):
    os.makedirs(output_dir)

# 3. Tentukan path lengkap untuk file Excel yang akan disimpan
output_filename = os.path.join(output_dir, f"books_{SINTA_ID}.xlsx")

# 4. Simpan menggunakan openpyxl
with pd.ExcelWriter(
    output_filename,
    engine="openpyxl"
) as writer:

    pd.DataFrame(data["books"]).to_excel(
        writer,
        sheet_name="BOOKS",
        index=False
    )

print(f"\n[+] File berhasil dibuat di: {output_filename}")