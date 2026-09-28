# Aturan Proyek: Pemodelan Data & ERD (Berdasarkan Modul 4)

Saat melakukan perancangan basis data atau sistem untuk proyek ini, Anda WAJIB mematuhi aturan berikut:

1. **Berbasis Kebutuhan Informasi**: Selalu mulai identifikasi data dari *Information Requirement Matrix* (IRM). Jangan membuat entitas tanpa justifikasi kebutuhan informasi sistem.
2. **Aturan Entitas & Atribut**:
   - Entitas dinamai dengan kata benda (contoh: Kategori, Barang, Pengguna).
   - Hindari menjadikan "proses" (seperti mencetak struk) sebagai entitas.
   - Tetapkan **Primary Key (PK)** untuk membedakan data secara unik pada setiap entitas.
   - Gunakan **Foreign Key (FK)** untuk menghubungkan entitas.
3. **Aturan Relationship & Kardinalitas**:
   - Nama relasi harus menggunakan kata kerja (contoh: memiliki, melakukan, mencatat).
   - Definisikan kardinalitas dengan jelas: `1:1`, `1:N`, atau `M:N`.
   - **Kewajiban**: Hubungan *Many-to-Many* (M:N) **TIDAK BOLEH** dibiarkan. Anda wajib memecahnya dengan menambahkan entitas penghubung (associative entity) sehingga berubah menjadi dua hubungan `1:N`.
4. **Notasi ERD**: ERD wajib digambarkan menggunakan notasi **Crow's Foot**.
5. **Validasi Akhir**: Pastikan selalu melakukan pengujian mental: *"Apakah informasi pada kebutuhan awal dapat dihasilkan dari data yang ada pada ERD ini?"*
