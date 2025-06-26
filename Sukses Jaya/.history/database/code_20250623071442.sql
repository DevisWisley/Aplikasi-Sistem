-- Database: suksesjaya
CREATE DATABASE IF NOT EXISTS suksesjaya;

USE suksesjaya;

-- ========================
-- 1. Tabel Data Admin
-- ========================

CREATE TABLE IF NOT EXISTS admin (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,            -- ID unik untuk tiap admin/pegawai
    username VARCHAR(50) NOT NULL UNIQUE,               -- Username wajib dan unik
    password VARCHAR(255) NOT NULL,                     -- Password (plaintext atau hash)
    level ENUM('Admin', 'Pegawai') NOT NULL,            -- Hak akses sistem
    cabang_id INT NOT NULL,                             -- Relasi ke cabang
    -- Relasi ke tabel cabang
    FOREIGN KEY (cabang_id) REFERENCES cabang(cabang_id)
        ON DELETE CASCADE                               -- Jika cabang dihapus, admin ikut dihapus
        ON UPDATE CASCADE                               -- Jika ID cabang diubah, ikut berubah
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
    FOREIGN KEY (jabatan_id) REFERENCES jabatan(jabatan_id)
        ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (cabang_id) REFERENCES cabang(cabang_id)
        ON DELETE SET NULL ON UPDATE CASCADE
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
    FOREIGN KEY (pegawai_id) REFERENCES pegawai(pegawai_id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (cabang_id) REFERENCES cabang(cabang_id)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (oleh_admin) REFERENCES admin(admin_id)
        ON DELETE CASCADE ON UPDATE CASCADE
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
INSERT INTO pegawai (nama, nik, tanggal_lahir, jenis_kelamin, alamat, telepon, email, jabatan_id, cabang_id, status, tanggal_masuk) VALUES
('Andi Saputra', '123456789001', '1990-01-15', 'Laki-laki', 'Jl. Merdeka No. 10', '081234567001', 'andi@suksesjaya.com', 1, 1, 'Aktif', '2020-05-01'),
('Budi Santoso', '123456789002', '1992-03-20', 'Laki-laki', 'Jl. Diponegoro No. 12', '081234567002', 'budi@suksesjaya.com', 2, 2, 'Aktif', '2019-07-10'),
('Citra Dewi', '123456789003', '1993-07-22', 'Perempuan', 'Jl. Kartini No. 8', '081234567003', 'citra@suksesjaya.com', 1, 1, 'Aktif', '2021-01-15'),
('Dodi Prasetyo', '123456789004', '1989-10-30', 'Laki-laki', 'Jl. Imam Bonjol No. 14', '081234567004', 'dodi@suksesjaya.com', 3, 3, 'Aktif', '2018-11-20'),
('Eka Putri', '123456789005', '1995-12-11', 'Perempuan', 'Jl. Sisingamangaraja No. 5', '081234567005', 'eka@suksesjaya.com', 2, 2, 'Aktif', '2022-03-18');

-- ADMIN
INSERT INTO admin (username, password, level, cabang_id) VALUES
('admin', 'admin123', 'Admin', 1),
('pegawai', 'pegawai123', 'Pegawai', 2);

-- TRANSAKSI DATA
INSERT INTO transaksi_data (pegawai_id, cabang_id, timestamp, oleh_admin) VALUES
(1, 1, '2023-05-01 09:00:00', 1),
(2, 2, '2023-06-15 10:30:00', 1),
(3, 1, '2023-07-20 08:45:00', 1),
(4, 3, '2023-08-10 11:00:00', 1),
(5, 2, '2023-09-01 13:15:00', 1);