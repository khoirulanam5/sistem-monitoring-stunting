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
							<th class="text-center">ID Pengambilan<br>Bantuan</th>
							<th class="text-center">ID Stok FIFO</th>
                            <th class="text-center">Nama Bantuan</th>
                            <th class="text-center">Jenis Bantuan</th>
                            <th class="text-center">Jumlah Pengambilan</th>
                            <th class="text-center">Tanggal Pengambilan</th>
							<th class="text-center">AKSI</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($pengambilan_bantuan as $value) : ?>
							<tr class = "text-center">
								<td class="text-center"><?= $no++ ?></td>
								<td><?= $value->id_pengambilan ?></td>
								<td><?= $value->id_stok_fifo ?></td>
                                <td><?= $value->nm_bantuan ?></td>
                                <td><?= $value->jenis_bantuan ?></td>
                                <td><?= $value->jml_pengambilan ?></td>
                                <td><?= do_formal_date($value->tgl_pengambilan) ?></td>
								<td>
                                    <a class="btn btn-sm btn-primary m-1" href="<?= base_url('petugas/pengambilan/detail/'.$value->id_pengambilan) ?>"><i class="fas fa-eye fa-sm"></i></a>
                                    <a class="btn btn-danger btn-sm m-1 hapus" href="<?= base_url('petugas/pengambilan/delete/'.$value->id_pengambilan) ?>"><i class="fas fa-trash"></i></a>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pengambilan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        	<span area-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="<?= base_url('petugas/pengambilan/add') ?>" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Jenis Bantuan</label>
                    <select name="id_stok_fifo" id="id_stok_fifo" class="form-control" required>
                        <option value="">Pilih Jenis Bantuan</option>
                        <?php foreach($stok as $val): ?>
                            <option value="<?= $val->id_stok_fifo ?>"><?= $val->jenis_bantuan ?> - Bantuan khusus <?= $val->status ?> ( Exp. <?= do_formal_date($val->tgl_kadaluarsa) ?> )</option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label>Jumlah Pengambilan dari Stok FIFO</label>
                    <input type="number" name="jml_pengambilan" id="jml_pengambilan" class="form-control" value="<?= set_value('jml_pengambilan'); ?>">
                    <?= form_error('jml_pengambilan', '<div class="text-danger small ml-3">', '</div>'); ?>
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