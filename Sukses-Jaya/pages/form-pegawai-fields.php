<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Nama</label>
        <input type="text" name="nama" class="form-control" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">NIK</label>
        <input type="text" name="nik" class="form-control" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" class="form-control" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Jenis Kelamin</label>
        <select name="jenis_kelamin" class="form-select" required>
            <option value="">-- Pilih --</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select>
    </div>
    <div class="col-md-12">
        <label class="form-label">Alamat</label>
        <textarea name="alamat" class="form-control" required></textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label">Telepon</label>
        <input type="text" name="telepon" class="form-control" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Jabatan</label>
        <select name="jabatan_id" class="form-select" required>
            <option value="">-- Pilih Jabatan --</option>
            <?php foreach ($jabatan as $j): ?>
                <option value="<?= $j['jabatan_id'] ?>"><?= $j['nama_jabatan'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Cabang</label>
        <select name="cabang_id" class="form-select" required>
            <option value="">-- Pilih Cabang --</option>
            <?php foreach ($cabang as $c): ?>
                <option value="<?= $c['cabang_id'] ?>"><?= $c['nama_cabang'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Status</label>
        <select name="status" class="form-select" required>
            <option value="">-- Pilih Status --</option>
            <option value="Aktif">Aktif</option>
            <option value="Nonaktif">Nonaktif</option>
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Tanggal Masuk</label>
        <input type="date" name="tanggal_masuk" class="form-control" required>
    </div>
</div>