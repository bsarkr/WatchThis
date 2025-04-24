-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 24, 2025 at 04:06 AM
-- Server version: 8.0.40
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `WatchThis`
--

-- --------------------------------------------------------

--
-- Table structure for table `posters`
--

CREATE TABLE `posters` (
  `tmdb_id` varchar(20) NOT NULL,
  `poster_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `posters`
--

INSERT INTO `posters` (`tmdb_id`, `poster_path`, `created_at`) VALUES
('100361', '/bvwSKvfo3zgSXynZRJVAmQYbPGA.jpg', '2025-04-22 17:45:50'),
('1012180', '/hrusjWrcRuClY6PNooSZiKL6gqv.jpg', '2025-04-18 22:27:51'),
('10360', '/kAGQzhdPApR6fpJw7GZbxwEJoRs.jpg', '2025-04-21 13:56:00'),
('107969', '/5f4bVBvbmoxpI1Kl4wph7fv41K1.jpg', '2025-04-22 17:53:45'),
('108506', '/7bLWBv3NbqpnIorQ5XNPizgYZdV.jpg', '2025-04-21 23:54:14'),
('11092', '/7D2hj9CroMdVk0xDWPW8ygyFjmH.jpg', '2025-04-23 00:31:47'),
('111061', '/zgyi0CCQCqZO4fPkGeehyBui6M2.jpg', '2025-04-21 13:56:01'),
('1118443', '/kZHF4QsTgoRcRWvEcv2i3tN8hLA.jpg', '2025-04-21 02:11:23'),
('111947', '/xprnovu2l3WM4U5ff3yh0eZFyAx.jpg', '2025-04-21 13:44:48'),
('112194', '/arnLFHhCV62oq784GhFAgu8p1i8.jpg', '2025-04-23 13:39:36'),
('112258', '/5gxWrJrW1oDDcYQ29YQ9LDpx9dM.jpg', '2025-04-23 13:39:36'),
('112722', '/AmeM6W1Bp6ibXH4FlhmU8I811aS.jpg', '2025-04-23 13:39:35'),
('11328', '/eg1HgM1kF0SJbYsWVmpP2BjvPUU.jpg', '2025-04-21 01:05:58'),
('113955', '/hdFNEBxI7oCp07IC7Xv3RDUfSCL.jpg', '2025-04-23 13:39:36'),
('113957', '/zhnZ0dAPxPkQWZ0YPc4KpooE7Tz.jpg', '2025-04-21 15:57:21'),
('117079', '/ssLOJJZaZyVF76E4M0ARW6hAMO7.jpg', '2025-04-21 16:20:57'),
('117778', '/dkwVUfdz1T1e5VGBPgHbQSTgPKG.jpg', '2025-04-22 17:53:45'),
('118872', '/2mjvVqEXb5Ii64NQWgjsgKDeFlU.jpg', '2025-04-21 16:05:50'),
('1203494', '/4G85RPavdfDJCxg1fmc6OPPIVWB.jpg', '2025-04-21 23:54:14'),
('1205', '/VT1DGePeuqweHp13Ce6b3PnTXr.jpg', '2025-04-21 02:26:14'),
('1212142', '/k2Lq3rCJ7P9gk5Df9of9kqr9IJM.jpg', '2025-04-21 01:01:32'),
('122371', '/5ep1f35JBQqM9XbcM0rsFhhuddL.jpg', '2025-04-21 02:12:20'),
('12303', '/p9f54OrVwLGVHiHj13dgNWPpar9.jpg', '2025-04-22 17:45:51'),
('124636', '/fdJ6o8uOcEFiTRCo9WuZklj8EPK.jpg', '2025-04-23 00:31:45'),
('1246553', '/8SFY4fyPL12kE6Xz05dAG2IFTTy.jpg', '2025-04-22 17:52:51'),
('1247579', '/xHT2BLV5cwdLF5tQqeeQYjV9gB3.jpg', '2025-04-23 13:59:24'),
('125988', '/c2OijvbFEXBW1onbzuvENr4CGQB.jpg', '2025-04-21 16:20:52'),
('1273049', '/vKNJPuejtE6Xrp6RK6LKsQcbL8L.jpg', '2025-04-20 23:35:52'),
('127544', '/eBaUVUNAWSOg70TMl7o9K3qSgYO.jpg', '2025-04-21 02:26:29'),
('128087', '/4EVVIddeogmeWP3Iu3G7VWNjRcE.jpg', '2025-04-21 02:08:02'),
('1281091', '/ucwirgaK4v9ylQyDkwoXJtDIlf7.jpg', '2025-04-20 23:35:54'),
('128756', '/uq1BO4DmBMTM1PPULLoy4yIpsD.jpg', '2025-04-21 23:54:13'),
('1293286', '/O7REXWPANWXvX2jhQydHjAq2DV.jpg', '2025-04-19 22:43:07'),
('130396', '/q9FzTtXCbF0k5AeiymTTouOnHu8.jpg', '2025-04-23 13:39:36'),
('1318917', '/pg6sFi0pv8cPelkJGLZqmUxh24F.jpg', '2025-04-18 22:27:47'),
('132018', '/2hKPYaKtRkm4sNQXpyjPiDUQ1N2.jpg', '2025-04-22 16:16:37'),
('132346', '/9eYDb8c28vO78GgWFgigVkmZK9C.jpg', '2025-04-23 13:39:35'),
('133054', '/pmoicISpTRSt4bu03bwEaVazBXS.jpg', '2025-04-18 22:27:53'),
('133144', '/sn5RqwngufKXDtO63jFjZcL8fnV.jpg', '2025-04-23 00:31:46'),
('133154', '/8BNGnDKMaDvpmkTd6z9pQL97Upe.jpg', '2025-04-18 22:27:55'),
('133341', '/1HxYGPD7HbXTqa86dsPMI4HICnG.jpg', '2025-04-23 00:31:47'),
('133367', '/2OyNphGhUfpHt8qfaDxIm9c7HrK.jpg', '2025-04-23 00:31:47'),
('135687', '/5spwn9gNp0DJokaTo0aL4W1QaQJ.jpg', '2025-04-23 13:59:24'),
('13647', '/eebNTSRa5Hh5skPKGdGJIJpo9Ls.jpg', '2025-04-21 13:55:41'),
('137293', '/4FZM1tBMTarVSFkbJPg49rQiYq6.jpg', '2025-04-22 17:53:45'),
('138711', '/9jevHxWg9k9CYyPjVf5N1Jwo6LW.jpg', '2025-04-23 00:31:47'),
('141127', '/nkMXRZcQmd1LjLInwaJxeHTaJMi.jpg', '2025-04-21 13:45:30'),
('1416889', '/avD34sOjy6KbU1w6Xy9LhHYg60c.jpg', '2025-04-20 23:35:56'),
('1418522', '/o1ZIvviAEuIHcH9x6sv112mSvTR.jpg', '2025-04-20 23:35:56'),
('1424217', '/4pEX67LJd7ZIqYWtksBtOgQEGcQ.jpg', '2025-04-20 23:35:52'),
('1429616', '/wcbX32cfEeTvCyiI9icF0sclZKK.jpg', '2025-04-20 23:35:55'),
('1449539', '/me7RIXcNdZqaBpXW4swBKNIN12Z.jpg', '2025-04-18 22:27:47'),
('14609', '/zyMZ2boSccbaUjOkl6AdzLb6KKd.jpg', '2025-04-21 13:56:00'),
('14613', '/1y4J9HZJoTIMdt77wCq80uXaQJ.jpg', '2025-04-21 13:56:00'),
('1465', '/5wCJ8Rt9PA1j6jzzmUQg0EjsxwV.jpg', '2025-04-22 17:53:44'),
('147050', '/6TdW4T2EsnhXrPQccB8szK93UhF.jpg', '2025-04-21 16:20:56'),
('151870', '/2V3Tbq7xdRRw0G92Tx62IYDLz1g.jpg', '2025-04-21 01:01:17'),
('152483', '/kZKfZWwFOAicgoKS2IO7oM1GuHZ.jpg', '2025-04-21 13:44:48'),
('154567', '/ynzf39cYhmmXVEBTnA6g3eCKFw0.jpg', '2025-04-23 13:39:36'),
('155904', '/pWojxEek7t5F5yiCmlQDLUdzOj3.jpg', '2025-04-22 17:53:44'),
('155941', '/3BNFojAD8H3ijVCQzwnLjbxnOiL.jpg', '2025-04-21 15:57:21'),
('156452', '/2VvWSSklbQRc6V9gqfB92GRHkoY.jpg', '2025-04-23 13:39:35'),
('156933', '/7MXg0BxuSRWz2yKc03M40du2mrc.jpg', '2025-04-18 22:27:54'),
('157421', '/AuhPoFUKgYBRNDYjsTOPHE56Nzz.jpg', '2025-04-21 13:56:00'),
('157741', '/rxWtATtTdwx0ERQjQ7BtVOMyq5r.jpg', '2025-04-21 16:20:54'),
('16355', '/qHkpvJ7fjtxJNuDCyGZBHqYG05w.jpg', '2025-04-23 00:31:44'),
('16362', '/5geMfNYPfv00LwiFdQbd9WkCKlk.jpg', '2025-04-22 17:53:45'),
('170436', '/xSsIyX3JasqVliLJN9OeTv5R9DI.jpg', '2025-04-23 13:59:24'),
('171204', '/ujuXBISGWcH3uB8PQcCzwMTofAc.jpg', '2025-04-21 02:08:01'),
('17762', '/63Sx4oIRFofXW4Jlda79jEtjmoi.jpg', '2025-04-22 17:47:11'),
('18345', '/yB4hsQyUOPabIh8MWI64wb0kIF6.jpg', '2025-04-21 13:44:48'),
('187493', '/i4w6TzpddtQ1JghPjhWu8oJQwWA.jpg', '2025-04-23 13:39:34'),
('18867', '/bseGN199uoDDtUJIk2N4Wbc4gHl.jpg', '2025-04-21 02:08:20'),
('188885', '/oayvUuIxhFc2ppkPIGU8Nn0WKTg.jpg', '2025-04-22 15:52:29'),
('19388', '/agVWBrIBPpdOQqhnMjfUJ823Y6h.jpg', '2025-04-22 17:45:49'),
('194970', '/wmBPPyZAm1HmstOaYDz2lXA0sAK.jpg', '2025-04-21 13:45:04'),
('196322', '/c6MRUtPk0nEPQ9FBD9RdRKt2rIm.jpg', '2025-04-18 22:27:54'),
('200768', '/aMaKFYRkkDYcI9FDQeAKO3v6UwV.jpg', '2025-04-22 17:52:51'),
('20213', '/78cvdpfAbb2Y5JzanVcGn23TJYw.jpg', '2025-04-21 13:45:03'),
('205715', '/uuot1N5AgZ7xRCKgm4ZCwOhgIJu.jpg', '2025-04-21 13:44:48'),
('210288', '/s0aUORoF63PQTMFOFn9n9QxXDw7.jpg', '2025-04-23 13:39:36'),
('210318', '/sZXernSnVWGhlrAhDUDtdg3fuZn.jpg', '2025-04-21 13:44:49'),
('213306', '/wy8NYpq3k4izodX5YOYmExKfHMe.jpg', '2025-04-18 22:27:57'),
('2164', '/nkY0h3WxWWKIxrcpUJdziMV3IN3.jpg', '2025-04-21 13:45:04'),
('216412', '/1DGS6UQ063QLAjLlBAvKY5GcsM4.jpg', '2025-04-21 17:03:15'),
('217', '/a6O7gKJQe5HWaMujYvdMYaj9PnO.jpg', '2025-04-21 15:52:15'),
('217553', '/y8h2RwUZM5chv9tuaKVwSPoo3KE.jpg', '2025-04-21 16:20:55'),
('217761', '/8ePvF7LTxgAXGS62tc9mImIUhZx.jpg', '2025-04-21 23:54:14'),
('217800', '/buyQqbfJ2gNcog86HrTawMyxVPD.jpg', '2025-04-22 16:16:37'),
('220051', '/2jSiEfZ120vUWFFIsyZY305nt5b.jpg', '2025-04-22 17:53:44'),
('220521', '/1TJSkVjupmQ5tEeMrVzIa0Ry1gG.jpg', '2025-04-21 13:44:49'),
('220992', '/i6zwenRLASRRKTklSW4r1IAiLKP.jpg', '2025-04-21 13:45:03'),
('224127', '/tWCoaXLLbEooQL4d5U8KkURgcEw.jpg', '2025-04-21 13:55:42'),
('224972', '/7436ZhdHSvCojPYinu1eFgpgCjH.jpg', '2025-04-23 13:39:35'),
('224995', '/kQaVmglZ35dumB7fvtWsH15NUlj.jpg', '2025-04-22 17:45:52'),
('225', '/22wNUqKyz2m6wzAt31f26H8Y433.jpg', '2025-04-21 13:55:42'),
('226712', '/fP1GdBhf6lcZQg73g8QWOdJ2rr.jpg', '2025-04-22 17:53:46'),
('228079', '/1ViwT4iIsQpxvrVgIoAidOp5J33.jpg', '2025-04-18 22:27:53'),
('228672', '/uLwaKEqyi5QiaPf53JBuxQ9YXU5.jpg', '2025-04-21 02:26:12'),
('229460', '/1i7ig2OJ62DCAEpHyTYYQ1imVlf.jpg', '2025-04-21 02:08:20'),
('229513', '/hKq3uKgcUfEFcxtS77jhIjlMEuj.jpg', '2025-04-21 16:20:56'),
('229711', '/gwd2HpY2ymvmASUP3zMYF59IIr7.jpg', '2025-04-18 22:27:52'),
('23319', '/jffjpqXw6W9x6etUSYBkMPEQWRY.jpg', '2025-04-21 16:02:33'),
('233742', '/cIC36RA59lg9ruYtPc7UA3f72yy.jpg', '2025-04-18 22:27:56'),
('236836', '/rRox2vlzrq3GXY516jSTEGN2cTk.jpg', '2025-04-22 17:45:52'),
('238849', '/instfZXTt43Qgs2v2fCng1xLvQO.jpg', '2025-04-22 17:47:11'),
('240932', '/lIhkV9LNwViVD2bylPTFQvDD21e.jpg', '2025-04-21 16:20:54'),
('242404', '/wrbqFg5sIkZBIrJihFxqflhinLw.jpg', '2025-04-21 13:44:29'),
('243790', '/xfdKC0zg8MvEYgE2NZsHbw3WvgL.jpg', '2025-04-22 17:45:51'),
('243881', '/64ooH4xSiMGAFG11emiGv3pdVkH.jpg', '2025-04-18 22:27:52'),
('2443', '/1SgcheHtEcacQxRFKpIuP0jYw6u.jpg', '2025-04-21 13:56:00'),
('245561', '/VICqDMbB1K3MWZjtqxVEvl7ror.jpg', '2025-04-21 02:26:12'),
('246929', '/oYz66iyll5q5yImMnzVkvUOxBho.jpg', '2025-04-21 16:20:55'),
('247104', '/9lfg9REfxUx8xyCuNMalxzawYpQ.jpg', '2025-04-23 00:31:48'),
('247367', '/2LuObyUIr1YlqbcwmypJT4tO6Bv.jpg', '2025-04-21 16:20:53'),
('247859', '/vORim2Ymnr8ULKPiVWSh9PAeZ4b.jpg', '2025-04-21 16:20:54'),
('248982', '/62TJdt6GlzdRbyWY9RYWjljgg3b.jpg', '2025-04-21 16:20:55'),
('249023', '/yAtcsq5ciJ6TBfGzM0b6BzVCaPA.jpg', '2025-04-18 22:27:53'),
('249031', '/1BifdNaVpUZUkbHYVPVDBYBlqJj.jpg', '2025-04-21 16:20:56'),
('249545', '/6EUZcmKU8JsRfsLQEDVBbiCuQ9G.jpg', '2025-04-21 02:26:12'),
('249755', '/7kbmuNn37gENS4nq1CDSKGQbHia.jpg', '2025-04-20 01:50:33'),
('250598', '/dHxGWlygSNRb97wujSwtEts5snP.jpg', '2025-04-21 13:45:04'),
('250682', '/xeCOGwEGwiAAIybmZVklo6jsG8m.jpg', '2025-04-22 17:53:44'),
('25392', '/2dsJUooqTX5BkOmkfnuuFlkmbB6.jpg', '2025-04-22 17:53:44'),
('254653', '/zeynuCJTLvZBpNYtAzi5clXfBiq.jpg', '2025-04-18 22:27:55'),
('256128', '/8nUvTNrvw89ZqRhMHeV0gyWUkWC.jpg', '2025-04-21 13:45:18'),
('256162', '/wZiSjLZz3pB8YOKRAZcCeMM7HiV.jpg', '2025-04-21 01:05:58'),
('258764', '/6HAbRWYkX3bouEeHA4bjsUxznKC.jpg', '2025-04-18 22:27:55'),
('259559', '/jn74fTmDPlQLyHyhhErM82WqTlD.jpg', '2025-04-21 02:26:12'),
('261148', '/ZkvF2ASZD3gLDnn2ZJ7L7RGSBc.jpg', '2025-04-21 16:20:53'),
('261298', '/4TyTS9O7ECH3mXpazQ6GpJXCqNm.jpg', '2025-04-21 16:20:53'),
('261311', '/9i9V4kmO2jN6vRnnqQB4LpDHltD.jpg', '2025-04-21 02:26:13'),
('261579', '/tXMi6tb1owDAALnFFqnWjjd26if.jpg', '2025-04-18 22:27:57'),
('26182', '/3lY9bR7a0xc8XMyGkvg7S3DkMEZ.jpg', '2025-04-22 17:45:50'),
('262550', '/8Z3Sp3UUIz4qlc4Hy3MfkEwK2D4.jpg', '2025-04-21 01:01:32'),
('262819', '/eMh1V4XiAE29F7lRnwHJAE0tLEH.jpg', '2025-04-18 22:27:53'),
('2640', '/38AVLCBEoQKJWMyzt9jkxqeefGb.jpg', '2025-04-21 13:44:29'),
('270966', '/bacRhkShTQ0qqwCRJb53xANmgUl.jpg', '2025-04-22 17:52:50'),
('271003', '/eCWtp80MCEBPMuRmAjm2zNMgOSW.jpg', '2025-04-18 22:27:56'),
('271177', '/ng3cpfUS31CZZBanudPSIiewK6e.jpg', '2025-04-23 13:59:24'),
('272540', '/dsdwVLEXyZfDMnsMsQ64ooAiQPR.jpg', '2025-04-23 00:31:47'),
('276204', '/fZiuJtxzOlvvbQcgrCSnwefqkcp.jpg', '2025-04-21 16:20:53'),
('27678', '/v8StvvS5thbpsidFFPUth6vMziS.jpg', '2025-04-22 17:47:11'),
('281944', '/r2RzH3LGj6aAYYNBgWF3xyNxzyM.jpg', '2025-04-21 16:05:50'),
('284731', '/uImPA5WhNwSMcLUb3Y1KDDioTPQ.jpg', '2025-04-21 16:20:57'),
('285128', '/8q7WWQqsc99rPAs0mjWf8Ey7IJk.jpg', '2025-04-18 22:27:55'),
('285267', '/jyJ7lRbh4QD6EOL2ARRZr5y3OAT.jpg', '2025-04-18 22:27:56'),
('285427', '/nxeChs62ZQKNySzrCwDnbHU00fg.jpg', '2025-04-18 22:27:55'),
('285569', '/4eHiO7vpl5HpL8AvrOmUjJ2GxTD.jpg', '2025-04-21 15:57:21'),
('286153', '/lZlZaKldZ2BqejLBBsmoAO5XGad.jpg', '2025-04-18 22:27:55'),
('286235', '/mkrCrpgi7ObE6RdOIGiHGwSDd6A.jpg', '2025-04-21 13:45:17'),
('286269', '/ayxcusC72JSnhVs1I62hvXnY4Yu.jpg', '2025-04-18 22:27:56'),
('287291', '/67e64FflP91V2IvM2uyaqU1ST4J.jpg', '2025-04-19 01:09:11'),
('288377', '/juNPjycMnjazImnPZzizH5wKQCz.jpg', '2025-04-18 22:27:55'),
('2898', '/beaMCxE00CGMSk6MVCcvhZkwqSV.jpg', '2025-04-22 15:52:29'),
('307280', '/kwYyJYqzVJwMUbpBenNh7waTdqv.jpg', '2025-04-23 13:39:35'),
('31115', '/asOWPn11QZglsGEVdN69gcyvQFQ.jpg', '2025-04-21 13:45:03'),
('31185', '/tAXsW2oiAtGHSSQzQZNZIZa7hAD.jpg', '2025-04-21 13:44:48'),
('317914', '/oxgRmGnB9hKuDGZ4JVhEDj04lIf.jpg', '2025-04-21 02:26:29'),
('318841', '/xmCShCHooYEKrHpDvBZhhdJRc53.jpg', '2025-04-23 00:31:45'),
('323408', '/pdNBpaKAaG9f6793LtYPkwPga1G.jpg', '2025-04-21 16:05:50'),
('33769', '/dRNiAhUIpiiZkvCabIPvmfyfvT6.jpg', '2025-04-21 13:45:30'),
('35006', '/wsf399maXMnhOWfQSjOxErURxzN.jpg', '2025-04-23 13:39:35'),
('353921', '/v0S1wr7E4c436d57hygZvDoeUvR.jpg', '2025-04-21 15:52:14'),
('353927', '/2eYc21lg0MoPEp0zFJCnbcSuQlk.jpg', '2025-04-21 15:52:14'),
('36096', '/oWr5sJpL46XyWfDNnh9AaBawjJP.jpg', '2025-04-21 13:45:29'),
('361112', '/23oWvVymDwaRkmLH8a8T7yGdDnN.jpg', '2025-04-21 23:54:13'),
('366969', '/m9tz62H82NEcGzwUAX3pT0tmaUJ.jpg', '2025-04-21 13:45:30'),
('368119', '/9XRqSJ8EGgBxPTWAmFcTbVcAgKk.jpg', '2025-04-21 13:45:31'),
('370082', '/aRIUNo1MIWZVZA25LA5j6UBYB1c.jpg', '2025-04-21 15:52:15'),
('37058', '/1jq9zUwPIFGid3BMrLLcm3YY2nY.jpg', '2025-04-21 15:57:21'),
('375814', '/dh9bSi241u6gUNybOZKzqXagTp6.jpg', '2025-04-21 13:45:17'),
('378204', '/ylLYJ5jl22ydWaSsagtSqPMA0un.jpg', '2025-04-21 01:25:06'),
('38112', '/zAdiOfxntBDbY3GSr17Q8vUQxE6.jpg', '2025-04-21 02:08:20'),
('38294', '/bJQnuGaXML31QyjxwMXuu39Tye1.jpg', '2025-04-22 17:45:51'),
('39026', '/tFVAVIXdlbw7bWP1OGvlVtD0n9H.jpg', '2025-04-22 16:16:37'),
('392031', '/y4IH8uTbG1Vr8UJcQB4JxMZbBaZ.jpg', '2025-04-21 13:56:00'),
('39369', '/9JvfWmL34CGzMvJy7SfMTRaTE7E.jpg', '2025-04-21 13:56:01'),
('398430', '/sQDEqYIXA1pHIzjNREu2XnX8vDn.jpg', '2025-04-23 00:31:44'),
('405755', '/6sFFzLjItKXdOQrSufN2Yh7cafd.jpg', '2025-04-21 15:57:21'),
('40684', '/ibrHNqVagmaOifBP2SVgNRqElRP.jpg', '2025-04-21 16:05:51'),
('410867', '/c00A26utg1OZPHmme2e2bAxzKv7.jpg', '2025-04-23 13:39:35'),
('411462', '/kPyJcXyhhu67ddUmTccnFlNEgWB.jpg', '2025-04-21 02:11:24'),
('42717', '/ibiCxfSxJvZdfknh5jiHfduBmFi.jpg', '2025-04-22 15:52:29'),
('42832', '/yk4NokXK0Bg84ULFOiVFmXp12EC.jpg', '2025-04-21 13:44:47'),
('42841', '/o36DMQwV9rYkAXMpPVbTDxniD6u.jpg', '2025-04-21 13:44:47'),
('428889', '/lEoLR253EuoV8U6vfvZTxUsziGH.jpg', '2025-04-22 17:53:43'),
('4289', '/j5A8NkLVhsqwwIhI0azgJ3pmpnb.jpg', '2025-04-22 15:52:29'),
('436824', '/f8C9Gvkjh75kkhWaYNGDvc8KSr5.jpg', '2025-04-23 13:59:24'),
('44869', '/8FinPadaPJ40JDEzfWIi8q4RV3Y.jpg', '2025-04-22 17:45:49'),
('45095', '/iP03rReURfYR4msTdsOS28DnnqH.jpg', '2025-04-21 13:45:04'),
('4552', '/kUTCJhSnH3Dt0KVzcQp8DnbmsjN.jpg', '2025-04-22 03:27:50'),
('458750', '/xIfESlEQhoayZ5SsSjPl90TCE4p.jpg', '2025-04-21 16:02:33'),
('46518', '/rSAmgcoA74371rplbqM27yVsd3y.jpg', '2025-04-18 22:27:54'),
('465712', '/12aQFBEZyqoeOPmWPilfAcpCpnd.jpg', '2025-04-21 16:02:34'),
('469369', '/urlZsokioZMQEMJEpV8HIzAtzku.jpg', '2025-04-22 17:53:43'),
('4752', '/A9yvtVflorbf0MmzkzWkQ0nmg3U.jpg', '2025-04-21 23:54:15'),
('475938', '/xyh60BxXx72lOh4eQeQvin82BsL.jpg', '2025-04-22 17:52:50'),
('476424', '/xNcvOfDbfL14F8SLYe1IlaBP57k.jpg', '2025-04-21 02:26:32'),
('48297', '/bKRXF9EIgSP1hzckjUTmj7VEr2m.jpg', '2025-04-21 13:45:03'),
('487458', '/4DzDcLodDRCMd4webyvt4MkYZ2.jpg', '2025-04-23 13:59:24'),
('49455', '/vHPJGFP7UONECmRW1blxcJ5clJ6.jpg', '2025-04-22 17:45:50'),
('495139', '/sD9MbhIIXR9IrsMqjTUpwPcJdNK.jpg', '2025-04-23 00:31:45'),
('503442', '/bemt4A9e75E4N4LFzZWbjlvDfNi.jpg', '2025-04-21 13:45:18'),
('505239', '/1fTLU6KMyn4GC1Bzqo83nQz7MvH.jpg', '2025-04-21 13:45:30'),
('505395', '/tZLFv0W4TXBzJhfps2Z945tEO3j.jpg', '2025-04-22 17:47:17'),
('509221', '/gdNjcdisO8I93UOF07u4ktyfeC3.jpg', '2025-04-21 16:02:33'),
('51712', '/1ZSoa5AMpWsrqjk5faQKvjgLmBX.jpg', '2025-04-23 00:31:47'),
('51868', '/gtJ9MYFJEi6PtZfOKYWralJCj0c.jpg', '2025-04-21 13:44:29'),
('5339', '/k9ux77quCeiEchr36OAUuv41zoR.jpg', '2025-04-21 15:52:15'),
('54930', '/yC0Ia6TukxzsEe0dtwjbn24a2Jp.jpg', '2025-04-22 16:16:37'),
('553071', '/yfGnDOwW4JiNO9LBgckffzgQfCq.jpg', '2025-04-23 00:31:45'),
('557292', '/vGhEc7Bu6u6Lr8sUeLN3iDFIPNM.jpg', '2025-04-21 13:45:16'),
('574475', '/cAoktVUBhGyULRoxV6mZ2LB3x7I.jpg', '2025-04-22 17:53:44'),
('575779', '/NkIzw27ddHPC3DS8xa8kQJi7XB.jpg', '2025-04-21 13:45:30'),
('57982', '/8EpqInXBpIqtf7csOmHFsdEvIj3.jpg', '2025-04-23 00:31:46'),
('584268', '/x2Nl7uztsmarItXY56DyRRcKscr.jpg', '2025-04-23 00:31:46'),
('608559', '/ndSD1g21f7QZHYmE3BHjrjxFOp1.jpg', '2025-04-21 01:12:46'),
('60860', '/g6OKf4gfojZg5Npfx6RPzVz8c8T.jpg', '2025-04-23 00:31:46'),
('611171', '/qPX9Pdv8xNdfgFJWUpVzgyIM4u4.jpg', '2025-04-21 16:02:34'),
('61367', '/AdJJMOA2I6Yw6NTPsEWS5jPxy0L.jpg', '2025-04-21 02:08:21'),
('61542', '/bHgBv4rZBn0PhF2goF3VfeKWBUt.jpg', '2025-04-21 13:45:04'),
('61739', '/pRt6yU9zAJfzc9VhARcmn8tIFNl.jpg', '2025-04-21 13:55:42'),
('618538', '/jdEFHow2NLApEx3EcdzKGrLUon6.jpg', '2025-04-21 02:07:12'),
('623533', '/qKpv6ldxn0sK4d15G2Iu1dNdZuX.jpg', '2025-04-21 13:45:03'),
('626561', '/roujpqgKE3dIY7jmO5FDw3aZ7td.jpg', '2025-04-21 01:05:58'),
('6278', '/3VT1T4gYPCBcG3dNLiHkcweMC2F.jpg', '2025-04-22 15:52:29'),
('627887', '/7P9cbzFsx7EiFSNe7HW5c9LCO07.jpg', '2025-04-21 16:02:34'),
('628431', '/4BDHKScNHldEE0kFeqwDYhtDhUg.jpg', '2025-04-21 13:55:42'),
('631170', '/4p71ut7hLsNIWXli2HcaHaqKFu9.jpg', '2025-04-23 13:39:35'),
('638307', '/nWGC3v4TCVVYljO7adQI1lgzjRu.jpg', '2025-04-21 16:02:33'),
('65046', '/uI8HWd0ksskaoypg5vE7zj3zTUe.jpg', '2025-04-21 02:26:14'),
('65945', '/a9lY3DCLU3DWvUshho6hAX2hKKh.jpg', '2025-04-21 02:08:20'),
('66614', '/2pxIl32GtXBHxZLwZtqbx2jYcoa.jpg', '2025-04-23 13:39:36'),
('666561', '/e5TGqnxk58bgxGrzi4rt9sqbZwl.jpg', '2025-04-22 17:52:50'),
('66848', '/d0bXykkAS4gR4eWlDLnCcOcuV9I.jpg', '2025-04-21 13:56:01'),
('681560', '/cOndQUYbCWhZhgNtRKS3agyjvSf.jpg', '2025-04-23 00:31:45'),
('68256', '/3Ts4fCTVnGPkd5KNdga3srZk8oG.jpg', '2025-04-21 13:45:31'),
('6831', '/7EXQeZtnW96CrDzsqQvexYWISeT.jpg', '2025-04-21 02:08:20'),
('68368', '/vjQFgKpE7o5URaSAPyvEGzTYKOo.jpg', '2025-04-21 02:08:02'),
('689986', '/gysElpoO9XADwjdbhf6JvFfZSwu.jpg', '2025-04-21 16:05:50'),
('69062', '/wLx4PNBtQyXQikYe9XFTuuH1ykB.jpg', '2025-04-21 13:56:01'),
('70616', '/ryfp4imf6yqz1f7bY8Iwkj2v6XJ.jpg', '2025-04-21 13:45:30'),
('70801', '/6wQAZaWSvBJOIIt68cqmC0KJjeE.jpg', '2025-04-21 13:56:01'),
('709614', '/951t3910hHAQ4bIa8PLiJWSPodl.jpg', '2025-04-23 13:59:24'),
('71922', '/jEr2olEf7ypfKafHrAM9HMYMDHL.jpg', '2025-04-21 13:45:04'),
('72739', '/pfGyOXhabq3CrjSLx7LJjCrWTHy.jpg', '2025-04-21 15:52:15'),
('727507', '/lnsCT4n8OD1UFQwHDVOBbamSdh.jpg', '2025-04-21 13:45:17'),
('727553', '/rcJyomm7U8sR48FiMmkLRCVZZ2U.jpg', '2025-04-21 13:45:16'),
('73339', '/axn4MXeCdFCOG7i8i6DvbolzZeG.jpg', '2025-04-21 13:44:48'),
('7361', '/tLomUa8wQd8IKursGSuGW2n6kt2.jpg', '2025-04-21 15:52:15'),
('736596', '/gBDLOpq1MKkJzIG132cCbwdLh5c.jpg', '2025-04-23 00:31:46'),
('750905', '/ne2JtanGjwQDmlREUBNrMlB93l0.jpg', '2025-04-23 13:39:35'),
('75671', '/nIZvx1tm7rxaAulbxoERTBMqErN.jpg', '2025-04-22 17:53:45'),
('76479', '/2zmTngn1tYC1AvfnrFLhxeD82hz.jpg', '2025-04-21 16:20:52'),
('76737', '/kP7ST8BGmzs2HGXKgoZRmSeGJBI.jpg', '2025-04-21 02:08:19'),
('77175', '/dOPrKofNEryFCTuJ5Zl61wfMyHi.jpg', '2025-04-23 00:31:47'),
('77269', '/93pxdXPT8RC2pArLU3iQPGyQkAX.jpg', '2025-04-21 02:08:02'),
('77362', '/w10ClxT6uqnyxJZiMAx2ty9GkWu.jpg', '2025-04-21 13:55:42'),
('781188', '/zGhMHY3Er39KsA1vQL0jph2KfxG.jpg', '2025-04-22 17:52:50'),
('78414', '/bZuk527rFDJuoKLShC48F89Pkjt.jpg', '2025-04-23 00:31:46'),
('79052', '/wIlHx7FRCpAxwOTI76aPZluMqzx.jpg', '2025-04-22 17:45:50'),
('80561', '/svQgyQM9mnEeQC8KtbNvU6Bhs76.jpg', '2025-04-22 16:16:37'),
('82682', '/df2BpzYyo4p4UrD12NGu1mKhkMc.jpg', '2025-04-22 16:16:37'),
('83040', '/h0TG8qjQvTkup3pITtTvvQdpZer.jpg', '2025-04-22 16:16:37'),
('84105', '/p0qM8hhlMF5DuxHBzl2EZR6TehX.jpg', '2025-04-21 02:08:21'),
('841815', '/bXUFhmFYgQCIsajcvIrzHrlZn69.jpg', '2025-04-22 17:52:50'),
('843486', '/1n2X6gCBshGwSln5tGUe3xmDXlJ.jpg', '2025-04-21 13:45:17'),
('870028', '/4rxr2grcBfxwH4penSxndcPwyDp.jpg', '2025-04-23 13:59:24'),
('88336', '/m5Z5nIegSkgXGQPlAKAAvLRs5l4.jpg', '2025-04-21 15:52:15'),
('88631', '/AbTrTGJcDOgqcES3lgBg20QgnsG.jpg', '2025-04-21 13:45:03'),
('8864', '/hMwTPH02bsdGSLEARYdEwlQiGC8.jpg', '2025-04-22 16:16:37'),
('891097', '/hT2jc1V7lHnZ4k1IYorZ92gpCIC.jpg', '2025-04-23 00:31:45'),
('895754', '/3QzSViaGB1qPjGVILubVPwb3rCM.jpg', '2025-04-21 13:45:17'),
('89664', '/jY6CkK0nAEg1uiUxeQMFlIRKbfp.jpg', '2025-04-22 17:52:51'),
('90100', '/gbjKysqkqa1OodfnXp3K60zAqBs.jpg', '2025-04-22 17:45:51'),
('94168', '/fi6aK4YAiEJ9AQiX06cET0Qb0Cz.jpg', '2025-04-23 13:39:35'),
('94954', '/rXojaQcxVUubPLSrFV8PD4xdjrs.jpg', '2025-04-21 02:12:20'),
('95396', '/pPHpeI2X1qEd1CS1SeyrdhZ4qnT.jpg', '2025-04-21 16:20:52'),
('95557', '/jBn4LWlgdsf6xIUYhYBwpctBVsj.jpg', '2025-04-21 16:20:52'),
('96420', '/olQwMktOpZLelpey4vOTZCxpZ4c.jpg', '2025-04-22 16:16:37'),
('96580', '/if3a4X3iJksQr7xmE7ITsbJ2PlA.jpg', '2025-04-21 16:05:50'),
('97206', '/ao7TWd597Rzg4NpMrCLlnRy1yRp.jpg', '2025-04-22 17:45:51'),
('979296', '/ifc2YN7eZeHKwaoiT0Xn8LiJCFb.jpg', '2025-04-23 00:31:45'),
('982151', '/5NKrsHUzpACAUWdfhbZOFbWOCGw.jpg', '2025-04-21 13:45:30'),
('98545', '/lIFdBogazScckoSyA68JRt8RyXp.jpg', '2025-04-21 01:01:17'),
('987973', '/wTVZyG5QTjzcm3CUgfstvAHep0i.jpg', '2025-04-21 23:54:14'),
('99026', '/aMw9QENE7fDFCRgC1D6wr4Giqyk.jpg', '2025-04-23 13:39:35'),
('99073', '/iyTiJqrAs2YItyTYGI18PdqX65c.jpg', '2025-04-21 13:45:04'),
('99242', '/kiAp7Ncqy6kk8nblGIin9E9yoXl.jpg', '2025-04-21 13:45:16'),
('9957', '/8IuTg9XaviDwpfm99IXUUPukrVA.jpg', '2025-04-23 13:39:35');

-- --------------------------------------------------------

--
-- Table structure for table `profile_pictures`
--

CREATE TABLE `profile_pictures` (
  `id` int NOT NULL,
  `file_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `profile_pictures`
--

INSERT INTO `profile_pictures` (`id`, `file_path`) VALUES
(11, '/assets/images/profPics/avatar1.png'),
(12, '/assets/images/profPics/avatar2.png'),
(13, '/assets/images/profPics/avatar3.png'),
(14, '/assets/images/profPics/avatar4.png'),
(15, '/assets/images/profPics/avatar5.png'),
(16, '/assets/images/profPics/avatar6.png'),
(17, '/assets/images/profPics/avatar7.png'),
(18, '/assets/images/profPics/avatar8.png'),
(19, '/assets/images/profPics/avatar9.png'),
(20, '/assets/images/profPics/avatar10.png');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `content`, `created_at`) VALUES
(3, 'Bilash', 'This website stinks!!', '2025-04-22 03:12:17'),
(4, 'Kristyanna', 'Great website, needs more features.', '2025-04-22 16:14:25'),
(5, 'Kevin', 'i like movie good movie good site yay', '2025-04-22 16:14:53'),
(6, 'Gisselle', 'Really easy to use! I&#039;m able to find where I can watch the movie super fast. Has every movie ever!!', '2025-04-22 17:49:30'),
(7, 'Haley M.', 'I love this website! This is the best thing ever since Sliced bread. I use it allllll the time.', '2025-04-22 17:50:42'),
(8, 'Chris Silva', 'Solid website needs a bit more work 8/10', '2025-04-22 17:57:26'),
(9, 'Steven P.', 'Absolute trash.... Google does it better. There isn&#039;t even a &quot;did you mean&quot; prompt after an incorrectly entered title. Jk. Pretty easy to use and has a very straightforward interface. After some work, this could be very useful.', '2025-04-22 18:09:23'),
(10, 'GG', 'Love the website, so informative. Great Job!', '2025-04-22 20:22:49'),
(11, 'Ken Alva', 'This site is great! I can&#039;t wait for the feature that allows me to set up times with friends to watch movies. However, I believe the genre list should be expanded. Movies are dynamic and often encompass multiple genres, so it would be beneficial to add the option to select more than one genre to refine the movie selection. The site does take a while to load, but other than that, I enjoy using it because it provides me with movie site information without the unnecessary extra details that Google often includes.', '2025-04-23 13:53:12'),
(12, 'J', 'Such a cool idea! Hope to see more improvements in the future! 5 stars.', '2025-04-23 13:54:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `avatar_id` int DEFAULT NULL,
  `sessionExpiration` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `avatar_id`, `sessionExpiration`) VALUES
(2, 'sinnies8', 'sarkarsinnie@gmail.com', '$2y$10$plt15veRRPlQJtu3FRO/2OtC8cNGRRyC9Ez8YZyTqsXyd.citJWmC', '2025-04-19 01:40:16', 14, NULL),
(52, 'bsarkar', 'bsarkar@fordham.edu', '$2y$10$RjEMcJYRNNZ/oUHd2O6eru9Qd5o5QNA/fNvvPu/pULjldiYdNTJTG', '2025-04-20 18:30:15', 13, '2025-04-24 07:38:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posters`
--
ALTER TABLE `posters`
  ADD PRIMARY KEY (`tmdb_id`);

--
-- Indexes for table `profile_pictures`
--
ALTER TABLE `profile_pictures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `profile_pictures`
--
ALTER TABLE `profile_pictures`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
