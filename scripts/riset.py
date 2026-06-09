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

URL = f"https://sinta.kemdiktisaintek.go.id/authors/profile/{SINTA_ID}/?view=researches"

HEADERS = {
    "User-Agent":
    "Mozilla/5.0"
}

# =====================================================
# REQUEST
# =====================================================

print("Mengambil halaman...")

response = requests.get(
    URL,
    headers=HEADERS
)

if response.status_code != 200:
    raise Exception(
        f"Gagal membuka halaman : {response.status_code}"
    )

html = response.text

soup = BeautifulSoup(
    html,
    "html.parser"
)

# =====================================================
# DATA
# =====================================================

data = {
    "researches": [],
    "research_per_year": []
}

# =====================================================
# RESEARCH PER YEAR
# =====================================================

for script in soup.find_all("script"):

    txt = script.get_text()

    if "research-chart-articles" not in txt:
        continue

    years_match = re.search(
        r"data:\s*\[(.*?)\]\s*,\s*axisLabel",
        txt,
        re.S
    )

    series_match = re.search(
        r"series:\s*\[\{\s*data:\s*\[(.*?)\]",
        txt,
        re.S
    )

    if years_match and series_match:

        years = re.findall(
            r"'(\d{4})'",
            years_match.group(1)
        )

        counts = [
            int(x)
            for x in re.findall(
                r"\d+",
                series_match.group(1)
            )
        ]

        for y, c in zip(years, counts):

            data["research_per_year"].append({
                "tahun": y,
                "jumlah": c
            })

        break

# =====================================================
# RESEARCH LIST
# =====================================================

for item in soup.select("div.ar-list-item"):

    research = {}

    title = item.select_one(
        "div.ar-title a"
    )

    if title:

        research["judul"] = (
            title.get_text(
                " ",
                strip=True
            )
        )

    metas = item.select(
        "div.ar-meta"
    )

    # Leader + Skema
    if len(metas) >= 1:

        links = metas[0].find_all("a")

        if len(links) >= 1:

            research["leader"] = (
                links[0]
                .get_text(
                    " ",
                    strip=True
                )
                .replace(
                    "Leader :",
                    ""
                )
                .strip()
            )

        pub = metas[0].select_one(
            "a.ar-pub"
        )

        if pub:

            research["skema"] = (
                pub.get_text(
                    " ",
                    strip=True
                )
            )

    # Personils
    if len(metas) >= 2:

        research["personils"] = (
            metas[1].get_text(
                " ",
                strip=True
            )
        )

    # Tahun, Dana, Status
    if len(metas) >= 3:

        year = metas[2].select_one(
            "a.ar-year"
        )

        if year:

            m = re.search(
                r"20\d{2}",
                year.get_text()
            )

            if m:
                research["tahun"] = (
                    m.group()
                )

        quartiles = metas[2].select(
            "a.ar-quartile"
        )

        if len(quartiles) >= 1:
            research["dana"] = (
                quartiles[0]
                .get_text(
                    " ",
                    strip=True
                )
            )

        if len(quartiles) >= 2:
            research["status"] = (
                quartiles[1]
                .get_text(
                    " ",
                    strip=True
                )
            )

        if len(quartiles) >= 3:
            research["source"] = (
                quartiles[2]
                .get_text(
                    " ",
                    strip=True
                )
            )

    data["researches"].append(
        research
    )

# =====================================================
# OUTPUT
# =====================================================

print("\n=== RESEARCH PER YEAR ===")
for item in data["research_per_year"]:
    print(f"{item['tahun']} : {item['jumlah']}")

print("\n=== RESEARCH LIST ===")
for i, r in enumerate(data["researches"], start=1):
    print(f"\n[{i}]")
    for k, v in r.items():
        print(f"{k}: {v}")

# =====================================================
# EXPORT EXCEL (Hanya XLSX)
# =====================================================

# 1. Tentukan folder tujuan (scripts/output) secara dinamis
output_dir = os.path.join(os.path.dirname(os.path.abspath(__file__)), 'output')

# 2. Buat foldernya otomatis jika belum ada
if not os.path.exists(output_dir):
    os.makedirs(output_dir)

# 3. Tentukan path lengkap untuk file Excel
output_filename = os.path.join(output_dir, f"research_{SINTA_ID}.xlsx")

# 4. Simpan menggunakan openpyxl ke folder output
with pd.ExcelWriter(
    output_filename,
    engine="openpyxl"
) as writer:

    pd.DataFrame(
        data["researches"]
    ).to_excel(
        writer,
        sheet_name="RESEARCHES",
        index=False
    )

    pd.DataFrame(
        data["research_per_year"]
    ).to_excel(
        writer,
        sheet_name="RESEARCH_YEARLY",
        index=False
    )

print(f"\n[+] Excel berhasil dibuat di: {output_filename}")