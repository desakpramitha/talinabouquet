-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Agu 2021 pada 16.33
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `talina`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(30) NOT NULL,
  `category_image` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_image`) VALUES
(7, 'Snack Box', 'sbox1_b.jpg'),
(8, 'Flower Bouquet', 'f1.jpg'),
(10, 'Snack Bouquet', 'sb142.jpg'),
(12, 'Money Bouquet', 'mb1.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `image_product`
--

CREATE TABLE `image_product` (
  `image_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `image_product`
--

INSERT INTO `image_product` (`image_id`, `product_id`, `image_name`) VALUES
(28, 14, 'sb14.jpg'),
(29, 14, 'sb222.jpg'),
(30, 15, 'beer-bouquet4.jpg'),
(31, 16, 'sbox1_a3.jpg'),
(32, 16, 'sbox1_b2.jpg'),
(33, 16, 'sbox1_c.jpg'),
(34, 17, 'banana3.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kabupaten`
--

CREATE TABLE `kabupaten` (
  `id_kab` int(11) NOT NULL,
  `kabupaten` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kabupaten`
--

INSERT INTO `kabupaten` (`id_kab`, `kabupaten`) VALUES
(1, 'Badung'),
(2, 'Denpasar'),
(3, 'Gianyar'),
(4, 'Tabanan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id_kec` int(11) NOT NULL,
  `id_kab` int(11) NOT NULL,
  `kecamatan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kecamatan`
--

INSERT INTO `kecamatan` (`id_kec`, `id_kab`, `kecamatan`) VALUES
(1, 1, 'Abiansemal'),
(2, 1, 'Kuta'),
(3, 1, 'Kuta Selatan'),
(4, 1, 'Kuta Utara'),
(5, 1, 'Mengwi'),
(6, 1, 'Petang'),
(7, 2, 'Denpasar Utara'),
(8, 2, 'Denpasar Barat'),
(9, 2, 'Denpasar Selatan'),
(10, 2, 'Denpasar Timur'),
(11, 3, 'Sukawati'),
(12, 3, 'Blahbatuh'),
(13, 3, 'Gianyar'),
(14, 3, 'Tampaksiring'),
(15, 3, 'Ubud'),
(16, 3, 'Tegallalang'),
(17, 3, 'Payangan'),
(18, 4, 'Selemadeg'),
(19, 4, 'Selemadeg Timur'),
(20, 4, 'Selemadeg Barat'),
(21, 4, 'Kerambitan'),
(22, 4, 'Tabanan'),
(23, 4, 'Kediri'),
(24, 4, 'Baturiti'),
(25, 4, 'Penebel'),
(26, 4, 'Pupuan'),
(27, 4, 'Marga');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `orders_code` varchar(20) NOT NULL,
  `date_order` datetime NOT NULL,
  `date_pengiriman` datetime NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `grand_total` int(11) NOT NULL,
  `pelanggan_name` varchar(100) NOT NULL,
  `pelanggan_address` varchar(100) NOT NULL,
  `pelanggan_phone` varchar(13) NOT NULL,
  `ship_id` int(11) NOT NULL,
  `status` varchar(30) NOT NULL,
  `note` varchar(100) NOT NULL,
  `id_kab` int(11) NOT NULL,
  `id_kec` int(11) NOT NULL,
  `kode_pos` varchar(5) NOT NULL,
  `account_name` varchar(30) NOT NULL,
  `account_number` varchar(30) NOT NULL,
  `status_bayar` int(11) NOT NULL,
  `bukti_bayar_image` varchar(128) NOT NULL,
  `note_payment` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `orders_code`, `date_order`, `date_pengiriman`, `total_bayar`, `grand_total`, `pelanggan_name`, `pelanggan_address`, `pelanggan_phone`, `ship_id`, `status`, `note`, `id_kab`, `id_kec`, `kode_pos`, `account_name`, `account_number`, `status_bayar`, `bukti_bayar_image`, `note_payment`) VALUES
(11, 24, '20210720V40PJIPY', '2021-07-20 00:00:00', '2021-07-23 00:00:00', 40000, 25000, 'Pradnya', 'Jl. Flamboyan', '2147483647', 4, '3', 'yeyayyy', 3, 15, '80361', 'Pradnya Pramitha', '23467997544', 1, 'Logo_Talina_Bouquet.jpg', 'sudah'),
(12, 24, '202107211FOVSDI4', '2021-07-20 00:00:00', '2021-07-23 00:00:00', 90000, 80000, 'Pramitha', 'Dalung', '86546896', 2, '1', 'lala lele', 1, 1, '87690', 'Pradnya Pramitha', '0986643356565', 1, 'Template_Fashion_Women_Puzzle_Post_Instagram2.jpg', 'udah ye'),
(13, 24, '202107210IJF186S', '2021-07-21 07:04:54', '2021-07-23 00:00:00', 95000, 80000, 'Pramitha', 'pejeng', '86546896', 4, '3', 'haiiii', 3, 13, '89808', 'Pramitha', '132675436248', 1, 'WhatsApp_Image_2021-07-11_at_19_02_44.jpeg', 'done'),
(27, 24, '20210807ZC9BHRSC', '2021-08-07 10:16:17', '2021-08-09 00:00:00', 35000, 25000, 'Pradnya', 'Jl. Flamboyan', '085737038573', 2, '3', 'met ultah', 1, 4, '80361', 'Pradnya Pramitha', '23467997544', 1, 'WhatsApp_Image_2021-08-08_at_01_40_06.jpeg', 'sudah bayar'),
(29, 24, '20210810NKT6IOI9', '2021-08-10 21:52:35', '2021-08-13 00:00:00', 210000, 200000, 'Desak Pramitha', 'Jalan Raya Dalung', '085737038573', 2, '2', 'Selamat Ulang Tahun', 1, 4, '80365', 'Desak Pramitha', '41170092327', 1, 'WhatsApp_Image_2021-08-08_at_01_40_061.jpeg', 'sudah bayar'),
(31, 24, '20210818VFB9CZ5N', '2021-08-18 09:08:14', '2021-08-21 00:00:00', 520000, 500000, 'buduh', 'jln', '55677888', 6, '0', 'selamat menikah', 1, 1, '80066', '', '', 0, '', ''),
(32, 24, '202108183XIGVTK4', '2021-08-18 09:18:05', '2021-08-10 00:00:00', 565000, 550000, 'vff', 'Jl. raya dalung', '06069', 4, '0', 'eeeee', 1, 1, '80365', '', '', 0, '', '');

--
-- Trigger `orders`
--
DELIMITER $$
CREATE TRIGGER `hapus_detail_order` AFTER DELETE ON `orders` FOR EACH ROW BEGIN
delete from order_detail where orders_code = old.orders_code; 
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_detail`
--

CREATE TABLE `order_detail` (
  `order_detail_id` int(11) NOT NULL,
  `orders_code` varchar(20) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `order_detail`
--

INSERT INTO `order_detail` (`order_detail_id`, `orders_code`, `product_id`, `qty`) VALUES
(18, '20210720V40PJIPY', 14, 1),
(19, '202107211FOVSDI4', 15, 1),
(20, '202107210IJF186S', 15, 1),
(30, '20210807ZC9BHRSC', 14, 1),
(32, '20210810NKT6IOI9', 16, 1),
(33, '20210810NKT6IOI9', 17, 1),
(35, '20210818VFB9CZ5N', 16, 5),
(36, '202108183XIGVTK4', 14, 6),
(37, '202108183XIGVTK4', 16, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `image_product` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`product_id`, `category_id`, `product_name`, `price`, `description`, `image_product`) VALUES
(14, 10, 'Cokelat bouquet', 25000, '2 buah silverqueen', 'sb22.jpg'),
(15, 10, 'Beer bouquet', 80000, '2 buah beer bintang', 'beer-bouquet3.jpg'),
(16, 7, 'Cute Box', 100000, 'Terdiri dari susu bear brand 1 buah, beng-beng 1 buah, dan pocky rasa cokelat 1 buah', 'sbox1_b.jpg'),
(17, 10, 'Banana Bouquet', 100000, '2 kg pisang cavendish', 'banana2.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'Pelanggan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `shipping`
--

CREATE TABLE `shipping` (
  `ship_id` int(11) NOT NULL,
  `shipping_method` varchar(30) NOT NULL,
  `lokasi` varchar(30) NOT NULL,
  `tax` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `shipping`
--

INSERT INTO `shipping` (`ship_id`, `shipping_method`, `lokasi`, `tax`) VALUES
(1, 'Ambil ke homestore', 'Jl. Tunjung Sari No 30', 0),
(2, 'Delivery Badung', 'Puspem Badung', 10000),
(3, 'Delivery Tabanan', 'Perempatan Patung Soekarno', 15000),
(4, 'Delivery Gianyar', 'Lapangan Astina', 15000),
(5, 'Delivery Denpasar', 'Taman Kota Lumintang', 10000),
(6, 'Antar ke rumah', 'Opsional', 20000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `testimoni`
--

CREATE TABLE `testimoni` (
  `testimoni_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` varchar(150) NOT NULL,
  `image_testimoni` varchar(255) NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `testimoni`
--

INSERT INTO `testimoni` (`testimoni_id`, `user_id`, `description`, `image_testimoni`, `date`) VALUES
(6, 24, 'Buketnya bagus banget', 'WhatsApp_Image_2021-08-08_at_00_42_12_(1).jpeg', 1628354786),
(11, 24, 'Keren Banget kak !', 'WhatsApp_Image_2021-08-08_at_00_42_12.jpeg', 1628659649);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `image` varchar(256) CHARACTER SET utf8 NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `name`, `address`, `phone`, `email`, `password`, `role_id`, `is_active`, `image`, `date_created`) VALUES
(16, 'Desak Pradnya', 'Dalung', '085737038573', 'dskpolin@gmail.com', '$2y$10$yE3Z2BtdEeNMsRDhffMd6eGh4rrcKycP4Mwl/pEsWDbJaHmP7QrK6', 1, 1, 'logo_teranyar.png', 1623643559),
(18, 'Cahaya', 'Jl. Raya Dalung, Kuta Utara, Badung, Bali', '08123456689', 'cahaya@gmail.com', '$2y$10$KkB6ZyVI.OqINWk2cc1hxumcqnwH8/sP60XkCTnhyraradJzn36yG', 2, 1, 'beer-bouquet.jpg', 1624491612),
(19, 'carky', 'jl. jempiring no 26', '08123456689', 'carkyboo@gmail.com', '$2y$10$kKY.z.c.Q0fM.E2iZn6qbOBA9ddAl6Tdr/kNU..mTDCZIDJWa.OH.', 2, 0, 'sammi-CCk6ZbuOW2w-unsplash.jpg', 1624492136),
(24, 'Desak Pramitha', 'Jalan Abianbase', '08124657918', 'desakpramitha93@gmail.com', '$2y$10$jI7ox0UPihCLTAB3Bp0mv.2BzovmsVROBBWudXpQ2eWuTxB.SyUQu', 2, 1, 'desaksuari.jpg', 1625648999),
(28, 'Cahaya Manika', 'Jalan Flamboyan', '081234566898', 'cahayamanika30@gmail.com', '$2y$10$Jp88sWRO7023Yi3hKqjMG.HUYYdOA/KP950KK9tiI/dXoD3qbzhuy', 2, 1, 'default.svg', 1628123984),
(29, 'Pradnya', '', '', 'pradnyapramitha89@gmail.com', '$2y$10$pnLr64LH/v6A5QKS2Je3Z.P4eJJPJAD9/RMHXlb0aSaTJ88V28tVa', 2, 1, 'default.svg', 1628560736),
(30, 'Deva Karisnu', '', '', 'devapenaka@gmail.com', '$2y$10$PZAFHJeo8icIs6ZJok/fGuIEPebZc8fpAAKx0APSwBb6pTJB4cb5.', 2, 0, 'default.svg', 1629215622);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `access_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`access_id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 2, 9),
(10, 2, 10),
(12, 2, 12),
(13, 1, 13),
(14, 2, 13),
(15, 2, 15);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `menu_id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`menu_id`, `menu`) VALUES
(1, 'admin_controller'),
(2, 'category_controller'),
(3, 'product_controller'),
(4, 'user_controller'),
(5, 'pesanan_controller'),
(6, 'testimoni_controller'),
(7, 'laporan_controller'),
(8, 'menu_management_controller'),
(9, 'pelanggan_controller'),
(10, 'cart_controller'),
(12, 'testimoni_pelanggan_controller'),
(13, 'auth_controller'),
(14, 'dashboard_controller'),
(15, 'order_controller');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_token`
--

CREATE TABLE `user_token` (
  `token_id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_token`
--

INSERT INTO `user_token` (`token_id`, `email`, `token`, `date_created`) VALUES
(4, 'desakpramitha93@gmail.com', 'd8LOFVpyg5gZPBrFvw2Z5nMnE2HLejliixbTnSu3BXY=', 1625666090),
(6, 'desakpramitha93@gmail.com', 'zGpQQWoVwZNWWxtQUOboJ5po9t3UMfMdUQoQmOZFW2U=', 1626246273),
(7, 'dskpolin@gmail.co', 'rb+p7x08kyxeNQRl2T4oRY3iHYjVn7lwZwxR76uK/m4=', 1626943059),
(8, 'desakpramitha93@gmail.com', '20210723RWBIHYYW', 1627036522),
(9, 'cahaya@gmail.com', '20210802IBXSZ8FM', 1627873362),
(10, 'cahaya@gmail.com', '20210805V3SNUOJI', 1628160676),
(11, 'cahaya@gmail.com', '20210807HRNJILDW', 1628319934),
(12, 'desakpramitha93@gmail.com', '2021080773ZIECES', 1628322793),
(13, 'desakpramitha93@gmail.com', '2021080773ZIECES', 1628322808),
(14, 'desakpramitha93@gmail.com', '2021080773ZIECES', 1628322820),
(15, 'desakpramitha93@gmail.com', '2021080773ZIECES', 1628322834),
(16, 'desakpramitha93@gmail.com', '2021080773ZIECES', 1628322847),
(17, 'desakpramitha93@gmail.com', '2021080773ZIECES', 1628322860),
(18, 'desakpramitha93@gmail.com', '2021080773ZIECES', 1628322875),
(19, 'desakpramitha93@gmail.com', '2021080773ZIECES', 1628322888),
(20, 'desakpramitha93@gmail.com', '20210807ZC9BHRSC', 1628324177),
(21, 'desakpramitha93@gmail.com', '20210807LKDY8N0U', 1628324770),
(22, 'desakpramitha93@gmail.com', '20210807GBAK189O', 1628326199),
(23, 'desakpramitha93@gmail.com', '20210807EUFRTHYV', 1628328325),
(24, 'desakpramitha93@gmail.com', '20210807EUFRTHYV', 1628328340),
(25, 'desakpramitha93@gmail.com', '20210807EUFRTHYV', 1628328352),
(26, 'desakpramitha93@gmail.com', '20210807EUFRTHYV', 1628328364),
(27, 'desakpramitha93@gmail.com', '20210807EUFRTHYV', 1628328377),
(28, 'desakpramitha93@gmail.com', '20210807UD8HXATL', 1628328897),
(30, 'desakpramitha93@gmail.com', '20210810ME6JRHPD', 1628573326),
(31, 'desakpramitha93@gmail.com', '20210810NKT6IOI9', 1628625155),
(32, 'desakpramitha93@gmail.com', '20210816ARFHQHZ1', 1629071930),
(33, 'devapenaka@gmail.com', 'MwKu+7akF5NKCFvZD4FUFjigJ/oBDtJ/5kn+jL5xjVo=', 1629215622),
(34, 'desakpramitha93@gmail.com', '20210818XAYTEQ3P', 1629262648),
(35, 'desakpramitha93@gmail.com', '20210818VFB9CZ5N', 1629270494),
(36, 'desakpramitha93@gmail.com', '202108183XIGVTK4', 1629271085);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indeks untuk tabel `image_product`
--
ALTER TABLE `image_product`
  ADD PRIMARY KEY (`image_id`);

--
-- Indeks untuk tabel `kabupaten`
--
ALTER TABLE `kabupaten`
  ADD PRIMARY KEY (`id_kab`);

--
-- Indeks untuk tabel `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id_kec`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indeks untuk tabel `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_detail_id`);

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indeks untuk tabel `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`ship_id`);

--
-- Indeks untuk tabel `testimoni`
--
ALTER TABLE `testimoni`
  ADD PRIMARY KEY (`testimoni_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`access_id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indeks untuk tabel `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`token_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `image_product`
--
ALTER TABLE `image_product`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `kabupaten`
--
ALTER TABLE `kabupaten`
  MODIFY `id_kab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `kecamatan`
--
ALTER TABLE `kecamatan`
  MODIFY `id_kec` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `shipping`
--
ALTER TABLE `shipping`
  MODIFY `ship_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `testimoni`
--
ALTER TABLE `testimoni`
  MODIFY `testimoni_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `access_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `user_token`
--
ALTER TABLE `user_token`
  MODIFY `token_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
