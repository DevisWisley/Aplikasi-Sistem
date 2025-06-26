<?php
include '../includes/config.php';
include '../includes/functions.php';
checkLogin();
include '../includes/header.php';
include '../includes/topbar.php';
include '../includes/sidebar.php';

$isAdmin = $_SESSION['level'] === 'Admin';
$username = $_SESSION['username'];

// Ambil data pegawai
if ($isAdmin) {
    $pegawais = $conn->query("SELECT p.*, j.nama_jabatan, j.gaji_pokok, c.nama_cabang 
        FROM pegawai p
        LEFT JOIN jabatan j ON p.jabatan_id = j.jabatan_id
        LEFT JOIN cabang c ON p.cabang_id = c.cabang_id
        ORDER BY p.pegawai_id DESC")->fetchAll(PDO::FETCH_ASSOC);
} else {
    $stmt = $conn->prepare("SELECT p.*, j.nama_jabatan, j.gaji_pokok, c.nama_cabang 
        FROM pegawai p
        JOIN jabatan j ON p.jabatan_id = j.jabatan_id
        JOIN cabang c ON p.cabang_id = c.cabang_id
        JOIN admin a ON a.username = ? AND a.cabang_id = p.cabang_id
        WHERE a.username = ?");
    $stmt->execute([$username, $username]);
    $pegawais = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$jabatan = $conn->query("SELECT * FROM jabatan")->fetchAll(PDO::FETCH_ASSOC);
$cabang = $conn->query("SELECT * FROM cabang")->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="p-4 w-100">
    <div class="d-flex justify-content-between mb-4" data-aos="fade-down">
        <h3>Data Pegawai</h3>
        <?php if ($isAdmin): ?>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="fas fa-plus"></i> Tambah
            </button>
        <?php else: ?>
            <a href="pegawai-pdf.php" target="_blank" class="btn btn-danger">
                <i class="fas fa-file-pdf"></i> Download PDF
            </a>
        <?php endif; ?>
    </div>

    <table id="pegawaiTable" class="table table-bordered table-striped" data-aos="fade-up">
        <thead class="table-dark">
            <tr>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Cabang</th>
                <?php if ($isAdmin): ?>
                    <th>NIK</th>
                    <th>Status</th>
                <?php else: ?>
                    <th>Gaji Pokok</th>
                <?php endif; ?>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pegawais as $p): ?>
            <tr>
                <td><?= htmlspecialchars($p['nama']); ?></td>
                <td><?= $p['nama_jabatan']; ?></td>
                <td><?= $p['nama_cabang']; ?></td>
                <?php if ($isAdmin): ?>
                    <td><?= $p['nik']; ?></td>
                    <td><span class="badge bg-<?= $p['status'] === 'Aktif' ? 'success' : 'secondary' ?>"><?= $p['status']; ?></span></td>
                <?php else: ?>
                    <td>Rp <?= number_format($p['gaji_pokok'], 0, ',', '.'); ?></td>
                <?php endif; ?>
                <td>
                    <?php if ($isAdmin): ?>
                        <button class="btn btn-warning btn-sm me-1" onclick='editPegawai(<?= json_encode($p); ?>)'><i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm me-1" onclick="hapusPegawai(<?= $p['pegawai_id']; ?>)"><i class="fas fa-trash"></i></button>
                    <?php endif; ?>
                    <button class="btn btn-info btn-sm" onclick='showDetail(<?= json_encode($p); ?>)'><i class="fas fa-eye"></i></button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal Tambah -->
<?php if ($isAdmin): ?>
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form method="POST" action="pegawai-crud.php?aksi=tambah" class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Tambah Pegawai</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
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
        <form method="POST" action="pegawai-crud.php?aksi=edit" class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title">Edit Pegawai</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
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
<?php endif; ?>

<!-- Modal Detail -->
<div class="modal fade" id="modalDetail" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">Detail Pegawai</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
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
        title: 'Hapus Pegawai?',
        text: 'Data yang dihapus tidak dapat dikembalikan.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location = 'pegawai-crud.php?aksi=hapus&id=' + id;
        }
    });
}

function editPegawai(data) {
    const modal = document.getElementById('modalEdit');
    modal.querySelector('#edit_id').value = data.pegawai_id;
    for (let key in data) {
        let field = modal.querySelector(`[name="${key}"]`);
        if (field) field.value = data[key];
    }
    new bootstrap.Modal(modal).show();
}

function showDetail(data) {
    let detail = '<ul class="list-group">';
    for (let key in data) {
        detail += `<li class="list-group-item"><strong>${key}:</strong> ${data[key]}</li>`;
    }
    detail += '</ul>';
    document.getElementById('detailContent').innerHTML = detail;
    new bootstrap.Modal(document.getElementById('modalDetail')).show();
}
</script>