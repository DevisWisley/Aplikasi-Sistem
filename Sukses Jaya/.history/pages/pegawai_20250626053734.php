<?php
include '../includes/config.php';
include '../includes/functions.php';
checkLogin();
include '../includes/header.php';
include '../includes/topbar.php';
include '../includes/sidebar.php';

// Proses tambah/edit/hapus
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $aksi = $_POST['aksi'] ?? '';
    if ($aksi === 'tambah') {
        $stmt = $conn->prepare("INSERT INTO pegawai (nama, nik, tanggal_lahir, jenis_kelamin, alamat, telepon, email, jabatan_id, cabang_id, status, tanggal_masuk) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $_POST['nama'], $_POST['nik'], $_POST['tanggal_lahir'], $_POST['jenis_kelamin'], $_POST['alamat'],
            $_POST['telepon'], $_POST['email'], $_POST['jabatan_id'], $_POST['cabang_id'], $_POST['status'], $_POST['tanggal_masuk']
        ]);
    } elseif ($aksi === 'edit') {
        $stmt = $conn->prepare("UPDATE pegawai SET nama=?, nik=?, tanggal_lahir=?, jenis_kelamin=?, alamat=?, telepon=?, email=?, jabatan_id=?, cabang_id=?, status=?, tanggal_masuk=? WHERE pegawai_id=?");
        $stmt->execute([
            $_POST['nama'], $_POST['nik'], $_POST['tanggal_lahir'], $_POST['jenis_kelamin'], $_POST['alamat'],
            $_POST['telepon'], $_POST['email'], $_POST['jabatan_id'], $_POST['cabang_id'], $_POST['status'], $_POST['tanggal_masuk'], $_POST['pegawai_id']
        ]);
    }
}

if (isset($_GET['delete']) && $_SESSION['level'] === 'Admin') {
    $conn->prepare("DELETE FROM pegawai WHERE pegawai_id = ?")->execute([$_GET['delete']]);
    header("Location: pegawai.php?msg=deleted");
    exit;
}

// Ambil data
$pegawais = $conn->query("SELECT p.*, j.nama_jabatan, j.gaji_pokok, c.nama_cabang
                          FROM pegawai p
                          LEFT JOIN jabatan j ON p.jabatan_id = j.jabatan_id
                          LEFT JOIN cabang c ON p.cabang_id = c.cabang_id
                          ORDER BY p.pegawai_id DESC")->fetchAll(PDO::FETCH_ASSOC);

$jabatan = $conn->query("SELECT * FROM jabatan")->fetchAll(PDO::FETCH_ASSOC);
$cabang = $conn->query("SELECT * FROM cabang")->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="p-4 w-100">
    <div class="d-flex justify-content-between mb-4">
        <h3 data-aos="fade-right">Data Pegawai</h3>
        <?php if ($_SESSION['level'] === 'Admin'): ?>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="fas fa-plus"></i> Tambah Pegawai
            </button>
        <?php endif; ?>
    </div>

    <table id="pegawaiTable" class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Nama</th>
                <th>Cabang</th>
                <th>Jabatan</th>
                <?php if ($_SESSION['level'] === 'Admin'): ?>
                    <th>NIK</th>
                    <th>Status</th>
                <?php else: ?>
                    <th>Gaji Pokok</th>
                <?php endif; ?>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pegawais as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['nama']); ?></td>
                    <td><?= $row['nama_cabang']; ?></td>
                    <td><?= $row['nama_jabatan']; ?></td>
                    <?php if ($_SESSION['level'] === 'Admin'): ?>
                        <td><?= $row['nik']; ?></td>
                        <td><span class="badge bg-<?= $row['status'] === 'Aktif' ? 'success' : 'secondary'; ?>"><?= $row['status']; ?></span></td>
                    <?php else: ?>
                        <td>Rp <?= number_format($row['gaji_pokok'], 0, ',', '.'); ?></td>
                    <?php endif; ?>
                    <td>
                        <button class="btn btn-info btn-sm" onclick="showDetail(<?= htmlspecialchars(json_encode($row)); ?>)">
                            <i class="fas fa-eye"></i>
                        </button>
                        <?php if ($_SESSION['level'] === 'Admin'): ?>
                            <button class="btn btn-warning btn-sm" onclick="editPegawai(<?= htmlspecialchars(json_encode($row)); ?>)">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="hapusPegawai(<?= $row['pegawai_id']; ?>)">
                                <i class="fas fa-trash"></i>
                            </button>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal Tambah/Edit/Detail -->
<?php include 'form-pegawai-fields.php'; ?>
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
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = 'pegawai.php?delete=' + id;
            }
        });
    }

    function editPegawai(data) {
        const form = document.querySelector('#modalEdit');
        for (let key in data) {
            const input = form.querySelector(`[name="${key}"]`);
            if (input) input.value = data[key];
        }
        new bootstrap.Modal(document.getElementById('modalEdit')).show();
    }

    function showDetail(data) {
        let html = `<ul class="list-group">`;
        for (let key in data) {
            html += `<li class="list-group-item"><strong>${key}:</strong> ${data[key]}</li>`;
        }
        html += `</ul>`;
        document.getElementById('detailContent').innerHTML = html;
        new bootstrap.Modal(document.getElementById('modalDetail')).show();
    }
</script>
