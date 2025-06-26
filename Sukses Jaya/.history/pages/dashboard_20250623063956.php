<?php
include '../includes/config.php';
include '../includes/functions.php';
checkLogin();
include '../includes/header.php';
include '../includes/topbar.php';
include '../includes/sidebar.php';
?>

<div class="p-4 w-100">
    <h3>Dashboard</h3>
    <p>Selamat datang, <?= $_SESSION['username']; ?> (<?= $_SESSION['level']; ?>)</p>

    <div class="row mt-4">
        <!-- Contoh Card Statistik -->
        <div class="col-md-4">
            <div class="card border-primary shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title"><i class="fas fa-users fa-2x mb-2"></i></h5>
                    <h6 class="card-subtitle mb-2 text-muted">Jumlah Pegawai</h6>
                    <p class="fs-4 fw-bold">
                        <?php
                        $stmt = $conn->query("SELECT COUNT(*) FROM pegawai");
                        echo $stmt->fetchColumn();
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <!-- Tambahkan Card lainnya jika perlu -->
    </div>
</div>

<?php include '../includes/footer.php'; ?>