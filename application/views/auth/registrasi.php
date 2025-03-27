<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Monitoring Stunting</title>
    <link rel="shortcut icon" href="<?= base_url('assets/logo.png') ?>">
    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url() ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url() ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gradient-primary">

    <div class="container">

        <?= $this->session->flashdata('pesan') ?>
        <div class="card o-hidden border-3 shadow-lg col-lg-9 my-5 mx-auto">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Registrasi Akun</h1>
                            </div>
                            <hr>
                            <form method="post" action="<?= base_url('auth/register') ?>" enctype="multipart/form-data">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="nama">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="nama" placeholder="Nama Anda" name="nama" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="nm_pengguna">Nama Panggilan</label>
                                        <input type="text" class="form-control" id="nm_pengguna" placeholder="Nama Panggilan" name="nm_pengguna" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="umur">Umur Wali / Ortu</label>
                                        <input type="number" class="form-control" id="umur" placeholder="Umur Wali / Ortu" name="umur" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" class="form-control" id="alamat" placeholder="Alamat" name="alamat" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="no_hp">No. HP</label>
                                        <input type="text" class="form-control" id="no_hp" placeholder="No. HP" name="no_hp" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="jenis_pekerjaan">Jenis Pekerjaan</label>
                                        <input type="text" class="form-control" id="jenis_pekerjaan" placeholder="Jenis Pekerjaan" name="jenis_pekerjaan" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="status_penerima">Status Penerima</label>
                                        <select name="status_penerima" class="form-control">
                                            <option value="">-- Pilih Status Penerima --</option>
                                            <option value="Bapak Kandung" <?= set_value('status_penerima') == 'Bapak Kandung' ? 'selected' : ''; ?>>Bapak Kandung</option>
                                            <option value="Ibu Kandung" <?= set_value('status_penerima') == 'Ibu Kandung' ? 'selected' : ''; ?>>Ibu Kandung</option>
                                            <option value="Saudara Kandung" <?= set_value('status_penerima') == 'Saudara Kandung' ? 'selected' : ''; ?>>Saudara Kandung</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="nm_balita">Nama Balita</label>
                                        <input type="text" class="form-control" id="nm_balita" placeholder="Nama Balita" name="nm_balita" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="umur_balita">Umur Balita</label>
                                        <input type="text" class="form-control" id="umur_balita" placeholder="Umur Balita" name="umur_balita" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="jenis_kelamin">Jenis Kelamin</label>
                                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                            <option value="">-- Pilih Jenis Kelamin --</option>
                                            <option value="Pria">Pria</option>
                                            <option value="Wanita">Wanita</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="tb">Tinggi Badan</label>
                                        <input type="number" class="form-control" id="tb" placeholder="Tinggi Badan (cm)" name="tb" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="bb">Berat Badan</label>
                                        <input type="number" class="form-control" id="bb" placeholder="Berat Badan (kg)" name="bb" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="ktp">Upload KTP</label>
                                        <input type="file" class="form-control" id="ktp" name="ktp" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="kk">Upload KK</label>
                                        <input type="file" class="form-control" id="kk" name="kk" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="tgl_pendataan">Tanggal Pendataan</label>
                                        <input type="date" class="form-control" id="tgl_pendataan" name="tgl_pendataan" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="status_stunting">Status Stunting</label>
                                        <select name="status_stunting" id="status_stunting" class="form-control">
                                            <option value="Normal (Tidak Stunting)" <?= set_value('status_stunting') == 'Normal (Tidak Stunting)' ? 'selected' : ''; ?>>Normal (Tidak Stunting)</option>
                                            <option value="Stunting Ringan" <?= set_value('status_stunting') == 'Stunting Ringan' ? 'selected' : ''; ?>>Stunting Ringan</option>
                                            <option value="Stunting Sedang" <?= set_value('status_stunting') == 'Stunting Sedang' ? 'selected' : ''; ?>>Stunting Sedang</option>
                                            <option value="Stunting Berat" <?= set_value('status_stunting') == 'Stunting Berat' ? 'selected' : ''; ?>>Stunting Berat</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary col-md-3">Daftar</button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="<?= base_url('auth/login') ?>">Sudah Punya Akun? <strong>Silakan Login!</strong></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>

</html>
<!-- Bootstrap core JavaScript-->
<script src="<?php echo base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url() ?>assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?php echo base_url() ?>assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?php echo base_url() ?>assets/js/demo/chart-area-demo.js"></script>
    <script src="<?php echo base_url() ?>assets/js/demo/chart-pie-demo.js"></script>

    <script src="<?php echo base_url() ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
  
    <script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "columnDefs": [{
                    "targets": [0, -1],
                    "className": 'text-center'
                },
                {
                    "targets": [-1],
                    "orderable": false
                }
            ]
        });
    });
    </script>

</body>

</html>