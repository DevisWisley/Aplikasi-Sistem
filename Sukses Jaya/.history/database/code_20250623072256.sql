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
('Cabang Medan', 'Jl. Gatot Subroto No. 1', 'Medan', '0611234567', 'Cabang Utama', 'medan@suksesjaya.co.id'),
('Cabang Jakarta', 'Jl. Sudirman No. 2', 'Jakarta', '0217654321', 'Cabang Pusat', 'jakarta@suksesjaya.co.id');

-- ========================
-- 2. Tabel Data Jabatan
-- ========================
CREATE TABLE jabatan (
  jabatan_id INT AUTO_INCREMENT PRIMARY KEY,
  nama_jabatan VARCHAR(100) NOT NULL,
  gaji_pokok DECIMAL(15,2) NOT NULL
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
    tanggal_lahir DATE NOT NULL,
    jenis_kelamin ENUM('Laki-laki', 'Perempuan') NOT NULL,
    alamat TEXT,
    telepon VARCHAR(20),
    email VARCHAR(100),
    jabatan_id INT,
    cabang_id INT,
    status ENUM('Aktif', 'Tidak Aktif') DEFAULT 'Aktif',
    tanggal_masuk DATE NOT NULL,
    FOREIGN KEY (jabatan_id) REFERENCES jabatan(jabatan_id) ON DELETE SET NULL,
    FOREIGN KEY (cabang_id) REFERENCES cabang(cabang_id) ON DELETE SET NULL
);

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

-- CABANG
INSERT INTO cabang (nama_cabang, alamat, kota, telepon, keterangan, email) VALUES
('Cabang Medan', 'Jl. Gatot Subroto No. 1', 'Medan', '0611234567', 'Cabang utama', 'medan@suksesjaya.co.id'),
('Cabang Jakarta', 'Jl. Sudirman No. 2', 'Jakarta', '0217654321', 'Cabang pusat', 'jakarta@suksesjaya.co.id');

-- JABATAN
INSERT INTO jabatan (nama_jabatan, gaji_pokok) VALUES
('Manager', 15000000),
('Supervisor', 10000000),
('Staff', 7000000),
('Marketing', 8000000);

-- PEGAWAI
INSERT INTO pegawai (nama, nik, tanggal_lahir, jenis_kelamin, alamat, telepon, email, jabatan_id, cabang_id, status, tanggal_masuk) VALUES
('Andi Pratama', '1234567890', '1990-05-15', 'Laki-laki', 'Jl. Melati No.1', '081234567891', 'andi@suksesjaya.co.id', 1, 1, 'Aktif', '2020-01-10'),
('Budi Santoso', '1234567891', '1988-08-20', 'Laki-laki', 'Jl. Mawar No.2', '081234567892', 'budi@suksesjaya.co.id', 2, 1, 'Aktif', '2019-03-20'),
('Citra Ayu', '1234567892', '1992-09-10', 'Perempuan', 'Jl. Anggrek No.3', '081234567893', 'citra@suksesjaya.co.id', 3, 2, 'Aktif', '2021-05-01'),
('Dedi Gunawan', '1234567893', '1987-07-12', 'Laki-laki', 'Jl. Flamboyan No.4', '081234567894', 'dedi@suksesjaya.co.id', 4, 1, 'Aktif', '2018-11-11'),
('Eka Lestari', '1234567894', '1993-12-01', 'Perempuan', 'Jl. Kemuning No.5', '081234567895', 'eka@suksesjaya.co.id', 3, 1, 'Aktif', '2020-06-15'),
('Fajar Nugroho', '1234567895', '1991-03-25', 'Laki-laki', 'Jl. Kamboja No.6', '081234567896', 'fajar@suksesjaya.co.id', 2, 2, 'Aktif', '2022-02-10'),
('Gita Putri', '1234567896', '1994-11-17', 'Perempuan', 'Jl. Seruni No.7', '081234567897', 'gita@suksesjaya.co.id', 1, 2, 'Aktif', '2021-09-30'),
('Hadi Saputra', '1234567897', '1989-06-05', 'Laki-laki', 'Jl. Dahlia No.8', '081234567898', 'hadi@suksesjaya.co.id', 4, 1, 'Aktif', '2017-08-20'),
('Indah Permata', '1234567898', '1995-01-22', 'Perempuan', 'Jl. Sakura No.9', '081234567899', 'indah@suksesjaya.co.id', 3, 2, 'Aktif', '2023-01-05'),
('Joko Wirawan', '1234567899', '1990-04-14', 'Laki-laki', 'Jl. Kenanga No.10', '081234567800', 'joko@suksesjaya.co.id', 2, 2, 'Aktif', '2022-04-01');

-- ADMIN
INSERT INTO admin (username, password, level, cabang_id) VALUES
('admin', 'admin123', 'Admin', 1),
('pegawai', 'pegawai123', 'Pegawai', 2);

-- TRANSAKSI DATA
INSERT INTO transaksi_data (pegawai_id, cabang_id, timestamp, oleh_admin) VALUES
(1, 1, '2024-06-01 10:00:00', 1),
(2, 1, '2024-06-02 11:30:00', 1),
(3, 2, '2024-06-03 08:45:00', 1),
(4, 1, '2024-06-04 09:20:00', 1),
(5, 1, '2024-06-05 14:10:00', 1);