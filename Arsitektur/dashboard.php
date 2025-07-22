<?php
include 'config.php';
include 'db.php';

$foto = $_SESSION['user']['foto'] ?? null;
$fotoPath = '';
$fotoAda = true;

if ($foto && file_exists('uploads/' . $foto)) {
    $fotoPath = 'uploads/' . $foto;
} elseif ($foto && file_exists('uploads/profile/' . $foto)) {
    $fotoPath = 'uploads/profile/' . $foto;
} else {
    $fotoAda = false; // tidak ada gambar valid
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- AOS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">

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
            transition: all 0.2s ease-in-out;
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
            font-weight: 600;
        }

        .header-title {
            font-size: 1.75rem;
            font-weight: 700;
        }

        .card-stats {
            transition: transform 0.2s ease;
        }

        .card-stats:hover {
            transform: translateY(-4px);
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
                <div>
                    <h2 class="header-title text-gray-800 mb-1">
                        <i class="fas fa-chart-line me-2"></i> Dashboard
                    </h2>
                    <p class="text-muted mb-0">Ringkasan informasi pengguna</p>
                </div>
                <div class="dropdown">
                    <button class="btn btn-outline-dark dropdown-toggle d-flex align-items-center" type="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle me-2 fs-5"></i>
                        <?= $_SESSION['user']['username'] ?? 'Guest' ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="akun.php"><i class="fas fa-users me-2"></i>Data Akun</a></li>
                        <li><a class="dropdown-item" href="kontak.php"><i class="fas fa-envelope me-2"></i>Data
                                Kontak</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item text-danger" href="logout.php"><i
                                    class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                    </ul>
                </div>
            </div>

            <!-- Statistik Cards -->
            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <div class="bg-white shadow-sm rounded p-4 d-flex align-items-center card-stats">
                        <div class="flex-shrink-0 me-3 text-primary fs-3">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 text-gray-700">Total Admin</h6>
                            <span class="badge bg-primary fs-6">
                                <?= $conn->query("SELECT * FROM tbl_user WHERE level='admin'")->num_rows ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="bg-white shadow-sm rounded p-4 d-flex align-items-center card-stats">
                        <div class="flex-shrink-0 me-3 text-success fs-3">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 text-gray-700">Total Pengunjung</h6>
                            <span class="badge bg-success fs-6">
                                <?= $conn->query("SELECT * FROM tbl_user WHERE level='pengunjung'")->num_rows ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grafik Pengguna -->
            <div class="bg-white rounded shadow p-4">
                <h6 class="mb-3 text-gray-600"><i class="fas fa-chart-bar me-2"></i> Grafik Pengguna</h6>
                <canvas id="userChart" height="120"></canvas>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>AOS.init();</script>

    <!-- Chart.js Script -->
    <script>
        const ctx = document.getElementById('userChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Admin', 'Pengunjung'],
                datasets: [{
                    label: 'Jumlah Pengguna',
                    data: [
                        <?= $conn->query("SELECT * FROM tbl_user WHERE level='admin'")->num_rows ?>,
                        <?= $conn->query("SELECT * FROM tbl_user WHERE level='pengunjung'")->num_rows ?>
                    ],
                    backgroundColor: ['#0d6efd', '#198754'],
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    </script>
</body>

</html>