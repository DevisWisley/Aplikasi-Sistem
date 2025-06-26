-- Database: suksesjaya
CREATE DATABASE IF NOT EXISTS suksesjaya;

USE suksesjaya;

-- ========================
-- 1. Tabel Data Admin
-- ========================
CREATE TABLE admin (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    level ENUM('Admin', 'Pegawai') NOT NULL,
    cabang_id INT NOT NULL,
    FOREIGN KEY (cabang_id) REFERENCES cabang(cabang_id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- ========================
-- 2. Tabel Data Cabang
-- ========================
CREATE TABLE cabang (
    cabang_id INT AUTO_INCREMENT PRIMARY KEY,
    nama_cabang VARCHAR(100) NOT NULL,
    alamat TEXT,
    kota VARCHAR(50),
    telepon VARCHAR(20),
    keterangan TEXT,
    email VARCHAR(100)
);

-- ========================
-- 3. Tabel Data Jabatan
-- ========================
CREATE TABLE jabatan (
    jabatan_id INT AUTO_INCREMENT PRIMARY KEY,
    nama_jabatan VARCHAR(100) NOT NULL,
    gaji_pokok DECIMAL(15,2) NOT NULL
);

-- ========================
-- 4. Tabel Data Pegawai
-- ========================
CREATE TABLE pegawai (
    pegawai_id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    nik VARCHAR(20) NOT NULL UNIQUE,
    tanggal_lahir DATE,
    jenis_kelamin ENUM('Laki-laki', 'Perempuan'),
    alamat TEXT,
    telepon VARCHAR(20),
    email VARCHAR(100),
    jabatan_id INT,
    cabang_id INT,
    status ENUM('Aktif', 'Tidak Aktif') DEFAULT 'Aktif',
    tanggal_masuk DATE,
    FOREIGN KEY (jabatan_id) REFERENCES jabatan(jabatan_id) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (cabang_id) REFERENCES cabang(cabang_id) ON DELETE SET NULL ON UPDATE CASCADE
);

-- ========================
-- 5. Tabel Transaksi Data
-- ========================
CREATE TABLE transaksi_data (
    transaksi_id INT AUTO_INCREMENT PRIMARY KEY,
    pegawai_id INT NOT NULL,
    cabang_id INT NOT NULL,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    oleh_admin INT NOT NULL,
    FOREIGN KEY (pegawai_id) REFERENCES pegawai(pegawai_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (cabang_id) REFERENCES cabang(cabang_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (oleh_admin) REFERENCES admin(admin_id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- CABANG
INSERT INTO cabang (nama_cabang, alamat, kota, telepon, keterangan, email) VALUES
('Cabang Medan', 'Jl. Gatot Subroto No. 1', 'Medan', '061-111111', 'Kantor Pusat', 'medan@suksesjaya.com'),
('Cabang Jakarta', 'Jl. Sudirman No. 99', 'Jakarta', '021-222222', 'Kantor Operasional', 'jakarta@suksesjaya.com'),
('Cabang Surabaya', 'Jl. Basuki Rahmat No. 88', 'Surabaya', '031-333333', 'Kantor Regional', 'surabaya@suksesjaya.com');

-- JABATAN
INSERT INTO jabatan (nama_jabatan, gaji_pokok) VALUES
('Staff', 5000000),
('Supervisor', 7500000),
('Manager', 10000000);

-- PEGAWAI
INSERT INTO admin (username, password, cabang_id, level) VALUES
('adminmedan', 'admin123', 1, 'admin'),
('adminjakarta', 'admin123', 2, 'admin'),
('adminbandung', 'admin123', 3, 'admin'),
('adminsurabaya', 'admin123', 4, 'admin'),
('adminbali', 'admin123', 5, 'admin'),
('adminmakassar', 'admin123', 6, 'admin'),
('adminpalembang', 'admin123', 7, 'admin'),
('adminpekanbaru', 'admin123', 8, 'admin'),
('adminaceh', 'admin123', 9, 'admin'),
('adminyogya', 'admin123', 10, 'admin');

-- USER
-- Admin (role admin)
INSERT INTO users (nama, username, password, role) VALUES
('Admin Medan', 'adminmedan', 'admin123', 'admin'),
('Admin Jakarta', 'adminjakarta', 'admin123', 'admin'),
('Admin Bandung', 'adminbandung', 'admin123', 'admin'),
('Admin Surabaya', 'adminsurabaya', 'admin123', 'admin'),
('Admin Bali', 'adminbali', 'admin123', 'admin'),
('Admin Makassar', 'adminmakassar', 'admin123', 'admin'),
('Admin Palembang', 'adminpalembang', 'admin123', 'admin'),
('Admin Pekanbaru', 'adminpekanbaru', 'admin123', 'admin'),
('Admin Aceh', 'adminaceh', 'admin123', 'admin'),
('Admin Yogya', 'adminyogya', 'admin123', 'admin');

-- Pegawai (role pegawai)
INSERT INTO users (nama, username, password, role) VALUES
('Dewi Rahmawati', 'dewi.pegawai', 'pegawai123', 'pegawai'),
('Agus Santoso', 'agus.pegawai', 'pegawai123', 'pegawai'),
('Lisa Marlina', 'lisa.pegawai', 'pegawai123', 'pegawai'),
('Rio Firmansyah', 'rio.pegawai', 'pegawai123', 'pegawai'),
('Mira Nursanti', 'mira.pegawai', 'pegawai123', 'pegawai'),
('Taufik Hidayat', 'taufik.pegawai', 'pegawai123', 'pegawai'),
('Yuni Lestari', 'yuni.pegawai', 'pegawai123', 'pegawai'),
('Fikri Ramadhan', 'fikri.pegawai', 'pegawai123', 'pegawai'),
('Sinta Amelia', 'sinta.pegawai', 'pegawai123', 'pegawai'),
('Bayu Saputra', 'bayu.pegawai', 'pegawai123', 'pegawai');

-- PEGAWAI
INSERT INTO pegawai (nama, nik, tanggal_lahir, jenis_kelamin, alamat, telepon, email, jabatan_id, cabang_id, status, tanggal_masuk) VALUES
('Dewi Rahmawati', '123456789001', '1990-05-12', 'Perempuan', 'Jl. Setia Budi', '081234567891', 'dewi@suksesjaya.com', 1, 1, 'Aktif', '2021-01-10'),
('Agus Santoso', '123456789002', '1988-03-10', 'Laki-laki', 'Jl. Cemara', '081234567892', 'agus@suksesjaya.com', 2, 2, 'Aktif', '2020-06-15'),
('Lisa Marlina', '123456789003', '1992-08-19', 'Perempuan', 'Jl. Jamin Ginting', '081234567893', 'lisa@suksesjaya.com', 3, 3, 'Aktif', '2022-11-01'),
('Rio Firmansyah', '123456789004', '1991-01-25', 'Laki-laki', 'Jl. Halat', '081234567894', 'rio@suksesjaya.com', 4, 4, 'Aktif', '2021-03-22'),
('Mira Nursanti', '123456789005', '1993-07-07', 'Perempuan', 'Jl. Krakatau', '081234567895', 'mira@suksesjaya.com', 5, 5, 'Aktif', '2019-09-09'),
('Taufik Hidayat', '123456789006', '1989-02-14', 'Laki-laki', 'Jl. Iskandar Muda', '081234567896', 'taufik@suksesjaya.com', 6, 6, 'Aktif', '2021-12-01'),
('Yuni Lestari', '123456789007', '1990-10-30', 'Perempuan', 'Jl. Asia Mega Mas', '081234567897', 'yuni@suksesjaya.com', 7, 7, 'Aktif', '2020-07-20'),
('Fikri Ramadhan', '123456789008', '1995-04-17', 'Laki-laki', 'Jl. Multatuli', '081234567898', 'fikri@suksesjaya.com', 8, 8, 'Aktif', '2022-02-05'),
('Sinta Amelia', '123456789009', '1996-06-11', 'Perempuan', 'Jl. Thamrin', '081234567899', 'sinta@suksesjaya.com', 9, 9, 'Aktif', '2023-01-18'),
('Bayu Saputra', '123456789010', '1987-12-05', 'Laki-laki', 'Jl. Pelajar', '081234567800', 'bayu@suksesjaya.com', 10, 10, 'Aktif', '2021-05-25');

-- TRANSAKSI DATA
INSERT INTO transaksi_data (pegawai_id, cabang_id, timestamp, oleh_admin) VALUES
(1, 1, NOW(), 1),
(2, 2, NOW(), 2),
(3, 3, NOW(), 3),
(4, 4, NOW(), 4),
(5, 5, NOW(), 5),
(6, 6, NOW(), 6),
(7, 7, NOW(), 7),
(8, 8, NOW(), 8),
(9, 9, NOW(), 9),
(10, 10, NOW(), 10);