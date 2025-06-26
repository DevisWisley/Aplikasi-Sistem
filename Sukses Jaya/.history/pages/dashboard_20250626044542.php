<?php
include '../includes/config.php';
include '../includes/functions.php';
checkLogin();
include '../includes/header.php';
include '../includes/topbar.php';
include '../includes/sidebar.php';

// Hitung total data
$jumlah_pegawai = $conn->query("SELECT COUNT(*) FROM pegawai")->fetchColumn();
$jumlah_cabang = $conn->query("SELECT COUNT(*) FROM cabang")->fetchColumn();
$jumlah_jabatan = $conn->query("SELECT COUNT(*) FROM jabatan")->fetchColumn();
$jumlah_transaksi = $conn->query("SELECT COUNT(*) FROM transaksi_data")->fetchColumn();
$jumlah_admin = $conn->query("SELECT COUNT(*) FROM admin")->fetchColumn();
?>

<!-- Main Content -->
<div class="p-4 w-100">
  <h3>Dashboard</h3>
  <p>Selamat datang, <strong><?= $_SESSION['username']; ?></strong> (<?= $_SESSION['level']; ?>)</p>

  <?php if ($_SESSION['level'] === 'Admin'): ?>
    <!-- Statistik Admin -->
    <div class="row mt-4">
      <?php
      $cards = [
        ['Jumlah Pegawai', $jumlah_pegawai, 'fa-users', 'primary'],
        ['Jumlah Cabang', $jumlah_cabang, 'fa-building', 'success'],
        ['Jumlah Jabatan', $jumlah_jabatan, 'fa-briefcase', 'warning'],
        ['Jumlah Transaksi Data', $jumlah_transaksi, 'fa-database', 'info'],
        ['Jumlah Admin', $jumlah_admin, 'fa-user-shield', 'danger']
      ];
      foreach ($cards as [$title, $value, $icon, $color]):
        ?>
        <div class="col-md-3 mb-4">
          <div class="card border-<?= $color ?> shadow-sm h-100">
            <div class="card-body text-center">
              <i class="fas <?= $icon ?> fa-2x text-<?= $color ?> mb-2"></i>
              <h6 class="text-muted"><?= $title ?></h6>
              <p class="fs-4 fw-bold"><?= $value ?></p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Chart Section -->
    <div class="mt-5">
      <h4 class="mb-3">Visualisasi Data</h4>
      <div class="row g-4">
        <?php
        $chartList = [
          ['areaChart', 'Area Chart', 'primary'],
          ['barChart', 'Bar Chart', 'success'],
          ['bubbleChart', 'Bubble Chart', 'warning text-dark'],
          ['pieChart', 'Pie Chart', 'danger'],
          ['lineChart', 'Line Chart', 'info'],
          ['mixedChart', 'Mixed Chart', 'secondary'],
          ['polarChart', 'Polar Area Chart', 'dark'],
          ['radarChart', 'Radar Chart', 'light text-dark'],
          ['scatterChart', 'Scatter Chart', 'primary']
        ];
        foreach ($chartList as [$id, $title, $color]):
          ?>
          <div class="col-md-6">
            <div class="card shadow-sm">
              <div class="card-header bg-<?= $color ?>"><?= $title ?></div>
              <div class="card-body"><canvas id="<?= $id ?>"></canvas></div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

  <?php elseif ($_SESSION['level'] === 'Pegawai'): ?>
    <!-- Statistik Pegawai -->
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
            <p class="fs-6">Terakhir login:
              <?= date('d-m-Y H:i:s', strtotime($_SESSION['last_login'] ?? date('Y-m-d H:i:s'))) ?></p>
          </div>
        </div>
      </div>
    </div>
  <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>
<script>
  const chartLabels = ["Jan", "Feb", "Mar", "Apr", "May", "Jun"];
  const chartData = [82, 23, 22, 79, 69, 26];

  new Chart(areaChart, {
    type: 'line',
    data: { labels: chartLabels, datasets: [{ data: chartData, label: 'Kinerja', fill: true, backgroundColor: 'rgba(13,110,253,0.2)', borderColor: '#0d6efd' }] }
  });

  new Chart(barChart, {
    type: 'bar',
    data: { labels: chartLabels, datasets: [{ label: 'Transaksi', data: chartData, backgroundColor: 'rgba(25,135,84,0.7)' }] }
  });

  new Chart(bubbleChart, {
    type: 'bubble',
    data: {
      datasets: [{
        label: 'Bubble Data',
        data: chartData.map((val, i) => ({ x: i, y: val, r: Math.random() * 10 + 5 })),
        backgroundColor: 'rgba(255,193,7,0.6)'
      }]
    }
  });

  new Chart(pieChart, {
    type: 'pie',
    data: {
      labels: chartLabels,
      datasets: [{
        data: chartData,
        backgroundColor: ['#dc3545', '#0d6efd', '#198754', '#ffc107', '#20c997', '#6f42c1']
      }]
    }
  });

  new Chart(lineChart, {
    type: 'line',
    data: { labels: chartLabels, datasets: [{ label: 'Line Data', data: chartData, borderColor: '#17a2b8' }] }
  });

  new Chart(mixedChart, {
    data: {
      labels: chartLabels,
      datasets: [
        { type: 'bar', label: 'Bar', data: chartData, backgroundColor: '#6f42c1' },
        { type: 'line', label: 'Line', data: chartData.map(x => x * 0.8), borderColor: '#fd7e14' }
      ]
    }
  });

  new Chart(polarChart, {
    type: 'polarArea',
    data: {
      labels: chartLabels,
      datasets: [{ data: chartData, backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745', '#6610f2', '#20c997'] }]
    }
  });

  new Chart(radarChart, {
    type: 'radar',
    data: {
      labels: chartLabels,
      datasets: [{
        label: 'Radar',
        data: chartData,
        fill: true,
        backgroundColor: 'rgba(108,117,125,0.2)',
        borderColor: '#6c757d'
      }]
    }
  });

  new Chart(scatterChart, {
    type: 'scatter',
    data: {
      datasets: [{
        label: 'Scatter Pegawai',
        data: chartData.map((y, i) => ({ x: i, y })),
        backgroundColor: '#0dcaf0'
      }]
    }
  });
</script>