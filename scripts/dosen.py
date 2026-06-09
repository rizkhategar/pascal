import math
import re
import time
import requests
import pandas as pd
from bs4 import BeautifulSoup

BASE_URL = "https://sinta.kemdiktisaintek.go.id/affiliations/authors/1996"

HEADERS = {
    "User-Agent": (
        "Mozilla/5.0 (Windows NT 10.0; Win64; x64) "
        "AppleWebKit/537.36 (KHTML, like Gecko) "
        "Chrome/137.0.0.0 Safari/537.36"
    )
}


def get_soup(page=1):
    url = f"{BASE_URL}?page={page}"

    response = requests.get(
        url,
        headers=HEADERS,
        timeout=30
    )

    response.raise_for_status()

    return BeautifulSoup(
        response.text,
        "html.parser"
    )


def get_total_pages():
    soup = get_soup(1)

    info_text = ""

    added_info = soup.select_one(".added-info")

    if added_info:
        info_text = added_info.get_text(
            " ",
            strip=True
        )

    match = re.search(
        r"(\d+)\s+Authors",
        info_text
    )

    if not match:
        raise Exception(
            "Jumlah author tidak ditemukan."
        )

    total_authors = int(
        match.group(1)
    )

    authors_in_page = len(
        soup.select("div.au-item")
    )

    if authors_in_page == 0:
        raise Exception(
            "Tidak ada data dosen ditemukan."
        )

    total_pages = math.ceil(
        total_authors / authors_in_page
    )

    print(f"Total Author : {total_authors}")
    print(f"Per Page     : {authors_in_page}")
    print(f"Total Page   : {total_pages}")

    return total_pages


def extract_author(item):

    name = ""
    profile_url = ""
    sinta_id = ""
    department = ""

    name_tag = item.select_one(
        ".profile-name a"
    )

    if name_tag:
        name = name_tag.get_text(
            strip=True
        )

        profile_url = name_tag.get(
            "href",
            ""
        )

        id_match = re.search(
            r"/authors/profile/(\d+)",
            profile_url
        )

        if id_match:
            sinta_id = id_match.group(1)

    dept_tag = item.select_one(
        ".profile-dept a"
    )

    if dept_tag:
        department = dept_tag.get_text(
            strip=True
        )

    hindex = item.select(
        ".profile-hindex"
    )

    scopus_hindex = ""
    gs_hindex = ""

    if len(hindex) >= 1:
        scopus_hindex = hindex[0].get_text(
            strip=True
        )

    if len(hindex) >= 2:
        gs_hindex = hindex[1].get_text(
            strip=True
        )

    stats = [
        s.get_text(strip=True)
        for s in item.select(".stat-num")
    ]

    sinta_score_3yr = stats[0] if len(stats) > 0 else ""
    sinta_score = stats[1] if len(stats) > 1 else ""
    affil_score_3yr = stats[2] if len(stats) > 2 else ""
    affil_score = stats[3] if len(stats) > 3 else ""

    return {
        "Nama": name,
        "SINTA ID": sinta_id,
        "Departemen": department,
        "Scopus H-Index": scopus_hindex,
        "Google Scholar H-Index": gs_hindex,
        "SINTA Score 3Yr": sinta_score_3yr,
        "SINTA Score": sinta_score,
        "Affiliation Score 3Yr": affil_score_3yr,
        "Affiliation Score": affil_score,
        "Profile URL": profile_url,
    }


def scrape_all_authors():

    total_pages = get_total_pages()

    results = []

    for page in range(
        1,
        total_pages + 1
    ):

        print(
            f"Scraping page {page}/{total_pages}"
        )

        try:
            soup = get_soup(page)

            authors = soup.select(
                "div.au-item"
            )

            for author in authors:
                results.append(
                    extract_author(author)
                )

            time.sleep(1)

        except Exception as e:
            print(
                f"Gagal page {page}: {e}"
            )

    return results


def main():

    data = scrape_all_authors()

    df = pd.DataFrame(data)

    filename = (
        "dosen_universitas_ngudi_waluyo.xlsx"
    )

    df.to_excel(
        filename,
        index=False,
        engine="openpyxl"
    )

    print(
        f"\nBerhasil menyimpan "
        f"{len(df)} dosen ke {filename}"
    )


if __name__ == "__main__":
    main()