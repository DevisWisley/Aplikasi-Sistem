<?php
include '../includes/config.php';
include '../includes/functions.php';
checkLogin();
include '../includes/header.php';
include '../includes/topbar.php';
include '../includes/sidebar.php';

// Tambah transaksi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['aksi'] === 'tambah') {
  $stmt = $conn->prepare("INSERT INTO transaksi_data (pegawai_id, cabang_id, timestamp, oleh_admin) VALUES (?, ?, NOW(), ?)");
  $stmt->execute([$_POST['pegawai_id'], $_POST['cabang_id'], $_SESSION['admin_id']]);
}

// Hapus transaksi
if (isset($_GET['delete'])) {
  $stmt = $conn->prepare("DELETE FROM transaksi_data WHERE transaksi_id = ?");
  $stmt->execute([$_GET['delete']]);
  header("Location: transaksi.php?msg=deleted");
  exit;
}

// Ambil data utama
$stmt = $conn->query("SELECT t.*, p.nama, c.nama_cabang, a.username 
    FROM transaksi_data t
    JOIN pegawai p ON t.pegawai_id = p.pegawai_id
    JOIN cabang c ON t.cabang_id = c.cabang_id
    JOIN admin a ON t.oleh_admin = a.admin_id
");
$transaksis = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Ambil data pegawai dan cabang untuk form
$pegawais = $conn->query("SELECT * FROM pegawai")->fetchAll(PDO::FETCH_ASSOC);
$cabangs = $conn->query("SELECT * FROM cabang")->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="p-4 w-100">
  <div class="d-flex justify-content-between mb-4">
    <h3 data-aos="fade-right">Data Transaksi</h3>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
      <i class="fas fa-plus"></i> Tambah Transaksi
    </button>
  </div>

  <table class="table table-bordered table-striped" id="transaksiTable">
    <thead class="table-dark">
      <tr>
        <th>No</th>
        <th>Pegawai</th>
        <th>Cabang</th>
        <th>Waktu</th>
        <th>Oleh</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1;
      foreach ($transaksis as $row): ?>
        <tr>
          <td><?= $no++; ?></td>
          <td><?= $row['nama']; ?></td>
          <td><?= $row['nama_cabang']; ?></td>
          <td><?= $row['timestamp']; ?></td>
          <td><?= $row['username']; ?></td>
          <td>
            <button class="btn btn-danger btn-sm" onclick='hapusTransaksi(<?= $row["transaksi_id"] ?>)'><i
                class="fas fa-trash"></i></button>
            <button class="btn btn-info btn-sm" onclick='showDetail(<?= json_encode($row) ?>)'><i
                class="fas fa-eye"></i></button>
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
              <option value="<?= $p['pegawai_id']; ?>"><?= $p['nama']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="mb-3">
          <label>Cabang</label>
          <select name="cabang_id" class="form-select" required>
            <option value="">-- Pilih Cabang --</option>
            <?php foreach ($cabangs as $c): ?>
              <option value="<?= $c['cabang_id']; ?>"><?= $c['nama_cabang']; ?></option>
            <?php endforeach; ?>
          </select>
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
      title: 'Yakin ingin menghapus transaksi?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Ya, Hapus',
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
        <li class="list-group-item"><strong>Pegawai:</strong> ${data.nama}</li>
        <li class="list-group-item"><strong>Cabang:</strong> ${data.nama_cabang}</li>
        <li class="list-group-item"><strong>Waktu:</strong> ${data.timestamp}</li>
        <li class="list-group-item"><strong>Oleh Admin:</strong> ${data.username}</li>
      </ul>`;
    document.getElementById('detailContent').innerHTML = html;
    new bootstrap.Modal(document.getElementById('modalDetail')).show();
  }
</script>