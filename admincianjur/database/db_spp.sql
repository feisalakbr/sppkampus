-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Sep 2024 pada 11.29
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
-- Database: `db_spp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_bayar`
--

CREATE TABLE `jenis_bayar` (
  `id` int(11) NOT NULL,
  `nama_jenis_bayar` varchar(255) NOT NULL,
  `jumlah_harus_bayar` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(50) NOT NULL,
  `kompetensi_keahlian` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `kompetensi_keahlian`) VALUES
(7, 'Manajemen Pendidikan Islam', 'TARBIYAH DAN ILMU KEGURUAN'),
(8, 'Ekonomi Syariah', 'EKONOMI DAN BISNIS ISLAM'),
(9, 'Pendidikan Bahasa Arab', 'TARBIYAH DAN ILMU KEGURUAN'),
(10, 'Perbankan Syariah', 'EKONOMI DAN BISNIS ISLAM'),
(11, 'Hukum Ekonomi Syariah', 'HUKUM ISLAM'),
(12, 'Hukum Keluarga Islam', 'HUKUM ISLAM');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_petugas` int(11) NOT NULL,
  `nim` varchar(11) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `bulan_dibayar` varchar(8) NOT NULL,
  `tahun_dibayar` varchar(4) NOT NULL,
  `id_spp` int(11) NOT NULL,
  `jumlah_bayar` int(11) NOT NULL,
  `jenis_bayar` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_petugas`, `nim`, `tgl_bayar`, `bulan_dibayar`, `tahun_dibayar`, `id_spp`, `jumlah_bayar`, `jenis_bayar`) VALUES
(78, 1, '12345', '2024-09-25', 'septembe', '2024', 0, 150000, 'PROPESA'),
(79, 1, '12345', '2024-09-27', 'septembe', '2024', 0, 120000, 'SPP'),
(80, 1, '12345', '2024-09-29', 'septembe', '2024', 0, 200000, 'ALAMAMATER'),
(81, 2, '123123', '2024-09-29', 'septembe', '2024', 0, 120000, 'SPP'),
(82, 1, '123455', '2024-09-27', 'septembe', '2024', 0, 120000, 'SPP'),
(84, 1, '1234563', '2024-09-28', 'septembe', '2024', 0, 150000, 'PROPESA'),
(85, 1, '1234563', '2024-09-28', 'septembe', '2024', 0, 200000, 'ALAMAMATER');

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(500) NOT NULL,
  `nama_petugas` varchar(35) NOT NULL,
  `level` enum('admin','petugas','siswa') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `username`, `password`, `nama_petugas`, `level`) VALUES
(1, 'admin1', 'admin', 'april', 'admin'),
(2, 'petugas1', 'petugas', 'lia', 'petugas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `nim` varchar(11) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `tahun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`nim`, `nama`, `id_kelas`, `alamat`, `no_telp`, `tahun`) VALUES
('123123', 'grifin arsya', 9, 'gadung', '1233333', 2024),
('12312424', 'abudi', 12, 'cilaku', '2132132', 2024),
('12345', 'MUHAMMAD FEISAL AKBAR', 8, 'BTN Gadung Permai Blok B No  17 Cianjur', '085939322522', 2024),
('123455', 'aris firman', 11, 'panembong', '43242343535', 2024),
('1234563', 'zaenal', 8, 'cilaku', '2312424535', 2024),
('21312323', 'agus', 8, 'bojong', '23214', 2024),
('21321412421', 'asep', 7, 'ciburial', '232142', 2024),
('2443432', 'nurdin', 8, 'cikidang', '33546234234', 2024);

-- --------------------------------------------------------

--
-- Struktur dari tabel `spp`
--

CREATE TABLE `spp` (
  `id_spp` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  `data` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `spp`
--

INSERT INTO `spp` (`id_spp`, `nominal`, `data`) VALUES
(2, 150000, 'PROPESA'),
(12, 120000, 'SPP'),
(14, 200000, 'ALAMAMATER');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `level` enum('mahasiswa') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama_user`, `level`) VALUES
(7, '12345', '12345', 'feisal akbar', 'mahasiswa'),
(8, '123123', '123123', 'grifiin ', 'mahasiswa');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `jenis_bayar`
--
ALTER TABLE `jenis_bayar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_petugas` (`id_petugas`),
  ADD KEY `nisn` (`nim`),
  ADD KEY `id_spp` (`id_spp`);

--
-- Indeks untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nim`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indeks untuk tabel `spp`
--
ALTER TABLE `spp`
  ADD PRIMARY KEY (`id_spp`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jenis_bayar`
--
ALTER TABLE `jenis_bayar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT untuk tabel `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `spp`
--
ALTER TABLE `spp`
  MODIFY `id_spp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`),
  ADD CONSTRAINT `pembayaran_ibfk_2` FOREIGN KEY (`nim`) REFERENCES `siswa` (`nim`);

--
-- Ketidakleluasaan untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
