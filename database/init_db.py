import sqlite3
import os

def init_db():
    db_path = os.path.join(os.path.dirname(__file__), 'daily_pet_care.db')
    schema_path = os.path.join(os.path.dirname(__file__), 'schema.sql')

    with open(schema_path, 'r') as f:
        schema_sql = f.read()

    # Membuka koneksi dan mengeksekusi skema
    conn = sqlite3.connect(db_path)
    cursor = conn.cursor()
    cursor.executescript(schema_sql)
    
    conn.commit()
    conn.close()
    
    print(f"✅ Database SQLite berhasil diinisialisasi di:\n{db_path}")

if __name__ == '__main__':
    init_db()
