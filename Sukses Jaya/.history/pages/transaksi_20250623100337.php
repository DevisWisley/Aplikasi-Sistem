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

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1">
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
<div class="modal fade" id="modalDetail" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">Detail Pegawai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="detailContent">
                <!-- Isi detail pegawai -->
            </div>
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
            title: 'Yakin hapus?',
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
        const form = document.querySelector('#modalEdit');
        form.querySelector('#edit_id').value = data.pegawai_id;
        for (let key in data) {
            const input = form.querySelector(`[name="${key}"]`);
            if (input) input.value = data[key];
        }
        new bootstrap.Modal(document.getElementById('modalEdit')).show();
    }

    function showDetail(data) {
        let detail = `<ul class="list-group">`;
        for (let key in data) {
            detail += `<li class="list-group-item"><strong>${key}:</strong> ${data[key]}</li>`;
        }
        detail += `</ul>`;
        document.getElementById('detailContent').innerHTML = detail;
        new bootstrap.Modal(document.getElementById('modalDetail')).show();
    }
    </script>