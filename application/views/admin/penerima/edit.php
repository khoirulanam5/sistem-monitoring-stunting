<!DOCTYPE html>
<html lang="en">

<body>
    <!-- Loader Start -->
    <div id="loading">
        <div id="loading-center"></div>
    </div>
    <!-- Loader END -->

    <!-- Wrapper Start -->
    <div class="wrapper">
        <div class="content-page rtl-page">
            <?= $this->session->flashdata('pesan') ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title"><?= $title ?></h4>
                                </div>
                            </div>

                            <div class="card-body">
                                <form action="<?= base_url('admin/penerima/edit/' . $value->id_user) ?>" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <!-- Nama Lengkap -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Nama Lengkap</label>
                                                <input type="hidden" name="id_penerima" value="<?= $value->id_penerima ?>">
                                                <input type="hidden" name="id_user" value="<?= $value->id_user ?>">
                                                <input type="text" name="nama" id="nama" class="form-control" value="<?= $value->nama ?>" required>
                                                <?= form_error('nama', '<div class="text-danger small ml-3">', '</div>'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- Nama Panggilan -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Nama Panggilan</label>
                                                <input type="text" name="nm_pengguna" id="nm_pengguna" class="form-control" value="<?= $value->nm_pengguna ?>" required>
                                                <?= form_error('nm_pengguna', '<div class="text-danger small ml-3">', '</div>'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- KTP -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>KTP (Kartu Tanda Penduduk)</label><br>
                                                <?php if (!empty($value->ktp)): ?>
                                                    <a href="<?= base_url('assets/images/' . $value->ktp) ?>" target="_blank">
                                                        <img src="<?= base_url('assets/images/' . $value->ktp) ?>" alt="File KTP" class="img-thumbnail mb-2" width="150">
                                                    </a>
                                                <?php endif; ?>
                                                <input type="file" name="ktp" class="form-control">
                                                <small class="text-muted">Kosongkan jika tidak ingin mengganti file.</small>
                                                <?= form_error('ktp', '<div class="text-danger small ml-3">', '</div>'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- KK -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>KK (Kartu Keluarga)</label><br>
                                                <?php if (!empty($value->kk)): ?>
                                                    <a href="<?= base_url('assets/images/' . $value->kk) ?>" target="_blank">
                                                        <img src="<?= base_url('assets/images/' . $value->kk) ?>" alt="File KK" class="img-thumbnail mb-2" width="150">
                                                    </a>
                                                <?php endif; ?>
                                                <input type="file" name="kk" class="form-control">
                                                <small class="text-muted">Kosongkan jika tidak ingin mengganti file.</small>
                                                <?= form_error('kk', '<div class="text-danger small ml-3">', '</div>'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- Umur -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Umur</label>
                                                <input type="number" name="umur" id="umur" class="form-control" value="<?= $value->umur ?>" required>
                                                <?= form_error('umur', '<div class="text-danger small ml-3">', '</div>'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- No. Handphone -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>No. Handphone</label>
                                                <input type="number" name="no_hp" id="no_hp" class="form-control" value="<?= $value->no_hp ?>" required>
                                                <?= form_error('no_hp', '<div class="text-danger small ml-3">', '</div>'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- Alamat -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <textarea name="alamat" class="form-control"><?= $value->alamat ?></textarea>
                                                <?= form_error('alamat', '<div class="text-danger small ml-3">', '</div>'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- Jenis Pekerjaan -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Jenis Pekerjaan</label>
                                                <input type="text" name="jenis_pekerjaan" id="jenis_pekerjaan" class="form-control" value="<?= $value->jenis_pekerjaan ?>" required>
                                                <?= form_error('jenis_pekerjaan', '<div class="text-danger small ml-3">', '</div>'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- Status Penerima -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Status Penerima</label>
                                                <select name="status_penerima" class="form-control" required>
                                                    <option value="">-- Pilih Status Penerima --</option>
                                                    <option value="Bapak Kandung" <?= $value->status_penerima == 'Bapak Kandung' ? 'selected' : '' ?>>Bapak Kandung</option>
                                                    <option value="Ibu Kandung" <?= $value->status_penerima == 'Ibu Kandung' ? 'selected' : '' ?>>Ibu Kandung</option>
                                                    <option value="Saudara Kandung" <?= $value->status_penerima == 'Saudara Kandung' ? 'selected' : '' ?>>Saudara Kandung</option>
                                                </select>
                                                <?= form_error('status_penerima', '<div class="text-danger small ml-3">', '</div>'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- Username -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" name="username" id="username" class="form-control" value="<?= $value->username ?>" required>
                                                <?= form_error('username', '<div class="text-danger small ml-3">', '</div>'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- Password -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" name="password" id="password" class="form-control" value="<?= $value->password ?>" required>
                                                <?= form_error('password', '<div class="text-danger small ml-3">', '</div>'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tombol Aksi -->
                                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                    <a href="<?= base_url('admin/penerima') ?>" class="btn btn-sm btn-secondary">Batal</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
