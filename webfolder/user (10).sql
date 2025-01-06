-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 21 Des 2024 pada 13.36
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
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(4) NOT NULL,
  `business_name` varchar(30) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `google_id` varchar(100) DEFAULT NULL,
  `google_token` text DEFAULT NULL,
  `google_avatar` varchar(255) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `avatar` mediumblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `business_name`, `email`, `google_id`, `google_token`, `google_avatar`, `name`, `last_name`, `phone_number`, `password`, `activation_code`, `avatar`) VALUES
(79, 'uii', 'fawwzganteng@rilsss', '', NULL, NULL, '', '', '082187252972', '$2y$10$2jfE1Cr/AQTZRv04ZPABcOeW2DhQjpe5EglSSWyhdOY47t0TqKc2W', NULL, ''),
(83, 'uii', 'fawwzganteng@rilsssff', NULL, NULL, NULL, 'fawwaz', 'wibowo', '082187252972', '$2y$10$CjkYoOWYTV75FpSl102rXeNJO9r0/L.LpVjeLKtHLKJiVvcusq48W', NULL, ''),
(84, 'uii', 'fawwzganteng@rilsssxxx', NULL, NULL, NULL, 'fawwaz', 'wibowo', '082187252972', '$2y$10$LAhf9Q0ab.Dw9sGXHjKynOGw6CV/0KmsOADBfSoEV7Knz3CSazeyS', NULL, ''),
(85, 'uii', 'fawwzganteng@rilsssxxx6767', NULL, NULL, NULL, 'fawwaz', 'wibowo', '082187252972', '$2y$10$PQOgwOifT/KgUS6TDKMYzewwjForw05d2crbMosAWB/Qe7fBNBVPe', NULL, ''),
(86, 'uii', 'fawwzganteng@rilsssxxx6767s', NULL, NULL, NULL, 'fawwaz', 'wibowo', '082187252972', '$2y$10$/k/HNnCT0JAeS/mt2aGBT.7d6b/H6EFTnhO3lohLtmkKKLWk92.Ha', NULL, ''),
(87, 'uii', 'fawwazzz@gmail.comm', NULL, NULL, NULL, 'fawwaz', 'wibowo', '082187252972', '$2y$10$uckcDR8knSq0kegCOukwbez71hMvxbH7MURPXt7nKx8fDFWwama7y', NULL, ''),
(88, 'uii', 'root@123', NULL, NULL, NULL, 'fawwaz', 'wibowo', '082187252972', '$2y$10$DMHPYbB68DKzo9z.F3olbuBWXfgYTRUm6MbF80VIuk1Z1o0P/EdCC', NULL, ''),
(89, 'uii', 'root@1233', NULL, NULL, NULL, 'fawwaz', 'wibowo', '082187252972', '$2y$10$neE/TovRedJrhCyMAX1Q/ueuNmroIu7xMSr6BXxRcf1dgQQ0xP49O', NULL, ''),
(90, 'uii', 'root@12334', NULL, NULL, NULL, 'fawwaz', 'wibowo', '082187252972', '$2y$10$NAjeDwJFtq2uZBvJQ.OHAebaChta.xLJY/mEMIR.gbZJPBEMZI8.e', NULL, ''),
(91, 'asdada', 'dsada@sadd', NULL, NULL, NULL, 'fawwz', 'awdasddd', 'dsadsad', '$2y$10$.GztM6oJsTZDuU7bjyGe.eHLMrxf9vMSg31nP7XrZJ0Ws0e5OtJmS', NULL, ''),
(92, 'uii', 'root@12', NULL, NULL, NULL, 'fawwaz', 'wibowo', '082187252972', '$2y$10$rkUpk4UTkbQZcAdbl8/YEeRsk3w/caZruP/PJS/QPkETpPiosNfLi', NULL, ''),
(93, 'uii', 'root@1212312313', NULL, NULL, NULL, 'fawwaz', 'wibowo', '082187252972', '$2y$10$7fNtQOYP/11VtRUgl57iHO5zJWnnHy3u3ibEz2s4QoSdDjjRQOcJm', NULL, ''),
(94, 'uii', 'fawwazwibowo69@gmail.com', NULL, NULL, NULL, 'fawwaz', 'wibowo', '082187252972', '$2y$10$v3N05lyXq8Q0z.lMEPw4keHz415P59GVQy1m8kUfSOegxr9zhVe2W', NULL, ''),
(95, 'uii', 'fawwazwibowo69@gmail.comm', NULL, NULL, NULL, 'fawwaz', 'wibowo', '082187252972', '$2y$10$ft5x.kH3ssMNDgAmn8FOCuU53jjwh5.PWi/0Ad0tKDyIOS487Wluu', NULL, ''),
(96, 'uii', 'root@46455645', NULL, NULL, NULL, 'fawwaz', 'wibowo', '082187252972', '$2y$10$9xO84VBpQLj/bO8AiJ19AeDNTvfv3czGu.tZFnbw5ZEW9mU610O3C', '26636a750fa884f2486c4b03fa1fac2c', ''),
(97, 'uii', 'fawwazwibowo96@Gmail.com', NULL, NULL, NULL, 'fawwaz', 'wibowo', '082187252972', '$2y$10$vNB4JDhcKq69lyq5lkGUWu5fN2J5nQCA734nVyAvi4yiXgeS9o6VW', '1543e13d58a23cca27bd7b3f2e5fdbcf', ''),
(98, 'uii', 'root@33', NULL, NULL, NULL, 'fawwaz', 'wibowo', '082187252972', '$2y$10$GUzBtJXRLnComy0Fv/wgY.OXDPGENLHF94I5c61dViWBuIpdFhJmO', NULL, ''),
(99, 'uii', 'root@12345', NULL, NULL, NULL, 'fawwaz', 'wibowo', '082187252972', '$2y$10$wx/bfkxh2VXPrR6H40wGB.QhtNxFPAh/rpCHcDXvTbhhGARhquWBG', NULL, ''),
(100, 'uii', 'fawwazwibowo963@gmail.com', NULL, NULL, NULL, 'fawwaz', 'wibowo', '082187252972', '$2y$10$MEurc4vQaWh0BpLL6wpXWeq0nwgKTTNZn1KG2CrfGhFIvDULukMjm', NULL, ''),
(101, 'uii', 'root@321', NULL, NULL, NULL, 'fawwaz12', 'wibowo', '082187252972', '$2y$10$sgiA.W0aEJZYCGWYyeFSHewRgE/WYS6LMvzLuJpvCEoQ8cSOhAcz.', NULL, ''),
(102, 'uii', 'fawwazwibowo1@gmail.com', NULL, NULL, NULL, 'fawwaz', 'wibowo', '082187252972', '$2y$10$OSXEPNYdjcr2PBdamiqjyeSJSNROJl.TK.3xMw9cSoBdg2xe4s5sK', NULL, ''),
(103, 'uii', 'root@2131313123', NULL, NULL, NULL, 'fawwaz', 'wibowo', '082187252972', '$2y$10$cOrytyBsydPWz/ocjKW.0OV2GEN/YM5Y4wmIHTZ19lZXBQg8/d2HG', NULL, ''),
(104, 'uii', 'root@111', NULL, NULL, NULL, 'fawwaz', 'wibowo', '082187252972', '$2y$10$Mq5wZV.R/iP88DOklbmY4.2pBOtNrJksVIxlEqNba61WTZFuyS.YC', NULL, ''),
(105, 'uii', '1@1', NULL, NULL, NULL, 'fawwaz', 'wibowo', '082187252972', '$2y$10$j/8wiEJwG4PYeKyCDG.CPun7fcDw82TP/DgX63aQWIQ/ajEjsYX0C', NULL, '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_2` (`email`),
  ADD UNIQUE KEY `google_id` (`google_id`),
  ADD UNIQUE KEY `email_3` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
