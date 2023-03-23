-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 27 Sty 2023, 09:46
-- Wersja serwera: 10.4.25-MariaDB
-- Wersja PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `blog`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `comments`
--

CREATE TABLE `comments` (
  `CommentID` int(11) NOT NULL,
  `PostsID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `CreationDate` datetime DEFAULT NULL,
  `Content` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `comments`
--

INSERT INTO `comments` (`CommentID`, `PostsID`, `UserID`, `CreationDate`, `Content`) VALUES
(5, 28, 1, NULL, 'super post'),
(6, 37, 1, NULL, 'gitara'),
(7, 28, 1, NULL, 'super');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kontak`
--

CREATE TABLE `kontak` (
  `ID` int(11) NOT NULL,
  `nick` varchar(20) NOT NULL,
  `email` varchar(250) NOT NULL,
  `Tresc` varchar(250) NOT NULL,
  `filename` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `kontak`
--

INSERT INTO `kontak` (`ID`, `nick`, `email`, `Tresc`, `filename`) VALUES
(90, 'a', 'a', 'a', 'IMG-63d32726945595.12376703.jpg'),
(91, 'a', 'a', 'a', 'IMG-63d327e4d8a691.74487805.jpg'),
(92, 'a', 'a', 'a', 'IMG-63d327f8900ec0.00608360.jpg'),
(93, 'a', 'a', 'a', 'IMG-63d328130005e8.06243525.jpg'),
(94, 'a', 'a', 'a', 'IMG-63d328a64c1ce7.05660325.jpg'),
(95, 'a', 'a', 'a', 'IMG-63d328b67058b2.79457467.jpg'),
(96, '', '', '', 'IMG-63d329671c7ff7.25547566.jpg'),
(97, '', '', '', 'IMG-63d348b69715a0.59098051.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `posts`
--

CREATE TABLE `posts` (
  `PostsID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `CategoryID` int(11) DEFAULT NULL,
  `Title` varchar(200) DEFAULT NULL,
  `CreationDate` datetime DEFAULT NULL,
  `Images` varchar(1000) DEFAULT NULL,
  `Content` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `posts`
--

INSERT INTO `posts` (`PostsID`, `UserID`, `CategoryID`, `Title`, `CreationDate`, `Images`, `Content`) VALUES
(28, 2, 1, 'Super Szybki RTX 3090  (KARTY)', NULL, 'https://image.ceneostatic.pl/data/article_picture/48/eb/8b28-b456-43c7-ad1b-a20c4635b4c6_large.jpg', 'Powiadają, że rozmiar nie ma znaczenia, jednak powyższa zasada chyba nie dotyczy systemów chłodzenia kart graficznych. Z pewnością projektanci ASUS ROG GeForce RTX 4090 Strix Gaming o takowej nigdy nie słyszeli.'),
(29, 2, 3, 'Nadciągają tańsze płyty główne dla AMD Ryzen 7000 (PROCESORY)', NULL, 'https://www.telepolis.pl/images/2023/01/plyty-glowne-asus-gigabyte-amd-am5-ryzen-7000-00.jpg', 'Chcesz złożyć tani komputer z najnowszym procesorem AMD Ryzne 7000? Już niedługo będzie to znacznie łatwiejsze. Wszystko dzięki płytom AMD A620.'),
(37, 4, 1, 'SUPER OKAZJA NA KARTE AMD (KARTY)', NULL, 'https://www.purepc.pl/files/Image/artykul_zdjecia/2013/AMD_Radeon_R9_R7_Test/amd_radeon_r9_270x_test_review_pics_1.jpg', 'tresc tresc tresc tresc tresc tresc tresc tresc tresc tresc tresc tresc tresc tresc tresc'),
(44, 1, 1, 'TEST ZNACZNIKÓW FORMATUJĄCYCH', NULL, 'https://s3.przepisy.pl/przepisy3ii/img/variants/500x0/soczysty-kurczak-z-patelni.jpg', '[b]GRUBE[/b]    [i]KURSYWA[/i]        [u]PODKREŚLENIE[/u]     [url]LINK[/url]'),
(46, 1, 1, 'TESTOWY DO USUNIĘCIA', NULL, 'https://s3.przepisy.pl/przepisy3ii/img/variants/500x0/soczysty-kurczak-z-patelni.jpg', 'pestoaaaaaaaaaaa');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `postscategory`
--

CREATE TABLE `postscategory` (
  `CategoryID` int(11) NOT NULL,
  `CategoryType` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `postscategory`
--

INSERT INTO `postscategory` (`CategoryID`, `CategoryType`) VALUES
(1, 'Karty graficzne'),
(2, 'Dyski'),
(3, 'Procesory'),
(4, 'Drukarki'),
(5, 'Słuchawki');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `role`
--

CREATE TABLE `role` (
  `RoleID` int(11) NOT NULL,
  `RoleType` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `role`
--

INSERT INTO `role` (`RoleID`, `RoleType`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `RoleID` int(11) DEFAULT NULL,
  `Username` varchar(200) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`UserID`, `RoleID`, `Username`, `Password`, `email`) VALUES
(1, 1, 'Artur', '$2y$10$HzJSYwVKQvvP3ft7vD.h2.sal1XkKIpb4We2pxvzA0x/D6RcTEBVy', 'megazioma@gmail.com'),
(3, 1, 'Anonymous', NULL, NULL),
(5, 1, 'admin', '$2y$10$p2ZXbjLo8XonpZLAzAM25.o7Pcf3ZX/tHfBEoSYTOWN1xKnAxJSe2', 'megazioma@gmail.com');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`CommentID`);

--
-- Indeksy dla tabeli `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`PostsID`);

--
-- Indeksy dla tabeli `postscategory`
--
ALTER TABLE `postscategory`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indeksy dla tabeli `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`RoleID`);

--
-- Indeksy dla tabeli `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `comments`
--
ALTER TABLE `comments`
  MODIFY `CommentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `kontak`
--
ALTER TABLE `kontak`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT dla tabeli `posts`
--
ALTER TABLE `posts`
  MODIFY `PostsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
