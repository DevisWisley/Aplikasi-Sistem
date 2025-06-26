<?php
include '../includes/config.php';
include '../includes/functions.php';
checkLogin();
include '../includes/header.php';
include '../includes/topbar.php';
include '../includes/sidebar.php';

// Ambil data count (pastikan nama tabel sesuai)
$jumlah_pegawai   = $conn->query("SELECT COUNT(*) FROM pegawai")->fetchColumn();
$jumlah_cabang    = $conn->query("SELECT COUNT(*) FROM cabang")->fetchColumn();
$jumlah_jabatan   = $conn->query("SELECT COUNT(*) FROM jabatan")->fetchColumn();
$jumlah_transaksi = $conn->query("SELECT COUNT(*) FROM transaksi_data")->fetchColumn(); // fix nama tabel
$jumlah_admin     = $conn->query("SELECT COUNT(*) FROM admin")->fetchColumn();
?>

<div class="p-4 w-100">
  <h3>Dashboard</h3>
  <p>Selamat datang, <strong><?= $_SESSION['username']; ?></strong> (<?= $_SESSION['level']; ?>)</p>

  <?php if ($_SESSION['level'] === 'Admin'): ?>
  <div class="row mt-4">
    <div class="col-md-3 mb-4">
      <div class="card border-primary shadow-sm h-100">
        <div class="card-body text-center">
          <i class="fas fa-users fa-2x text-primary mb-2"></i>
          <h6 class="text-muted">Jumlah Pegawai</h6>
          <p class="fs-4 fw-bold"><?= $jumlah_pegawai; ?></p>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-4">
      <div class="card border-success shadow-sm h-100">
        <div class="card-body text-center">
          <i class="fas fa-building fa-2x text-success mb-2"></i>
          <h6 class="text-muted">Jumlah Cabang</h6>
          <p class="fs-4 fw-bold"><?= $jumlah_cabang; ?></p>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-4">
      <div class="card border-warning shadow-sm h-100">
        <div class="card-body text-center">
          <i class="fas fa-briefcase fa-2x text-warning mb-2"></i>
          <h6 class="text-muted">Jumlah Jabatan</h6>
          <p class="fs-4 fw-bold"><?= $jumlah_jabatan; ?></p>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-4">
      <div class="card border-info shadow-sm h-100">
        <div class="card-body text-center">
          <i class="fas fa-database fa-2x text-info mb-2"></i>
          <h6 class="text-muted">Jumlah Transaksi Data</h6>
          <p class="fs-4 fw-bold"><?= $jumlah_transaksi; ?></p>
        </div>
      </div>
    </div>
    <div class="col-md-3 mb-4">
      <div class="card border-danger shadow-sm h-100">
        <div class="card-body text-center">
          <i class="fas fa-user-shield fa-2x text-danger mb-2"></i>
          <h6 class="text-muted">Jumlah Admin</h6>
          <p class="fs-4 fw-bold"><?= $jumlah_admin; ?></p>
        </div>
      </div>
    </div>
  </div>

  <?php elseif ($_SESSION['level'] === 'Pegawai'): ?>
  <div class="row mt-4">
    <div class="col-md-6 mb-4">
      <div class="card border-primary shadow-sm h-100">
        <div class="card-body text-center">
          <i class="fas fa-id-card fa-2x text-primary mb-2"></i>
          <h6 class="text-muted">Profil Saya</h6>
          <p class="fs-5 fw-semibold"><?= $_SESSION['username']; ?></p>
        </div>
      </div>
    </div>
    <div class="col-md-6 mb-4">
      <div class="card border-secondary shadow-sm h-100">
        <div class="card-body text-center">
          <i class="fas fa-clock fa-2x text-secondary mb-2"></i>
          <h6 class="text-muted">Log Aktivitas</h6>
          <p class="fs-6">Terakhir login: <?= date('d-m-Y H:i:s', strtotime($_SESSION['last_login'] ?? date('Y-m-d H:i:s'))) ?></p>
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>