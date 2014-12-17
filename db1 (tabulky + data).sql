-- phpMyAdmin SQL Dump
-- version 4.3.1
-- http://www.phpmyadmin.net
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Úte 16. pro 2014, 21:18
-- Verze serveru: 5.6.17
-- Verze PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáze: `db1`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `diskuze`
--

CREATE TABLE IF NOT EXISTS `diskuze` (
`id` int(255) NOT NULL,
  `jmeno` varchar(30) COLLATE utf8_czech_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `cas` datetime NOT NULL,
  `text` varchar(500) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `diskuze`
--

INSERT INTO `diskuze` (`id`, `jmeno`, `email`, `cas`, `text`) VALUES
(1, 'Milan Růžička', 'milda.ruzicka@gmail.com', '2014-12-10 21:53:51', 'Vítejte na našich stránkách... :-) Zde se můžete ptát na cokoliv co Vás napadne. Jestliže se zaregistrujete můžete využít i soukromé zprávy přímo Našim poradcům.'),
(2, 'Karel', 'karel@gmail.com', '2014-12-10 21:57:10', 'Dobrý den, nemohu reagovat (odpovídat) na Dotazy statních... Kde je chyba?? Děkuji Karel'),
(3, 'Lenka', 'sdflenka@seznam.cz', '2014-12-10 22:10:48', 'Dobrý den, líbí se mi Vaše stránky a jelikož potřebuji pro svou firmu taky nějaké, chtěla bych člověka co vám je dělal...'),
(4, 'Bohumil Vzácný', 'vzacny@quatrofin.cz', '2014-12-10 22:13:46', 'Chtěl bych Vám všem nabídnout bla bla. Prostě něco co tu bude napasný...');

-- --------------------------------------------------------

--
-- Struktura tabulky `odpoved`
--

CREATE TABLE IF NOT EXISTS `odpoved` (
  `cas` datetime NOT NULL,
  `text` varchar(500) COLLATE utf8_czech_ci NOT NULL,
  `diskuze_id` int(255) NOT NULL,
  `uzivatel_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `odpoved`
--

INSERT INTO `odpoved` (`cas`, `text`, `diskuze_id`, `uzivatel_id`) VALUES
('2014-12-10 21:58:51', 'Dobrý den, musíte mít autorizovaný učet. Při registraci Vám přišel email s autorizačním odkazem, jestliže se Vám někde zatoulal, můžete si z nabídky "Můj účet" zaslat nový autorizační odkaz!', 2, 2),
('2014-12-10 22:11:20', 'Jsem to k Vašim službám... pište mi do soukromých zpráv, děkuji! :-)', 3, 1),
('2014-12-10 22:12:51', 'Paráda! :-)', 1, 3),
('2014-12-15 14:16:46', ':-) :-) :-)', 1, 1);

-- --------------------------------------------------------

--
-- Struktura tabulky `prijemce`
--

CREATE TABLE IF NOT EXISTS `prijemce` (
  `uzivatel_id` int(255) NOT NULL,
  `zprava_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `prijemce`
--

INSERT INTO `prijemce` (`uzivatel_id`, `zprava_id`) VALUES
(1, 14),
(2, 15),
(5, 16),
(3, 17),
(4, 18),
(6, 19),
(7, 20),
(8, 21);

-- --------------------------------------------------------

--
-- Struktura tabulky `uzivatel`
--

CREATE TABLE IF NOT EXISTS `uzivatel` (
`id` int(255) NOT NULL,
  `jmeno` varchar(30) COLLATE utf8_czech_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `heslo` varchar(200) COLLATE utf8_czech_ci NOT NULL,
  `telefon` int(9) NOT NULL,
  `typ_uctu` varchar(10) COLLATE utf8_czech_ci NOT NULL,
  `autorizace` varchar(30) COLLATE utf8_czech_ci NOT NULL,
  `ban` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `uzivatel`
--

INSERT INTO `uzivatel` (`id`, `jmeno`, `email`, `heslo`, `telefon`, `typ_uctu`, `autorizace`, `ban`) VALUES
(1, 'Milan Růžička', 'milda.ruzicka@gmail.com', 'af48f6b133945b2d659cbbbd8818a8de', 603355187, 'admin', '1', 0),
(2, 'Bohumil Vzácný', 'vzacny@quatrofin.cz', 'af48f6b133945b2d659cbbbd8818a8de', 777222333, 'admin', '1', 0),
(3, 'Václav', 'vasek@seznam.cz', 'af48f6b133945b2d659cbbbd8818a8de', 0, 'user', '1', 0),
(4, 'Karel', 'karel@gmail.com', 'af48f6b133945b2d659cbbbd8818a8de', 660934534, 'user', '04IqmmBZ7wQXiAJqRFeMvYT8BHxi7r', 0),
(5, 'Jitka Zajímavá', 'zajimava@guatrofin.cz', 'af48f6b133945b2d659cbbbd8818a8de', 0, 'admin', '1', 0),
(6, 'Ladislav Nový', 'novyl@atlas.cz', 'af48f6b133945b2d659cbbbd8818a8de', 343534635, 'user', '1', 0),
(7, 'Lucka S.', 'luciess@gmail.com', 'af48f6b133945b2d659cbbbd8818a8de', 0, 'user', 'aQlsGreYOqcfpbgI88OG3MpGrWRLBw', 1),
(8, 'Lenka', 'sdflenka@seznam.cz', 'af48f6b133945b2d659cbbbd8818a8de', 345345345, 'user', 'PH5LiTJq53QkYNjL9YYkilRPOLGRRU', 0),
(9, 'Dominik', 'domca@seznam.cz', 'af48f6b133945b2d659cbbbd8818a8de', 0, 'user', 'pSKmPsgo16tRoiMqfAMV7c1Y5sbcbL', 0);

-- --------------------------------------------------------

--
-- Struktura tabulky `zprava`
--

CREATE TABLE IF NOT EXISTS `zprava` (
`id` int(255) NOT NULL,
  `cas` datetime NOT NULL,
  `predmet` varchar(30) COLLATE utf8_czech_ci NOT NULL,
  `text` varchar(1000) COLLATE utf8_czech_ci NOT NULL,
  `kod_zpravy` varchar(20) COLLATE utf8_czech_ci NOT NULL,
  `uzivatel_id` int(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `zprava`
--

INSERT INTO `zprava` (`id`, `cas`, `predmet`, `text`, `kod_zpravy`, `uzivatel_id`) VALUES
(14, '2014-12-15 11:57:12', 'Zkouška admin', ' dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh ', 'odeslano', 1),
(15, '2014-12-15 11:57:12', 'Zkouška admin', ' dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh ', 'odeslano', 1),
(16, '2014-12-15 11:57:12', 'Zkouška admin', ' dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh  dfg s hgsgh sgh ', 'odeslano', 1),
(17, '2014-12-15 12:01:06', 'Zkouška user', '46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř ', 'odeslano', 2),
(18, '2014-12-15 12:01:06', 'Zkouška user', '46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř ', 'odeslano', 2),
(19, '2014-12-15 12:01:07', 'Zkouška user', '46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř ', 'odeslano', 2),
(20, '2014-12-15 12:01:07', 'Zkouška user', '46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř ', 'odeslano', 2),
(21, '2014-12-15 12:01:07', 'Zkouška user', '46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř 46334 řžččšř ', 'odeslano', 2);

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `diskuze`
--
ALTER TABLE `diskuze`
 ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `odpoved`
--
ALTER TABLE `odpoved`
 ADD KEY `diskuze_id` (`diskuze_id`), ADD KEY `uzivatel_id` (`uzivatel_id`);

--
-- Klíče pro tabulku `prijemce`
--
ALTER TABLE `prijemce`
 ADD KEY `zprava_id` (`zprava_id`), ADD KEY `uzivatel_id` (`uzivatel_id`);

--
-- Klíče pro tabulku `uzivatel`
--
ALTER TABLE `uzivatel`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `email` (`email`);

--
-- Klíče pro tabulku `zprava`
--
ALTER TABLE `zprava`
 ADD PRIMARY KEY (`id`), ADD KEY `uzivatel_id` (`uzivatel_id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `diskuze`
--
ALTER TABLE `diskuze`
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pro tabulku `uzivatel`
--
ALTER TABLE `uzivatel`
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pro tabulku `zprava`
--
ALTER TABLE `zprava`
MODIFY `id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `odpoved`
--
ALTER TABLE `odpoved`
ADD CONSTRAINT `odpoved_ibfk_1` FOREIGN KEY (`uzivatel_id`) REFERENCES `uzivatel` (`id`),
ADD CONSTRAINT `odpoved_ibfk_2` FOREIGN KEY (`diskuze_id`) REFERENCES `diskuze` (`id`);

--
-- Omezení pro tabulku `prijemce`
--
ALTER TABLE `prijemce`
ADD CONSTRAINT `prijemce_ibfk_1` FOREIGN KEY (`zprava_id`) REFERENCES `zprava` (`id`),
ADD CONSTRAINT `prijemce_ibfk_2` FOREIGN KEY (`uzivatel_id`) REFERENCES `uzivatel` (`id`);

--
-- Omezení pro tabulku `zprava`
--
ALTER TABLE `zprava`
ADD CONSTRAINT `zprava_ibfk_1` FOREIGN KEY (`uzivatel_id`) REFERENCES `uzivatel` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
