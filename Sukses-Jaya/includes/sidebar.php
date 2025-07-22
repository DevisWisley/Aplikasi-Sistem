<?php $page = basename($_SERVER['PHP_SELF']); ?>
<style>
    .nav-link {
        color: #343a40;
        transition: background 0.3s, color 0.3s;
        border-radius: 5px;
        padding: 8px 12px;
    }

    .nav-link:hover {
        background-color: #0d6efd;
        color: white;
    }

    .nav-link:hover i {
        color: white;
    }

    .nav-link.active {
        background-color: #0d6efd;
        color: white !important;
        font-weight: 500;
    }

    .nav-link.active i {
        color: white !important;
    }
</style>
<div class="d-flex">
    <div class="bg-white border-end p-3 d-flex flex-column justify-content-between"
        style="width: 220px; min-height: 100vh;">
        <!-- Profil Info dengan Gambar -->
        <div class="mb-4 d-flex align-items-center px-1">
            <img src="/uploads/profile.png" alt="Profile" class="rounded-circle me-2 border" width="45" height="45">
            <div>
                <div class="fw-bold text-dark">
                    <?= $_SESSION['username']; ?>
                </div>
                <small class="text-muted">
                    <?= $_SESSION['level']; ?>
                </small>
            </div>
        </div>

        <!-- Menu Navigasi -->
        <ul class="nav flex-column mb-auto">
            <li class="nav-item">
                <a class="nav-link <?= activeSidebar('dashboard.php', $page); ?>" href="dashboard.php">
                    <i class="fas fa-home me-2"></i> Dashboard
                </a>
            </li>

            <?php if (isAdmin()): ?>
                <li class="nav-item">
                    <a class="nav-link
                <?= activeSidebar('pegawai.php', $page); ?>" href="pegawai.php">
                        <i class="fas fa-users me-2"></i> Data Pegawai
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= activeSidebar('cabang.php', $page); ?>" href="cabang.php">
                        <i class="fas fa-building me-2"></i> Data Cabang
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= activeSidebar('jabatan.php', $page); ?>" href="jabatan.php">
                        <i class="fas fa-briefcase me-2"></i> Data Jabatan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= activeSidebar('transaksi.php', $page); ?>" href="transaksi.php">
                        <i class="fas fa-file-alt me-2"></i> Transaksi Data
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= activeSidebar('admin.php', $page); ?>" href="admin.php">
                        <i class="fas fa-user-shield me-2"></i> Data Admin
                    </a>
                </li>
            <?php endif; ?>

            <?php if (isPegawai()): ?>
                <li class="nav-item">
                    <a class="nav-link <?= activeSidebar('pegawai.php', $page); ?>" href="pegawai.php">
                        <i class="fas fa-user me-2"></i> Profil Saya
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= activeSidebar('transaksi.php', $page); ?>" href=" transaksi.php">
                        <i class="fas fa-clock me-2"></i> Log Aktivitas
                    </a>
                </li>
            <?php endif; ?>
        </ul>

        <!-- Tombol Logout -->
        <div class="border-top pt-3">
            <a class="nav-link text-danger" href="/auth/logout.php">
                <i class="fas fa-sign-out-alt me-2"></i> Logout
            </a>
        </div>
    </div>