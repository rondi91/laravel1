INSERT INTO pelanggans (nama_pelanggan, alamat) 
VALUES
    ('John', 'Jakarta'),
    ('Lisa', 'Surabaya'),
    ('David', 'Bandung'),
    ('Sarah', 'Semarang'),
    ('Michael', 'Medan'),
    ('Emma', 'Yogyakarta'),
    ('Daniel', 'Malang'),
    ('Olivia', 'Denpasar'),
    ('William', 'Palembang'),
    ('Sophia', 'Makassar');
INSERT INTO pakets (nama_paket, deskripsi) 
VALUES
    ('Internet', 'Paket internet cepat'),
    ('Telepon', 'Paket panggilan'),
    ('TV Kabel', 'Paket saluran TV'),
    ('Listrik', 'Paket listrik bulanan'),
    ('Air Bersih', 'Paket air bersih'),
    ('Keamanan', 'Paket keamanan rumah'),
    ('Perawatan Taman', 'Paket perawatan taman'),
    ('Cuci Kendaraan', 'Paket cuci kendaraan'),
    ('Keanggotaan Gym', 'Paket keanggotaan gym'),
    ('Pengiriman Makanan', 'Paket pengiriman makanan');
INSERT INTO langganans (pelanggan_id, paket_id)
SELECT 
    (SELECT id FROM pelanggans ORDER BY RAND() LIMIT 1),
    (SELECT id FROM pakets ORDER BY RAND() LIMIT 1)
FROM
    information_schema.tables
LIMIT 10;
INSERT INTO pembayarans (langganan_id, jumlah_pembayaran, tanggal_pembayaran)
SELECT
    langganans.id,
    FLOOR(RAND() * 100000) + 50000,
    DATE_SUB(NOW(), INTERVAL FLOOR(RAND() * 90) DAY)
FROM
    langganans
LIMIT 10;
