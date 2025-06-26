<?php
include '../includes/config.php';
include '../includes/functions.php';
checkLogin();
include '../includes/header.php';
include '../includes/topbar.php';
include '../includes/sidebar.php';
?>

<div class="p-4 w-100">
  <h3>Transaksi Data Pegawai</h3>

  <table class="table table-bordered" id="transaksiTable">
    <thead class="table-dark">
      <tr>
        <th>No</th>
        <th>Pegawai</th>
        <th>Cabang</th>
        <th>Waktu</th>
        <th>Oleh</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      $stmt = $conn->query("SELECT t.*, p.nama, c.nama_cabang, a.username 
        FROM transaksi_data t
        JOIN pegawai p ON t.pegawai_id = p.pegawai_id
        JOIN cabang c ON t.cabang_id = c.cabang_id
        JOIN admin a ON t.oleh_admin = a.admin_id
      ");
      while ($row = $stmt->fetch()) {
      ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= $row['nama']; ?></td>
        <td><?= $row['nama_cabang']; ?></td>
        <td><?= $row['timestamp']; ?></td>
        <td><?= $row['username']; ?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<?php include '../includes/footer.php'; ?>
