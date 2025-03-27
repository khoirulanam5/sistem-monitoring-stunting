<div class="container-fluid">
    <div class="row">
        <?= $this->session->flashdata('pesan') ?>
        
        <!-- Card untuk Data Stok FIFO -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Data Stok FIFO</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $stok ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card untuk Daftar Bantuan -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Daftar Bantuan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $daftar_bantuan ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card untuk Uang Masuk -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Distribusi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $distribusi ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hand-holding-medical fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card untuk Daftar Penerima -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Daftar Penerima</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $penerima ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Selamat Datang -->
    <div class="col-xl-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <center>
                    <h4 class="header-title">Selamat Datang <?= $this->session->userdata('nm_pengguna'); ?> di Sistem Monitoring Stunting Pada Desa Megawon.</h4>
                    <p class="text-muted">Anda dapat melakukan pekerjaan anda sesuai dengan jabatan <?= $this->session->userdata('level'); ?> </p>
                </center>
            </div>
        </div>
    </div>

    <!-- Card Monitoring Data Stunting -->
    <div class="col-xl-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title text-center">Monitoring Data Stunting</h4>
                <canvas id="stuntingChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data manual yang digunakan untuk chart
    const dataLabels = ['2021', '2022', '2023', '2024']; // Tahun sebagai label
    const dataValues = [58, 99, 112, 103]; // Jumlah kasus stunting untuk tiap tahun

    const ctx = document.getElementById('stuntingChart').getContext('2d');
    const stuntingChart = new Chart(ctx, {
        type: 'bar', // Tipe chart (Bar Chart)
        data: {
            labels: dataLabels, // Menggunakan data labels (tahun)
            datasets: [{
                label: 'Jumlah Data Stunting', // Label untuk dataset
                data: dataValues, // Data jumlah stunting per tahun
                backgroundColor: 'rgb(75, 192, 192)', // Warna latar belakang
                borderColor: 'rgb(75, 192, 192)', // Warna border
                borderWidth: 1 // Ketebalan border
            }]
        },
        options: {
            responsive: true, // Responsif
            plugins: {
                legend: {
                    display: true, // Menampilkan legend
                    position: 'top' // Posisi legend
                }
            },
            scales: {
                y: {
                    beginAtZero: true // Sumbu Y dimulai dari nol
                }
            }
        }
    });
</script>
