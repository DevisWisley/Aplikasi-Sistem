<?php
include '../includes/config.php';
include '../includes/functions.php';
checkLogin();

include '../includes/header.php';
include '../includes/topbar.php';
include '../includes/sidebar.php';

// Hitung jumlah entitas
$jumlah_pegawai   = $conn->query("SELECT COUNT(*) FROM pegawai")->fetchColumn();
$jumlah_cabang    = $conn->query("SELECT COUNT(*) FROM cabang")->fetchColumn();
$jumlah_jabatan   = $conn->query("SELECT COUNT(*) FROM jabatan")->fetchColumn();
$jumlah_transaksi = $conn->query("SELECT COUNT(*) FROM transaksi_data")->fetchColumn();
$jumlah_admin     = $conn->query("SELECT COUNT(*) FROM admin")->fetchColumn();
?>

<style>
  .dashboard-card {
    transition: all 0.3s ease-in-out;
    cursor: pointer;
  }
  .dashboard-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
  }
  .dashboard-title {
    font-weight: 600;
    color: #333;
  }
  .card-header {
    font-weight: 500;
  }
</style>

<div class="p-4 w-100">
  <h3 class="dashboard-title mb-2" data-aos="fade-down">Dashboard</h3>
  <p class="text-muted mb-4">Selamat datang, <strong><?= $_SESSION['username']; ?></strong> (<?= $_SESSION['level']; ?>)</p>

  <?php if ($_SESSION['level'] === 'Admin'): ?>
  <!-- Statistik Admin -->
  <div class="row g-4 mb-5">
    <?php
    $cards = [
      ['Jumlah Pegawai', $jumlah_pegawai, 'fa-users', 'primary'],
      ['Jumlah Cabang', $jumlah_cabang, 'fa-building', 'success'],
      ['Jumlah Jabatan', $jumlah_jabatan, 'fa-briefcase', 'warning'],
      ['Jumlah Transaksi', $jumlah_transaksi, 'fa-database', 'info'],
      ['Jumlah Admin', $jumlah_admin, 'fa-user-shield', 'danger']
    ];
    foreach ($cards as [$title, $value, $icon, $color]):
    ?>
    <div class="col-md-4 col-lg-3" data-aos="zoom-in">
      <div class="card border-0 shadow-sm dashboard-card text-center">
        <div class="card-body py-4">
          <i class="fas <?= $icon ?> fa-2x text-<?= $color ?> mb-3"></i>
          <h6 class="text-muted"><?= $title ?></h6>
          <h4 class="fw-bold"><?= $value ?></h4>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>

  <!-- Chart Section -->
  <div class="mt-5">
    <h4 class="mb-4 text-secondary" data-aos="fade-up">Visualisasi Data</h4>
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
      <div class="col-md-6" data-aos="fade-up">
        <div class="card shadow-sm dashboard-card">
          <div class="card-header bg-<?= $color ?> text-white"><?= $title ?></div>
          <div class="card-body"><canvas id="<?= $id ?>"></canvas></div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>

  <?php elseif ($_SESSION['level'] === 'Pegawai'): ?>
  <!-- Statistik Pegawai -->
  <div class="row g-4">
    <div class="col-md-6" data-aos="fade-right">
      <div class="card dashboard-card border-primary shadow-sm h-100 text-center">
        <div class="card-body">
          <i class="fas fa-id-card fa-2x text-primary mb-2"></i>
          <h6 class="text-muted">Profil Saya</h6>
          <p class="fs-5 fw-semibold"><?= $_SESSION['username']; ?></p>
        </div>
      </div>
    </div>
    <div class="col-md-6" data-aos="fade-left">
      <div class="card dashboard-card border-secondary shadow-sm h-100 text-center">
        <div class="card-body">
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

<script>
  AOS.init();

  const chartLabels = ["Jan", "Feb", "Mar", "Apr", "May", "Jun"];
  const chartData = [82, 23, 22, 79, 69, 26];

  const chartConfigs = {
    areaChart:   { type: 'line', data: { labels: chartLabels, datasets: [{ data: chartData, label: 'Kinerja', fill: true, backgroundColor: 'rgba(13,110,253,0.2)', borderColor: '#0d6efd' }] }},
    barChart:    { type: 'bar',  data: { labels: chartLabels, datasets: [{ label: 'Transaksi', data: chartData, backgroundColor: 'rgba(25,135,84,0.7)' }] }},
    bubbleChart: { type: 'bubble', data: { datasets: [{ label: 'Bubble Data', data: chartData.map((val, i) => ({ x: i, y: val, r: Math.random() * 10 + 5 })), backgroundColor: 'rgba(255,193,7,0.6)' }] }},
    pieChart:    { type: 'pie', data: { labels: chartLabels, datasets: [{ data: chartData, backgroundColor: ['#dc3545','#0d6efd','#198754','#ffc107','#20c997','#6f42c1'] }] }},
    lineChart:   { type: 'line', data: { labels: chartLabels, datasets: [{ label: 'Line Data', data: chartData, borderColor: '#17a2b8' }] }},
    mixedChart:  { data: { labels: chartLabels, datasets: [
                      { type: 'bar', label: 'Bar', data: chartData, backgroundColor: '#6f42c1' },
                      { type: 'line', label: 'Line', data: chartData.map(x => x * 0.8), borderColor: '#fd7e14' }
                  ]}},
    polarChart:  { type: 'polarArea', data: { labels: chartLabels, datasets: [{ data: chartData, backgroundColor: ['#007bff','#dc3545','#ffc107','#28a745','#6610f2','#20c997'] }] }},
    radarChart:  { type: 'radar', data: { labels: chartLabels, datasets: [{ label: 'Radar', data: chartData, fill: true, backgroundColor: 'rgba(108,117,125,0.2)', borderColor: '#6c757d' }] }},
    scatterChart:{ type: 'scatter', data: { datasets: [{ label: 'Scatter', data: chartData.map((y, i) => ({ x: i, y })), backgroundColor: '#0dcaf0' }] }},
  };

  Object.entries(chartConfigs).forEach(([id, config]) => {
    const ctx = document.getElementById(id);
    if (ctx) new Chart(ctx, config);
  });
</script>