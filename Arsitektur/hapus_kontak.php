<?php
include 'config.php';
include 'db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $conn->query("DELETE FROM tbl_pesanan WHERE id=$id");
}

header("Location: kontak.php");
exit;