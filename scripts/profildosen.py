import requests
from bs4 import BeautifulSoup
import pandas as pd
import re
import json
import sys
import os

# =====================================================
# CONFIG
# =====================================================

if len(sys.argv) > 1:
    SINTA_ID = sys.argv[1]
else:
    SINTA_ID = "6803382"

URL = f"https://sinta.kemdiktisaintek.go.id/authors/profile/{SINTA_ID}/?view=scopus"

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
    raise Exception(f"Gagal membuka halaman. Status: {response.status_code}")

print("Status:", response.status_code)

soup = BeautifulSoup(response.text, "html.parser")
page_text = soup.get_text("\n", strip=True)

# =====================================================
# DATA DOSEN
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
    "publications": [],
    "publication_per_year": []
}


# =====================================================
# PUBLIKASI PER TAHUN (SCOPUS CHART)
# =====================================================

for script in soup.find_all("script"):

    script_text = script.get_text()

    if "scopus-chart-articles" not in script_text:
        continue

    # Ambil tahun
    years = re.findall(
        r"'(20\d{2})'",
        script_text
    )

    # Ambil data series
    series_match = re.search(
        r"series:\s*\[\{\s*data:\s*\[(.*?)\]",
        script_text,
        re.DOTALL
    )

    counts = []

    if series_match:

        counts = [
            int(x)
            for x in re.findall(
                r"\d+",
                series_match.group(1)
            )
        ]

    print("YEARS =", years)
    print("COUNTS =", counts)

    for y, c in zip(years, counts):

        data["publication_per_year"].append({
            "tahun": y,
            "jumlah": c
        })

    break

# =====================================================
# NAMA DOSEN
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

# =====================================================
# PUBLIKASI SCOPUS
# =====================================================

data["publications"] = []

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
    # META BLOCK
    # ==================================

    meta_blocks = item.select("div.ar-meta")

    # ------------------------------
    # META PERTAMA
    # ------------------------------

    if len(meta_blocks) >= 1:

        # Quartile
        quartile_tag = meta_blocks[0].select_one(
            "a.ar-quartile"
        )

        if quartile_tag:

            publication["quartile"] = (
                quartile_tag.get_text(
                    " ",
                    strip=True
                )
            )

        # Journal / Proceeding
        journal_tag = meta_blocks[0].select_one(
            "a.ar-pub"
        )

        if journal_tag:

            publication["journal"] = (
                journal_tag.get_text(
                    " ",
                    strip=True
                )
            )

            publication["url_journal"] = (
                journal_tag.get(
                    "href",
                    ""
                )
            )

        # Author Order dan Creator
        for a in meta_blocks[0].find_all("a"):

            txt = a.get_text(
                " ",
                strip=True
            )

            if "Author Order" in txt:

                publication["author_order"] = (
                    txt.replace(
                        "Author Order :",
                        ""
                    ).strip()
                )

            elif "Creator" in txt:

                publication["creator"] = (
                    txt.replace(
                        "Creator :",
                        ""
                    ).strip()
                )

    # ------------------------------
    # META KEDUA
    # ------------------------------

    if len(meta_blocks) >= 2:

        # Tahun
        year_tag = meta_blocks[1].select_one(
            "a.ar-year"
        )

        if year_tag:

            year_text = year_tag.get_text(
                " ",
                strip=True
            )

            year_match = re.search(
                r"20\d{2}",
                year_text
            )

            if year_match:

                publication["tahun"] = (
                    year_match.group()
                )

        # Citation
        cited_tag = meta_blocks[1].select_one(
            "a.ar-cited"
        )

        if cited_tag:

            cited_text = cited_tag.get_text(
                " ",
                strip=True
            )

            citation_match = re.search(
                r"(\d+)",
                cited_text
            )

            if citation_match:

                publication["citation"] = (
                    citation_match.group(1)
                )

    # ==================================
    # SIMPAN
    # ==================================

    if publication.get("judul"):

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

print("\n=== PUBLIKASI PER TAHUN ===")
for item in data["publication_per_year"]:
    print(f"{item['tahun']} : {item['jumlah']} publikasi")

print("\n=== PUBLIKASI SCOPUS ===")
for i, pub in enumerate(data["publications"], start=1):
    print(f"\n[{i}]")
    print("Judul         :", pub.get("judul"))
    print("URL Artikel   :", pub.get("url_artikel"))
    print("Quartile      :", pub.get("quartile"))
    print("Journal       :", pub.get("journal"))
    print("URL Journal   :", pub.get("url_journal"))
    print("Author Order  :", pub.get("author_order"))
    print("Creator       :", pub.get("creator"))
    print("Tahun         :", pub.get("tahun"))
    print("Citation      :", pub.get("citation"))


# =====================================================
# EXPORT EXCEL (Hanya XLSX)
# =====================================================

profil_dosen = [{
    "Nama": data["nama"],
    "Institusi": data["institusi"],
    "Program Studi": data["program_studi"],
    "SINTA ID": data["sinta_id"],
    "Bidang Minat": data["bidang_minat"],
    "SINTA Score Overall": data["sinta_score_overall"],
    "SINTA Score 3Yr": data["sinta_score_3yr"],
    "Affil Score": data["affil_score"],
    "Affil Score 3Yr": data["affil_score_3yr"]
}]

publication_rows = []
for pub in data["publications"]:
    publication_rows.append({
        "Judul": pub.get("judul"),
        "Tahun": pub.get("tahun"),
        "Citation": pub.get("citation"),
        "Quartile": pub.get("quartile"),
        "Journal": pub.get("journal"),
        "Author Order": pub.get("author_order"),
        "Creator": pub.get("creator"),
        "URL Artikel": pub.get("url_artikel"),
        "URL Journal": pub.get("url_journal")
    })

# 1. Tentukan folder tujuan (scripts/output) secara dinamis
output_dir = os.path.join(os.path.dirname(os.path.abspath(__file__)), 'output')

# 2. Buat foldernya otomatis jika belum ada
if not os.path.exists(output_dir):
    os.makedirs(output_dir)

# 3. Tentukan path lengkap untuk file Excel
output_filename = os.path.join(output_dir, f"scopus_{SINTA_ID}.xlsx")

# 4. Simpan menggunakan openpyxl ke folder output
with pd.ExcelWriter(
    output_filename,
    engine="openpyxl"
) as writer:

    # Sheet 1: Data Dosen
    pd.DataFrame(
        profil_dosen
    ).to_excel(
        writer,
        sheet_name="DATA_DOSEN",
        index=False
    )

    # Sheet 2: Scopus Publications
    pd.DataFrame(
        publication_rows
    ).to_excel(
        writer,
        sheet_name="SCOPUS_PUBLICATIONS",
        index=False
    )

    # Sheet 3: Scopus Yearly Stats
    pd.DataFrame(
        data["publication_per_year"]
    ).to_excel(
        writer,
        sheet_name="SCOPUS_YEARLY_STATS",
        index=False
    )

print(f"\n[+] Excel berhasil dibuat di: {output_filename}")