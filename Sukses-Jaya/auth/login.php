<?php
session_start();
require_once '../includes/config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    try {
        $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $password === $user['password']) {
            $_SESSION['user_id'] = $user['admin_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['level'] = $user['level'];
            $_SESSION['cabang_id'] = $user['cabang_id'];
            header('Location: ../pages/dashboard.php');
            exit;
        } else {
            $error = "Username atau Password salah!";
        }
    } catch (PDOException $e) {
        $error = "Terjadi kesalahan koneksi database!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login | Sistem Pegawai</title>
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
            box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, .25);
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
        <div class="col-md-5">
            <div class="card shadow-lg p-4 bg-white">
                <div class="text-center mb-4">
                    <div class="logo"><i class="fas fa-building"></i> Sukses Jaya</div>
                    <p class="text-muted">Login Sistem Pegawai</p>
                </div>

                <?php if ($error): ?>
                    <div class="alert alert-danger"><?= $error; ?></div>
                <?php endif; ?>

                <form method="post" autocomplete="off">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Masukkan username" required
                            autofocus>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan password"
                            required>
                    </div>
                    <div class="d-grid mb-2">
                        <button type="submit" class="btn btn-primary"><i
                                class="fas fa-sign-in-alt me-2"></i>Masuk</button>
                    </div>
                </form>

                <div class="text-center mt-3">
                    <small>Belum punya akun? <a href="register.php">Daftar di sini</a></small>
                </div>
            </div>
            <p class="text-center text-white mt-3 small">&copy; 2025 PT. Sukses Jaya Medan</p>
        </div>
    </div>

</body>

</html>