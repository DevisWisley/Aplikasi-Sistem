<?php
include '../includes/config.php';
include '../includes/functions.php';
checkLogin();
include '../includes/header.php';
include '../includes/topbar.php';
include '../includes/sidebar.php';

// Tambah Transaksi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['aksi'] === 'tambah') {
    $pegawai_id  = $_POST['pegawai_id'];
    $cabang_id   = $_POST['cabang_id'];
    $oleh_admin  = $_POST['oleh_admin'];

    $stmt = $conn->prepare("INSERT INTO transaksi (pegawai_id, cabang_id, oleh_admin) VALUES (?, ?, ?)");
    $stmt->execute([$pegawai_id, $cabang_id, $oleh_admin]);
}

// Hapus Transaksi
if (isset($_GET['delete'])) {
    $stmt = $conn->prepare("DELETE FROM transaksi WHERE transaksi_id=?");
    $stmt->execute([$_GET['delete']]);
    header("Location: transaksi.php?msg=deleted");
    exit;
}

// Ambil Data
$transaksi = $conn->query("
    SELECT t.*, p.nama AS nama_pegawai, c.nama_cabang 
    FROM transaksi t 
    JOIN pegawai p ON t.pegawai_id = p.pegawai_id
    JOIN cabang c ON t.cabang_id = c.cabang_id
    ORDER BY t.transaksi_id DESC
")->fetchAll(PDO::FETCH_ASSOC);

// Ambil pilihan untuk select
$pegawais = $conn->query("SELECT * FROM pegawai")->fetchAll(PDO::FETCH_ASSOC);
$cabangs  = $conn->query("SELECT * FROM cabang")->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="p-4 w-100">
    <a class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="fas fa-plus"></i> Tambah Transaksi Data
    </a>

    <table id="transaksiTable" class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>Pegawai</th>
        <th>Cabang</th>
        <th>Timestamp</th>
        <th>Oleh Admin</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($transaksi as $t): ?>
      <tr>
        <td><?= htmlspecialchars($t['nama_pegawai']) ?></td>
        <td><?= htmlspecialchars($t['nama_cabang']) ?></td>
        <td><?= $t['timestamp'] ?></td>
        <td><?= $t['oleh_admin'] ?></td>
        <td>
            <button class="btn btn-danger btn-sm" onclick='hapusTransaksi(<?= $t["transaksi_id"] ?>)'><i class="fas fa-trash"></i></button>
            <button class="btn btn-info btn-sm" onclick='showDetail(<?= json_encode($t) ?>)'><i class="fas fa-eye"></i></button>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1">
  <div class="modal-dialog">
    <form method="POST" class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Tambah Transaksi</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="aksi" value="tambah">
        <div class="mb-3">
          <label>Pegawai</label>
          <select name="pegawai_id" class="form-select" required>
            <option value="">-- Pilih Pegawai --</option>
            <?php foreach ($pegawais as $p): ?>
              <option value="<?= $p['pegawai_id'] ?>"><?= $p['nama'] ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="mb-3">
          <label>Cabang</label>
          <select name="cabang_id" class="form-select" required>
            <option value="">-- Pilih Cabang --</option>
            <?php foreach ($cabangs as $c): ?>
              <option value="<?= $c['cabang_id'] ?>"><?= $c['nama_cabang'] ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="mb-3">
          <label>Oleh Admin</label>
          <input type="text" name="oleh_admin" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="modalDetail" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-info text-white">
        <h5 class="modal-title">Detail Transaksi</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="detailContent"></div>
    </div>
  </div>
</div>

<?php include '../includes/footer.php'; ?>

<script>
  $(function () {
    $('#transaksiTable').DataTable();
    AOS.init();
  });

  function hapusTransaksi(id) {
    Swal.fire({
      title: 'Yakin hapus transaksi ini?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Ya, hapus',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        location.href = 'transaksi.php?delete=' + id;
      }
    });
  }

  function showDetail(data) {
    const html = `
      <ul class="list-group">
        <li class="list-group-item"><strong>ID Transaksi:</strong> ${data.transaksi_id}</li>
        <li class="list-group-item"><strong>Nama Pegawai:</strong> ${data.nama_pegawai}</li>
        <li class="list-group-item"><strong>Cabang:</strong> ${data.nama_cabang}</li>
        <li class="list-group-item"><strong>Waktu:</strong> ${data.timestamp}</li>
        <li class="list-group-item"><strong>Oleh Admin:</strong> ${data.oleh_admin}</li>
      </ul>`;
    document.getElementById('detailContent').innerHTML = html;
    new bootstrap.Modal(document.getElementById('modalDetail')).show();
  }
</script>