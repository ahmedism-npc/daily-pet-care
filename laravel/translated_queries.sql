SELECT DISTINCT nama AS nama_pemilik, kontak AS no_telp, alamat 
FROM customers 
ORDER BY nama ASC;

SELECT id AS id_hewan, nama_hewan, spesies AS jenis_dan_ras
FROM pets 
WHERE spesies LIKE '%Anjing%' 
ORDER BY id DESC;

SELECT nama_layanan, harga AS tarif 
FROM services 
WHERE harga >= 50000 
ORDER BY harga DESC;

SELECT h.id AS id_hewan, h.nama_hewan, h.spesies, p.nama AS nama_pemilik, p.kontak AS no_telp
FROM pets AS h
INNER JOIN customers AS p ON h.customer_id = p.id;

SELECT p.nama AS nama_pemilik, p.kontak AS no_telp, h.nama_hewan, h.spesies
FROM customers AS p
LEFT JOIN pets AS h ON p.id = h.customer_id;

SELECT COUNT(*) AS total_hewan_terdaftar 
FROM pets;

SELECT SUM(total_harga) AS total_pendapatan_kotor 
FROM transactions;

SELECT AVG(total_harga) AS rata_rata_transaksi 
FROM transactions;

SELECT MAX(total_harga) AS transaksi_tertinggi, MIN(total_harga) AS transaksi_terendah 
FROM transactions;

SELECT service_id AS id_layanan, SUM(jumlah) AS total_kali_dipesan
FROM transaction_details
GROUP BY service_id
HAVING SUM(jumlah) > 2;

SELECT id AS id_transaksi, total_harga AS total_bayar
FROM transactions
WHERE total_harga > (SELECT AVG(total_harga) FROM transactions)
ORDER BY total_harga DESC;

SELECT id AS id_pemilik, nama AS nama_pemilik, kontak AS no_telp
FROM customers
WHERE id IN (
    SELECT customer_id 
    FROM transactions
);
