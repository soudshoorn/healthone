-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20220531.aadb8cc914
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 29 jun 2022 om 23:27
-- Serverversie: 10.4.24-MariaDB
-- PHP-versie: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `healthone`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `img`) VALUES
(1, 'Crosstrainers', 'crosstrainers.jpg'),
(2, 'Loopbanden', 'loopbanden.jpg'),
(3, 'Roeitrainers', 'roeitrainers.jpg'),
(4, 'Hometrainers', 'hometrainers.jpg');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `products`
--

INSERT INTO `products` (`id`, `name`, `img`, `description`, `category_id`) VALUES
(29, 'Loopband TX20', '62bcb944034b71.05683786.jpg', 'De cardiostrong TX20 is een compacte en betaalbare loopband op instapniveau om thuis eenvoudige hardloop- en wandeltrainingen te doen. Dankzij zijn kleine afmetingen en een inklapmechanisme kan de loopband zelfs in kleine fitnessruimtes of woonkamers worden gebruikt.', 2),
(32, 'Crosstrainer EX60', '62bcb0cc4812e0.54134120.jpg', 'De cardiostrong crosstrainer EX60 Touch staat voor stabiliteit, uitstekende bewegingskwaliteit, een stijlvol design en zeer comfortabel. Dankzij het compacte ontwerp is de EX60 erg ruimtebesparend en kan daarom vrijwel in elke woonkamer terecht. Met zijn twee vliegwielen voor en achter zet de crosstrainer nieuwe maatstaven in zijn klasse op het gebied van bewegingskwaliteit en biedt hij een optimale trainingservaring, zelfs in de kleinste ruimtes. Het elegante zwarte frame en de slijtvaste poedercoating geven de EX60 Touch een stijlvol uiterlijk.', 1),
(34, 'Hometrainer BX70i', '62bcb2c12b7389.82643222.jpg', 'De BX70i van cardiostrong maakte indruk in de reeks testen, met hoe het aandrijf- en remsysteem samenwerkten. Deze ergometer is uitgerust met een hoogwaardig inductieremsysteem. Deze onderhoudsvrije vorm van weerstandsopwekking is bijzonder nauwkeurig, de aanpassing van de weerstand gaat sneller en de berekening van het werkelijke (watt)vermogen is nauwkeuriger. De rem werkt op een vliegwiel van 10 kg.', 4),
(35, 'Roeitrainer RM50', '62bcb3e2135fd9.31475133.jpg', 'De Darwin RM50 is een modern vormgegeven roeitrainer met waterweerstand. Mede hierdoor kom je met de RM50 dicht in de buurt van het natuurlijke roeigevoel wat je krijgt alsof je op het water bent. Roeien met op de achtergrond geruis van het water. Dit zorgt voor een ontspannen en prettige sfeer tijdens de training. Bij het trainen met een waterweerstandssysteem bepaal je zelf de intensiteit of de weerstand aan de hand van hoe hard je trekt. Hoe harder je trekt hoe intensiever je roeitraining wordt.', 3),
(36, 'Roeitrainer RX50', '62bcb4107aee41.68821709.jpg', 'De cardiostrong RX50 Roeitrainer is gemaakt van hoogwaardige materialen en heeft een modern design. De roeitrainer kan tot maar liefst 120 kg worden belast. De RX50 is uitgerust met een lucht- en magneetweerstand, wat zorgt voor een soepele trainingsbeweging en krachtige roeislagen zodat je intensief en effectief kan trainen. Dit maakt de cardiostrong RX50 de perfecte roeitrainer voor thuisgebruik.', 3),
(37, 'Loopband 56XT', '62bcb6066df807.98007735.jpg', 'Met de BXT56 Loopband heeft Bowflex een hoogwaardige loopband ontwikkeld die zorgt voor een natuurlijke hardloopervaring in je eigen huis. Zowel de brede loopmat (152x56cm) als de buitengewone helling, dragen bij aan een realistische loopervaring. De helling stijgt tot 20%. Bij deze loopband heb je ook de mogelijkheid om bergafwaarts te rennen met een negatieve helling tot wel 5%. Met het effectieve Comfort-Tech dempingssysteem ervaar je een soepele en natuurlijke hardlooptraining. De snelheid van de loopband kan worden gevarieerd tussen 0,5-20 km/u.', 2),
(38, 'Crosstrainer 570E', '62bcb64cacf8d8.12385246.jpg', 'De Schwinn 570E Crosstrainer is een eersteklas crosstrainer en van alle gemakken voorzien. Hij kan individueel worden versteld, zodat mensen met verschillende lichaamslengtes comfortabel kunnen trainen. De grote paslengte van 50,8 cm zorgt voor een soepele en aangename trainingsbeweging. Twee mooie LCD-schermen houden je tijdens het trainen op de hoogte van maar liefst 13 verschillende trainingswaarden, zoals tijd, snelheid, afstand, calorieverbruik en hartslag.', 1),
(39, 'Taurus UB99', '62bcb7ffc29bc6.13549160.jpg', 'Is het slecht weer buiten of heb je gewoon weinig tijd maar wil je toch fit blijven? Dan is de Taurus Ergometer UB9.9 hét perfecte fitnesstoestel voor jou: eenvoudig in gebruik, ruimtebesparend, comfortabel en met een breed scala aan prestaties.', 4);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `stars` int(11) NOT NULL,
  `description` text NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `stars`, `description`, `product_id`) VALUES
(36, 'Guest - Presentatie', 1, 'Slecht product, werkt voor geen meter!', 32);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'guest'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(7, 'Admin - Presentatie', 'admin@presentatie.nl', '$2y$10$W68kOtXGINszIMLrqfnfkOO3ofzWHP/gpbs1MKracRtYu3M0idA6.', 'admin'),
(9, 'Guest - Presentatie', 'guest@presentatie.nl', '$2y$10$ox.y7h5HRWEpKrg4/Bm3NOthLq3eZsWpwJVdliKjcLapBvw6id1cK', 'guest');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexen voor tabel `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT voor een tabel `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Beperkingen voor tabel `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



