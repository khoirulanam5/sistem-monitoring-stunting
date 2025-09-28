<div class="container-fluid">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h3 class="h3 mb-0 text-gray-800"><b><?= $title ?></b></h3>
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
							<th class="text-center">ID Stok</th>
							<th class="text-center">Jenis Bantuan</th>
              <th class="text-center">Harga</th>
              <th class="text-center">Tanggal Masuk</th>
              <th class="text-center">Tanggal Kadaluarsa</th>
              <th class="text-center">Update Tanggal Barang Keluar</th>
              <th class="text-center">Jumlah Stok</th>
							<th class="text-center">AKSI</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($stok as $value) : ?>
							<tr class = "text-center">
								<td class="text-center"><?= $no++ ?></td>
								<td><?= $value->id_stok_fifo ?></td>
								<td><?= $value->jenis_bantuan ?></td>
                <td><?= rp($value->harga) ?></td>
                <td><?= do_formal_date($value->tgl_masuk) ?></td>
                <td><?= do_formal_date($value->tgl_kadaluarsa) ?></td>
                <td>
									<?php if($value->tgl_keluar == NULL): ?>
										<span>Barang belum keluar</span>
									<?php elseif($value->tgl_keluar): ?>
										<?= do_formal_date($value->tgl_keluar) ?>
									<?php endif; ?>
								</td>
                <td><?= $value->jml_stok ?></td>
								<td>
                <a class="btn btn-danger btn-sm m-1 hapus" href="<?= base_url('admin/stok/delete/'.$value->id_stok_fifo) ?>"><i class="fas fa-trash"></i></a>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Stok FIFO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        	<span area-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('admin/stok/add') ?>" method="post" enctype="multipart/form-data">
        	<div class="form-group">
        		<label>Jenis Bantuan</label>
                <select class="form-control" name="id_bantuan" id="id_bantuan" required>
                    <option value="">--Pilih Jenis Bantuan--</option>
                    <?php foreach($jenis as $value): ?>
                        <option value="<?= $value->id_bantuan ?>"><?= $value->jenis_bantuan ?> - (<?= $value->status ?>)</option>
                    <?php endforeach; ?>
                </select>
        	</div>
            <div class="form-group">
        		<label>Harga</label>
        		<input type="number" name="harga" id="harga" class="form-control" required>
        	</div>
            <div class="form-group">
        		<label>Tanggal Kadaluarsa</label>
        		<input type="date" name="tgl_kadaluarsa" id="tgl_kadaluarsa" class="form-control" required>
        	</div>
            <div class="form-group">
        		<label>Jumlah</label>
        		<input type="number" name="jml_stok" id="jml_stok" class="form-control" required>
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