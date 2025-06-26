<div class="mb-3">
  <label>Username</label>
  <input type="text" name="username" class="form-control" required>
</div>
<div class="mb-3">
  <label>Password</label>
  <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diubah">
</div>
<div class="mb-3">
  <label>Level</label>
  <select name="level" class="form-select" required>
    <option value="">-- Pilih Level --</option>
    <option value="Admin">Admin</option>
    <option value="Pegawai">Pegawai</option>
  </select>
</div>
<div class="mb-3">
  <label>Cabang</label>
  <select name="cabang_id" class="form-select" required>
    <option value="">-- Pilih Cabang --</option>
    <?php foreach ($cabangs as $cabang): ?>
      <option value="<?= $cabang['cabang_id'] ?>"><?= $cabang['nama_cabang'] ?></option>
    <?php endforeach; ?>
  </select>
</div>