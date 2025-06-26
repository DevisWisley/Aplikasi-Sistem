<?php
include '../includes/config.php';
include '../includes/functions.php';
checkLogin();
include '../includes/header.php';
include '../includes/topbar.php';
include '../includes/sidebar.php';
?>

<!-- Konten utama dengan margin kiri (menyesuaikan sidebar) -->
<main class="ms-240 p-4" style="margin-left: 240px;">
    <div class="container-fluid">
        <h3 class="mb-3">Dashboard</h3>
        <p>Selamat datang, <strong><?= htmlspecialchars($_SESSION['username']); ?></strong> (<?= htmlspecialchars($_SESSION['level']); ?>)</p>

        <!-- Row Cards -->
        <div class="row mt-4 g-3">
            <!-- Card Jumlah Pegawai -->
            <div class="col-md-4 col-sm-6">
                <div class="card border-primary shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-users fa-2x text-primary mb-2"></i>
                        <h6 class="text-muted">Jumlah Pegawai</h6>
                        <p class="fs-4 fw-bold mb-0">
                            <?php
                            $stmt = $conn->query("SELECT COUNT(*) FROM pegawai");
                            echo $stmt->fetchColumn();
                            ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Tambahkan Card Statistik Lain jika dibutuhkan -->
            <div class="col-md-4 col-sm-6">
                <div class="card border-success shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-building fa-2x text-success mb-2"></i>
                        <h6 class="text-muted">Jumlah Cabang</h6>
                        <p class="fs-4 fw-bold mb-0">
                            <?php
                            $stmt = $conn->query("SELECT COUNT(*) FROM cabang");
                            echo $stmt->fetchColumn();
                            ?>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6">
                <div class="card border-warning shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-briefcase fa-2x text-warning mb-2"></i>
                        <h6 class="text-muted">Jumlah Jabatan</h6>
                        <p class="fs-4 fw-bold mb-0">
                            <?php
                            $stmt = $conn->query("SELECT COUNT(*) FROM jabatan");
                            echo $stmt->fetchColumn();
                            ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include '../includes/footer.php'; ?>