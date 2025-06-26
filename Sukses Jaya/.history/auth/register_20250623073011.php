<?php
require_once '../includes/config.php';
$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username   = trim($_POST['username']);
    $password   = trim($_POST['password']);
    $level      = $_POST['level'];
    $cabang_id  = $_POST['cabang_id'];

    // Validasi sederhana
    if ($username == '' || $password == '' || $level == '' || $cabang_id == '') {
        $error = "Semua field wajib diisi!";
    } else {
        try {
            // Cek apakah username sudah ada
            $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
            $stmt->execute([$username]);
            if ($stmt->rowCount() > 0) {
                $error = "Username sudah terdaftar!";
            } else {
                // Simpan (plaintext password - hanya untuk testing, gunakan hash di produksi!)
                $stmt = $conn->prepare("INSERT INTO admin (username, password, level, cabang_id) VALUES (?, ?, ?, ?)");
                $stmt->execute([$username, $password, $level, $cabang_id]);
                $success = "Registrasi berhasil! Silakan login.";
            }
        } catch (PDOException $e) {
            $error = "Terjadi kesalahan: " . $e->getMessage();
        }
    }
}

// Ambil data cabang
$cabangs = $conn->query("SELECT * FROM cabang")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Registrasi | Sistem Pegawai</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #007bff, #00c6ff);
      font-family: 'Poppins', sans-serif;
    }
    .card {
      border: none;
      border-radius: 15px;
    }
    .form-control:focus {
      border-color: #007bff;
      box-shadow: 0 0 0 0.25rem rgba(0,123,255,.25);
    }
    .btn-primary {
      background-color: #007bff;
      border: none;
    }
    .btn-primary:hover {
      background-color: #0056b3;
    }
    .logo {
      font-size: 2rem;
      font-weight: bold;
      color: #007bff;
    }
  </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center vh-100">
  <div class="col-md-6">
    <div class="card shadow-lg p-4 bg-white">
      <div class="text-center mb-4">
        <div class="logo"><i class="fas fa-building"></i> Sukses Jaya</div>
        <p class="text-muted">Form Registrasi Pengguna</p>
      </div>

      <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error; ?></div>
      <?php elseif ($success): ?>
        <div class="alert alert-success"><?= $success; ?> <a href="login.php">Login sekarang</a>.</div>
      <?php endif; ?>

      <form method="post">
        <div class="mb-3">
          <label class="form-label">Username</label>
          <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Level</label>
          <select name="level" class="form-select" required>
            <option value="">-- Pilih Peran --</option>
            <option value="Admin">Admin</option>
            <option value="Pegawai">Pegawai</option>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">Cabang</label>
          <select name="cabang_id" class="form-select" required>
            <option value="">-- Pilih Cabang --</option>
            <?php foreach ($cabangs as $cabang): ?>
              <option value="<?= $cabang['cabang_id']; ?>"><?= $cabang['nama_cabang']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="d-grid mb-2">
          <button type="submit" class="btn btn-primary"><i class="fas fa-user-plus me-2"></i>Daftar</button>
        </div>
      </form>

      <div class="text-center mt-3">
        <small>Sudah punya akun? <a href="login.php">Login di sini</a></small>
      </div>
    </div>
    <p class="text-center text-white mt-3 small">&copy; 2025 PT. Sukses Jaya Medan</p>
  </div>
</div>

</body>
</html>
