-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 22 Des 2024 pada 18.48
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ses`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `consultation_form`
--

CREATE TABLE `consultation_form` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_field` varchar(255) NOT NULL,
  `company_size` int(11) NOT NULL,
  `company_address` text NOT NULL,
  `current_lighting` text DEFAULT NULL,
  `problem_detail` text DEFAULT NULL,
  `goals` text DEFAULT NULL,
  `min_budget` int(11) DEFAULT NULL,
  `max_budget` int(11) DEFAULT NULL,
  `privacy_policy` tinyint(1) DEFAULT 0,
  `updates_promotions` tinyint(1) DEFAULT 0,
  `status` enum('running','finished') DEFAULT 'running',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `preferredDate` date NOT NULL,
  `id_user` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `consultation_form`
--

INSERT INTO `consultation_form` (`id`, `company_name`, `company_field`, `company_size`, `company_address`, `current_lighting`, `problem_detail`, `goals`, `min_budget`, `max_budget`, `privacy_policy`, `updates_promotions`, `status`, `created_at`, `preferredDate`, `id_user`) VALUES
(15, 'ses', 'etc', 1, '1', '1', '1', '1', 1, 1, 1, 1, 'running', '2024-12-22 14:42:33', '2024-12-26', 112);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `consultation_form`
--
ALTER TABLE `consultation_form`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `consultation_form`
--
ALTER TABLE `consultation_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `consultation_form`
--
ALTER TABLE `consultation_form`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
