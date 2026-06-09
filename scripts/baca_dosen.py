import pandas as pd
import json
import os

# Menggunakan absolute path dinamis berdasarkan letak script ini berada
file_path = os.path.join(os.path.dirname(__file__), 'output', 'dosen_universitas_ngudi_waluyo.xlsx')

try:
    if os.path.exists(file_path):
        df = pd.read_excel(file_path)
        df = df[['Nama', 'SINTA ID']].fillna("")
        df = df[df['SINTA ID'] != ""]
        data = df.to_dict(orient='records')
        print(json.dumps(data))
    else:
        print(json.dumps([]))
except Exception as e:
    print(json.dumps([{"error": str(e)}]))