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

-- PEGAWAI
INSERT INTO pegawai (nama, nik, tanggal_lahir, jenis_kelamin, alamat, telepon, email, jabatan_id, cabang_id, status, tanggal_masuk) VALUES
('Andi Wijaya', '1000000001', '1990-01-01', 'Laki-laki', 'Jl. Melati 1', '081234567801', 'andi1@suksesjaya.co.id', 1, 1, 'Aktif', '2020-01-01'),
('Budi Dharma', '1000000002', '1991-02-02', 'Laki-laki', 'Jl. Mawar 2', '081234567802', 'budi2@suksesjaya.co.id', 2, 2, 'Aktif', '2021-02-02'),
('Citra Dewi', '1000000003', '1992-03-03', 'Perempuan', 'Jl. Kenanga 3', '081234567803', 'citra3@suksesjaya.co.id', 3, 3, 'Aktif', '2022-03-03'),
('Deni Saputra', '1000000004', '1989-04-04', 'Laki-laki', 'Jl. Flamboyan 4', '081234567804', 'deni4@suksesjaya.co.id', 4, 4, 'Aktif', '2023-04-04'),
('Eka Lestari', '1000000005', '1993-05-05', 'Perempuan', 'Jl. Kamboja 5', '081234567805', 'eka5@suksesjaya.co.id', 5, 5, 'Aktif', '2021-05-05'),
('Fajar Ramadhan', '1000000006', '1994-06-06', 'Laki-laki', 'Jl. Dahlia 6', '081234567806', 'fajar6@suksesjaya.co.id', 6, 6, 'Aktif', '2020-06-06'),
('Gita Pertiwi', '1000000007', '1995-07-07', 'Perempuan', 'Jl. Anggrek 7', '081234567807', 'gita7@suksesjaya.co.id', 7, 7, 'Aktif', '2019-07-07'),
('Hadi Putra', '1000000008', '1996-08-08', 'Laki-laki', 'Jl. Cempaka 8', '081234567808', 'hadi8@suksesjaya.co.id', 8, 8, 'Aktif', '2022-08-08'),
('Indah Sari', '1000000009', '1997-09-09', 'Perempuan', 'Jl. Teratai 9', '081234567809', 'indah9@suksesjaya.co.id', 9, 9, 'Aktif', '2023-09-09'),
('Joko Santoso', '1000000010', '1988-10-10', 'Laki-laki', 'Jl. Sakura 10', '081234567810', 'joko10@suksesjaya.co.id', 10, 10, 'Aktif', '2018-10-10');

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