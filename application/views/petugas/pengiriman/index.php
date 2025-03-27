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
							<th class="text-center">ID Pengiriman</th>
							<th class="text-center">Nama Penerima</th>
							<th class="text-center">Nama Bantuan</th>
							<th class="text-center">Jenis Bantuan</th>
							<th class="text-center">Tanggal Pengiriman</th>
							<th class="text-center">Lokasi Pengiriman</th>
							<th class="text-center">Jumlah Pengiriman</th>
							<th class="text-center">Status</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($pengiriman as $value) : ?>
							<tr class = "text-center">
								<td class="text-center"><?= $no++ ?></td>
								<td><?= $value->id_pengiriman ?></td>
								<td><?= $value->nama ?></td>
								<td><?= $value->nm_bantuan ?></td>
								<td><?= $value->jenis_bantuan ?></td>
								<td><?= do_formal_date($value->tgl_pengiriman) ?></td>
								<td><?= $value->lokasi_pengiriman ?></td>
								<td><?= $value->jml_pengiriman ?></td>
								<td>
                                    <?php if($value->status_pengiriman == 'Dikirim'): ?>
                                        <a class="badge badge-warning">Dikirim</a>
                                    <?php elseif($value->status_pengiriman == 'Diterima'): ?>
                                        <a class="badge badge-success">Diterima</a>
                                    <?php endif; ?>
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
        <h5 class="modal-title" id="exampleModalLabel">Form Kirim Bantuan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        	<span area-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="<?= base_url('petugas/pengiriman/add') ?>" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Nama Penerima</label>
                    <select name="id_penerima" id="id_penerima" class="form-control" required>
                        <option value="">--Pilih Penerima--</option>
                        <?php foreach($penerima as $val): ?>
                            <option value="<?= $val->id_penerima ?>"><?= $val->nama ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label>Jenis Bantuan</label>
                    <select name="id_pengambilan" id="id_pengambilan" class="form-control" required>
                        <option value="">--Pilih Jenis Bantuan--</option>
                        <?php foreach($pengambilan as $val): ?>
                            <option value="<?= $val->id_pengambilan ?>"><?= $val->jenis_bantuan ?> - Bantuan khusus <?= $val->status ?>  ( Exp. <?= do_formal_date($val->tgl_kadaluarsa) ?> )</option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Lokasi Pengiriman</label>
                    <input type="text" name="lokasi_pengiriman" id="lokasi_pengiriman" class="form-control" value="<?= set_value('lokasi_pengiriman'); ?>">
                    <?= form_error('lokasi_pengiriman', '<div class="text-danger small ml-3">', '</div>'); ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Jumlah Pengiriman</label>
                    <input type="number" name="jml_pengiriman" id="jml_pengiriman" class="form-control" value="<?= set_value('jml_pengiriman'); ?>">
                    <?= form_error('jml_pengiriman', '<div class="text-danger small ml-3">', '</div>'); ?>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="reset" class="btn btn-secondary btn-sm">Reset</button>
            <button type="submit" class="btn btn-primary btn-sm">Kirim</button>
        </div>
    </form>
    </div>
  </div>
</div>