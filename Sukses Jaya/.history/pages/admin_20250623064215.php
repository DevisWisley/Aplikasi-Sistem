<?php
include '../includes/config.php';
include '../includes/functions.php';
checkLogin();
if (!isAdmin()) {
  die('Akses ditolak.');
}
include '../includes/header.php';
include '../includes/topbar.php';
include '../includes/sidebar.php';
?>

<div class="p-4 w-100">
  <h3>Data Admin</h3>

  <table class="table table-bordered" id="adminTable">
    <thead class="table-dark">
      <tr>
        <th>No</th>
        <th>Username</th>
        <th>Cabang</th>
        <th>Level</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      $stmt = $conn->query("SELECT a.*, c.nama_cabang 
        FROM admin a
        LEFT JOIN cabang c ON a.cabang_id = c.cabang_id
      ");
      while ($row = $stmt->fetch()) {
      ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= $row['username']; ?></td>
        <td><?= $row['nama_cabang']; ?></td>
        <td><?= $row['level']; ?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<?php include '../includes/footer.php'; ?>
