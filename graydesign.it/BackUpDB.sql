-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 31.11.39.173
-- Creato il: Set 17, 2024 alle 15:45
-- Versione del server: 8.0.36-28
-- Versione PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Sql1813933_1`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Animals'),
(2, 'Ladies'),
(3, 'Nature');

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `is_admin` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `is_admin`) VALUES
(1, 'Gabri', 'gabriele.montecchiani@myself.com', '$2y$10$OwZjfKDAOYOW6JAZDp/5hOL7JBkRiJkZnYVVofkKfWboINRjyIO4i', 1),
(2, 'Beibe', 'kaze.editor@gmail.com', '$2y$10$TmA2ro8WDkRkA8e6ssHP9u236r93dcj2K4LYwfY61H5D/nKN9OTSi', 0),
(6, 'Emma', 'e.cubeddu@virgilio.it', '$2y$10$AWN7X9Hh.T/Rwi1B94ey9ukt939v.InMOgF/DvE1i5Y.hWUyWXmWy', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `works`
--

CREATE TABLE `works` (
  `id` int NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `url_image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `committed_by` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `works`
--

INSERT INTO `works` (`id`, `title`, `url_image`, `description`, `committed_by`, `created_at`, `category_id`, `user_id`) VALUES
(2, 'Rabbit', 'http://fc07.deviantart.net/fs71/f/2013/251/8/f/rabbit_doubt_by_azy0-d6lilbm.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer convallis odio mauris, sit amet pretium enim tincidunt et. Pellentesque luctus egestas auctor. Integer vel magna augue. Suspendisse finibus rhoncus arcu. Nam sapien sapien, volutpat sit amet elit id, tincidunt consectetur nisl. Curabitur sit amet nisl sed turpis viverra pulvinar. Nunc fringilla mi id dui placerat, nec mattis est pulvinar. Etiam euismod diam nec tortor rhoncus sagittis. Sed facilisis justo non ipsum ullamcorper faucibus. Etiam auctor tellus vel lectus dictum semper. Suspendisse potenti.', 'Geomethric Animals', '2013-08-18', 1, 2),
(3, 'Hawk', 'https://i.pinimg.com/originals/1e/fc/81/1efc8109907c0af0cb83b77709aa0311.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras posuere gravida vulputate. Aenean mi felis, fermentum ullamcorper facilisis eu, finibus sed augue. Curabitur imperdiet vehicula dignissim. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam sollicitudin feugiat euismod. Nulla efficitur in nisl quis interdum. Phasellus risus lorem, pellentesque eu nulla quis, fermentum semper nisi. Phasellus aliquet tincidunt leo vitae consectetur. Sed quis ex aliquam, cursus purus non, iaculis elit.', 'ArtForWild', '2020-03-06', 1, 1),
(4, 'VanCat', 'https://i.pinimg.com/originals/e1/0a/c4/e10ac4122f4486d51eb07bce328c2a2e.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras posuere gravida vulputate. Aenean mi felis, fermentum ullamcorper facilisis eu, finibus sed augue. Curabitur imperdiet vehicula dignissim. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam sollicitudin feugiat euismod. Nulla efficitur in nisl quis interdum. Phasellus risus lorem, pellentesque eu nulla quis, fermentum semper nisi. Phasellus aliquet tincidunt leo vitae consectetur. Sed quis ex aliquam, cursus purus non, iaculis elit.', 'Kids Museum', '2021-06-08', 1, 1),
(5, 'Red Panda', 'https://i.etsystatic.com/41030275/r/il/18a13b/4831514528/il_1140xN.4831514528_faw3.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras posuere gravida vulputate. Aenean mi felis, fermentum ullamcorper facilisis eu, finibus sed augue. Curabitur imperdiet vehicula dignissim. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam sollicitudin feugiat euismod. Nulla efficitur in nisl quis interdum. Phasellus risus lorem, pellentesque eu nulla quis, fermentum semper nisi. Phasellus aliquet tincidunt leo vitae consectetur. Sed quis ex aliquam, cursus purus non, iaculis elit.', 'Etsy.com', '2023-08-01', 1, 1),
(6, 'Whales', 'https://i.pinimg.com/564x/3e/6f/48/3e6f4899a98cd7ffad223d9c486ef065.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer convallis odio mauris, sit amet pretium enim tincidunt et. Pellentesque luctus egestas auctor. Integer vel magna augue. Suspendisse finibus rhoncus arcu. Nam sapien sapien, volutpat sit amet elit id, tincidunt consectetur nisl. Curabitur sit amet nisl sed turpis viverra pulvinar. Nunc fringilla mi id dui placerat, nec mattis est pulvinar. Etiam euismod diam nec tortor rhoncus sagittis. Sed facilisis justo non ipsum ullamcorper faucibus. Etiam auctor tellus vel lectus dictum semper. Suspendisse potenti.', 'ThisIsColossal.com', '2022-10-16', 1, 1),
(7, 'Jessica', 'http://fc01.deviantart.net/fs70/f/2013/076/4/b/jessica2_by_azy0-d5ycket.gif', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras posuere gravida vulputate. Aenean mi felis, fermentum ullamcorper facilisis eu, finibus sed augue. Curabitur imperdiet vehicula dignissim. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam sollicitudin feugiat euismod. Nulla efficitur in nisl quis interdum. Phasellus risus lorem, pellentesque eu nulla quis, fermentum semper nisi. Phasellus aliquet tincidunt leo vitae consectetur. Sed quis ex aliquam, cursus purus non, iaculis elit.\r\n          ', 'Asian Ladies', '2024-05-23', 2, 1),
(8, 'Shin-Hye', 'https://assets-metrostyle.abs-cbn.com/prod/metrostyle/attachments/11b9b077-1090-43e0-81ee-06600a9b09c4_40760746_328542471234793_1274194090078743455_n.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras posuere gravida vulputate. Aenean mi felis, fermentum ullamcorper facilisis eu, finibus sed augue. Curabitur imperdiet vehicula dignissim. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam sollicitudin feugiat euismod. Nulla efficitur in nisl quis interdum. Phasellus risus lorem, pellentesque eu nulla quis, fermentum semper nisi. Phasellus aliquet tincidunt leo vitae consectetur. Sed quis ex aliquam, cursus purus non, iaculis elit.', 'Gorgeous-K', '2015-05-17', 2, 1),
(9, 'Kim', 'https://images.saymedia-content.com/.image/t_share/MTc1MTEwNzY1NTM0MTkzNDc2/top-10-most-successful-korean-actresses.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras posuere gravida vulputate. Aenean mi felis, fermentum ullamcorper facilisis eu, finibus sed augue. Curabitur imperdiet vehicula dignissim. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam sollicitudin feugiat euismod. Nulla efficitur in nisl quis interdum. Phasellus risus lorem, pellentesque eu nulla quis, fermentum semper nisi. Phasellus aliquet tincidunt leo vitae consectetur. Sed quis ex aliquam, cursus purus non, iaculis elit.', 'K-actress', '2020-04-05', 2, 1),
(24, 'Ji-Won', 'https://media.list.ly/production/279282/1770589/item1770589_600px.jpeg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras posuere gravida vulputate. Aenean mi felis, fermentum ullamcorper facilisis eu, finibus sed augue. Curabitur imperdiet vehicula dignissim. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam sollicitudin feugiat euismod. Nulla efficitur in nisl quis interdum. Phasellus risus lorem, pellentesque eu nulla quis, fermentum semper nisi. Phasellus aliquet tincidunt leo vitae consectetur. Sed quis ex aliquam, cursus purus non, iaculis elit.', 'Asian smiles', '2018-11-13', 2, 1),
(25, 'So-Eun', 'https://images.saymedia-content.com/.image/t_share/MTc1MTEyNzQ1NzgyNjE3OTI0/top10mostbeautifulkoreanactressesin2015.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras posuere gravida vulputate. Aenean mi felis, fermentum ullamcorper facilisis eu, finibus sed augue. Curabitur imperdiet vehicula dignissim. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam sollicitudin feugiat euismod. Nulla efficitur in nisl quis interdum. Phasellus risus lorem, pellentesque eu nulla quis, fermentum semper nisi. Phasellus aliquet tincidunt leo vitae consectetur. Sed quis ex aliquam, cursus purus non, iaculis elit.', 'the K!', '2020-12-14', 2, 1),
(26, 'Mi-Nah', 'https://2sao.vietnamnetjsc.vn/images/2021/11/16/22/10/suzy.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras posuere gravida vulputate. Aenean mi felis, fermentum ullamcorper facilisis eu, finibus sed augue. Curabitur imperdiet vehicula dignissim. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam sollicitudin feugiat euismod. Nulla efficitur in nisl quis interdum. Phasellus risus lorem, pellentesque eu nulla quis, fermentum semper nisi. Phasellus aliquet tincidunt leo vitae consectetur. Sed quis ex aliquam, cursus purus non, iaculis elit.', 'Celebrities!', '2022-01-05', 2, 1),
(27, 'Rhino', 'https://i.pinimg.com/originals/61/14/60/61146070487c0a9ee037a4ede918d5a5.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer convallis odio mauris, sit amet pretium enim tincidunt et. Pellentesque luctus egestas auctor. Integer vel magna augue. Suspendisse finibus rhoncus arcu. Nam sapien sapien, volutpat sit amet elit id, tincidunt consectetur nisl. Curabitur sit amet nisl sed turpis viverra pulvinar. Nunc fringilla mi id dui placerat, nec mattis est pulvinar. Etiam euismod diam nec tortor rhoncus sagittis. Sed facilisis justo non ipsum ullamcorper faucibus. Etiam auctor tellus vel lectus dictum semper. Suspendisse potenti.', 'Wild Portrait', '2019-10-19', 1, 1),
(28, 'Freedom', 'http://fc08.deviantart.net/fs70/f/2013/121/9/9/freedom_by_azy0-d63p88n.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer convallis odio mauris, sit amet pretium enim tincidunt et. Pellentesque luctus egestas auctor. Integer vel magna augue. Suspendisse finibus rhoncus arcu. Nam sapien sapien, volutpat sit amet elit id, tincidunt consectetur nisl. Curabitur sit amet nisl sed turpis viverra pulvinar. Nunc fringilla mi id dui placerat, nec mattis est pulvinar. Etiam euismod diam nec tortor rhoncus sagittis. Sed facilisis justo non ipsum ullamcorper faucibus. Etiam auctor tellus vel lectus dictum semper. Suspendisse potenti.', 'Art of sky', '2013-10-15', 3, 1),
(29, 'WaterTree', 'https://i.pinimg.com/564x/5c/bb/ab/5cbbab21053df3d28812cc8cca1c58b5.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer convallis odio mauris, sit amet pretium enim tincidunt et. Pellentesque luctus egestas auctor. Integer vel magna augue. Suspendisse finibus rhoncus arcu. Nam sapien sapien, volutpat sit amet elit id, tincidunt consectetur nisl. Curabitur sit amet nisl sed turpis viverra pulvinar. Nunc fringilla mi id dui placerat, nec mattis est pulvinar. Etiam euismod diam nec tortor rhoncus sagittis. Sed facilisis justo non ipsum ullamcorper faucibus. Etiam auctor tellus vel lectus dictum semper. Suspendisse potenti.', 'Waternature.net', '2024-02-13', 3, 1),
(30, 'Aestetic', 'https://i.pinimg.com/736x/2d/55/e3/2d55e328fc6c7714005336a34b8b2eff.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer convallis odio mauris, sit amet pretium enim tincidunt et. Pellentesque luctus egestas auctor. Integer vel magna augue. Suspendisse finibus rhoncus arcu. Nam sapien sapien, volutpat sit amet elit id, tincidunt consectetur nisl. Curabitur sit amet nisl sed turpis viverra pulvinar. Nunc fringilla mi id dui placerat, nec mattis est pulvinar. Etiam euismod diam nec tortor rhoncus sagittis. Sed facilisis justo non ipsum ullamcorper faucibus. Etiam auctor tellus vel lectus dictum semper. Suspendisse potenti.', 'ArtOfPainting!', '2019-10-04', 3, 1),
(31, 'Simplified nature', 'https://i.pinimg.com/564x/43/ab/64/43ab64dbba06a894b1cbb4e9a096c86c.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer convallis odio mauris, sit amet pretium enim tincidunt et. Pellentesque luctus egestas auctor. Integer vel magna augue. Suspendisse finibus rhoncus arcu. Nam sapien sapien, volutpat sit amet elit id, tincidunt consectetur nisl. Curabitur sit amet nisl sed turpis viverra pulvinar. Nunc fringilla mi id dui placerat, nec mattis est pulvinar. Etiam euismod diam nec tortor rhoncus sagittis. Sed facilisis justo non ipsum ullamcorper faucibus. Etiam auctor tellus vel lectus dictum semper. Suspendisse potenti.', 'Pixabay.com', '2024-01-01', 3, 1),
(32, 'Nature&#039;s Essence', 'https://i.pinimg.com/564x/ba/c4/c3/bac4c3b6626d76308f2c9603d20ead42.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer convallis odio mauris, sit amet pretium enim tincidunt et. Pellentesque luctus egestas auctor. Integer vel magna augue. Suspendisse finibus rhoncus arcu. Nam sapien sapien, volutpat sit amet elit id, tincidunt consectetur nisl. Curabitur sit amet nisl sed turpis viverra pulvinar. Nunc fringilla mi id dui placerat, nec mattis est pulvinar. Etiam euismod diam nec tortor rhoncus sagittis. Sed facilisis justo non ipsum ullamcorper faucibus. Etiam auctor tellus vel lectus dictum semper. Suspendisse potenti.', 'Pixabay.com', '2024-02-18', 3, 1),
(33, 'Hibiscus', 'https://i.pinimg.com/564x/47/8d/4f/478d4f22a0d7ab798f4394af7c93cf62.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer convallis odio mauris, sit amet pretium enim tincidunt et. Pellentesque luctus egestas auctor. Integer vel magna augue. Suspendisse finibus rhoncus arcu. Nam sapien sapien, volutpat sit amet elit id, tincidunt consectetur nisl. Curabitur sit amet nisl sed turpis viverra pulvinar. Nunc fringilla mi id dui placerat, nec mattis est pulvinar. Etiam euismod diam nec tortor rhoncus sagittis. Sed facilisis justo non ipsum ullamcorper faucibus. Etiam auctor tellus vel lectus dictum semper. Suspendisse potenti.', 'PaintWithDiamonds', '2019-08-04', 3, 1);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indici per le tabelle `works`
--
ALTER TABLE `works`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `works`
--
ALTER TABLE `works`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `works`
--
ALTER TABLE `works`
  ADD CONSTRAINT `works_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `works_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
