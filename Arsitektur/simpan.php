<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nama = $_POST['nama'];
  $email = $_POST['email'];
  $subjek = $_POST['subjek'];
  $pesan = $_POST['pesan'];

  // Proses upload gambar
  $gambarName = null;

  if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === 0) {
    $folderTujuan = "uploads/";
    if (!is_dir($folderTujuan)) {
      mkdir($folderTujuan, 0777, true);
    }

    $namaFile = basename($_FILES["gambar"]["name"]);
    $ext = pathinfo($namaFile, PATHINFO_EXTENSION);
    $gambarName = time() . "-" . uniqid() . "." . $ext;
    $targetPath = $folderTujuan . $gambarName;

    move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetPath);
  }

  $sql = "INSERT INTO tbl_pesanan (nama, email, subjek, pesan, gambar) VALUES (?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sssss", $nama, $email, $subjek, $pesan, $gambarName);

  if ($stmt->execute()) {
    echo "<script>alert('Pesan berhasil dikirim!'); window.location.href='index.php#kontak';</script>";
  } else {
    echo "<script>alert('Gagal menyimpan data!'); window.history.back();</script>";
  }

  $stmt->close();
  $conn->close();
}
?>