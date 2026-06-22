# Sistem Sales Order - PT Maju Jaya
## CodeIgniter 3 + SB Admin 2

### Cara Install
1. Import database: `database/sales_order.sql` ke phpMyAdmin
2. Copy folder ke `htdocs/` (XAMPP) atau `www/` (WAMP)
3. Sesuaikan konfigurasi database di `application/config/database.php`
4. Buka browser: `http://localhost/sales_order_app`

### Akun Default
| Role    | Username | Password   |
|---------|----------|------------|
| Admin   | admin    | admin123   |
| Sales   | budi     | budi123    |
| Sales   | siti     | siti123    |
| Manager | hendra   | hendra123  |

### Hak Akses
- **Admin**: Kelola produk, pelanggan, semua order, update status, laporan
- **Sales**: Buat & lihat order miliknya sendiri
- **Manager**: Lihat semua order, laporan penjualan

### Fitur
- Login & manajemen session per role
- CRUD Produk (kode, nama, harga, stok)
- CRUD Pelanggan (nama, alamat, telepon)
- Sales Order dengan multi-produk, hitung otomatis
- Status order: Draft → Dikirim → Selesai / Dibatalkan
- Laporan: per sales, per produk, per periode
- Export PDF (via print browser)

### Struktur File Utama
```
application/
├── controllers/
│   ├── auth.php          (Login/Logout)
│   ├── dashboard.php     (Dashboard)
│   ├── produk.php        (Master Produk)
│   ├── pelanggan.php     (Master Pelanggan)
│   ├── sales_order.php   (Transaksi Order)
│   └── laporan.php       (Laporan)
├── models/
│   ├── auth_model.php
│   ├── Produk_model.php
│   ├── Pelanggan_model.php
│   └── SalesOrder_model.php
├── views/
│   ├── auth/login.php
│   ├── templates/ (header, sidebar, topbar, footer)
│   ├── dashboard/index.php
│   ├── produk/ (index, tambah, edit)
│   ├── pelanggan/ (index, tambah, edit)
│   ├── sales_order/ (index, tambah, edit, detail)
│   └── laporan/ (penjualan, cetak_pdf)
└── core/
    └── MY_Controller.php (Base controller dengan auth check)
```
