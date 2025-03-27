<div class="container-fluid">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h3 class="h3 mb-0 text-gray-800"><b><?= $title?></b></h3>
	</div>
	<button class="btn btn-sm btn-primary mb-3" data-toggle="modal" data-target="#add"><i class="fas fa-plus fa-sm"></i> Tambah</button>
	<?= $this->session->flashdata('pesan') ?>
	<div class="card shadow">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="dataTable">
					<thead>
						<tr>
							<th class="text-center">No.</th>
							<th class="text-center">ID Penerima</th>
							<th class="text-center">Nama</th>
                            <th class="text-center">Usia</th>
                            <th class="text-center">Alamat</th>
                            <th class="text-center">Jenis Pekerjaan</th>
                            <th class="text-center">Status Penerima</th>
                            <th class="text-center">Verifikasi Akun</th>
							<th class="text-center">AKSI</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($penerima as $value) : ?>
							<tr class = "text-center">
								<td class="text-center"><?= $no++ ?></td>
								<td><?= $value->id_penerima ?></td>
								<td><?= $value->nama ?></td>
                                <td><?= $value->umur ?></td>
                                <td><?= $value->alamat ?></td>
                                <td><?= $value->jenis_pekerjaan ?></td>
                                <td><?= $value->status_penerima ?></td>
                                <td>
                                    <?php if($value->verify == 'Verifikasi'): ?>
                                        <a class="badge badge-warning verifikasi" href="<?= base_url('admin/penerima/verifikasi/' . $value->id_penerima) ?>">Verifikasi Akun</a>
                                    <?php elseif($value->verify == 'Terverifikasi'): ?>
                                        <a class="badge badge-primary">Terverifikasi</a>
                                    <?php endif; ?>
                                </td>
								<td>
                                    <a href="<?= base_url('admin/penerima/edit/' . $value->id_user) ?>" class="btn btn-primary btn-sm m-1"><i class="fas fa-eye fa-sm"></i></a>
                                    <a class="btn btn-danger btn-sm m-1 hapus" href="<?= base_url('admin/penerima/delete/'.$value->id_user) ?>"><i class="fas fa-trash"></i></a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Penerima</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        	<span area-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="<?= base_url('admin/penerima/add') ?>" method="post" enctype="multipart/form-data">
        <div class="row">
            <!-- Nama Lengkap -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" value="<?= set_value('nama'); ?>">
                    <?= form_error('nama', '<div class="text-danger small ml-3">', '</div>'); ?>
                </div>
            </div>

            <!-- Nama Pengguna -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nama Panggilan</label>
                    <input type="text" name="nm_pengguna" class="form-control" value="<?= set_value('nm_pengguna'); ?>">
                    <?= form_error('nm_pengguna', '<div class="text-danger small ml-3">', '</div>'); ?>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- KTP -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>KTP (Kartu Tanda Penduduk)</label>
                    <input type="file" name="ktp" class="form-control">
                    <?= form_error('ktp', '<div class="text-danger small ml-3">', '</div>'); ?>
                </div>
            </div>

            <!-- KK -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>KK (Kartu Keluarga)</label>
                    <input type="file" name="kk" class="form-control">
                    <?= form_error('kk', '<div class="text-danger small ml-3">', '</div>'); ?>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Umur -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Umur</label>
                    <input type="text" name="umur" class="form-control" value="<?= set_value('umur'); ?>">
                    <?= form_error('umur', '<div class="text-danger small ml-3">', '</div>'); ?>
                </div>
            </div>

            <!-- Nomer Handphone -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>No. Handphone</label>
                    <input type="text" name="no_hp" class="form-control" value="<?= set_value('no_hp'); ?>">
                    <?= form_error('no_hp', '<div class="text-danger small ml-3">', '</div>'); ?>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Alamat -->
            <div class="col-md-12">
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control"><?= set_value('alamat'); ?></textarea>
                    <?= form_error('alamat', '<div class="text-danger small ml-3">', '</div>'); ?>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Jenis Pekerjaan -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Jenis Pekerjaan</label>
                    <input type="text" name="jenis_pekerjaan" class="form-control" value="<?= set_value('jenis_pekerjaan'); ?>">
                    <?= form_error('jenis_pekerjaan', '<div class="text-danger small ml-3">', '</div>'); ?>
                </div>
            </div>

            <!-- Status Penerima -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Status Penerima</label>
                    <select name="status_penerima" class="form-control">
                        <option value="">-- Pilih Status Penerima --</option>
                        <option value="Bapak Kandung" <?= set_value('status_penerima') == 'Bapak Kandung' ? 'selected' : ''; ?>>Bapak Kandung</option>
                        <option value="Ibu Kandung" <?= set_value('status_penerima') == 'Ibu Kandung' ? 'selected' : ''; ?>>Ibu Kandung</option>
                        <option value="Saudara Kandung" <?= set_value('status_penerima') == 'Saudara Kandung' ? 'selected' : ''; ?>>Saudara Kandung</option>
                    </select>
                    <?= form_error('status_penerima', '<div class="text-danger small ml-3">', '</div>'); ?>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Username -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" value="<?= set_value('username'); ?>">
                    <?= form_error('username', '<div class="text-danger small ml-3">', '</div>'); ?>
                </div>
            </div>

            <!-- Password -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control">
                    <?= form_error('password', '<div class="text-danger small ml-3">', '</div>'); ?>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="reset" class="btn btn-secondary btn-sm">Reset</button>
            <button type="submit" class="btn btn-primary btn-sm">Register</button>
        </div>
    </form>
    </div>
  </div>
</div>

<script>
   document.querySelectorAll('.hapus').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault(); // Mencegah link agar tidak langsung dijalankan
            var url = this.getAttribute('href'); // Ambil URL dari atribut href
            Swal.fire({
                title: "Hapus Data?",
                text: "Data yang sudah dihapus tidak dapat dipulihkan kembali!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Hapus"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika konfirmasi, redirect ke URL penghapusan
                    window.location.href = url;
                }
            });
        });
    });
</script>

<script>
   document.querySelectorAll('.verifikasi').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault(); // Mencegah link agar tidak langsung dijalankan
            var url = this.getAttribute('href'); // Ambil URL dari atribut href
            Swal.fire({
                title: "Verifikasi Akun?",
                text: "",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Verifikasi"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika konfirmasi, redirect ke URL penghapusan
                    window.location.href = url;
                }
            });
        });
    });
</script>