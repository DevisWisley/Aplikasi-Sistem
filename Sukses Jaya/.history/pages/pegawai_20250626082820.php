<?php
include '../includes/config.php';
include '../includes/functions.php';
checkLogin();
include '../includes/header.php';
include '../includes/topbar.php';
include '../includes/sidebar.php';

$isAdmin = ($_SESSION['level'] === 'Admin');

// CRUD logic hanya untuk admin
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $isAdmin) {
    if ($_POST['aksi'] === 'tambah') {
        $stmt = $conn->prepare("INSERT INTO pegawai (nama, nik, tanggal_lahir, jenis_kelamin, alamat, telepon, email, jabatan_id, cabang_id, status, tanggal_masuk) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $_POST['nama'], $_POST['nik'], $_POST['tanggal_lahir'], $_POST['jenis_kelamin'],
            $_POST['alamat'], $_POST['telepon'], $_POST['email'],
            $_POST['jabatan_id'], $_POST['cabang_id'], $_POST['status'], $_POST['tanggal_masuk']
        ]);
    }

    if ($_POST['aksi'] === 'edit') {
        $stmt = $conn->prepare("UPDATE pegawai SET nama=?, nik=?, tanggal_lahir=?, jenis_kelamin=?, alamat=?, telepon=?, email=?, jabatan_id=?, cabang_id=?, status=?, tanggal_masuk=? WHERE pegawai_id=?");
        $stmt->execute([
            $_POST['nama'], $_POST['nik'], $_POST['tanggal_lahir'], $_POST['jenis_kelamin'],
            $_POST['alamat'], $_POST['telepon'], $_POST['email'],
            $_POST['jabatan_id'], $_POST['cabang_id'], $_POST['status'], $_POST['tanggal_masuk'], $_POST['pegawai_id']
        ]);
    }
}

if ($isAdmin && isset($_GET['delete'])) {
    $stmt = $conn->prepare("DELETE FROM pegawai WHERE pegawai_id = ?");
    $stmt->execute([$_GET['delete']]);
    header("Location: pegawai.php?msg=deleted");
    exit;
}

// Ambil data
if ($isAdmin) {
    $pegawais = $conn->query("SELECT p.*, j.nama_jabatan, j.gaji_pokok, c.nama_cabang
      FROM pegawai p
      LEFT JOIN jabatan j ON p.jabatan_id = j.jabatan_id
      LEFT JOIN cabang c ON p.cabang_id = c.cabang_id")->fetchAll(PDO::FETCH_ASSOC);
} else {
    $stmt = $conn->prepare("SELECT p.*, j.nama_jabatan, j.gaji_pokok, c.nama_cabang
      FROM pegawai p
      LEFT JOIN jabatan j ON p.jabatan_id = j.jabatan_id
      LEFT JOIN cabang c ON p.cabang_id = c.cabang_id
      WHERE p.email = ?");
    $stmt->execute([$_SESSION['username']]);
    $pegawais = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// untuk form
$jabatan = $conn->query("SELECT * FROM jabatan")->fetchAll(PDO::FETCH_ASSOC);
$cabang = $conn->query("SELECT * FROM cabang")->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="p-4 w-100">
  <div class="d-flex justify-content-between mb-4">
    <h3 data-aos="fade-right">Data Pegawai</h3>
    <?php if ($isAdmin): ?>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
      <i class="fas fa-plus"></i> Tambah Pegawai
    </button>
    <?php endif; ?>
  </div>

  <table id="pegawaiTable" class="table table-striped table-bordered">
    <thead class="table-dark">
      <tr>
        <th>Nama</th>
        <?php if ($isAdmin): ?><th>NIK</th><?php endif; ?>
        <th>Cabang</th>
        <th>Jabatan</th>
        <?php if ($isAdmin): ?>
        <th>Status</th>
        <th>Aksi</th>
        <?php else: ?>
        <th>Gaji Pokok</th>
        <?php endif; ?>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($pegawais as $row): ?>
      <tr>
        <td><?= htmlspecialchars($row['nama']); ?></td>
        <?php if ($isAdmin): ?><td><?= $row['nik']; ?></td><?php endif; ?>
        <td><?= $row['nama_cabang']; ?></td>
        <td><?= $row['nama_jabatan']; ?></td>
        <?php if ($isAdmin): ?>
        <td><span class="badge bg-<?= $row['status'] === 'Aktif' ? 'success' : 'secondary'; ?>"><?= $row['status']; ?></span></td>
        <td>
          <button class="btn btn-warning btn-sm" onclick="editPegawai(<?= htmlspecialchars(json_encode($row)); ?>)">
            <i class="fas fa-edit"></i>
          </button>
          <button class="btn btn-danger btn-sm" onclick="hapusPegawai(<?= $row['pegawai_id']; ?>)">
            <i class="fas fa-trash"></i>
          </button>
          <button class="btn btn-info btn-sm" onclick="showDetail(<?= htmlspecialchars(json_encode($row)); ?>)">
            <i class="fas fa-eye"></i>
          </button>
        </td>
        <?php else: ?>
        <td>Rp <?= number_format($row['gaji_pokok'], 0, ',', '.'); ?></td>
        <?php endif; ?>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<!-- Modal Tambah -->
<?php if ($isAdmin): ?>
<div class="modal fade" id="modalTambah">
  <div class="modal-dialog modal-lg">
    <form method="POST" class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Tambah Pegawai</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="aksi" value="tambah">
        <?php include 'form-pegawai-fields.php'; ?>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>
<?php endif; ?>

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit">
  <div class="modal-dialog modal-lg">
    <form method="POST" class="modal-content">
      <div class="modal-header bg-warning text-white">
        <h5 class="modal-title">Edit Pegawai</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="aksi" value="edit">
        <input type="hidden" name="pegawai_id" id="edit_id">
        <?php include 'form-pegawai-fields.php'; ?>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-warning">Update</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="modalDetail">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-info text-white">
        <h5 class="modal-title">Detail Pegawai</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="detailContent"></div>
    </div>
  </div>
</div>

<?php include '../includes/footer.php'; ?>

<script>
  $(document).ready(function () {
    $('#pegawaiTable').DataTable();
    AOS.init();
  });

  function hapusPegawai(id) {
    Swal.fire({
      title: 'Yakin ingin menghapus?',
      text: 'Data tidak bisa dikembalikan!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Hapus',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location = 'pegawai.php?delete=' + id;
      }
    });
  }

  function editPegawai(data) {
    const modal = document.getElementById('modalEdit');
    modal.querySelector('#edit_id').value = data.pegawai_id;
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
