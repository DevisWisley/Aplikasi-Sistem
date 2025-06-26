<?php
include '../includes/config.php';
include '../includes/functions.php';
checkLogin();
include '../includes/header.php';
include '../includes/topbar.php';
include '../includes/sidebar.php';

// Tambah dan Edit Admin
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password']; // Hanya untuk demo, produksi harus hash!
    $level    = $_POST['level'];
    $cabang   = $_POST['cabang_id'];

    if ($_POST['aksi'] === 'tambah') {
        $stmt = $conn->prepare("INSERT INTO admin (username, password, level, cabang_id) VALUES (?, ?, ?, ?)");
        $stmt->execute([$username, $password, $level, $cabang]);
    }

    if ($_POST['aksi'] === 'edit') {
        $id = $_POST['admin_id'];
        $stmt = $conn->prepare("UPDATE admin SET username=?, password=?, level=?, cabang_id=? WHERE admin_id=?");
        $stmt->execute([$username, $password, $level, $cabang, $id]);
    }
}

// Hapus Admin
if (isset($_GET['delete'])) {
    $stmt = $conn->prepare("DELETE FROM admin WHERE admin_id=?");
    $stmt->execute([$_GET['delete']]);
    header("Location: admin.php?msg=deleted");
    exit;
}

// Ambil data
$admins  = $conn->query("SELECT a.*, c.nama_cabang FROM admin a LEFT JOIN cabang c ON a.cabang_id = c.cabang_id ORDER BY admin_id DESC")->fetchAll(PDO::FETCH_ASSOC);
$cabangs = $conn->query("SELECT * FROM cabang")->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="p-4 w-100">
    <div class="d-flex justify-content-between mb-4">
        <h3 data-aos="fade-right">Data Pegawai</h3>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="fas fa-plus"></i> Tambah Pegawai
        </button>
    </div>

    <table id="pegawaiTable" class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Nama</th>
                <th>NIK</th>
                <th>Cabang</th>
                <th>Jabatan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pegawais as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['nama']); ?></td>
                    <td><?= $row['nik']; ?></td>
                    <td><?= $row['nama_cabang']; ?></td>
                    <td><?= $row['nama_jabatan']; ?></td>
                    <td><span
                            class="badge bg-<?= $row['status'] === 'Aktif' ? 'success' : 'secondary'; ?>"><?= $row['status']; ?></span>
                    </td>
                    <td>
                        <button class="btn btn-warning btn-sm me-1"
                            onclick="editPegawai(<?= htmlspecialchars(json_encode($row)); ?>)">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-danger btn-sm" onclick="hapusPegawai(<?= $row['pegawai_id']; ?>)">
                            <i class="fas fa-trash"></i>
                        </button>
                        <button class="btn btn-info btn-sm me-1"
                            onclick="showDetail(<?= htmlspecialchars(json_encode($row)); ?>)">
                            <i class="fas fa-eye"></i>
                        </button>
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