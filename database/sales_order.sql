-- Database: db_sales_order
-- Sistem Sales Order PT Maju Jaya

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
SET NAMES utf8mb4;

CREATE DATABASE IF NOT EXISTS `db_sales_order` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `db_sales_order`;

-- Tabel users (Admin, Sales, Manager)
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('admin','sales','manager') NOT NULL DEFAULT 'sales',
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel produk
CREATE TABLE `produk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_produk` varchar(20) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga` decimal(15,2) NOT NULL DEFAULT 0,
  `stok` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode_produk` (`kode_produk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel pelanggan
CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pelanggan` varchar(100) NOT NULL,
  `alamat` text,
  `no_telepon` varchar(20),
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel sales_order (header)
CREATE TABLE `sales_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_order` varchar(20) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_sales` int(11) NOT NULL,
  `tanggal_order` date NOT NULL,
  `total_harga` decimal(15,2) NOT NULL DEFAULT 0,
  `status` enum('draft','dikirim','selesai','dibatalkan') NOT NULL DEFAULT 'draft',
  `catatan` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `no_order` (`no_order`),
  KEY `id_pelanggan` (`id_pelanggan`),
  KEY `id_sales` (`id_sales`),
  CONSTRAINT `fk_so_pelanggan` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id`),
  CONSTRAINT `fk_so_sales` FOREIGN KEY (`id_sales`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel detail_order
CREATE TABLE `detail_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_order` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL DEFAULT 1,
  `harga_satuan` decimal(15,2) NOT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_order` (`id_order`),
  KEY `id_produk` (`id_produk`),
  CONSTRAINT `fk_detail_order` FOREIGN KEY (`id_order`) REFERENCES `sales_order` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_detail_produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Data awal users
INSERT INTO `users` (`nama`, `username`, `password`, `role`) VALUES
('Administrator', 'admin', MD5('admin123'), 'admin'),
('Budi Santoso', 'budi', MD5('budi123'), 'sales'),
('Siti Rahayu', 'siti', MD5('siti123'), 'sales'),
('Hendra Wijaya', 'hendra', MD5('hendra123'), 'manager');

-- Data awal produk
INSERT INTO `produk` (`kode_produk`, `nama_produk`, `harga`, `stok`) VALUES
('PRD001', 'Laptop ASUS VivoBook 14', 8500000, 10),
('PRD002', 'Monitor Samsung 24"', 2200000, 20),
('PRD003', 'Keyboard Logitech K380', 450000, 50),
('PRD004', 'Mouse Wireless Logitech M235', 250000, 75),
('PRD005', 'Printer Canon PIXMA', 1350000, 15),
('PRD006', 'Headset Sony WH-1000XM4', 3200000, 8);

-- Data awal pelanggan
INSERT INTO `pelanggan` (`nama_pelanggan`, `alamat`, `no_telepon`) VALUES
('PT Teknologi Maju', 'Jl. Sudirman No. 10, Jakarta', '021-5551234'),
('CV Berkah Jaya', 'Jl. Gatot Subroto No. 25, Bandung', '022-5552345'),
('Toko Elektronik Sejahtera', 'Jl. Malioboro No. 5, Yogyakarta', '0274-5553456');

COMMIT;
