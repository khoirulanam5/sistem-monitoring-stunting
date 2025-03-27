<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Bantuan Terdistribusi</title>
    <link rel="shortcut icon" href="<?= base_url('assets/logo.png') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
        body {
            margin: 30px;
            margin-top: 70px;
            margin-left: 50px;
            margin-right: 50px;
            font-family: Arial, sans-serif;
        }
        @media print {
            .no-print {
                display: none;
            }
        }
        .header-container {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .header-logo {
            height: 100px;
        }
        .header-text {
            text-align: center;
            width: 100%;
            margin: 0; /* Hilangkan margin default */
            padding: 1px; /* Tambahkan padding kecil jika diperlukan */
            line-height: 0.6; /* Kurangi jarak antar baris */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        .signature {
            text-align: left;
            margin-top: 50px;
            margin-left: auto; /* Secara default, biarkan di tengah */
            width: fit-content;
        }

        @media print and (orientation: portrait) {
            .signature {
                margin-left: 450px; /* Margin khusus untuk mode potret */
            }
        }

        @media print and (orientation: landscape) {
            .signature {
                margin-left: 680px; /* Margin khusus untuk mode lanskap */
            }
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <div class="header-container">
        <div>
            <img src="<?= base_url('assets/logo.png') ?>" alt="Logo" class="header-logo">
        </div>
        <div class="header-text">
            <h2><b>PEMERINTAH DESA MEGAWON</b></h2>
            <h1><b>BANTUAN BALITA STUNTING</b></h1>
            <p>Alamat: Desa Megawon, Kecamatan Jati, Kabupaten Kudus Jawa Tengah</p>
        </div>
    </div>
    <hr style="border: 2px solid black;">
    
    <!-- Content Section -->
    <table class="table table-striped table-bordered" id="dataTable">
					<thead>
						<tr>
							<th class="text-center">No.</th>
							<th class="text-center">Nama Penerima</th>
							<th class="text-center">Status Penerima</th>
							<th class="text-center">Nama Bantuan</th>
							<th class="text-center">Jenis Bantuan</th>
							<th class="text-center">Lokasi</th>
							<th class="text-center">Jumlah</th>
							<th class="text-center">Tanggal Diterima</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($distribusi as $value) : ?>
							<tr class = "text-center">
								<td class="text-center"><?= $no++ ?></td>
								<td><?= $value->nama ?></td>
								<td><?= $value->status_penerima ?></td>
								<td><?= $value->nm_bantuan ?></td>
								<td><?= $value->jenis_bantuan ?></td>
								<td><?= $value->lokasi_pengiriman ?></td>
								<td><?= $value->jml_pengiriman ?></td>
								<td><?= do_formal_date($value->tgl_diterima) ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
    
    <!-- Signature Section -->
    <div class="signature">
        <?php foreach($user as $item): ?>
        <p style="text-align: left;">Kudus, <?= date('d F Y'); ?></p>
        <p style="text-align: left;"><b>KEPALA DESA</b></p>
        <br><br><br>
        <div style="text-align: left; display: inline-block;">
            <p><b><u><?= $item->nm_pengguna ?></u></b></p>
        </div>
        <?php endforeach; ?>
    </div>
    
    <script>
        window.print();
    </script>
</body>
</html>
