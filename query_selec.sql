SELECT p.nama_pelanggan, pa.nama_paket
FROM pelanggans p
JOIN langganans l ON p.id = l.pelanggan_id
JOIN pakets pa ON l.paket_id = pa.id;


SELECT p.nama_pelanggan, pb.jumlah_pembayaran, pb.tanggal_pembayaran
FROM pelanggans p
JOIN langganans l ON p.id = l.pelanggan_id
JOIN pembayarans pb ON l.id = pb.langganan_id
WHERE p.id = 7;
