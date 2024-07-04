-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Jun 2024 pada 10.09
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `burjo`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(7, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `kode_menu` varchar(12) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `kategori` varchar(100) DEFAULT NULL,
  `status` enum('tersedia','tidak tersedia') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id_menu`, `kode_menu`, `nama`, `harga`, `kategori`, `status`) VALUES
(0, 'MN51', 'ayam kumlot', 14000, 'Makanan', 'tersedia'),
(1, 'MN01', 'Bebek Cabe Ijo', 40000, 'Makanan', 'tersedia'),
(2, 'MN02', 'Kerang Asam manis', 50000, 'Makanan', 'tersedia'),
(3, 'MN03', 'Gurame Saus Tauco', 25000, 'Makanan', 'tersedia'),
(4, 'MN04', 'Gurame Asam Manis', 30000, 'Makanan', 'tersedia'),
(5, 'MN05', 'Dendeng Balado', 35000, 'Makanan', 'tersedia'),
(6, 'MN06', 'Bebek Goreng Kelapa', 35000, 'Makanan', 'tersedia'),
(7, 'MN07', 'Balado Kerang Pedas', 45000, 'Makanan', 'tersedia'),
(8, 'MN08', 'Ayam Bakar Madu', 25000, 'Makanan', 'tersedia'),
(9, 'MN09', 'Nasi Goreng Sosis', 15000, 'Makanan', 'tersedia'),
(19, 'MN19', 'Molen Kacang Hijau', 5000, 'Snack', 'tersedia'),
(20, 'MN20', 'Kue Cubit', 10000, 'Snack', 'tersedia'),
(21, 'MN21', 'Otak2 Udang Keju', 15000, 'Snack', 'tersedia'),
(22, 'MN22', 'Donat Kentang', 15000, 'Snack', 'tersedia'),
(23, 'MN23', 'Siomay Bandung', 30000, 'Snack', 'tersedia'),
(24, 'MN24', 'Rolade Tahu', 20000, 'Snack', 'tersedia'),
(34, 'MN34', 'Pandan Roll Kismis', 20000, 'Dessert', 'tersedia'),
(35, 'MN35', 'Caramel Frappuccino', 8000, 'Minuman', 'tersedia'),
(36, 'MN36', 'Susu Caramel Kopo', 8000, 'Minuman', 'tersedia'),
(37, 'MN37', 'Ice Caramel Macchiato', 8000, 'Minuman', 'tersedia'),
(38, 'MN38', 'Capuccino Float', 8000, 'Minuman', 'tersedia'),
(39, 'MN39', 'Jus Pisang', 5000, 'Minuman', 'tersedia'),
(40, 'MN40', 'Jus Nangka', 5000, 'Minuman', 'tersedia'),
(41, 'MN41', 'Jus Mangga', 5000, 'Minuman', 'tersedia'),
(42, 'MN42', 'Jus Alpukat', 5000, 'Minuman', 'tersedia'),
(43, 'MN43', 'Jus Melon', 5000, 'Minuman', 'tersedia'),
(44, 'MN44', 'Jus Sirsak', 5000, 'Minuman', 'tersedia'),
(45, 'MN45', 'Jus Wortel', 5000, 'Minuman', 'tersedia'),
(46, 'MN46', 'Es Kacang Ijo', 12000, 'Minuman', 'tersedia'),
(47, 'MN47', 'Rainbow Juice', 12000, 'Minuman', 'tersedia'),
(48, 'MN48', 'Strawberry Ice Tea', 12000, 'Minuman', 'tersedia'),
(49, 'MN49', 'Smoothie Mangga', 12000, 'Minuman', 'tersedia'),
(50, 'MN50', 'Es Kopyor', 8000, 'Minuman', 'tersedia'),
(52, 'MN52', 'Es Teh Manis', 3000, 'Minuman', 'tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `kode_pesanan` varchar(12) NOT NULL,
  `kode_menu` varchar(12) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `kode_pesanan`, `kode_menu`, `qty`) VALUES
(53, '667bfd486419', 'MN52', 1),
(55, '667c39d5a441', 'MN52', 10),
(57, '667cc95e6d5c', 'MN52', 20),
(58, '667cca58d110', 'MN52', 20),
(59, '667ccd03b2e1', 'MN51', 1),
(67, '667cf46597b3', 'MN52', 2),
(70, '667d082a00d7', 'MN52', 12),
(71, '667d0888e04c', 'MN51', 1),
(72, '667d08fc019c', 'MN52', 3),
(73, '667d0963e050', 'MN51', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `kode_pesanan` varchar(12) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `kode_pesanan`, `nama_pelanggan`, `waktu`) VALUES
(38, '667cf46597b3', 'cs', '2024-06-27 12:11:01'),
(41, '667d082a00d7', 'halida', '2024-06-27 13:35:22'),
(42, '667d0888e04c', 'amin', '2024-06-27 13:36:56'),
(43, '667d08fc019c', 'am', '2024-06-27 13:38:52'),
(44, '667d0963e050', 'aldi', '2024-06-27 13:40:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `password`) VALUES
(1, 'rendi12', '', '69c796f5bbd1339f3ba3e18ce54fcc63'),
(3, 'admin1', '', '827ccb0eea8a706c4c34a16891f84e7b'),
(6, 'fdgdfg', 'admin@gmail.com', '202cb962ac59075b964b07152d234b70');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
