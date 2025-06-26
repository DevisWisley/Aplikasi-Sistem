<?php
include '../includes/config.php';
include '../includes/functions.php';
checkLogin();
include '../includes/header.php';
include '../includes/topbar.php';
include '../includes/sidebar.php';

// Ambil role dan user ID
$level = $_SESSION['level'];
$username = $_SESSION['username'];

// Pegawai ID dari username (jika pegawai)
if ($level === 'Pegawai') {
    $stmt = $conn->prepare("SELECT pegawai_id FROM admin WHERE username = ?");
    $stmt->execute([$username]);
    $pegawai_id = $stmt->fetchColumn();
}
?>

<main class="ms-240 p-4" style="margin-left: 240px;">
    <div class="container-fluid">
        <h3 class="mb-3">Dashboard</h3>
        <p>Selamat datang, <strong><?= htmlspecialchars($username); ?></strong> (<?= htmlspecialchars($level); ?>)</p>

        <!-- Statistik Cards -->
        <div class="row mt-4 g-3">

            <!-- Card: Pegawai -->
            <div class="col-md-4 col-sm-6">
                <div class="card border-primary shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-users fa-2x text-primary mb-2"></i>
                        <h6 class="text-muted">
                            <?= $level === 'Admin' ? 'Total Pegawai' : 'Profil Saya'; ?>
                        </h6>
                        <p class="fs-4 fw-bold mb-0">
                            <?php
                            if ($level === 'Admin') {
                                echo $conn->query("SELECT COUNT(*) FROM pegawai")->fetchColumn();
                            } else {
                                echo "1";
                            }
                            ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card: Cabang -->
            <div class="col-md-4 col-sm-6">
                <div class="card border-success shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-building fa-2x text-success mb-2"></i>
                        <h6 class="text-muted">Jumlah Cabang</h6>
                        <p class="fs-4 fw-bold mb-0">
                            <?= $conn->query("SELECT COUNT(*) FROM cabang")->fetchColumn(); ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card: Jabatan -->
            <div class="col-md-4 col-sm-6">
                <div class="card border-warning shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="fas fa-briefcase fa-2x text-warning mb-2"></i>
                        <h6 class="text-muted">Jumlah Jabatan</h6>
                        <p class="fs-4 fw-bold mb-0">
                            <?= $conn->query("SELECT COUNT(*) FROM jabatan")->fetchColumn(); ?>
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

<?php include '../includes/footer.php'; ?>