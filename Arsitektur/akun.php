<?php
include 'config.php';
include 'db.php';

$user = $_SESSION['user'] ?? null;
if (!$user) {
    header("Location: login.php");
    exit;
}

$username = $user['username'];
$data = $conn->query("SELECT * FROM tbl_user WHERE username='$username'")->fetch_assoc();

$fotoPath = '';
$fotoAda = true;
if (!empty($data['foto']) && file_exists("uploads/{$data['foto']}")) {
    $fotoPath = "uploads/{$data['foto']}";
} elseif (!empty($data['foto']) && file_exists("uploads/profile/{$data['foto']}")) {
    $fotoPath = "uploads/profile/{$data['foto']}";
} else {
    $fotoAda = false;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Data Akun</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        body {
            background-color: #f1f5f9;
            font-family: 'Segoe UI', sans-serif;
        }

        .sidebar {
            background: linear-gradient(to bottom, #1e3a8a, #2563eb);
            color: white;
        }

        .sidebar .nav-link {
            color: white !important;
            font-weight: 500;
        }

        .sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.15);
            border-radius: 6px;
            padding-left: 12px;
        }

        .sidebar .nav-link.active {
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 6px;
            padding-left: 12px;
        }

        .header-title {
            font-size: 1.75rem;
            font-weight: 700;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar p-4 shadow-lg w-64 min-h-screen">
            <div class="bg-white/20 rounded-lg p-3 mb-4 flex items-center gap-3">
                <?php if ($fotoAda): ?>
                    <img src="<?= $fotoPath ?>" class="rounded-circle border border-white" width="60" height="60"
                        alt="Foto Profil">
                <?php else: ?>
                    <div class="text-white text-sm">
                        <em>Tidak ada</em>
                    </div>
                <?php endif; ?>
                <div class="text-white">
                    <div class="fw-bold text-sm"><?= $_SESSION['user']['username'] ?? 'Guest' ?></div>
                    <div class="text-xs opacity-75"><?= $_SESSION['user']['level'] ?? '-' ?></div>
                </div>
            </div>
            <ul class="nav flex-column space-y-2">
                <li class="nav-item mb-2">
                    <a href="dashboard.php"
                        class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : '' ?>">
                        <i class="fas fa-chart-line me-2"></i> Dashboard
                    </a>
                </li>
                <hr class="border-white/100 my-2">
                <li class="nav-item mb-2">
                    <a href="akun.php"
                        class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'akun.php' ? 'active' : '' ?>">
                        <i class="fas fa-users me-2"></i> Data Akun
                    </a>
                </li>
                <hr class="border-white/100 my-2">
                <li class="nav-item mb-2">
                    <a href="kontak.php"
                        class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'kontak.php' ? 'active' : '' ?>">
                        <i class="fas fa-envelope me-2"></i> Data Kontak
                    </a>
                </li>
                <hr class="border-white/100 my-2">
                <li class="nav-item mt-4">
                    <a href="logout.php" class="btn btn-light text-dark w-100">
                        <i class="fas fa-sign-out-alt me-1"></i> Logout
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-5" data-aos="fade-up">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="header-title text-gray-800 mb-0">Data Akun</h2>
            </div>

            <!-- Formulir Akun Dibagi Dua Kolom -->
            <form action="edit_akun_process.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $data['id'] ?>">

                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" id="username" class="form-control" required
                                value="<?= htmlspecialchars($data['username']) ?>">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required
                                value="<?= htmlspecialchars($data['email']) ?>">
                        </div>

                        <div class="mb-3">
                            <label for="old_password" class="form-label">Password Lama</label>
                            <input type="password" name="old_password" id="old_password" class="form-control"
                                placeholder="Masukkan password lama">
                        </div>

                        <div class="mb-3">
                            <label for="new_password" class="form-label">Password Baru</label>
                            <input type="password" name="new_password" id="new_password" class="form-control"
                                placeholder="Biarkan kosong jika tidak diganti">
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control"
                                placeholder="Ulangi password baru">
                        </div>

                        <div class="mb-3">
                            <label for="level" class="form-label">Level</label>
                            <?php if ($user['level'] === 'admin'): ?>
                                <select name="level" id="level" class="form-select">
                                    <option value="admin" <?= $data['level'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                                    <option value="pengunjung" <?= $data['level'] === 'pengunjung' ? 'selected' : '' ?>>
                                        Pengunjung</option>
                                </select>
                            <?php else: ?>
                                <input type="text" class="form-control" readonly value="<?= ucfirst($data['level']) ?>">
                                <input type="hidden" name="level" value="<?= $data['level'] ?>">
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto Profil</label>
                            <input type="file" name="foto" class="form-control mb-2">
                            <?php if ($fotoAda): ?>
                                <img src="<?= $fotoPath ?>" alt="Foto" width="100" class="rounded mb-2 border">
                            <?php else: ?>
                                <p><em>Tidak ada foto</em></p>
                            <?php endif; ?>
                            <p class="text-muted small">Path: <code><?= $fotoPath ?></code></p>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Simpan Perubahan
                </button>
                <a href="dashboard.php" class="btn btn-secondary ms-2">Kembali</a>
            </form>
        </div>
    </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init();

        <?php if (!empty($_SESSION['success'])): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '<?= $_SESSION['success'] ?>',
                timer: 3000,
                showConfirmButton: false
            });
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
    </script>
</body>

</html>