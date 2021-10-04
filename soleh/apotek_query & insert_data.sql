-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Agu 2021 pada 07.05
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apotek`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_obat`
--

CREATE TABLE `detail_obat` (
  `kode_obat` char(20) NOT NULL,
  `jenis_obat` enum('tablet','serbuk') NOT NULL,
  `id` int(10) NOT NULL,
  `kategori_obat` char(20) NOT NULL,
  `dosis_obat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_obat`
--

INSERT INTO `detail_obat` (`kode_obat`, `jenis_obat`, `id`, `kategori_obat`, `dosis_obat`) VALUES
('BA-23', 'tablet', 1, 'Sakit Kepala', 'Sedang'),
('DA-2', 'tablet', 2, 'mengobati diare', 'Dosis rendah'),
('EY-23', 'tablet', 3, 'Untuk kesehatan mata', 'dosis tinggi'),
('PE-10', 'tablet', 4, 'meredahkan sakit kep', 'dosis sedang'),
('PB-6', 'tablet', 5, 'meredahkan sakit gig', 'dosis tinggi'),
('UF-27', 'tablet', 6, 'meredahkan hidung te', 'dosisi rendah'),
('NP-10', 'serbuk', 7, 'meredakan sesak nafa', 'dosisi tinggi'),
('CE-20', 'tablet', 8, 'vitamin untuk keseha', 'Dosis rendah'),
('CG-20', 'tablet', 9, 'Mencerdaskan otak', 'Dosis sedang'),
('BP-50', 'tablet', 10, 'meredahakan sakit ke', 'dosis rendah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `id_obat` int(10) NOT NULL,
  `nama_obat` varchar(30) NOT NULL,
  `stock` varchar(20) NOT NULL,
  `id_detail` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`id_obat`, `nama_obat`, `stock`, `id_detail`) VALUES
(1, 'paramex', '20', 1),
(2, 'diapet', '10', 2),
(3, 'Eyevit(Vitamin Mata)', '10', 3),
(4, 'panadol_extra (pereda sakit ke', '5', 4),
(5, 'panadol_biru(meringakan sakit ', '5', 5),
(6, 'untraflu(meredakan flu)', '20', 6),
(7, 'neo napacin', '3', 7),
(8, 'cerebrovit x-cel', '50', 8),
(9, 'cerebrot gold (mecerdaskan ota', '5', 9),
(10, 'bodrex paracetamol', '3', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(10) NOT NULL,
  `nama_pelanggan` varchar(15) NOT NULL,
  `umur` int(3) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `jk` enum('Laki-laki','Perempuan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama_pelanggan`, `umur`, `alamat`, `jk`) VALUES
(1, 'Kukuh Apriliant', 24, 'Jalan suka menanti Rt:08/Rw:011 Kel.Rawa Buaya Kec', 'Laki-laki'),
(2, 'nur muhamad sol', 23, 'jalan suka menanti rt:08/rw:011 kel.rawa buaya kec', 'Laki-laki'),
(3, 'wahyu adi saput', 21, 'jalan karet tegsin', 'Laki-laki'),
(4, 'winta', 26, 'jalan tangerang raya', 'Perempuan'),
(5, 'dwi puspita sar', 20, 'jalan serang raya', 'Perempuan'),
(6, 'alex dwi fajar ', 12, 'jalan suka menanti rt:08/rw:011 kel.rawa buaya kec', 'Laki-laki'),
(7, 'andrian hartato', 18, 'jalan karawaci, tangerang', 'Laki-laki'),
(8, 'risma apriliant', 25, 'banjarnegara', 'Laki-laki'),
(9, 'erwin riyatmoko', 26, 'sleman yogyakarta', 'Laki-laki'),
(10, 'nur', 24, 'kapuk raya jakarta barat', 'Laki-laki');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL,
  `id_pelanggan` int(10) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `total_transaksi` bigint(10) NOT NULL,
  `total_bayar` bigint(10) NOT NULL,
  `total_kembalian` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id`, `id_pelanggan`, `tanggal_transaksi`, `total_transaksi`, `total_bayar`, `total_kembalian`) VALUES
(1, 1, '2021-08-04', 1, 2000, 0),
(2, 2, '2021-08-10', 2, 12000, 0),
(3, 3, '2021-08-09', 10, 22000, 2000),
(4, 4, '2021-08-09', 12, 12000, 0),
(5, 5, '2021-08-05', 5, 10000, 0),
(6, 6, '2021-08-06', 50, 100000, 0),
(7, 7, '2021-08-08', 1, 2000, 500),
(8, 8, '2021-08-09', 5000, 2, 1000),
(9, 9, '2021-08-08', 3, 30000, 0),
(10, 10, '2021-08-08', 2, 2000, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan_detail`
--

CREATE TABLE `penjualan_detail` (
  `id_transaksi_detail` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_obat` int(10) NOT NULL,
  `jumlah_obat` int(11) NOT NULL,
  `harga_obat` bigint(12) NOT NULL,
  `total_harga` bigint(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penjualan_detail`
--

INSERT INTO `penjualan_detail` (`id_transaksi_detail`, `id_transaksi`, `id_obat`, `jumlah_obat`, `harga_obat`, `total_harga`) VALUES
(1, 1, 2, 1, 2500, 2500),
(2, 1, 10, 1, 1500, 1500),
(3, 3, 8, 10, 18000, 18000),
(4, 4, 3, 2, 10000, 10000),
(5, 5, 7, 1, 2000, 2000),
(6, 6, 5, 2, 3000, 3000),
(7, 7, 6, 1, 1000, 1000),
(9, 9, 9, 2, 19000, 19000),
(10, 10, 8, 2, 4000, 4000);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_obat`
--
ALTER TABLE `detail_obat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id_obat`),
  ADD KEY `id_detail` (`id_detail`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indeks untuk tabel `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  ADD PRIMARY KEY (`id_transaksi_detail`),
  ADD KEY `FK_penjualan` (`id_obat`),
  ADD KEY `FK_penjualan_detail` (`id_transaksi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_obat`
--
ALTER TABLE `detail_obat`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `obat`
--
ALTER TABLE `obat`
  MODIFY `id_obat` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  MODIFY `id_transaksi_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_obat`
--
ALTER TABLE `detail_obat`
  ADD CONSTRAINT `FK_obat` FOREIGN KEY (`id`) REFERENCES `obat` (`id_detail`);

--
-- Ketidakleluasaan untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD CONSTRAINT `FK_pelanggan` FOREIGN KEY (`id`) REFERENCES `penjualan` (`id_pelanggan`);

--
-- Ketidakleluasaan untuk tabel `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  ADD CONSTRAINT `FK_penjualan` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id_obat`),
  ADD CONSTRAINT `FK_penjualan_detail` FOREIGN KEY (`id_transaksi`) REFERENCES `penjualan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
