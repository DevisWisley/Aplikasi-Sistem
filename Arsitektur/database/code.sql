-- Buat database
CREATE DATABASE IF NOT EXISTS db_architect;

-- Gunakan database
USE db_architect;

-- Tabel user
CREATE TABLE IF NOT EXISTS tbl_user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    level ENUM('admin', 'pengunjung') NOT NULL DEFAULT 'pengunjung',
    foto VARCHAR(255) DEFAULT NULL
);

INSERT INTO tbl_user (username, email, password, level, foto) VALUES
('devis', 'devis@gmail.com', 'devis123', 'admin', 'devis.png'),
('risbelina', 'risbelina@gmail.com', 'risbelina123', 'pengunjung', 'risbelina.png'),
('kharena', 'kharena@gmail.com', 'kharena123', 'pengunjung', 'kharena.png'),
('dwi', 'dwi@gmail.com', 'dwi123', 'pengunjung', 'dwi.png'),
('ray', 'ray@gmail.com', 'ray123', 'pengunjung', 'ray.png');

-- Tabel pesanan
CREATE TABLE IF NOT EXISTS tbl_pesanan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    subjek VARCHAR(150) NOT NULL,
    gambar VARCHAR(255) NOT NULL,
    pesan TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS tbl_transaksi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_pelanggan VARCHAR(100) NOT NULL,
    produk VARCHAR(150) NOT NULL,
    tanggal DATE NOT NULL,
    total INT(11) NOT NULL
);