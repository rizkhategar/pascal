
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

URL = f"https://sinta.kemdiktisaintek.go.id/authors/profile/{SINTA_ID}/?view=googlescholar"

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

print("Mengambil halaman Google Scholar...")

response = requests.get(
    URL,
    headers=HEADERS
)

if response.status_code != 200:
    raise Exception(
        f"Gagal membuka halaman. Status: {response.status_code}"
    )

print("Status:", response.status_code)

soup = BeautifulSoup(
    response.text,
    "html.parser"
)

# =====================================================
# STATISTIK PUBLIKASI TAHUNAN
# =====================================================

def extract_yearly_stats(html):

    yearly_stats = []

    # ==========================
    # TAHUN
    # ==========================

    years_match = re.search(
        r"xAxis\s*:\s*\[\s*\{.*?data\s*:\s*\[(.*?)\]",
        html,
        re.DOTALL
    )

    if not years_match:
        print("Gagal menemukan xAxis")
        return []

    years = re.findall(
        r"'(\d{4})'",
        years_match.group(1)
    )

    # ==========================
    # BLOK SERIES
    # ==========================

    series_match = re.search(
        r"series\s*:\s*\[(.*?)\]\s*};",
        html,
        re.DOTALL
    )

    if not series_match:
        print("Gagal menemukan series")
        return []

    series_text = series_match.group(1)

    # ==========================
    # PUBLICATIONS
    # ==========================

    pub_match = re.search(
        r"name:\s*'Publications'.*?data:\s*\[(.*?)\]",
        series_text,
        re.DOTALL
    )

    publications = []

    if pub_match:

        publications = [
            int(x)
            for x in re.findall(
                r"\d+",
                pub_match.group(1)
            )
        ]

    # ==========================
    # CITATIONS
    # ==========================

    cite_match = re.search(
        r"name:\s*'Citations'.*?data:\s*\[(.*?)\]",
        series_text,
        re.DOTALL
    )

    citations = []

    if cite_match:

        citations = [
            int(x)
            for x in re.findall(
                r"\d+",
                cite_match.group(1)
            )
        ]

    print("YEARS        =", years)
    print("PUBLICATIONS =", publications)
    print("CITATIONS    =", citations)

    # ==========================
    # GABUNGKAN
    # ==========================

    size = min(
        len(years),
        len(publications),
        len(citations)
    )

    for i in range(size):

        yearly_stats.append({
            "tahun": years[i],
            "publications": publications[i],
            "citations": citations[i]
        })

    return yearly_stats
    
# =====================================================
# DATA
# =====================================================

data = {
    "sinta_id": SINTA_ID,
    "publications": [],
    "yearly_stats": []
}

# =====================================================
# AMBIL STATISTIK TAHUNAN
# =====================================================

data["yearly_stats"] = extract_yearly_stats(
    response.text
)

# =====================================================
# PUBLIKASI GOOGLE SCHOLAR
# =====================================================

for item in soup.select("div.ar-list-item"):

    publication = {}

    # ----------------------------------
    # JUDUL + URL GOOGLE SCHOLAR
    # ----------------------------------

    title_link = item.select_one(
        "div.ar-title a"
    )

    if title_link:

        publication["judul"] = (
            title_link.get_text(
                " ",
                strip=True
            )
        )

        publication["url_artikel"] = (
            title_link.get(
                "href",
                ""
            )
        )

    # ----------------------------------
    # META
    # ----------------------------------

    meta_blocks = item.select(
        "div.ar-meta"
    )

    # META PERTAMA
    if len(meta_blocks) >= 1:

        for a in meta_blocks[0].find_all("a"):

            txt = a.get_text(
                " ",
                strip=True
            )

            # Authors

            if txt.startswith(
                "Authors :"
            ):

                publication["authors"] = (
                    txt.replace(
                        "Authors :",
                        ""
                    ).strip()
                )

            # Source / Publisher

            elif "ar-pub" in a.get(
                "class",
                []
            ):

                publication["source"] = txt

    # META KEDUA
    if len(meta_blocks) >= 2:

        # Tahun

        year_tag = meta_blocks[1].select_one(
            "a.ar-year"
        )

        if year_tag:

            year_text = (
                year_tag.get_text(
                    " ",
                    strip=True
                )
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

            cited_text = (
                cited_tag.get_text(
                    " ",
                    strip=True
                )
            )

            citation_match = re.search(
                r"(\d+)",
                cited_text
            )

            if citation_match:

                publication["citation"] = (
                    citation_match.group(
                        1
                    )
                )

    # SIMPAN

    if publication.get("judul"):

        data["publications"].append(
            publication
        )

# =====================================================
# OUTPUT
# =====================================================

print("\n=== PUBLIKASI GOOGLE SCHOLAR ===")
for i, pub in enumerate(data["publications"], start=1):
    print(f"\n[{i}]")
    print("Judul        :", pub.get("judul"))
    print("URL Scholar  :", pub.get("url_artikel"))
    print("Authors      :", pub.get("authors"))
    print("Source       :", pub.get("source"))
    print("Tahun        :", pub.get("tahun"))
    print("Citation     :", pub.get("citation"))

print("\n=== STATISTIK PUBLIKASI TAHUNAN ===")
for stat in data["yearly_stats"]:
    print(
        f"{stat['tahun']} | "
        f"Publications: {stat['publications']} | "
        f"Citations: {stat['citations']}"
    )

# =====================================================
# EXPORT EXCEL (Hanya XLSX)
# =====================================================

# SHEET 1 - PUBLIKASI GOOGLE SCHOLAR
publication_rows = []
for pub in data["publications"]:
    publication_rows.append({
        "SINTA ID": data["sinta_id"],
        "Judul": pub.get("judul"),
        "URL Scholar": pub.get("url_artikel"),
        "Authors": pub.get("authors"),
        "Source": pub.get("source"),
        "Tahun": pub.get("tahun"),
        "Citation": pub.get("citation")
    })

df_publications = pd.DataFrame(publication_rows)

# SHEET 2 - STATISTIK PUBLIKASI TAHUNAN
stats_rows = []
for stat in data["yearly_stats"]:
    stats_rows.append({
        "Tahun": stat["tahun"],
        "Publications": stat["publications"],
        "Citations": stat["citations"]
    })

df_stats = pd.DataFrame(stats_rows)

# 1. Tentukan folder tujuan (scripts/output) secara dinamis
output_dir = os.path.join(os.path.dirname(os.path.abspath(__file__)), 'output')

# 2. Buat foldernya otomatis jika belum ada
if not os.path.exists(output_dir):
    os.makedirs(output_dir)

# 3. Tentukan path lengkap untuk file Excel
output_filename = os.path.join(output_dir, f"scholar_{SINTA_ID}.xlsx")

# 4. Simpan menggunakan openpyxl ke folder output
with pd.ExcelWriter(
    output_filename,
    engine="openpyxl"
) as writer:

    df_publications.to_excel(
        writer,
        sheet_name="SCHOLAR_PUBLICATIONS",
        index=False
    )

    df_stats.to_excel(
        writer,
        sheet_name="SCHOLAR_YEARLY_STATS",
        index=False
    )

print(f"\n[+] Excel berhasil disimpan: {output_filename}")