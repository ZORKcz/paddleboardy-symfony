-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Pát 24. dub 2026, 11:13
-- Verze serveru: 10.4.32-MariaDB
-- Verze PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `paddleboardy`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `adresa`
--

CREATE TABLE `adresa` (
  `id` int(11) NOT NULL,
  `ulice` varchar(100) NOT NULL,
  `mesto` varchar(100) NOT NULL,
  `psc` varchar(10) NOT NULL,
  `zeme` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `adresa`
--

INSERT INTO `adresa` (`id`, `ulice`, `mesto`, `psc`, `zeme`) VALUES
(1, 'Hlavní pláž 1', 'Doksy', '47201', 'Česká republika'),
(2, 'Přístav 123', 'Lipno nad Vltavou', '38278', 'Česká republika'),
(3, 'Nová Rabyně', 'Slapy', '25208', 'Česká republika');

-- --------------------------------------------------------

--
-- Struktura tabulky `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Vypisuji data pro tabulku `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20260423120356', '2026-04-23 14:04:01', 1215),
('DoctrineMigrations\\Version20260423124709', '2026-04-23 14:47:14', 11);

-- --------------------------------------------------------

--
-- Struktura tabulky `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `platba`
--

CREATE TABLE `platba` (
  `id` int(11) NOT NULL,
  `castka` decimal(10,2) NOT NULL,
  `datum_platby` date NOT NULL,
  `variabilni_symbol` varchar(10) NOT NULL,
  `rezervace_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `polozka_rezervace`
--

CREATE TABLE `polozka_rezervace` (
  `id` int(11) NOT NULL,
  `mnozstvi` int(11) NOT NULL,
  `skutecna_cena` decimal(10,2) NOT NULL,
  `rezervace_id` int(11) NOT NULL,
  `skladova_polozka_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `produkt`
--

CREATE TABLE `produkt` (
  `id` int(11) NOT NULL,
  `nazev` varchar(150) NOT NULL,
  `popis` varchar(255) DEFAULT NULL,
  `doporucena_cena` decimal(10,2) NOT NULL,
  `foto_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `produkt`
--

INSERT INTO `produkt` (`id`, `nazev`, `popis`, `doporucena_cena`, `foto_url`) VALUES
(1, 'Základní set', 'Paddleboard, hliníkové pádlo, leash, pumpa.', 150.00, '/img/zakladni_set.jpg'),
(2, 'Premium set', 'Rychlý touring board, karbonové pádlo, vak.', 200.00, '/img/premium_set.jpg'),
(3, 'Rodinný balíček', '2x dospělý board, 1x dětský, 3x vesta.', 550.00, '/img/rodinny_set.jpg');

-- --------------------------------------------------------

--
-- Struktura tabulky `region`
--

CREATE TABLE `region` (
  `id` int(11) NOT NULL,
  `nazev` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `region`
--

INSERT INTO `region` (`id`, `nazev`) VALUES
(1, 'Liberecký kraj'),
(2, 'Jihočeský kraj'),
(3, 'Středočeský kraj');

-- --------------------------------------------------------

--
-- Struktura tabulky `rezervace`
--

CREATE TABLE `rezervace` (
  `id` int(11) NOT NULL,
  `datum_od` date NOT NULL,
  `datum_do` date NOT NULL,
  `celkova_cena` decimal(10,2) DEFAULT NULL,
  `datum_vytvoreni` date NOT NULL,
  `zakaznik_id` int(11) NOT NULL,
  `stav_rezervace_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `skladova_polozka`
--

CREATE TABLE `skladova_polozka` (
  `id` int(11) NOT NULL,
  `mnozstvi_skladem` int(11) NOT NULL,
  `seriove_cislo` varchar(100) DEFAULT NULL,
  `gps_lokator_id` varchar(50) DEFAULT NULL,
  `poznamka` varchar(255) DEFAULT NULL,
  `produkt_id` int(11) NOT NULL,
  `stanice_id` int(11) NOT NULL,
  `stav_polozky_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `skladova_polozka`
--

INSERT INTO `skladova_polozka` (`id`, `mnozstvi_skladem`, `seriove_cislo`, `gps_lokator_id`, `poznamka`, `produkt_id`, `stanice_id`, `stav_polozky_id`) VALUES
(1, 10, 'ZAKL-MACH-01', 'GPS-M01', 'Standardní výbava', 1, 1, 1),
(2, 5, 'PREM-LIP-01', 'GPS-L01', 'Prémiová výbava', 2, 2, 1),
(3, 3, 'ROD-SLAP-01', 'GPS-S01', 'Rodinné sety', 3, 3, 1);

-- --------------------------------------------------------

--
-- Struktura tabulky `stanice`
--

CREATE TABLE `stanice` (
  `id` int(11) NOT NULL,
  `nazev` varchar(100) NOT NULL,
  `gps_pozice` varchar(50) NOT NULL,
  `servisni_telefon` varchar(20) NOT NULL,
  `region_id` int(11) NOT NULL,
  `adresa_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `stanice`
--

INSERT INTO `stanice` (`id`, `nazev`, `gps_pozice`, `servisni_telefon`, `region_id`, `adresa_id`) VALUES
(1, 'Máchovo jezero', '50.5833, 14.6667', '+420 111 222 333', 1, 1),
(2, 'Lipno nad Vltavou', '48.6333, 14.2167', '+420 444 555 666', 2, 2),
(3, 'Slapy', '49.8167, 14.4167', '+420 777 888 999', 3, 3);

-- --------------------------------------------------------

--
-- Struktura tabulky `stav_rezervace`
--

CREATE TABLE `stav_rezervace` (
  `id` int(11) NOT NULL,
  `kod` varchar(50) NOT NULL,
  `popis` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `stav_rezervace`
--

INSERT INTO `stav_rezervace` (`id`, `kod`, `popis`) VALUES
(1, 'NOVA', 'Nová rezervace, čeká na platbu'),
(2, 'ZAPLACENA', 'Rezervace je zaplacená a potvrzená'),
(3, 'PROBIHA', 'Zákazník má paddleboard aktuálně vypůjčený'),
(4, 'DOKONCENA', 'Paddleboard byl v pořádku vrácen'),
(5, 'ZRUSENA', 'Rezervace byla zrušena');

-- --------------------------------------------------------

--
-- Struktura tabulky `stav_skladove_polozky`
--

CREATE TABLE `stav_skladove_polozky` (
  `id` int(11) NOT NULL,
  `nazev` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `stav_skladove_polozky`
--

INSERT INTO `stav_skladove_polozky` (`id`, `nazev`) VALUES
(1, 'K dispozici'),
(2, 'Vypůjčeno'),
(3, 'V servisu'),
(4, 'Vyřazeno');

-- --------------------------------------------------------

--
-- Struktura tabulky `vydej`
--

CREATE TABLE `vydej` (
  `id` int(11) NOT NULL,
  `datum_cas_vydeje` date NOT NULL,
  `datum_cas_vraceni` date DEFAULT NULL,
  `poznamka` varchar(255) DEFAULT NULL,
  `polozka_rezervace_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `zakaznik`
--

CREATE TABLE `zakaznik` (
  `id` int(11) NOT NULL,
  `jmeno` varchar(100) NOT NULL,
  `prijmeni` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefon` varchar(20) NOT NULL,
  `souhlas_s_podminkami` tinyint(4) NOT NULL,
  `poznamka` varchar(255) DEFAULT NULL,
  `heslo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Vypisuji data pro tabulku `zakaznik`
--

INSERT INTO `zakaznik` (`id`, `jmeno`, `prijmeni`, `email`, `telefon`, `souhlas_s_podminkami`, `poznamka`, `heslo`) VALUES
(1, '', '', 'zork7417@gmail.com', '', 1, NULL, '9E0AE6');

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `adresa`
--
ALTER TABLE `adresa`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexy pro tabulku `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750` (`queue_name`,`available_at`,`delivered_at`,`id`);

--
-- Indexy pro tabulku `platba`
--
ALTER TABLE `platba`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_5B3E3E2F8CB78B49` (`rezervace_id`);

--
-- Indexy pro tabulku `polozka_rezervace`
--
ALTER TABLE `polozka_rezervace`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_667850798CB78B49` (`rezervace_id`),
  ADD KEY `IDX_66785079EB1B61AE` (`skladova_polozka_id`);

--
-- Indexy pro tabulku `produkt`
--
ALTER TABLE `produkt`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `rezervace`
--
ALTER TABLE `rezervace`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_472D00E510BBF3DA` (`zakaznik_id`),
  ADD KEY `IDX_472D00E5C566524E` (`stav_rezervace_id`);

--
-- Indexy pro tabulku `skladova_polozka`
--
ALTER TABLE `skladova_polozka`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E834183E75F42D9B` (`produkt_id`),
  ADD KEY `IDX_E834183EF0E21BB5` (`stanice_id`),
  ADD KEY `IDX_E834183E8420589B` (`stav_polozky_id`);

--
-- Indexy pro tabulku `stanice`
--
ALTER TABLE `stanice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9BFAD9CE98260155` (`region_id`),
  ADD KEY `IDX_9BFAD9CE7E9666B8` (`adresa_id`);

--
-- Indexy pro tabulku `stav_rezervace`
--
ALTER TABLE `stav_rezervace`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `stav_skladove_polozky`
--
ALTER TABLE `stav_skladove_polozky`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pro tabulku `vydej`
--
ALTER TABLE `vydej`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5CB4793CD90432D3` (`polozka_rezervace_id`);

--
-- Indexy pro tabulku `zakaznik`
--
ALTER TABLE `zakaznik`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `adresa`
--
ALTER TABLE `adresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pro tabulku `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `platba`
--
ALTER TABLE `platba`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `polozka_rezervace`
--
ALTER TABLE `polozka_rezervace`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `produkt`
--
ALTER TABLE `produkt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pro tabulku `region`
--
ALTER TABLE `region`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pro tabulku `rezervace`
--
ALTER TABLE `rezervace`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `skladova_polozka`
--
ALTER TABLE `skladova_polozka`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pro tabulku `stanice`
--
ALTER TABLE `stanice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pro tabulku `stav_rezervace`
--
ALTER TABLE `stav_rezervace`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pro tabulku `stav_skladove_polozky`
--
ALTER TABLE `stav_skladove_polozky`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pro tabulku `vydej`
--
ALTER TABLE `vydej`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pro tabulku `zakaznik`
--
ALTER TABLE `zakaznik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `platba`
--
ALTER TABLE `platba`
  ADD CONSTRAINT `FK_5B3E3E2F8CB78B49` FOREIGN KEY (`rezervace_id`) REFERENCES `rezervace` (`id`);

--
-- Omezení pro tabulku `polozka_rezervace`
--
ALTER TABLE `polozka_rezervace`
  ADD CONSTRAINT `FK_667850798CB78B49` FOREIGN KEY (`rezervace_id`) REFERENCES `rezervace` (`id`),
  ADD CONSTRAINT `FK_66785079EB1B61AE` FOREIGN KEY (`skladova_polozka_id`) REFERENCES `skladova_polozka` (`id`);

--
-- Omezení pro tabulku `rezervace`
--
ALTER TABLE `rezervace`
  ADD CONSTRAINT `FK_472D00E510BBF3DA` FOREIGN KEY (`zakaznik_id`) REFERENCES `zakaznik` (`id`),
  ADD CONSTRAINT `FK_472D00E5C566524E` FOREIGN KEY (`stav_rezervace_id`) REFERENCES `stav_rezervace` (`id`);

--
-- Omezení pro tabulku `skladova_polozka`
--
ALTER TABLE `skladova_polozka`
  ADD CONSTRAINT `FK_E834183E75F42D9B` FOREIGN KEY (`produkt_id`) REFERENCES `produkt` (`id`),
  ADD CONSTRAINT `FK_E834183E8420589B` FOREIGN KEY (`stav_polozky_id`) REFERENCES `stav_skladove_polozky` (`id`),
  ADD CONSTRAINT `FK_E834183EF0E21BB5` FOREIGN KEY (`stanice_id`) REFERENCES `stanice` (`id`);

--
-- Omezení pro tabulku `stanice`
--
ALTER TABLE `stanice`
  ADD CONSTRAINT `FK_9BFAD9CE7E9666B8` FOREIGN KEY (`adresa_id`) REFERENCES `adresa` (`id`),
  ADD CONSTRAINT `FK_9BFAD9CE98260155` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`);

--
-- Omezení pro tabulku `vydej`
--
ALTER TABLE `vydej`
  ADD CONSTRAINT `FK_5CB4793CD90432D3` FOREIGN KEY (`polozka_rezervace_id`) REFERENCES `polozka_rezervace` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
