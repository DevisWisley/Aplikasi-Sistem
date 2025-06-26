<?php
include '../includes/config.php';
include '../includes/functions.php';
checkLogin();
include '../includes/header.php';
include '../includes/topbar.php';
include '../includes/sidebar.php';

// Tambah / Edit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $level = $_POST['level'];
  $cabang_id = $_POST['cabang_id'];

  if ($_POST['aksi'] === 'tambah') {
    $stmt = $conn->prepare("INSERT INTO admin (username, password, level, cabang_id) VALUES (?, ?, ?, ?)");
    $stmt->execute([$username, $password, $level, $cabang_id]);
  } elseif ($_POST['aksi'] === 'edit') {
    if (!empty($password)) {
      $stmt = $conn->prepare("UPDATE admin SET username=?, password=?, level=?, cabang_id=? WHERE admin_id=?");
      $stmt->execute([$username, $password, $level, $cabang_id, $_POST['admin_id']]);
    } else {
      $stmt = $conn->prepare("UPDATE admin SET username=?, level=?, cabang_id=? WHERE admin_id=?");
      $stmt->execute([$username, $level, $cabang_id, $_POST['admin_id']]);
    }
  }
}

// Hapus
if (isset($_GET['delete'])) {
  $conn->prepare("DELETE FROM admin WHERE admin_id=?")->execute([$_GET['delete']]);
  header("Location: admin.php?msg=deleted");
  exit;
}

$data = $conn->query("SELECT a.*, c.nama_cabang FROM admin a LEFT JOIN cabang c ON a.cabang_id = c.cabang_id")->fetchAll(PDO::FETCH_ASSOC);
$cabangs = $conn->query("SELECT * FROM cabang")->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="p-4 w-100">
  <div class="d-flex justify-content-between mb-4">
    <h3 data-aos="fade-right">Data Admin</h3>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
      <i class="fas fa-plus"></i> Tambah Admin
    </button>
  </div>

  <table class="table table-bordered" id="adminTable">
    <thead class="table-dark">
      <tr>
        <th>No</th>
        <th>Username</th>
        <th>Cabang</th>
        <th>Level</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1;
      foreach ($data as $row): ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= htmlspecialchars($row['username']) ?></td>
          <td><?= $row['nama_cabang'] ?></td>
          <td><?= $row['level'] ?></td>
          <td>
            <button class="btn btn-warning btn-sm" onclick='editAdmin(<?= json_encode($row) ?>)'><i
                class="fas fa-edit"></i></button>
            <button class="btn btn-danger btn-sm" onclick='hapusAdmin(<?= $row["admin_id"] ?>)'><i
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
        <h5 class="modal-title">Tambah Admin</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="aksi" value="tambah">
        <?php include 'form-admin-fields.php'; ?>
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
        <h5 class="modal-title">Edit Admin</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="aksi" value="edit">
        <input type="hidden" name="admin_id" id="edit_id">
        <?php include 'form-admin-fields.php'; ?>
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
        <h5 class="modal-title">Detail Admin</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="detailContent"></div>
    </div>
  </div>
</div>

<?php include '../includes/footer.php'; ?>

<script>
  $(function () {
    $('#adminTable').DataTable();
    AOS.init();
  });

  function hapusAdmin(id) {
    Swal.fire({
      title: 'Hapus Admin?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Ya, Hapus',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        location.href = 'admin.php?delete=' + id;
      }
    });
  }

  function editAdmin(data) {
    const modal = document.querySelector('#modalEdit');
    modal.querySelector('#edit_id').value = data.admin_id;
    modal.querySelector('[name="username"]').value = data.username;
    modal.querySelector('[name="level"]').value = data.level;
    modal.querySelector('[name="cabang_id"]').value = data.cabang_id;
    new bootstrap.Modal(modal).show();
  }

  function showDetail(data) {
    const html = `
      <ul class="list-group">
        <li class="list-group-item"><strong>Username:</strong> ${data.username}</li>
        <li class="list-group-item"><strong>Level:</strong> ${data.level}</li>
        <li class="list-group-item"><strong>ID Cabang:</strong> ${data.cabang_id}</li>
      </ul>`;
    document.getElementById('detailContent').innerHTML = html;
    new bootstrap.Modal(document.getElementById('modalDetail')).show();
  }
</script>