-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1:3306
-- Létrehozás ideje: 2024. Már 18. 15:13
-- Kiszolgáló verziója: 8.2.0
-- PHP verzió: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `php_a_gyakorlatban`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cms_admin`
--

DROP TABLE IF EXISTS `cms_admin`;
CREATE TABLE IF NOT EXISTS `cms_admin` (
  `id` tinyint UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `jelszo` char(48) COLLATE utf8mb4_general_ci NOT NULL,
  `letrehozas` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `cms_admin`
--

INSERT INTO `cms_admin` (`id`, `email`, `jelszo`, `letrehozas`) VALUES
(1, 'jancsi@gmail.com', '49cef48df229f6e608f4b57c11ef05c4f014f0c6', '2024-03-18 18:15:00');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cms_tartalom`
--

DROP TABLE IF EXISTS `cms_tartalom`;
CREATE TABLE IF NOT EXISTS `cms_tartalom` (
  `id` smallint UNSIGNED NOT NULL AUTO_INCREMENT,
  `allias` varchar(32) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sorrend` smallint UNSIGNED NOT NULL,
  `menunev` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `tartalom` text COLLATE utf8mb4_general_ci NOT NULL,
  `letrehozas` datetime NOT NULL,
  `modositas` datetime DEFAULT NULL,
  `leiras` text COLLATE utf8mb4_general_ci,
  `kulcsszavak` text COLLATE utf8mb4_general_ci,
  `statusz` tinyint UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `cms_tartalom`
--

INSERT INTO `cms_tartalom` (`id`, `allias`, `sorrend`, `menunev`, `tartalom`, `letrehozas`, `modositas`, `leiras`, `kulcsszavak`, `statusz`) VALUES
(1, 'bemutatkozas', 1, 'Bemutatkozás', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '2024-03-18 07:15:15', NULL, 'Leírás 1.', 'Kulcsszavak 1.', 1),
(2, 'kedvencek', 2, 'Kedvencek', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', '2024-03-18 07:20:20', NULL, 'Learás 2.', 'Kulcsszavak 2.', 1),
(3, 'kepgaleria', 3, 'Képgaléria', '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p>', '2024-03-18 07:25:25', NULL, 'Leírás 3.', 'Kulcsszavak 3.', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
