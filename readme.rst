# 📊 Sistem Informasi Manajemen Monitoring Data Stunting  
### 🚼 Dengan Fitur Metode FIFO untuk Monitoring Inventory Pembagian Makanan

Sistem ini dirancang untuk membantu instansi dalam melakukan monitoring data stunting serta mengelola distribusi makanan menggunakan metode **FIFO (First In First Out)**. Dengan fitur pencatatan penerima, stok makanan, serta pelaporan untuk pimpinan, sistem ini membantu proses pendistribusian agar lebih tepat, efisien, dan terkontrol.

---

## 🚀 Fitur Utama

### 🔐 Role & Hak Akses
- **Admin**
  - Mengelola data pengguna
  - Mengelola data penerima
  - Mengelola stok makanan (FIFO)
  - Mengelola data petugas
  - Mengakses semua laporan
- **Petugas**
  - Input data pembagian makanan
  - Melakukan update stok sesuai FIFO
  - Melihat data penerima
- **Penerima**
  - Melihat informasi jadwal & riwayat penerimaan makanan
- **Pimpinan**
  - Melihat laporan lengkap
  - Dashboard statistik stunting & distribusi makanan

---

## 🧮 Implementasi Metode FIFO
Metode FIFO digunakan untuk memastikan stok makanan yang lebih awal masuk akan digunakan lebih dulu. Sistem mengatur:
- Urutan stok berdasarkan tanggal masuk
- Validasi stok sebelum transaksi
- Pengurangan otomatis berdasarkan urutan FIFO

---

## 🖥️ Teknologi yang Digunakan

| Komponen     | Teknologi |
|--------------|-----------|
| Backend      | CodeIgniter 3 |
| Database     | MySQL |
| Frontend     | HTML, CSS, JavaScript, Bootstrap |
| Arsitektur   | MVC |

---

## 📦 Modul Sistem

### 📁 Data Master
- Data penerima
- Data user & role
- Data petugas
- Data kategori makanan
- Data stok makanan (FIFO)

### 🍱 Distribusi Makanan
- Input distribusi
- Validasi stok otomatis
- Riwayat pembagian

### 📊 Dashboard & Laporan
- Grafik status stunting
- Distribusi makanan per periode
- Sisa stok makanan
- Export laporan (opsional)

---

## 🛠️ Instalasi

1. **Clone repository**
   ```bash
   git clone https://github.com/username/repo.git
