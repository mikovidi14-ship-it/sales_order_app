-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Jun 2026 pada 13.52
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sales_order`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_order`
--

CREATE TABLE `detail_order` (
  `id` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL DEFAULT 1,
  `harga_satuan` decimal(15,2) NOT NULL,
  `subtotal` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_order`
--

INSERT INTO `detail_order` (`id`, `id_order`, `id_produk`, `jumlah`, `harga_satuan`, `subtotal`) VALUES
(1, 1, 7, 1, '6000000.00', '6000000.00'),
(2, 1, 5, 1, '1350000.00', '1350000.00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `alamat` text DEFAULT NULL,
  `no_telepon` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama_pelanggan`, `alamat`, `no_telepon`, `created_at`) VALUES
(1, 'PT Teknologi Maju', 'Jl. Sudirman No. 10, Jakarta', '021-5551234', '2026-06-06 12:57:57'),
(2, 'CV Berkah Jaya', 'Jl. Gatot Subroto No. 25, Bandung', '022-5552345', '2026-06-06 12:57:57'),
(3, 'Toko Elektronik Sejahtera', 'Jl. Malioboro No. 5, Yogyakarta', '0274-5553456', '2026-06-06 12:57:57'),
(4, 'PT ARTINDO ', 'JL. CADAS , mekar jaya, TANGERANG', '085781021758', '2026-06-09 16:08:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `kode_produk` varchar(20) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga` decimal(15,2) NOT NULL DEFAULT 0.00,
  `stok` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id`, `kode_produk`, `nama_produk`, `harga`, `stok`, `created_at`) VALUES
(1, 'PRD001', 'Laptop ASUS VivoBook 14', '8500000.00', 10, '2026-06-06 12:57:57'),
(2, 'PRD002', 'Monitor Samsung 24\"', '2200000.00', 20, '2026-06-06 12:57:57'),
(3, 'PRD003', 'Keyboard Logitech K380', '450000.00', 50, '2026-06-06 12:57:57'),
(4, 'PRD004', 'Mouse Wireless Logitech M235', '250000.00', 75, '2026-06-06 12:57:57'),
(5, 'PRD005', 'Printer Canon PIXMA', '1350000.00', 15, '2026-06-06 12:57:57'),
(6, 'PRD006', 'Headset Sony WH-1000XM4', '3200000.00', 8, '2026-06-06 12:57:57'),
(7, '1245', 'IPHONE 11 PRO MAX', '6000000.00', 100, '2026-06-09 16:07:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sales_order`
--

CREATE TABLE `sales_order` (
  `id` int(11) NOT NULL,
  `no_order` varchar(20) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_sales` int(11) NOT NULL,
  `tanggal_order` date NOT NULL,
  `total_harga` decimal(15,2) NOT NULL DEFAULT 0.00,
  `status` enum('draft','dikirim','selesai','dibatalkan') NOT NULL DEFAULT 'draft',
  `catatan` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `sales_order`
--

INSERT INTO `sales_order` (`id`, `no_order`, `id_pelanggan`, `id_sales`, `tanggal_order`, `total_harga`, `status`, `catatan`, `created_at`) VALUES
(1, 'SO-20260001', 4, 1224160001, '2026-06-10', '7350000.00', 'selesai', '', '2026-06-09 16:11:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('admin','sales','manager') NOT NULL DEFAULT 'sales',
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `role`, `last_login`) VALUES
(1224160001, 'admin', 'Admin', '0192023a7bbd73250516f069df18b500', 'admin', '2026-06-10 10:27:01');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_order`
--
ALTER TABLE `detail_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_order` (`id_order`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_produk` (`kode_produk`);

--
-- Indeks untuk tabel `sales_order`
--
ALTER TABLE `sales_order`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_order` (`no_order`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_sales` (`id_sales`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_order`
--
ALTER TABLE `detail_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `sales_order`
--
ALTER TABLE `sales_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1224160002;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_order`
--
ALTER TABLE `detail_order`
  ADD CONSTRAINT `fk_detail_order` FOREIGN KEY (`id_order`) REFERENCES `sales_order` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_detail_produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`);

--
-- Ketidakleluasaan untuk tabel `sales_order`
--
ALTER TABLE `sales_order`
  ADD CONSTRAINT `fk_so_pelanggan` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id`),
  ADD CONSTRAINT `fk_so_sales` FOREIGN KEY (`id_sales`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
