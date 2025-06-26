<?php
include '../includes/config.php';
include '../includes/functions.php';
checkLogin();
include '../includes/header.php';
include '../includes/topbar.php';
include '../includes/sidebar.php';
?>

<div class="p-4 w-100">
  <h3>Data Jabatan</h3>

  <table class="table table-bordered" id="jabatanTable">
    <thead class="table-dark">
      <tr>
        <th>No</th>
        <th>Nama Jabatan</th>
        <th>Gaji Pokok</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      $stmt = $conn->query("SELECT * FROM jabatan");
      while ($row = $stmt->fetch()) {
      ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= $row['nama_jabatan']; ?></td>
        <td>Rp<?= number_format($row['gaji_pokok'], 0, ',', '.'); ?></td>
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
