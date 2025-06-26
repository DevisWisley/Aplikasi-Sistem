-- Database: suksesjaya
CREATE DATABASE IF NOT EXISTS suksesjaya;

USE suksesjaya;

-- ========================
-- 1. Tabel Data Cabang
-- ========================
CREATE TABLE cabang (
    cabang_id INT AUTO_INCREMENT PRIMARY KEY,
    nama_cabang VARCHAR(100) NOT NULL,
    alamat TEXT NOT NULL,
    kota VARCHAR(50) NOT NULL,
    telepon VARCHAR(20),
    keterangan TEXT,
    email VARCHAR(100)
);

-- CABANG
INSERT INTO cabang (nama_cabang, alamat, kota, telepon, keterangan, email) VALUES
('Cabang Medan', 'Jl. Gatot Subroto No. 1', 'Medan', '0611234567', 'Pusat', 'medan@suksesjaya.co.id'),
('Cabang Jakarta', 'Jl. Sudirman No. 2', 'Jakarta', '0217654321', 'Cabang Besar', 'jakarta@suksesjaya.co.id'),
('Cabang Bandung', 'Jl. Braga No. 3', 'Bandung', '022888888', 'Wilayah Barat', 'bandung@suksesjaya.co.id'),
('Cabang Surabaya', 'Jl. Darmo No. 4', 'Surabaya', '031999999', 'Wilayah Timur', 'surabaya@suksesjaya.co.id'),
('Cabang Bali', 'Jl. Raya Kuta No. 5', 'Denpasar', '0361456789', 'Pariwisata', 'bali@suksesjaya.co.id'),
('Cabang Yogyakarta', 'Jl. Malioboro No. 6', 'Yogyakarta', '0274123456', 'Pendidikan', 'yogya@suksesjaya.co.id'),
('Cabang Makassar', 'Jl. Pettarani No. 7', 'Makassar', '041111111', 'Sulawesi', 'makassar@suksesjaya.co.id'),
('Cabang Palembang', 'Jl. Sudirman No. 8', 'Palembang', '071112345', 'Sumatera Selatan', 'palembang@suksesjaya.co.id'),
('Cabang Balikpapan', 'Jl. Ahmad Yani No. 9', 'Balikpapan', '054212345', 'Kalimantan', 'balikpapan@suksesjaya.co.id'),
('Cabang Batam', 'Jl. Engku Putri No. 10', 'Batam', '077812345', 'Perdagangan', 'batam@suksesjaya.co.id');

-- ========================
-- 2. Tabel Data Jabatan
-- ========================
CREATE TABLE jabatan (
    jabatan_id INT AUTO_INCREMENT PRIMARY KEY,
    nama_jabatan VARCHAR(100) NOT NULL,
    gaji_pokok DECIMAL(15,2) NOT NULL
);

-- JABATAN
INSERT INTO jabatan (nama_jabatan, gaji_pokok) VALUES
('Manager', 15000000),
('Supervisor', 12000000),
('Staff', 9000000),
('Marketing', 8500000),
('HRD', 10000000),
('Keuangan', 9500000),
('IT Support', 9200000),
('Programmer', 11000000),
('Designer', 8800000),
('Security', 6000000);

-- ========================
-- 3. Tabel Data Admin
-- ========================
CREATE TABLE admin (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    level ENUM('Admin', 'Pegawai') NOT NULL,
    cabang_id INT,
    FOREIGN KEY (cabang_id) REFERENCES cabang(cabang_id) ON DELETE SET NULL
);

-- ADMIN
INSERT INTO admin (username, password, level, cabang_id) VALUES
('admin', 'admin123', 'Admin', 1),
('admin1', 'admin123', 'Admin', 2),
('admin2', 'admin123', 'Admin', 3),
('admin3', 'admin123', 'Admin', 4),
('admin4', 'admin123', 'Admin', 5),
('pegawai', 'pegawai123', 'Pegawai', 6),
('pegawai1', 'pegawai123', 'Pegawai', 7),
('pegawai2', 'pegawai123', 'Pegawai', 8),
('pegawai3', 'pegawai123', 'Pegawai', 9),
('pegawai4', 'pegawai123', 'Pegawai', 10);

-- ========================
-- 4. Tabel Data Pegawai
-- ========================
CREATE TABLE pegawai (
    pegawai_id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    nik VARCHAR(20) UNIQUE NOT NULL,
    tanggal_lahir DATE NOT NULL,
    jenis_kelamin ENUM('Laki-laki', 'Perempuan') NOT NULL,
    alamat TEXT NOT NULL,
    telepon VARCHAR(20),
    email VARCHAR(100) UNIQUE NOT NULL,
    jabatan_id INT,
    cabang_id INT,
    status ENUM('Aktif', 'Nonaktif') NOT NULL DEFAULT 'Aktif',
    tanggal_masuk DATE NOT NULL,
    FOREIGN KEY (jabatan_id) REFERENCES jabatan(jabatan_id) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (cabang_id) REFERENCES cabang(cabang_id) ON DELETE SET NULL ON UPDATE CASCADE
);

-- PEGAWAI
INSERT INTO pegawai (nama, nik, tanggal_lahir, jenis_kelamin, alamat, telepon, email, jabatan_id, cabang_id, status, tanggal_masuk) VALUES
('Andi Saputra', '3214567890', '1991-01-10', 'Laki-laki', 'Medan', '0812345001', 'andi@example.com', 1, 1, 'Aktif', '2020-05-01'),
('Siti Aminah', '3214567891', '1993-02-12', 'Perempuan', 'Jakarta', '0812345002', 'siti@example.com', 2, 2, 'Aktif', '2021-06-01'),
('Bambang Sugiarto', '3214567892', '1988-03-14', 'Laki-laki', 'Bandung', '0812345003', 'bambang@example.com', 3, 3, 'Nonaktif', '2019-01-01'),
('Dewi Lestari', '3214567893', '1990-04-20', 'Perempuan', 'Surabaya', '0812345004', 'dewi@example.com', 4, 4, 'Aktif', '2022-08-10'),
('Agus Prasetyo', '3214567894', '1992-05-22', 'Laki-laki', 'Makassar', '0812345005', 'agus@example.com', 5, 5, 'Aktif', '2023-01-01'),
('Melati Sari', '3214567895', '1994-06-30', 'Perempuan', 'Bali', '0812345006', 'melati@example.com', 6, 6, 'Nonaktif', '2018-03-15'),
('Yudi Santoso', '3214567896', '1989-07-25', 'Laki-laki', 'Palembang', '0812345007', 'yudi@example.com', 7, 7, 'Aktif', '2020-09-09'),
('Putri Wulandari', '3214567897', '1995-08-18', 'Perempuan', 'Yogyakarta', '0812345008', 'putri@example.com', 8, 8, 'Aktif', '2021-11-11'),
('Dani Prabowo', '3214567898', '1991-09-12', 'Laki-laki', 'Padang', '0812345009', 'dani@example.com', 9, 9, 'Aktif', '2022-04-04'),
('Rina Ayu', '3214567899', '1993-10-17', 'Perempuan', 'Aceh', '0812345010', 'rina@example.com', 10, 10, 'Aktif', '2020-02-02');

-- ========================
-- 5. Tabel Transaksi Data
-- ========================
CREATE TABLE transaksi_data (
    transaksi_id INT AUTO_INCREMENT PRIMARY KEY,
    pegawai_id INT NOT NULL,
    cabang_id INT NOT NULL,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    oleh_admin INT,
    FOREIGN KEY (pegawai_id) REFERENCES pegawai(pegawai_id) ON DELETE CASCADE,
    FOREIGN KEY (cabang_id) REFERENCES cabang(cabang_id) ON DELETE CASCADE,
    FOREIGN KEY (oleh_admin) REFERENCES admin(admin_id) ON DELETE SET NULL
);

-- TRANSAKSI DATA
INSERT INTO transaksi_data (pegawai_id, cabang_id, timestamp, oleh_admin) VALUES
(1, 1, '2024-06-01 10:00:00', 1),
(2, 2, '2024-06-02 11:00:00', 2),
(3, 3, '2024-06-03 12:00:00', 3),
(4, 4, '2024-06-04 13:00:00', 4),
(5, 5, '2024-06-05 14:00:00', 5),
(6, 6, '2024-06-06 15:00:00', 1),
(7, 7, '2024-06-07 16:00:00', 2),
(8, 8, '2024-06-08 17:00:00', 3),
(9, 9, '2024-06-09 18:00:00', 4),
(10, 10, '2024-06-10 19:00:00', 5);