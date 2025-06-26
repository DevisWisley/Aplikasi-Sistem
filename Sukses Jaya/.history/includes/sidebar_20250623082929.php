<?php
$page     = basename($_SERVER['PHP_SELF']);
$username = $_SESSION['username'] ?? 'User';
$level    = $_SESSION['level'] ?? 'Guest';
?>

<aside class="bg-white border-end d-flex flex-column shadow-sm p-3" style="width: 240px; min-height: 100vh; position: fixed;">
  
  <!-- Profile -->
  <div class="text-center mb-4">
    <img src="/uploads/profile.png" alt="Avatar" class="rounded-circle shadow" width="80" height="80">
    <h6 class="fw-semibold mt-2 mb-0"><?= htmlspecialchars($username); ?></h6>
    <small class="text-muted"><?= htmlspecialchars($level); ?></small>
  </div>

  <hr>

  <!-- Navigation -->
  <ul class="nav flex-column mb-auto">
    <li class="nav-item">
      <a href="dashboard.php" class="nav-link <?= ($page === 'dashboard.php') ? 'active bg-primary text-white' : 'text-dark'; ?>">
        <i class="fas fa-home me-2"></i> Dashboard
      </a>
    </li>

    <?php if (isAdmin()): ?>
      <li><a href="pegawai.php" class="nav-link <?= ($page === 'pegawai.php') ? 'active bg-primary text-white' : 'text-dark'; ?>"><i class="fas fa-users me-2"></i> Data Pegawai</a></li>
      <li><a href="cabang.php" class="nav-link <?= ($page === 'cabang.php') ? 'active bg-primary text-white' : 'text-dark'; ?>"><i class="fas fa-building me-2"></i> Data Cabang</a></li>
      <li><a href="jabatan.php" class="nav-link <?= ($page === 'jabatan.php') ? 'active bg-primary text-white' : 'text-dark'; ?>"><i class="fas fa-briefcase me-2"></i> Data Jabatan</a></li>
      <li><a href="transaksi.php" class="nav-link <?= ($page === 'transaksi.php') ? 'active bg-primary text-white' : 'text-dark'; ?>"><i class="fas fa-file-alt me-2"></i> Transaksi</a></li>
      <li><a href="admin.php" class="nav-link <?= ($page === 'admin.php') ? 'active bg-primary text-white' : 'text-dark'; ?>"><i class="fas fa-user-shield me-2"></i> Data Admin</a></li>
    <?php endif; ?>

    <?php if (isPegawai()): ?>
      <li><a href="pegawai.php" class="nav-link <?= ($page === 'pegawai.php') ? 'active bg-primary text-white' : 'text-dark'; ?>"><i class="fas fa-user me-2"></i> Profil Saya</a></li>
      <li><a href="transaksi.php" class="nav-link <?= ($page === 'transaksi.php') ? 'active bg-primary text-white' : 'text-dark'; ?>"><i class="fas fa-clock me-2"></i> Log Aktivitas</a></li>
    <?php endif; ?>
  </ul>

  <hr class="mt-auto">

  <!-- Logout -->
  <div class="text-center">
    <a href="/auth/logout.php" class="btn btn-outline-danger w-100">
      <i class="fas fa-sign-out-alt me-2"></i> Logout
    </a>
  </div>
</aside>