-- Tabel Pelanggan
CREATE TABLE Pelanggan (
  ID_Pelanggan INT PRIMARY KEY,
  Nama_Pelanggan VARCHAR(255),
  Alamat_Pelanggan VARCHAR(255),
  Nomor_Telepon VARCHAR(20)
);

-- Tabel Paket
CREATE TABLE Paket (
  ID_Paket INT PRIMARY KEY,
  Nama_Paket VARCHAR(255),
  Kecepatan_Internet VARCHAR(50),
  Kuota VARCHAR(50),
  Durasi INT
);

-- Tabel Langganan
CREATE TABLE Langganan (
  ID_Langganan INT PRIMARY KEY,
  ID_Pelanggan INT,
  ID_Paket INT,
  Tanggal_Mulai DATE,
  Tanggal_Berakhir DATE,
  Status_Langganan VARCHAR(20),
  FOREIGN KEY (ID_Pelanggan) REFERENCES Pelanggan(ID_Pelanggan),
  FOREIGN KEY (ID_Paket) REFERENCES Paket(ID_Paket)
);

-- Tabel Pembayaran
CREATE TABLE Pembayaran (
  ID_Pembayaran INT PRIMARY KEY,
  ID_Langganan INT,
  Tanggal_Pembayaran DATE,
  Jumlah_Pembayaran DECIMAL(10, 2),
  FOREIGN KEY (ID_Langganan) REFERENCES Langganan(ID_Langganan)
);
