<?php
$host = "localhost";
$user = "root";           // atau username MySQL kamu
$password = "";           // atau password-nya
$database = "db_architect"; // nama database yang akan digunakan

$conn = new mysqli($host, $user, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}
?>