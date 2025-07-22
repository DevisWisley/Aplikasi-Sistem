<?php
include '../includes/config.php';
include '../includes/functions.php';
checkLogin();
include '../includes/header.php';
include '../includes/topbar.php';
include '../includes/sidebar.php';

// Create
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if ($_POST['aksi'] === 'tambah') {
    $stmt = $conn->prepare("INSERT INTO cabang (nama_cabang, alamat, kota, telepon, keterangan, email) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([
      $_POST['nama_cabang'],
      $_POST['alamat'],
      $_POST['kota'],
      $_POST['telepon'],
      $_POST['keterangan'],
      $_POST['email']
    ]);
  }

  if ($_POST['aksi'] === 'edit') {
    $stmt = $conn->prepare("UPDATE cabang SET nama_cabang=?, alamat=?, kota=?, telepon=?, keterangan=?, email=? WHERE cabang_id=?");
    $stmt->execute([
      $_POST['nama_cabang'],
      $_POST['alamat'],
      $_POST['kota'],
      $_POST['telepon'],
      $_POST['keterangan'],
      $_POST['email'],
      $_POST['cabang_id']
    ]);
  }
}

// Delete
if (isset($_GET['delete'])) {
  $stmt = $conn->prepare("DELETE FROM cabang WHERE cabang_id=?");
  $stmt->execute([$_GET['delete']]);
  header("Location: cabang.php?msg=deleted");
  exit;
}

// Fetch
$data = $conn->query("SELECT * FROM cabang ORDER BY cabang_id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="p-4 w-100">
  <div class="d-flex justify-content-between mb-4">
    <h3 data-aos="fade-right">Data Cabang</h3>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
      <i class="fas fa-plus"></i> Tambah Cabang
    </button>
  </div>

  <table id="cabangTable" class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>Nama Cabang</th>
        <th>Kota</th>
        <th>Telepon</th>
        <th>Email</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($data as $cabang): ?>
        <tr>
          <td><?= htmlspecialchars($cabang['nama_cabang']) ?></td>
          <td><?= $cabang['kota'] ?></td>
          <td><?= $cabang['telepon'] ?></td>
          <td><?= $cabang['email'] ?></td>
          <td>
            <button class="btn btn-warning btn-sm" onclick='editCabang(<?= json_encode($cabang) ?>)'><i
                class="fas fa-edit"></i></button>
            <button class="btn btn-danger btn-sm" onclick='hapusCabang(<?= $cabang["cabang_id"] ?>)'><i
                class="fas fa-trash"></i></button>
            <button class="btn btn-info btn-sm" onclick='showDetail(<?= json_encode($cabang) ?>)'><i
                class="fas fa-eye"></i></button>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <form method="POST" class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Tambah Cabang</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="aksi" value="tambah">
        <?php include 'form-cabang-fields.php'; ?>
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
  <div class="modal-dialog modal-lg">
    <form method="POST" class="modal-content">
      <div class="modal-header bg-warning text-white">
        <h5 class="modal-title">Edit Cabang</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="aksi" value="edit">
        <input type="hidden" name="cabang_id" id="edit_id">
        <?php include 'form-cabang-fields.php'; ?>
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
        <h5 class="modal-title">Detail Cabang</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="detailContent"></div>
    </div>
  </div>
</div>

<?php include '../includes/footer.php'; ?>

<script>
  $(function () {
    $('#cabangTable').DataTable();
    AOS.init();
  });

  function hapusCabang(id) {
    Swal.fire({
      title: 'Yakin hapus cabang?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Hapus',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        location.href = 'cabang.php?delete=' + id;
      }
    });
  }

  function editCabang(data) {
    const modal = document.querySelector('#modalEdit');
    modal.querySelector('#edit_id').value = data.cabang_id;
    for (let key in data) {
      const input = modal.querySelector(`[name="${key}"]`);
      if (input) input.value = data[key];
    }
    new bootstrap.Modal(modal).show();
  }

  function showDetail(data) {
    let html = '<ul class="list-group">';
    for (let key in data) {
      html += `<li class="list-group-item"><strong>${key}:</strong> ${data[key]}</li>`;
    }
    html += '</ul>';
    document.getElementById('detailContent').innerHTML = html;
    new bootstrap.Modal(document.getElementById('modalDetail')).show();
  }
</script>