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
    <title>Data Kontak</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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
        <div class="container overflow-x-hidden overflow-y-auto p-5" data-aos="fade-up">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="header-title text-gray-800 mb-0">Data Kontak</h2>
                <a href="kontak.php" class="btn btn-outline-primary me-2">
                    <i class="fas fa-sync-alt me-1"></i> Reload
                </a>
            </div>

            <!-- Table -->
            <div class="bg-white p-4 shadow-sm rounded">
                <table class="table table-bordered table-hover" id="kontakTable">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Subjek</th>
                            <th>Pesan</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $q = $conn->query("SELECT * FROM tbl_pesanan");
                        while ($r = $q->fetch_assoc()): ?>
                            <tr>
                                <td><?= $r['id'] ?></td>
                                <td><?= $r['nama'] ?></td>
                                <td><?= $r['email'] ?></td>
                                <td><?= $r['subjek'] ?></td>
                                <td><?= $r['pesan'] ?></td>
                                <td>
                                    <?php if (!empty($r['gambar'])): ?>
                                        <img src="uploads/<?= htmlspecialchars($r['gambar']) ?>" alt="Gambar" class="rounded border" width="100">
                                    <?php else: ?>
                                        <span class="text-muted">Tidak ada</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($_SESSION['user']['level'] === 'admin'): ?>
                                        <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?= $r['id'] ?>)">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    <?php endif; ?>
                                    <button class="btn btn-info btn-sm"
                                        onclick="showDetail('<?= htmlspecialchars(addslashes($r['nama'])) ?>', '<?= htmlspecialchars(addslashes($r['email'])) ?>', '<?= htmlspecialchars(addslashes($r['subjek'])) ?>', '<?= htmlspecialchars(addslashes($r['pesan'])) ?>')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- CDN Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init();

        $(document).ready(function () {
            $('#kontakTable').DataTable({
                responsive: true,
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ entri",
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                    paginate: {
                        previous: "Sebelumnya",
                        next: "Berikutnya"
                    }
                }
            });
        });

        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin hapus data ini?',
                text: "Data tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `hapus_kontak.php?id=${id}`;
                }
            });
        }

        function showDetail(nama, email, subjek, pesan) {
            Swal.fire({
                title: `<strong>${nama}</strong>`,
                html: `
                    <p><i class="fas fa-envelope text-primary"></i> <strong>Email:</strong> ${email}</p>
                    <p><i class="fas fa-tag text-success"></i> <strong>Subjek:</strong> ${subjek}</p>
                    <p><i class="fas fa-comment text-secondary"></i> <strong>Pesan:</strong><br>${pesan}</p>
                `,
                icon: 'info'
            });
        }
    </script>
</body>

</html>