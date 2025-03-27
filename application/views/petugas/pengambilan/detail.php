<div class="container-fluid">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h3 class="h3 mb-0 text-gray-800"><i class="fas fa-book"></i> DETAIL BANTUAN</h3>
	</div>

	<div class="card">
	  <h5 class="card-header">Detail Bantuan</h5>
	  <div class="card-body">

	  	<?php foreach ($pengambilan_bantuan as $value) : ?>

	  	<div class="row">
	    <div class="col-md-12">
	    	<table class="table">
	    		<tr>
	    			<td>ID Pengambilan Bantuan</td>
	    			<td><strong>: <?php echo $value->id_pengambilan ?></strong></td>
	    		</tr>
	    		<tr>
	    			<td>ID Stok FIFO</td>
	    			<td><strong>: <?php echo $value->id_stok_fifo ?></strong></td>
	    		</tr>
	    		<tr>
	    			<td>Nama Bantuan</td>
	    			<td><strong>: <?php echo $value->nm_bantuan ?></strong></td>
	    		</tr>
	    		<tr>
	    			<td>Jenis Bantuan</td>
	    			<td><strong>: <?php echo $value->jenis_bantuan ?></strong></td>
	    		</tr>
	    		<tr>
	    			<td>Tanggal Masuk</td>
	    			<td><strong>: <?php echo do_formal_date($value->tgl_masuk) ?></strong></td>
	    		</tr>
	    		<tr>
	    			<td>Tanggal Kadaluarsa</td>
	    			<td><strong>: <?php echo do_formal_date($value->tgl_kadaluarsa) ?></strong></td>
	    		</tr>
	    		<tr>
	    			<td>Tanggal Keluar</td>
	    			<td><strong>: <?php echo do_formal_date($value->tgl_keluar) ?></strong></td>
	    		</tr>
	    		<tr>
	    			<td>Jumlah Stok FIFO</td>
	    			<td><strong>: <?= $value->jml_stok ?></strong></td>
	    		</tr>
	    		<tr>
	    			<td>Jumlah Pengambilan</td>
	    			<td><strong>: <?= $value->jml_pengambilan ?></strong></td>
	    		</tr>
	    		<tr>
	    			<td>Tanggal Pengambilan</td>
	    			<td><strong>: <?= do_formal_date($value->tgl_pengambilan) ?></strong></td>
	    		</tr>
	    	</table>

			<div align="left">
				<a class="btn btn-sm btn-primary" href="<?= base_url('petugas/pengambilan/') ?>">Kembali</a>
			</div>

	    </div>

	  	</div>
	    
		<?php endforeach; ?>
	  </div>
	</div>

</div>