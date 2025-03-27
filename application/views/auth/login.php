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
<body class="bg-gradient-white" style="background-color: #83A6CE;">
    <div class="container">
        <?= $this->session->flashdata('pesan') ?>
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-1">MONITORING STUNTING</h1>
                                        <p>Desa Megawon, Kecamatan Jati, Kabupaten Kudus, Jawa Tengah</p>
                                        <hr>
                                    </div>
                                    <form method="post" action="<?= base_url('auth/login') ?>">
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control" id="username" placeholder="Masukan Username Anda..." name="username">
                                            <?= form_error('username', '<div class="text-danger small ml-2">', '</div>') ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" placeholder="Masukan Password Anda..." name="password">
                                            <?= form_error('password', '<div class="text-danger small ml-2">', '</div>') ?>
                                        </div>
                                        <button type="submit" class="btn btn-primary col-md-3">Login</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?= base_url('auth/register') ?>">Belum Punya Akun?<strong> Daftar</strong></a>
                                    </div>
                                </div>
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