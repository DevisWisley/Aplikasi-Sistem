<?php
session_start();
include '../includes/config.php';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $level = $_POST['level'];
    $cabang_id = $_POST['cabang_id'];

    $stmt = $conn->prepare("INSERT INTO admin (username, password, level, cabang_id) VALUES (?, ?, ?, ?)");
    $stmt->execute([$username, $password, $level, $cabang_id]);

    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Register - Sukses Jaya</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center" style="height: 100vh;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5">
        <h4 class="text-center mb-3">Registrasi Akun</h4>
        <form method="POST">
          <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Cabang</label>
            <select name="cabang_id" class="form-control" required>
              <?php
              include '../includes/config.php';
              $stmt = $conn->query("SELECT * FROM cabang");
              while ($row = $stmt->fetch()) {
                  echo "<option value='{$row['cabang_id']}'>{$row['nama_cabang']}</option>";
              }
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label>Level</label>
            <select name="level" class="form-control" required>
              <option value="Admin">Admin</option>
              <option value="Pegawai">Pegawai</option>
            </select>
          </div>
          <button class="btn btn-success w-100" type="submit" name="register">Register</button>
          <a href="login.php" class="d-block mt-3 text-center">Sudah punya akun?</a>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
