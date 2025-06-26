<?php
include '../includes/config.php';
include '../includes/functions.php';
checkLogin();
include '../includes/header.php';
include '../includes/topbar.php';
include '../includes/sidebar.php';

// Proses tambah dan edit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if ($_POST['aksi'] === 'tambah') {
    $stmt = $conn->prepare("INSERT INTO jabatan (nama_jabatan, gaji_pokok) VALUES (?, ?)");
    $stmt->execute([$_POST['nama_jabatan'], $_POST['gaji_pokok']]);
  } elseif ($_POST['aksi'] === 'edit') {
    $stmt = $conn->prepare("UPDATE jabatan SET nama_jabatan=?, gaji_pokok=? WHERE jabatan_id=?");
    $stmt->execute([$_POST['nama_jabatan'], $_POST['gaji_pokok'], $_POST['jabatan_id']]);
  }
}

// Proses hapus
if (isset($_GET['delete'])) {
  $stmt = $conn->prepare("DELETE FROM jabatan WHERE jabatan_id=?");
  $stmt->execute([$_GET['delete']]);
  header("Location: jabatan.php?msg=deleted");
  exit;
}

// Ambil data
$data = $conn->query("SELECT * FROM jabatan ORDER BY jabatan_id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="p-4 w-100">
  <div class="d-flex justify-content-between mb-4">
    <h3 data-aos="fade-right">Data Jabatan</h3>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
      <i class="fas fa-plus"></i> Tambah Jabatan
    </button>
  </div>

  <table id="jabatanTable" class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>Nama Jabatan</th>
        <th>Gaji Pokok</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($data as $jabatan): ?>
        <tr>
          <td><?= htmlspecialchars($jabatan['nama_jabatan']) ?></td>
          <td>Rp <?= number_format($jabatan['gaji_pokok'], 0, ',', '.') ?></td>
          <td>
            <button class="btn btn-warning btn-sm" onclick='editJabatan(<?= json_encode($jabatan) ?>)'><i
                class="fas fa-edit"></i></button>
            <button class="btn btn-danger btn-sm" onclick='hapusJabatan(<?= $jabatan["jabatan_id"] ?>)'><i
                class="fas fa-trash"></i></button>
            <button class="btn btn-info btn-sm" onclick='showDetail(<?= json_encode($jabatan) ?>)'><i
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
        <h5 class="modal-title">Tambah Jabatan</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="aksi" value="tambah">
        <?php include 'form-jabatan-fields.php'; ?>
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
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="aksi" value="edit">
        <input type="hidden" name="jabatan_id" id="edit_id">
        <?php include 'form-jabatan-fields.php'; ?>
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
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="detailContent"></div>
    </div>
  </div>
</div>

<?php include '../includes/footer.php'; ?>

<script>
  $(function () {
    $('#jabatanTable').DataTable();
    AOS.init();
  });

  function hapusJabatan(id) {
    Swal.fire({
      title: 'Yakin hapus jabatan?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Hapus',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        location.href = 'jabatan.php?delete=' + id;
      }
    });
  }

  function editJabatan(data) {
    const modal = document.querySelector('#modalEdit');
    modal.querySelector('#edit_id').value = data.jabatan_id;
    modal.querySelector('[name="nama_jabatan"]').value = data.nama_jabatan;
    modal.querySelector('[name="gaji_pokok"]').value = data.gaji_pokok;
    new bootstrap.Modal(modal).show();
  }

  function showDetail(data) {
    const html = `
      <ul class="list-group">
        <li class="list-group-item"><strong>Nama Jabatan:</strong> ${data.nama_jabatan}</li>
        <li class="list-group-item"><strong>Gaji Pokok:</strong> Rp ${parseInt(data.gaji_pokok).toLocaleString()}</li>
      </ul>`;
    document.getElementById('detailContent').innerHTML = html;
    new bootstrap.Modal(document.getElementById('modalDetail')).show();
  }
</script>