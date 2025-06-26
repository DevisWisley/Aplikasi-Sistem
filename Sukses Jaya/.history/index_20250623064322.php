<?php
session_start();

if (isset($_SESSION['user_id'])) {
    // Jika sudah login, arahkan ke dashboard
    header("Location: pages/dashboard.php");
    exit;
} else {
    // Jika belum login, arahkan ke login
    header("Location: auth/login.php");
    exit;
}
?>