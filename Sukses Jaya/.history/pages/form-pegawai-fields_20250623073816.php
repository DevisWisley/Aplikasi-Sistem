<div class="row">
  <div class="col-md-6 mb-3">
    <label>Nama</label>
    <input name="nama" class="form-control" required>
  </div>
  <div class="col-md-6 mb-3">
    <label>NIK</label>
    <input name="nik" class="form-control" required>
  </div>
  <div class="col-md-6 mb-3">
    <label>Tanggal Lahir</label>
    <input type="date" name="tanggal_lahir" class="form-control" required>
  </div>
  <div class="col-md-6 mb-3">
    <label>Jenis Kelamin</label>
    <select name="jenis_kelamin" class="form-select" required>
      <option value="">Pilih</option>
      <option value="Laki-laki">Laki-laki</option>
      <option value="Perempuan">Perempuan</option>
    </select>
  </div>
  <div class="col-md-12 mb-3">
    <label>Alamat</label>
    <textarea name="alamat" class="form-control" required></textarea>
  </div>
  <div class="col-md-6 mb-3">
    <label>Telepon</label>
    <input name="telepon" class="form-control" required>
  </div>
  <div class="col-md-6 mb-3">
    <label>Email</label>
    <input type="email" name="email" class="form-control" required>
  </div>
  <div class="col-md-6 mb-3">
    <label>Jabatan</label>
    <select name="jabatan_id" class="form-select" required>
      <?php foreach ($jabatan as $j): ?>
        <option value="<?= $j['jabatan_id'] ?>"><?= $j['nama_jabatan'] ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="col-md-6 mb-3">
    <label>Cabang</label>
    <select name="cabang_id" class="form-select" required>
      <?php foreach ($cabang as $c): ?>
        <option value="<?= $c['cabang_id'] ?>"><?= $c['nama_cabang'] ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="col-md-6 mb-3">
    <label>Status</label>
    <select name="status" class="form-select" required>
      <option value="Aktif">Aktif</option>
      <option value="Tidak Aktif">Tidak Aktif</option>
    </select>
  </div>
  <div class="col-md-6 mb-3">
    <label>Tanggal Masuk</label>
    <input type="date" name="tanggal_masuk" class="form-control" required>
  </div>
</div>
