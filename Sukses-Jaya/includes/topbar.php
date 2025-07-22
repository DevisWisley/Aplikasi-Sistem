<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="../pages/dashboard.php">PT. Sukses Jaya</a>
        <div class="d-flex">
            <span class="navbar-text text-white me-3">
                Halo, <?= $_SESSION['username']; ?> (<?= $_SESSION['level']; ?>)
            </span>
            <a href="../auth/logout.php" class="btn btn-sm btn-danger">Logout</a>
        </div>
    </div>
</nav>