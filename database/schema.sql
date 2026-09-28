-- Skema Database: Daily Pet Care
-- Mengimplementasikan relasi ERD ke dalam bentuk tabel (Modul 5)

CREATE TABLE IF NOT EXISTS Customer (
    id_customer INTEGER PRIMARY KEY AUTOINCREMENT,
    nama TEXT NOT NULL,
    kontak TEXT NOT NULL,
    alamat TEXT
);

CREATE TABLE IF NOT EXISTS Pet (
    id_pet INTEGER PRIMARY KEY AUTOINCREMENT,
    id_customer INTEGER NOT NULL,
    nama_hewan TEXT NOT NULL,
    spesies TEXT NOT NULL,
    FOREIGN KEY (id_customer) REFERENCES Customer(id_customer)
);

CREATE TABLE IF NOT EXISTS Service (
    id_service INTEGER PRIMARY KEY AUTOINCREMENT,
    nama_layanan TEXT NOT NULL,
    harga DECIMAL(10, 2) NOT NULL
);

CREATE TABLE IF NOT EXISTS Staff (
    id_staff INTEGER PRIMARY KEY AUTOINCREMENT,
    nama_staff TEXT NOT NULL,
    peran TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS "Transaction" (
    id_transaksi INTEGER PRIMARY KEY AUTOINCREMENT,
    id_customer INTEGER NOT NULL,
    id_pet INTEGER NOT NULL,
    id_staff INTEGER NOT NULL,
    tanggal DATE NOT NULL,
    total_harga DECIMAL(10, 2) DEFAULT 0,
    FOREIGN KEY (id_customer) REFERENCES Customer(id_customer),
    FOREIGN KEY (id_pet) REFERENCES Pet(id_pet),
    FOREIGN KEY (id_staff) REFERENCES Staff(id_staff)
);

-- Associative Entity untuk mengatasi relasi M:N antara Transaction dan Service
CREATE TABLE IF NOT EXISTS Transaction_Detail (
    id_detail INTEGER PRIMARY KEY AUTOINCREMENT,
    id_transaksi INTEGER NOT NULL,
    id_service INTEGER NOT NULL,
    jumlah INTEGER NOT NULL DEFAULT 1,
    subtotal DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (id_transaksi) REFERENCES "Transaction"(id_transaksi),
    FOREIGN KEY (id_service) REFERENCES Service(id_service)
);

-- --- Data Dummy Awal ---
INSERT INTO Service (nama_layanan, harga) VALUES ('Basic Grooming', 75000);
INSERT INTO Service (nama_layanan, harga) VALUES ('Full Grooming', 150000);
INSERT INTO Service (nama_layanan, harga) VALUES ('Daycare (Per Hari)', 50000);
INSERT INTO Staff (nama_staff, peran) VALUES ('Budi', 'Groomer');
INSERT INTO Staff (nama_staff, peran) VALUES ('Siti', 'Admin/Kasir');
