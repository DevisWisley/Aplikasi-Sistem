<?php
include 'db.php';
session_start();

// Ambil data dari form
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$level = $_POST['level'];

// Validasi dasar
if (!$username || !$email || !$password || !$confirm_password || !$level) {
    $_SESSION['error'] = "Harap lengkapi semua data!";
    header("Location: register.php");
    exit;
}

// Validasi kecocokan password
if ($password !== $confirm_password) {
    $_SESSION['error'] = "Password dan konfirmasi tidak cocok!";
    header("Location: register.php");
    exit;
}

// Cek apakah username sudah ada
$check = $conn->prepare("SELECT * FROM tbl_user WHERE username = ?");
$check->bind_param("s", $username);
$check->execute();
$res = $check->get_result();

if ($res->num_rows > 0) {
    $_SESSION['error'] = "Username sudah digunakan!";
    header("Location: register.php");
    exit;
}

// Password disimpan langsung (tanpa hash) ❌
$plain_password = $password;

// Upload foto jika ada
$foto = null;
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
    $folder = "uploads/";
    $file_ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $foto = uniqid("foto_") . '.' . strtolower($file_ext);
    $uploadPath = $folder . $foto;

    if (!is_dir($folder)) {
        mkdir($folder, 0755, true);
    }

    move_uploaded_file($_FILES['foto']['tmp_name'], $uploadPath);
}

// Simpan ke database
$stmt = $conn->prepare("INSERT INTO tbl_user (username, email, password, level, foto) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $username, $email, $plain_password, $level, $foto);

if ($stmt->execute()) {
    $_SESSION['success'] = "Registrasi berhasil! Silakan login.";
    header("Location: login.php");
    exit;
} else {
    $_SESSION['error'] = "Registrasi gagal. Silakan coba lagi.";
    header("Location: register.php");
    exit;
}
?>