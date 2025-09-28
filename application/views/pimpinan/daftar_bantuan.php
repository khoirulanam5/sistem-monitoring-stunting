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
							<th class="text-center">ID Daftar Bantuan</th>
							<th class="text-center">Nama Bantuan</th>
              <th class="text-center">Jenis Bantuan</th>
              <th class="text-center">Jumlah Anggaran</th>
							<th class="text-center">AKSI</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($daftar_bantuan as $value) : ?>
							<tr class = "text-center">
								<td class="text-center"><?= $no++ ?></td>
								<td><?= $value->id_bantuan ?></td>
								<td><?= $value->nm_bantuan ?></td>
                <td><?= $value->jenis_bantuan ?></td>
                <td><?= rp($value->anggaran) ?></td>
								<td>
                <button class="btn btn-sm btn-primary m-1" data-toggle="modal" data-target="#edit<?= $value->id_bantuan ?>"><i class="fas fa-edit fa-sm"></i></button>
                <a class="btn btn-danger btn-sm m-1 hapus" href="<?= base_url('pimpinan/daftar_bantuan/delete/'.$value->id_bantuan) ?>"><i class="fas fa-trash"></i></a>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Daftar Bantuan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        	<span area-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('pimpinan/daftar_bantuan/add') ?>" method="post" enctype="multipart/form-data">
        	<div class="form-group">
        		<label>Nama Bantuan</label>
        		<input type="text" name="nm_bantuan" id="nm_bantuan" class="form-control" required>
        	</div>
            <div class="form-group">
        		<label>Jenis Bantuan</label>
        		<input type="text" name="jenis_bantuan" id="jenis_bantuan" class="form-control" required>
        	</div>
            <div class="form-group">
        		<label>Anggaran Bantuan</label>
        		<input type="number" name="anggaran" id="anggaran" class="form-control" required>
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

<?php foreach ($daftar_bantuan as $value): ?>
<div class="modal fade" id="edit<?= $value->id_bantuan ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Daftar Bantuan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        	<span area-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('pimpinan/daftar_bantuan/edit/' . $value->id_bantuan) ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Nama Bantuan</label>
                    <input type="text" name="nm_bantuan" id="nm_bantuan" class="form-control" value="<?= $value->nm_bantuan ?>" required>
                </div>
                <div class="form-group">
                    <label>Jenis Bantuan</label>
                    <input type="text" name="jenis_bantuan" id="jenis_bantuan" class="form-control" value="<?= $value->jenis_bantuan ?>" required>
                </div>
                <div class="form-group">
                    <label>Anggaran Bantuan</label>
                    <input type="number" name="anggaran" id="anggaran" class="form-control" value="<?= $value->anggaran ?>" required>
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