<?php
include '../includes/config.php';
include '../includes/functions.php';
checkLogin();
include '../includes/header.php';
include '../includes/topbar.php';
include '../includes/sidebar.php';

// Proses Create dan Edit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama_jabatan'];
    $gaji = $_POST['gaji_pokok'];
    $aksi = $_POST['aksi'];

    if ($aksi === 'tambah') {
        $stmt = $conn->prepare("INSERT INTO jabatan (nama_jabatan, gaji_pokok) VALUES (?, ?)");
        $stmt->execute([$nama, $gaji]);
    } elseif ($aksi === 'edit') {
        $stmt = $conn->prepare("UPDATE jabatan SET nama_jabatan = ?, gaji_pokok = ? WHERE jabatan_id = ?");
        $stmt->execute([$nama, $gaji, $_POST['jabatan_id']]);
    }
    header("Location: jabatan.php");
    exit;
}

// Proses Delete
if (isset($_GET['delete'])) {
    $stmt = $conn->prepare("DELETE FROM jabatan WHERE jabatan_id = ?");
    $stmt->execute([$_GET['delete']]);
    header("Location: jabatan.php?deleted=true");
    exit;
}

// Ambil data jabatan
$jabatan = $conn->query("SELECT * FROM jabatan ORDER BY jabatan_id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="p-4 w-100">
    <a class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="fas fa-plus"></i> Tambah Jabatan
    </a>

    <table id="jabatanTable" class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>Nama Jabatan</th>
        <th>Gaji Pokok</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($jabatan as $row): ?>
        <tr>
          <td><?= htmlspecialchars($row['nama_jabatan']); ?></td>
          <td>Rp <?= number_format($row['gaji_pokok'], 0, ',', '.'); ?></td>
          <td>
              <button class="btn btn-warning btn-sm me-1" onclick='editJabatan(<?= json_encode($row); ?>)'><i class="fas fa-edit"></i></button>
              <button class="btn btn-danger btn-sm" onclick='hapusJabatan(<?= $row['jabatan_id']; ?>)'><i class="fas fa-trash"></i></button>
              <button class="btn btn-info btn-sm me-1" onclick='showDetail(<?= json_encode($row); ?>)'><i class="fas fa-eye"></i></button>
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
        <h5 class="modal-title">Tambah Jabatan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="aksi" value="tambah">
        <div class="mb-3">
          <label class="form-label">Nama Jabatan</label>
          <input type="text" name="nama_jabatan" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Gaji Pokok</label>
          <input type="number" name="gaji_pokok" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1">
  <div class="modal-dialog">
    <form method="POST" class="modal-content">
      <div class="modal-header bg-warning text-white">
        <h5 class="modal-title">Edit Jabatan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="aksi" value="edit">
        <input type="hidden" name="jabatan_id" id="edit_id">
        <div class="mb-3">
          <label class="form-label">Nama Jabatan</label>
          <input type="text" name="nama_jabatan" id="edit_nama" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Gaji Pokok</label>
          <input type="number" name="gaji_pokok" id="edit_gaji" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-warning">Update</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="modalDetail" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-info text-white">
        <h5 class="modal-title">Detail Jabatan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="detailContent">
        <!-- Detail jabatan akan ditampilkan di sini -->
      </div>
    </div>
  </div>
</div>

<?php include '../includes/footer.php'; ?>

<script>
  $(document).ready(function () {
    $('#jabatanTable').DataTable();
    AOS.init();
  });

  function hapusJabatan(id) {
    Swal.fire({
      title: 'Yakin ingin hapus?',
      text: 'Data tidak dapat dikembalikan!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Hapus',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location = 'jabatan.php?delete=' + id;
      }
    });
  }

  function editJabatan(data) {
    document.getElementById('edit_id').value = data.jabatan_id;
    document.getElementById('edit_nama').value = data.nama_jabatan;
    document.getElementById('edit_gaji').value = data.gaji_pokok;
    new bootstrap.Modal(document.getElementById('modalEdit')).show();
  }

  function showDetail(data) {
    const content = `
      <ul class="list-group">
        <li class="list-group-item"><strong>Nama Jabatan:</strong> ${data.nama_jabatan}</li>
        <li class="list-group-item"><strong>Gaji Pokok:</strong> Rp ${parseInt(data.gaji_pokok).toLocaleString()}</li>
      </ul>`;
    document.getElementById('detailContent').innerHTML = content;
    new bootstrap.Modal(document.getElementById('modalDetail')).show();
  }
</script>