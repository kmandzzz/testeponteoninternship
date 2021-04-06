-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03-Abr-2021 às 20:07
-- Versão do servidor: 10.4.18-MariaDB
-- versão do PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `empresarios`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresarios`
--

CREATE TABLE `empresarios` (
  `id_empr` int(11) NOT NULL,
  `nom_empr` varchar(100) NOT NULL,
  `cel_empr` varchar(11) NOT NULL,
  `est_cid_empr` varchar(100) NOT NULL,
  `pai_id_empr` int(11) DEFAULT NULL,
  `data_cad_empr` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `empresarios`
--

INSERT INTO `empresarios` (`id_empr`, `nom_empr`, `cel_empr`, `est_cid_empr`, `pai_id_empr`, `data_cad_empr`) VALUES
(6, 'Fulano de Tal', '49985414569', 'SC', NULL, '2021-03-04 09:58:54'),
(7, 'Beltrano Tomé', '48998764239', 'SC', 6, '2021-03-04 10:00:38'),
(8, 'Pedro Pederneiras', '21985414123', 'RJ', 6, '2021-03-04 10:01:40'),
(9, 'José das Dores', '11982211129', 'SP', 8, '2021-03-04 10:02:40'),
(10, 'Zezinho dos Codes', '91985414529', 'PA', 6, '2021-03-04 10:03:22'),
(11, 'Maria Recursiva', '47968128765', 'SC', 9, '2021-03-04 10:03:57');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `empresarios`
--
ALTER TABLE `empresarios`
  ADD PRIMARY KEY (`id_empr`),
  ADD UNIQUE KEY `cel_empr_unq` (`cel_empr`),
  ADD KEY `empresarios_FK` (`pai_id_empr`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `empresarios`
--
ALTER TABLE `empresarios`
  MODIFY `id_empr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `empresarios`
--
ALTER TABLE `empresarios`
  ADD CONSTRAINT `empresarios_FK` FOREIGN KEY (`pai_id_empr`) REFERENCES `empresarios` (`id_empr`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
