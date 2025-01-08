-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Jan 2025 pada 14.49
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
-- Database: `bioskop`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `film`
--

CREATE TABLE `film` (
  `id_film` int(10) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `judul_film` varchar(50) NOT NULL,
  `genre` varchar(50) NOT NULL,
  `tahun_tayang` int(11) NOT NULL,
  `durasi_tayang` varchar(15) NOT NULL,
  `sutradara` varchar(255) NOT NULL,
  `rating_usia` varchar(255) NOT NULL,
  `sinopsis` mediumtext NOT NULL,
  `status` enum('Now Playing','Coming Soon') DEFAULT 'Coming Soon'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `film`
--

INSERT INTO `film` (`id_film`, `image`, `judul_film`, `genre`, `tahun_tayang`, `durasi_tayang`, `sutradara`, `rating_usia`, `sinopsis`, `status`) VALUES
(1002356802, 'https://mlpnk72yciwc.i.optimole.com/cqhiHLc.WqA8~2eefa/w:auto/h:auto/q:75/https://bleedingcool.com/wp-content/uploads/2022/04/FPn5XwMVgAE8v2x.jpeg', 'DOCTOR STRANGE : MULTIVERSE OF MADNESS', 'Action, Adventure', 2022, '2 j 6 m', 'Sam Raimi', 'PG-13', 'Doctor Strange membuka pintu ke multiverse yang berbahaya...', 'Now Playing'),
(1002356803, 'https://wallpapercosmos.com/w/full/b/b/e/34907-2160x3840-phone-4k-the-batman-2022-background-photo.jpg', 'THE BATMAN', 'Action, Crime, Drama', 2022, '2 j 55 m', 'Matt Reeves', 'PG-13', 'Bruce Wayne sebagai Batman menghadapi misteri baru...', 'Now Playing'),
(1002356804, 'https://amc-theatres-res.cloudinary.com/v1589456070/amc-cdn/production/2/movies/300/294/Poster/p_800x1200_TopGun_En_050720.jpg', 'TOP GUN : MAVERICK', 'Action, Drama', 2022, '2 j 10 m', 'Joseph Kosinski', 'PG-13', 'Maverick kembali sebagai pilot uji coba setelah lebih dari 30 tahun...', 'Now Playing'),
(1002356811, 'http://cdn.collider.com/wp-content/uploads/2015/05/ant-man-poster-1.jpg', 'ANT MAN', 'action', 2022, '130', 'dadang', '13+', 'werty78 wertyui dfghj ertyu ertyui rtgyhjk dfghj ertyui rtyui ', 'Coming Soon');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_tayang`
--

CREATE TABLE `jadwal_tayang` (
  `id_tayang` int(10) NOT NULL,
  `id_film` int(10) NOT NULL,
  `id_studio` int(11) NOT NULL,
  `tanggal` varchar(11) NOT NULL,
  `jam` varchar(5) NOT NULL,
  `harga` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jadwal_tayang`
--

INSERT INTO `jadwal_tayang` (`id_tayang`, `id_film`, `id_studio`, `tanggal`, `jam`, `harga`) VALUES
(2, 1002356802, 2, '2025-01-08', '21:00', 55000),
(3, 1002356803, 3, '2025-01-09', '20:00', 60000),
(4, 1002356804, 4, '2025-01-09', '18:00', 45000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kursi`
--

CREATE TABLE `kursi` (
  `id_studio` int(10) NOT NULL,
  `id_kursi` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kursi`
--

INSERT INTO `kursi` (`id_studio`, `id_kursi`) VALUES
(1, 'A1'),
(1, 'A2'),
(1, 'A3'),
(1, 'A4'),
(1, 'B1'),
(1, 'B2'),
(1, 'B3'),
(1, 'B4'),
(1, 'C1'),
(1, 'C2'),
(1, 'C3'),
(1, 'C4'),
(1, 'D1'),
(1, 'D2'),
(1, 'D3'),
(1, 'D4');

-- --------------------------------------------------------

--
-- Struktur dari tabel `studio`
--

CREATE TABLE `studio` (
  `id_studio` int(10) NOT NULL,
  `nama_studio` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `studio`
--

INSERT INTO `studio` (`id_studio`, `nama_studio`) VALUES
(1, 'XXI Pakuwo'),
(2, 'CGV Lippo'),
(3, 'CGI Amplaz'),
(4, 'Kampus 4 U');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tiket`
--

CREATE TABLE `tiket` (
  `id_tiket` int(10) NOT NULL,
  `id_user` int(10) NOT NULL,
  `id_film` int(10) NOT NULL,
  `kursi` varchar(10) NOT NULL,
  `total_bayar` int(10) NOT NULL,
  `tanggal_pemesanan` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tiket`
--

INSERT INTO `tiket` (`id_tiket`, `id_user`, `id_film`, `kursi`, `total_bayar`, `tanggal_pemesanan`) VALUES
(1, 6, 1002356803, 'C3', 50000, '2025-01-06 06:26:07'),
(2, 6, 1002356803, 'C1', 50000, '2025-01-06 06:27:03'),
(3, 6, 1002356803, 'E1', 50000, '2025-01-06 06:29:42'),
(4, 6, 1002356802, 'C1', 50000, '2025-01-06 07:24:05'),
(5, 6, 1002356802, 'C4', 50000, '2025-01-08 20:11:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `no_kontak` varchar(13) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(20) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama`, `no_kontak`, `email`, `username`, `password`, `level`) VALUES
(6, 'anjay', '0812345612111', 'anjay@gmail.com', 'anjay', 'ujangujang', 'customer'),
(7, 'admin', '0845676434567', 'admin@gmail.com', 'admin', '12345678', 'admin'),
(9, 'kucing', '08234567654', 'kucing@gmail.com', 'kucing', '12345678', 'customer'),
(10, 'nanang', '0846361762311', 'nanang@gmail.com', 'nanang', '12345678', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id_film`);

--
-- Indeks untuk tabel `jadwal_tayang`
--
ALTER TABLE `jadwal_tayang`
  ADD PRIMARY KEY (`id_tayang`),
  ADD KEY `id_film` (`id_film`),
  ADD KEY `jadwal_tayang_ibfk_2` (`id_studio`);

--
-- Indeks untuk tabel `kursi`
--
ALTER TABLE `kursi`
  ADD PRIMARY KEY (`id_kursi`),
  ADD KEY `id_studio` (`id_studio`);

--
-- Indeks untuk tabel `studio`
--
ALTER TABLE `studio`
  ADD PRIMARY KEY (`id_studio`);

--
-- Indeks untuk tabel `tiket`
--
ALTER TABLE `tiket`
  ADD PRIMARY KEY (`id_tiket`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_film` (`id_film`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `film`
--
ALTER TABLE `film`
  MODIFY `id_film` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1002356812;

--
-- AUTO_INCREMENT untuk tabel `jadwal_tayang`
--
ALTER TABLE `jadwal_tayang`
  MODIFY `id_tayang` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `studio`
--
ALTER TABLE `studio`
  MODIFY `id_studio` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tiket`
--
ALTER TABLE `tiket`
  MODIFY `id_tiket` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `jadwal_tayang`
--
ALTER TABLE `jadwal_tayang`
  ADD CONSTRAINT `jadwal_tayang_ibfk_1` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`) ON DELETE CASCADE,
  ADD CONSTRAINT `jadwal_tayang_ibfk_2` FOREIGN KEY (`id_studio`) REFERENCES `studio` (`id_studio`);

--
-- Ketidakleluasaan untuk tabel `kursi`
--
ALTER TABLE `kursi`
  ADD CONSTRAINT `kursi_ibfk_1` FOREIGN KEY (`id_studio`) REFERENCES `studio` (`id_studio`);

--
-- Ketidakleluasaan untuk tabel `tiket`
--
ALTER TABLE `tiket`
  ADD CONSTRAINT `tiket_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `tiket_ibfk_2` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
