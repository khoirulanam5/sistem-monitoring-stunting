<div class="container-fluid">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h3 class="h3 mb-0 text-gray-800"><i class="fas fa-book"></i> DETAIL BANTUAN</h3>
	</div>

	<div class="card">
	  <h5 class="card-header">Detail Bantuan Terdistribusi</h5>
	  <div class="card-body">

	  	<?php foreach ($distribusi as $value) : ?>

	  	<div class="row">
	    <div class="col-md-12">
	    	<table class="table">
	    		<tr>
	    			<td>ID Pengiriman Bantuan</td>
	    			<td><strong>: <?php echo $value->id_pengiriman ?></strong></td>
	    		</tr>
	    		<tr>
	    			<td>ID Penerima Bantuan</td>
	    			<td><strong>: <?php echo $value->id_penerima ?></strong></td>
	    		</tr>
	    		<tr>
	    			<td>Nama Penerima Bantuan</td>
	    			<td><strong>: <?php echo $value->nama ?></strong></td>
	    		</tr>
	    		<tr>
	    			<td>Umur Penerima Bantuan</td>
	    			<td><strong>: <?php echo $value->umur ?></strong></td>
	    		</tr>
	    		<tr>
	    			<td>Status Penerima Bantuan</td>
	    			<td><strong>: <?php echo $value->status_penerima ?></strong></td>
	    		</tr>
	    		<tr>
	    			<td>Jenis Pekerjaan</td>
	    			<td><strong>: <?php echo $value->jenis_pekerjaan ?></strong></td>
	    		</tr>
	    		<tr>
	    			<td>No. Telp</td>
	    			<td><strong>: <?php echo $value->no_hp ?></strong></td>
	    		</tr>
	    		<tr>
	    			<td>Alamat</td>
	    			<td><strong>: <?= $value->alamat ?></strong></td>
	    		</tr>
	    		<tr>
	    			<td>Nama Bantuan</td>
	    			<td><strong>: <?= $value->nm_bantuan ?></strong></td>
	    		</tr>
	    		<tr>
	    			<td>Jenis Bantuan</td>
	    			<td><strong>: <?= $value->jenis_bantuan ?></strong></td>
	    		</tr>
				<tr>
					<td>Jumlah Bantuan</td>
					<td><strong>: <?= $value->jml_pengiriman ?></strong></td>
				</tr>
	    		<tr>
	    			<td>Lokasi Distribusi</td>
	    			<td><strong>: <?= $value->lokasi_pengiriman ?></strong></td>
	    		</tr>
	    		<tr>
	    			<td>Tanggal Pengiriman</td>
	    			<td><strong>: <?= do_formal_date($value->tgl_pengiriman) ?></strong></td>
	    		</tr>
	    		<tr>
	    			<td>Status</td>
	    			<td><strong>:
						<?php if($value->status_pengiriman == 'Dikirim'): ?>
							<a class="badge badge-primary konfirmasi" href="<?= base_url('penerima/distribusi/konfirmasi/' . $value->id_pengiriman) ?>">Konfirmasi Bantuan Telah Diterima</a>
						<?php elseif($value->status_pengiriman == 'Diterima'): ?>
							<a class="badge badge-success">Bantuan diterima</a>
						<?php endif; ?>
					</strong></td>
	    		</tr>
	    	</table>

			<div align="left">
				<a class="btn btn-sm btn-primary" href="<?= base_url('pimpinan/laporan/') ?>">Kembali</a>
			</div>

	    </div>

	  	</div>
	    
		<?php endforeach; ?>
	  </div>
	</div>

</div>