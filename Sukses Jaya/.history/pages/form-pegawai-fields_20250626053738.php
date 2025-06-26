<?php
// Hanya admin yang bisa input/edit semua field
$isAdmin = $_SESSION['level'] === 'Admin';
?>

<div class="row">
  <div class="col-md-6 mb-3">
    <label>Nama</label>
    <input type="text" name="nama" class="form-control" required>
  </div>
  <div class="col-md-6 mb-3">
    <label>Jabatan</label>
    <select name="jabatan_id" class="form-select" required>
      <option value="">-- Pilih Jabatan --</option>
      <?php foreach ($jabatan as $j): ?>
        <option value="<?= $j['jabatan_id']; ?>"><?= $j['nama_jabatan']; ?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="col-md-6 mb-3">
    <label>Cabang</label>
    <select name="cabang_id" class="form-select" required>
      <option value="">-- Pilih Cabang --</option>
      <?php foreach ($cabang as $c): ?>
        <option value="<?= $c['cabang_id']; ?>"><?= $c['nama_cabang']; ?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <?php if ($isAdmin): ?>
    <div class="col-md-6 mb-3">
      <label>NIK</label>
      <input type="text" name="nik" class="form-control">
    </div>
    <div class="col-md-6 mb-3">
      <label>Tanggal Lahir</label>
      <input type="date" name="tanggal_lahir" class="form-control">
    </div>
    <div class="col-md-6 mb-3">
      <label>Jenis Kelamin</label>
      <select name="jenis_kelamin" class="form-select">
        <option value="L">Laki-laki</option>
        <option value="P">Perempuan</option>
      </select>
    </div>
    <div class="col-md-6 mb-3">
      <label>Alamat</label>
      <input type="text" name="alamat" class="form-control">
    </div>
    <div class="col-md-6 mb-3">
      <label>Telepon</label>
      <input type="text" name="telepon" class="form-control">
    </div>
    <div class="col-md-6 mb-3">
      <label>Email</label>
      <input type="email" name="email" class="form-control">
    </div>
    <div class="col-md-6 mb-3">
      <label>Status</label>
      <select name="status" class="form-select">
        <option value="Aktif">Aktif</option>
        <option value="Nonaktif">Nonaktif</option>
      </select>
    </div>
    <div class="col-md-6 mb-3">
      <label>Tanggal Masuk</label>
      <input type="date" name="tanggal_masuk" class="form-control">
    </div>
  <?php endif; ?>
</div>

<!-- Modal Edit & Detail -->
<div class="modal fade" id="modalEdit" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <form method="POST" class="modal-content">
      <div class="modal-header bg-warning text-white">
        <h5 class="modal-title">Edit Pegawai</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="aksi" value="edit">
        <input type="hidden" name="pegawai_id" id="edit_id">
        <?php include __FILE__; ?>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-warning">Update</button>
      </div>
    </form>
  </div>
</div>

<div class="modal fade" id="modalDetail" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-info text-white">
        <h5 class="modal-title">Detail Pegawai</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="detailContent"></div>
    </div>
  </div>
</div>