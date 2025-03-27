<div class="container-fluid">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h3 class="h3 mb-0 text-gray-800"><b><?= $title?></b></h3>
	</div>
	<?= $this->session->flashdata('pesan') ?>
	<div class="card shadow">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-striped table-bordered" id="dataTable">
				<div align="right">
					<a class="btn btn-sm btn-primary mb-3 col-md-2" target="_blank" href="<?= base_url('pimpinan/laporan/cetak') ?>"><i class="fas fa-print fa-sm"></i> Cetak</a>
				</div>
					<thead>
						<tr>
							<th class="text-center">No.</th>
							<th class="text-center">Nama Penerima</th>
							<th class="text-center">Nama Bantuan</th>
							<th class="text-center">Jenis Bantuan</th>
							<th class="text-center">Tanggal Pengiriman</th>
							<th class="text-center">Lokasi Pengiriman</th>
							<th class="text-center">Jumlah Pengiriman</th>
							<th class="text-center">AKSI</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($distribusi as $value) : ?>
							<tr class = "text-center">
								<td class="text-center"><?= $no++ ?></td>
								<td><?= $value->nama ?></td>
								<td><?= $value->nm_bantuan ?></td>
								<td><?= $value->jenis_bantuan ?></td>
								<td><?= do_formal_date($value->tgl_pengiriman) ?></td>
								<td><?= $value->lokasi_pengiriman ?></td>
								<td><?= $value->jml_pengiriman ?></td>
								<td>
									<a class="btn btn-sm btn-primary m-1" href="<?= base_url('pimpinan/laporan/detail/'.$value->id_pengiriman) ?>"><i class="fas fa-eye fa-sm"></i></a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>