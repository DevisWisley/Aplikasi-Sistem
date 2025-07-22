<?php
include 'db.php';
session_start();

// Ambil data dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// Query ke database tanpa hashing (tidak aman, hanya untuk pembelajaran)
$query = $conn->prepare("SELECT * FROM tbl_user WHERE username = ? AND password = ?");
$query->bind_param("ss", $username, $password);
$query->execute();
$result = $query->get_result();

// Cek hasil login
if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    $_SESSION['user'] = $user; // simpan user ke session
    header("Location: dashboard.php");
    exit;
} else {
    $_SESSION['error'] = "Username atau password salah!";
    header("Location: login.php");
    exit;
}
?>