<?php
include '../includes/config.php';
include '../includes/functions.php';
checkLogin();
include '../includes/header.php';
include '../includes/topbar.php';
include '../includes/sidebar.php';

// Ambil data jumlah
$jumlah_pegawai   = $conn->query("SELECT COUNT(*) FROM pegawai")->fetchColumn();
$jumlah_cabang    = $conn->query("SELECT COUNT(*) FROM cabang")->fetchColumn();
$jumlah_jabatan   = $conn->query("SELECT COUNT(*) FROM jabatan")->fetchColumn();
$jumlah_transaksi = $conn->query("SELECT COUNT(*) FROM transaksi_data")->fetchColumn(); // sesuaikan nama tabel
$jumlah_admin     = $conn->query("SELECT COUNT(*) FROM admin")->fetchColumn();

// Dummy data chart
$labels = json_encode(['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun']);
$data1 = json_encode([12, 19, 3, 5, 2, 3]);
$data2 = json_encode([3, 10, 13, 2, 20, 30]);
?>

<div class="p-4 w-100">
  <h3>Dashboard</h3>
  <p>Selamat datang, <strong><?= $_SESSION['username']; ?></strong> (<?= $_SESSION['level']; ?>)</p>

  <?php if ($_SESSION['level'] === 'Admin'): ?>
    <div class="row mt-4">
      <?php foreach ([
        ['fas fa-users', 'Jumlah Pegawai', $jumlah_pegawai, 'primary'],
        ['fas fa-building', 'Jumlah Cabang', $jumlah_cabang, 'success'],
        ['fas fa-briefcase', 'Jumlah Jabatan', $jumlah_jabatan, 'warning'],
        ['fas fa-database', 'Jumlah Transaksi', $jumlah_transaksi, 'info'],
        ['fas fa-user-shield', 'Jumlah Admin', $jumlah_admin, 'danger'],
      ] as $item): ?>
      <div class="col-md-3 mb-4">
        <div class="card border-<?= $item[3] ?> shadow-sm h-100">
          <div class="card-body text-center">
            <i class="<?= $item[0] ?> fa-2x text-<?= $item[3] ?> mb-2"></i>
            <h6 class="text-muted"><?= $item[1] ?></h6>
            <p class="fs-4 fw-bold"><?= $item[2] ?></p>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <div class="row mt-5">
      <?php foreach ([
        ['Area Chart', 'areaChart'],
        ['Bar Chart', 'barChart'],
        ['Bubble Chart', 'bubbleChart'],
        ['Pie Chart', 'pieChart'],
        ['Line Chart', 'lineChart'],
        ['Mixed Chart', 'mixedChart'],
        ['Polar Area Chart', 'polarChart'],
        ['Radar Chart', 'radarChart'],
        ['Scatter Chart', 'scatterChart'],
      ] as $chart): ?>
      <div class="col-md-6 mb-4" data-aos="fade-up">
        <div class="card p-3">
          <h6 class="text-center"><?= $chart[0] ?></h6>
          <canvas id="<?= $chart[1] ?>"></canvas>
        </div>
      </div>
      <?php endforeach; ?>
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
<script>
  const labels = <?= $labels ?>;
  const data1 = <?= $data1 ?>;
  const data2 = <?= $data2 ?>;

  function createChart(id, type, datasets, options = {}) {
    new Chart(document.getElementById(id), {
      type,
      data: { labels, datasets },
      options: { responsive: true, ...options }
    });
  }

  createChart('areaChart', 'line', [{ label: 'Area', data: data1, fill: true, backgroundColor: 'rgba(0,123,255,0.3)' }]);
  createChart('barChart', 'bar', [{ label: 'Bar', data: data1, backgroundColor: 'rgba(0,200,0,0.5)' }]);
  createChart('bubbleChart', 'bubble', [{
    label: 'Bubble',
    data: [{ x: 10, y: 15, r: 10 }, { x: 20, y: 25, r: 15 }],
    backgroundColor: 'rgba(255,99,132,0.5)'
  }]);
  createChart('pieChart', 'pie', [{
    label: 'Pie',
    data: [10, 20, 30],
    backgroundColor: ['#007bff', '#28a745', '#ffc107']
  }]);
  createChart('lineChart', 'line', [{ label: 'Line', data: data2, borderColor: '#dc3545', fill: false }]);
  createChart('mixedChart', 'bar', [
    { type: 'bar', label: 'Bar', data: data1, backgroundColor: 'rgba(54,162,235,0.5)' },
    { type: 'line', label: 'Line', data: data2, borderColor: '#ff9900', fill: false }
  ]);
  createChart('polarChart', 'polarArea', [{
    label: 'Polar',
    data: [11, 16, 7, 3, 14],
    backgroundColor: ['#007bff', '#28a745', '#ffc107', '#6f42c1', '#17a2b8']
  }]);
  createChart('radarChart', 'radar', [{
    label: 'Radar',
    data: data1,
    backgroundColor: 'rgba(255,0,0,0.2)',
    borderColor: '#ff0000'
  }]);
  createChart('scatterChart', 'scatter', [{
    label: 'Scatter',
    data: [{ x: -10, y: 0 }, { x: 0, y: 10 }, { x: 10, y: 5 }],
    backgroundColor: '#800080'
  }], {
    scales: { x: { type: 'linear', position: 'bottom' } }
  });
</script>

<?php include '../includes/footer.php'; ?>