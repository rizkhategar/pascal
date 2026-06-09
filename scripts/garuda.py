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

URL = f"https://sinta.kemdiktisaintek.go.id/authors/profile/{SINTA_ID}/?view=garuda"

HEADERS = {
    "User-Agent": (
        "Mozilla/5.0 (Windows NT 10.0; Win64; x64) "
        "AppleWebKit/537.36 (KHTML, like Gecko) "
        "Chrome/132.0.0.0 Safari/537.36"
    )
}

# =====================================================
# REQUEST
# =====================================================

print("Mengambil halaman...")

response = requests.get(URL, headers=HEADERS)

if response.status_code != 200:
    raise Exception(
        f"Gagal membuka halaman. Status: {response.status_code}"
    )

print("Status:", response.status_code)
html = response.text

soup = BeautifulSoup(response.text, "html.parser")


page_text = soup.get_text("\n", strip=True)

# =====================================================
# PROFIL DOSEN
# =====================================================

data = {
    "nama": None,
    "institusi": None,
    "program_studi": None,
    "sinta_id": SINTA_ID,
    "bidang_minat": None,
    "sinta_score_overall": None,
    "sinta_score_3yr": None,
    "affil_score": None,
    "affil_score_3yr": None,
    "publications": []
}

# =====================================================
# NAMA
# =====================================================

h3 = soup.find("h3")

if h3:
    data["nama"] = h3.get_text(strip=True)

# =====================================================
# INSTITUSI
# =====================================================

for a in soup.find_all("a", href=True):

    href = a["href"]

    if "/affiliations/profile/" in href:

        text = a.get_text(" ", strip=True)

        if text != "Affiliations":
            data["institusi"] = text
            break

# =====================================================
# PROGRAM STUDI
# =====================================================

for a in soup.find_all("a", href=True):

    href = a["href"]

    if "/departments/profile/" in href:

        text = a.get_text(" ", strip=True)

        if text != "Departments":
            data["program_studi"] = text
            break

# =====================================================
# BIDANG MINAT
# =====================================================

interest_keywords = [
    "Data Mining",
    "Machine Learning",
    "Artificial Intelligence",
    "Data Science"
]

for keyword in interest_keywords:

    if keyword.lower() in page_text.lower():
        data["bidang_minat"] = keyword
        break

# =====================================================
# SCORE
# =====================================================

lines = [
    x.strip()
    for x in page_text.split("\n")
    if x.strip()
]

for i, line in enumerate(lines):

    if line == "SINTA Score Overall" and i > 0:
        data["sinta_score_overall"] = lines[i - 1]

    elif line == "SINTA Score 3Yr" and i > 0:
        data["sinta_score_3yr"] = lines[i - 1]

    elif line == "Affil Score" and i > 0:
        data["affil_score"] = lines[i - 1]

    elif line == "Affil Score 3Yr" and i > 0:
        data["affil_score_3yr"] = lines[i - 1]

import re

def extract_garuda_yearly_stats(html):

    yearly_stats = []

    # Ambil blok chart Garuda
    chart_match = re.search(
        r"garuda-chart-articles.*?option\s*=\s*\{(.*?)myChart\.setOption",
        html,
        re.DOTALL
    )

    if not chart_match:
        print("Grafik Garuda tidak ditemukan")
        return []

    chart_text = chart_match.group(1)

    # =====================
    # Tahun
    # =====================

    years_match = re.search(
        r"data:\s*\[(.*?)\]\s*,\s*axisLabel",
        chart_text,
        re.DOTALL
    )

    years = []

    if years_match:

        years = re.findall(
            r"'(\d{4})'",
            years_match.group(1)
        )

    # =====================
    # Jumlah artikel
    # =====================

    series_match = re.search(
        r"series:\s*\[\s*\{\s*data:\s*\[(.*?)\]",
        chart_text,
        re.DOTALL
    )

    articles = []

    if series_match:

        articles = [
            int(x)
            for x in re.findall(
                r"\d+",
                series_match.group(1)
            )
        ]

    print("YEARS =", years)
    print("ARTICLES =", articles)

    size = min(
        len(years),
        len(articles)
    )

    for i in range(size):

        yearly_stats.append({
            "tahun": years[i],
            "articles": articles[i]
        })

    return yearly_stats

garuda_yearly_stats = extract_garuda_yearly_stats(html)

# =====================================================
# PUBLIKASI GARUDA
# =====================================================

for item in soup.select("div.ar-list-item"):

    publication = {}

    # ==================================
    # JUDUL + URL ARTIKEL
    # ==================================

    title_link = item.select_one("div.ar-title a")

    if title_link:

        publication["judul"] = title_link.get_text(
            " ",
            strip=True
        )

        publication["url_artikel"] = title_link.get(
            "href",
            ""
        )

    # ==================================
    # META
    # ==================================

    meta_blocks = item.select("div.ar-meta")

    if len(meta_blocks) >= 1:

        publisher_links = meta_blocks[0].find_all("a")

        # Publisher

        if len(publisher_links) >= 1:

            publication["publisher"] = (
                publisher_links[0]
                .get_text(" ", strip=True)
            )

        # Journal

        if len(publisher_links) >= 2:

            publication["journal"] = (
                publisher_links[1]
                .get_text(" ", strip=True)
            )

            publication["url_journal"] = (
                publisher_links[1]
                .get("href", "")
            )

    # ==================================
    # AUTHOR / DOI / TAHUN
    # ==================================

    if len(meta_blocks) >= 2:

        text = meta_blocks[1].get_text(
            "\n",
            strip=True
        )

        lines = [
            x.strip()
            for x in text.split("\n")
            if x.strip()
        ]

        for line in lines:

            # Author Order

            if line.startswith("Author Order"):

                publication["author_order"] = (
                    line.replace(
                        "Author Order :",
                        ""
                    ).strip()
                )

            # Authors

            elif ";" in line:

                publication["authors"] = line

            # Tahun

            elif re.fullmatch(r"20\d{2}", line):

                publication["tahun"] = line

            # DOI

            elif "DOI:" in line:

                publication["doi"] = (
                    line.replace(
                        "DOI:",
                        ""
                    ).strip()
                )

            # Akreditasi

            elif "Accred" in line:

                publication["accreditation"] = (
                    line.replace(
                        "Accred :",
                        ""
                    ).strip()
                )

    data["publications"].append(
        publication
    )

# =====================================================
# OUTPUT
# =====================================================

print("\n=== PROFIL DOSEN ===")
print("Nama               :", data["nama"])
print("Institusi          :", data["institusi"])
print("Program Studi      :", data["program_studi"])
print("SINTA ID           :", data["sinta_id"])
print("Bidang Minat       :", data["bidang_minat"])

print("\n=== SCORE ===")
print("SINTA Score Overall :", data["sinta_score_overall"])
print("SINTA Score 3Yr     :", data["sinta_score_3yr"])
print("Affil Score         :", data["affil_score"])
print("Affil Score 3Yr     :", data["affil_score_3yr"])

print("\n=== PUBLIKASI GARUDA ===")

for i, pub in enumerate(data["publications"], start=1):
    print(f"\n[{i}]")
    for k, v in pub.items():
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
output_filename = os.path.join(output_dir, f"garuda_{SINTA_ID}.xlsx")

# 4. Simpan menggunakan openpyxl (Tanpa CSV)
with pd.ExcelWriter(
    output_filename,
    engine="openpyxl"
) as writer:

    pd.DataFrame(
        data["publications"]
    ).to_excel(
        writer,
        sheet_name="GARUDA_PUBLICATIONS",
        index=False
    )

    pd.DataFrame(
        garuda_yearly_stats
    ).to_excel(
        writer,
        sheet_name="GARUDA_YEARLY_STATS",
        index=False
    )

print(f"\n[+] Excel berhasil dibuat di: {output_filename}")