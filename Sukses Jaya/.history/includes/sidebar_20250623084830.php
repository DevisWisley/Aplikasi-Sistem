<?php $page = basename($_SERVER['PHP_SELF']); ?>
<div class="d-flex">
    <div class="bg-white border-end p-3" style="width: 220px; min-height: 100vh;">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?= activeSidebar('dashboard.php', $page); ?>" href="dashboard.php">
                    <i class="fas fa-home me-2"></i> Dashboard
                </a>
            </li>

            <?php if (isAdmin()): ?>
                <li class="nav-item">
                    <a class="nav-link <?= activeSidebar('pegawai.php', $page); ?>" href="pegawai.php">
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
                <li class="nav-item">
                    <a class="nav-link <?= activeSidebar('/auth/logout.php', $page); ?>" href="/auth/logout.php">
                        <i class="fas fa-sign-out-alt me-2"></i> Logout
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
                    <a class="nav-link <?= activeSidebar('transaksi.php', $page); ?>" href="transaksi.php">
                        <i class="fas fa-clock me-2"></i> Log Aktivitas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= activeSidebar('/auth/logout.php', $page); ?>" href="/auth/logout.php">
                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </div>