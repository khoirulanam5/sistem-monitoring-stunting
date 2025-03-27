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
							<th class="text-center">ID Balita<br>Stunting</th>
							<th class="text-center">Nama Wali<br>Penerima Bantuan</th>
                            <th class="text-center">Nama Balita</th>
                            <th class="text-center">Umur</th>
                            <th class="text-center">Jenis Kelamin</th>
                            <th class="text-center">Tinggi Badan</th>
                            <th class="text-center">Berat Badan</th>
                            <th class="text-center">Status Stunting</th>
                            <th class="text-center">Tanggal Pendataan</th>
							<th class="text-center">AKSI</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($stunting as $value) : ?>
							<tr class = "text-center">
								<td class="text-center"><?= $no++ ?></td>
								<td><?= $value->id_stunting ?></td>
								<td><?= $value->nama ?></td>
                                <td><?= $value->nm_balita ?></td>
                                <td><?= $value->umur_balita ?></td>
                                <td><?= $value->jenis_kelamin ?></td>
                                <td><?= $value->tb ?></td>
                                <td><?= $value->bb ?></td>
                                <td><?= $value->status_stunting ?></td>
                                <td><?= do_formal_date($value->tgl_pendataan) ?></td>
								<td>
                                    <button class="btn btn-sm btn-primary m-1" data-toggle="modal" data-target="#edit<?= $value->id_stunting ?>"><i class="fas fa-eye fa-sm"></i></button>
                                    <a class="btn btn-danger btn-sm m-1 hapus" href="<?= base_url('admin/stunting/delete/'.$value->id_stunting) ?>"><i class="fas fa-trash"></i></a>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Stunting</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        	<span area-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="<?= base_url('admin/stunting/add') ?>" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nama Wali (Penerima Bantuan)</label>
                    <select name="id_penerima" id="id_penerima" class="form-control" required>
                        <?php foreach($penerima as $val): ?>
                            <option value="<?= $val->id_penerima ?>"><?= $val->nama ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Nama Balita</label>
                    <input type="text" name="nm_balita" class="form-control" value="<?= set_value('nm_balita'); ?>">
                    <?= form_error('nm_balita', '<div class="text-danger small ml-3">', '</div>'); ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Umur Balita</label>
                    <input type="text" name="umur_balita" id="umur_balita" class="form-control" value="<?= set_value('umur_balita'); ?>">
                    <?= form_error('umur_balita', '<div class="text-danger small ml-3">', '</div>'); ?>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                        <option value="Pria" <?= set_value('jenis_kelamin') == 'Pria' ? 'selected' : ''; ?>>Pria</option>
                        <option value="Wanita" <?= set_value('jenis_kelamin') == 'Wanita' ? 'selected' : ''; ?>>Wanita</option>
                    </select>
                    <?= form_error('jenis_kelamin', '<div class="text-danger small ml-3">', '</div>'); ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Tinggi Badan (cm)</label>
                    <input type="number" name="tb" id="tb" class="form-control" value="<?= set_value('tb'); ?>">
                    <?= form_error('tb', '<div class="text-danger small ml-3">', '</div>'); ?>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Berat Badan (kg)</label>
                    <input type="number" name="bb" id="bb" class="form-control" value="<?= set_value('bb'); ?>">
                    <?= form_error('bb', '<div class="text-danger small ml-3">', '</div>'); ?>
                </div>
            </div>
        </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>Status Stunting</label>
                    <select name="status_stunting" id="status_stunting" class="form-control">
                        <option value="Normal (Tidak Stunting)" <?= set_value('status_stunting') == 'Normal (Tidak Stunting)' ? 'selected' : ''; ?>>Normal (Tidak Stunting)</option>
                        <option value="Stunting Ringan" <?= set_value('status_stunting') == 'Stunting Ringan' ? 'selected' : ''; ?>>Stunting Ringan</option>
                        <option value="Stunting Sedang" <?= set_value('status_stunting') == 'Stunting Sedang' ? 'selected' : ''; ?>>Stunting Sedang</option>
                        <option value="Stunting Berat" <?= set_value('status_stunting') == 'Stunting Berat' ? 'selected' : ''; ?>>Stunting Berat</option>
                    </select>
                    <?= form_error('status_stunting', '<div class="text-danger small ml-3">', '</div>'); ?>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
    </div>
  </div>
</div>

<?php foreach ($stunting as $value): ?>
<div class="modal fade" id="edit<?= $value->id_stunting ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Stunting</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('admin/stunting/edit/' . $value->id_stunting) ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Wali (Penerima Bantuan)</label>
                        <select name="id_penerima" id="id_penerima" class="form-control" required>
                            <?php foreach($penerima as $val): ?>
                                <option value="<?= $val->id_penerima ?>" <?= ($val->id_penerima == $value->id_penerima) ? 'selected' : ''; ?>>
                                    <?= $val->nama ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Balita</label>
                        <input type="text" name="nm_balita" class="form-control" value="<?= $value->nm_balita; ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Umur Balita</label>
                        <input type="text" name="umur_balita" class="form-control" value="<?= $value->umur_balita; ?>">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control">
                            <option value="Pria" <?= ($value->jenis_kelamin == 'Pria') ? 'selected' : ''; ?>>Pria</option>
                            <option value="Wanita" <?= ($value->jenis_kelamin == 'Wanita') ? 'selected' : ''; ?>>Wanita</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tinggi Badan (cm)</label>
                        <input type="number" name="tb" class="form-control" value="<?= $value->tb; ?>">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Berat Badan (kg)</label>
                        <input type="number" name="bb" class="form-control" value="<?= $value->bb; ?>">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Status Stunting</label>
                <select name="status_stunting" class="form-control">
                    <option value="Normal (Tidak Stunting)" <?= ($value->status_stunting == 'Normal (Tidak Stunting)') ? 'selected' : ''; ?>>Normal (Tidak Stunting)</option>
                    <option value="Stunting Ringan" <?= ($value->status_stunting == 'Stunting Ringan') ? 'selected' : ''; ?>>Stunting Ringan</option>
                    <option value="Stunting Sedang" <?= ($value->status_stunting == 'Stunting Sedang') ? 'selected' : ''; ?>>Stunting Sedang</option>
                    <option value="Stunting Berat" <?= ($value->status_stunting == 'Stunting Berat') ? 'selected' : ''; ?>>Stunting Berat</option>
                </select>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php endforeach; ?>

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
