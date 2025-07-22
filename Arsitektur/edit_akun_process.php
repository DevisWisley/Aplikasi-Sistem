<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $level = $_POST['level'];
    $passwordLamaInput = $_POST['password_lama'] ?? '';
    $passwordBaru = $_POST['password_baru'] ?? '';
    $konfirmasiPassword = $_POST['konfirmasi_password'] ?? '';

    // Ambil data user lama
    $result = $conn->query("SELECT * FROM tbl_user WHERE id = '$id'");
    $data = $result->fetch_assoc();

    // Validasi password jika ingin diubah
    if (!empty($passwordBaru)) {
        if ($passwordLamaInput !== $data['password']) {
            $_SESSION['success'] = 'Password lama salah!';
            header("Location: dashboard.php");
            exit;
        }

        if ($passwordBaru !== $konfirmasiPassword) {
            $_SESSION['success'] = 'Konfirmasi password tidak cocok!';
            header("Location: dashboard.php");
            exit;
        }

        $password = $passwordBaru; // tanpa hash
    } else {
        $password = $data['password']; // Tetap gunakan password lama
    }

    // Proses upload foto jika ada
    $foto = $data['foto'];
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
        $namaFile = $_FILES['foto']['name'];
        $tmpName = $_FILES['foto']['tmp_name'];
        $folder = "uploads/profile/";

        // Buat folder jika belum ada
        if (!file_exists($folder)) {
            mkdir($folder, 0755, true);
        }

        $targetFile = $folder . basename($namaFile);
        if (move_uploaded_file($tmpName, $targetFile)) {
            $foto = $namaFile;
        }
    }

    // Update ke database
    $stmt = $conn->prepare("UPDATE tbl_user SET username=?, email=?, password=?, level=?, foto=? WHERE id=?");
    $stmt->bind_param("sssssi", $username, $email, $password, $level, $foto, $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Akun berhasil diperbarui!";
    } else {
        $_SESSION['success'] = "Gagal memperbarui akun!";
    }

    header("Location: dashboard.php");
    exit;
}
?>