<?php
include '../includes/config.php';
include '../includes/functions.php';
checkLogin();
include '../includes/header.php';
include '../includes/topbar.php';
include '../includes/sidebar.php';
?>

<div class="p-4 w-100">
  <h3>Data Cabang</h3>

  <table class="table table-bordered" id="cabangTable">
    <thead class="table-dark">
      <tr>
        <th>No</th>
        <th>Nama Cabang</th>
        <th>Kota</th>
        <th>Email</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      $stmt = $conn->query("SELECT * FROM cabang");
      while ($row = $stmt->fetch()) {
      ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= $row['nama_cabang']; ?></td>
        <td><?= $row['kota']; ?></td>
        <td><?= $row['email']; ?></td>
        <td>
          <a href="#" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
          <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<?php include '../includes/footer.php'; ?>
