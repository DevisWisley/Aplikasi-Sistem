<?php
include '../includes/config.php';
include '../includes/functions.php';
checkLogin();
include '../includes/header.php';
include '../includes/topbar.php';
include '../includes/sidebar.php';

// CRUD logic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['aksi']) && $_POST['aksi'] === 'tambah') {
        $stmt = $conn->prepare("INSERT INTO pegawai (nama, nik, tanggal_lahir, jenis_kelamin, alamat, telepon, email, jabatan_id, cabang_id, status, tanggal_masuk) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $_POST['nama'],
            $_POST['nik'],
            $_POST['tanggal_lahir'],
            $_POST['jenis_kelamin'],
            $_POST['alamat'],
            $_POST['telepon'],
            $_POST['email'],
            $_POST['jabatan_id'],
            $_POST['cabang_id'],
            $_POST['status'],
            $_POST['tanggal_masuk']
        ]);
    }

    if (isset($_POST['aksi']) && $_POST['aksi'] === 'edit') {
        $stmt = $conn->prepare("UPDATE pegawai SET nama=?, nik=?, tanggal_lahir=?, jenis_kelamin=?, alamat=?, telepon=?, email=?, jabatan_id=?, cabang_id=?, status=?, tanggal_masuk=? WHERE pegawai_id=?");
        $stmt->execute([
            $_POST['nama'],
            $_POST['nik'],
            $_POST['tanggal_lahir'],
            $_POST['jenis_kelamin'],
            $_POST['alamat'],
            $_POST['telepon'],
            $_POST['email'],
            $_POST['jabatan_id'],
            $_POST['cabang_id'],
            $_POST['status'],
            $_POST['tanggal_masuk'],
            $_POST['pegawai_id']
        ]);
    }
}

if (isset($_GET['delete'])) {
    $stmt = $conn->prepare("DELETE FROM pegawai WHERE pegawai_id = ?");
    $stmt->execute([$_GET['delete']]);
    header("Location: pegawai.php?msg=deleted");
    exit;
}

// Ambil data
$pegawais = $conn->query("SELECT p.*, j.nama_jabatan, c.nama_cabang
                          FROM pegawai p
                          LEFT JOIN jabatan j ON p.jabatan_id = j.jabatan_id
                          LEFT JOIN cabang c ON p.cabang_id = c.cabang_id
                          ORDER BY p.pegawai_id DESC")->fetchAll(PDO::FETCH_ASSOC);

$jabatan = $conn->query("SELECT * FROM jabatan")->fetchAll(PDO::FETCH_ASSOC);
$cabang = $conn->query("SELECT * FROM cabang")->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="p-4 w-100">
    <a class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="fas fa-plus"></i> Tambah Pegawai
    </a>

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
                        <button class="btn btn-info btn-sm me-1"
                            onclick="showDetail(<?= htmlspecialchars(json_encode($row)); ?>)">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-warning btn-sm me-1"
                            onclick="editPegawai(<?= htmlspecialchars(json_encode($row)); ?>)">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-danger btn-sm" onclick="hapusPegawai(<?= $row['pegawai_id']; ?>)">
                            <i class="fas fa-trash"></i>
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