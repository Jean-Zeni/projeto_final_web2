-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29/11/2024 às 02:44
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_portal_noticias`
--
CREATE DATABASE IF NOT EXISTS `bd_portal_noticias` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bd_portal_noticias`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_noticias`
--

DROP TABLE IF EXISTS `tb_noticias`;
CREATE TABLE `tb_noticias` (
  `pk_id_noticia` int(11) NOT NULL,
  `titulo_noticia` varchar(100) NOT NULL,
  `fk_id_autor` int(11) NOT NULL,
  `data_noticia` datetime NOT NULL,
  `noticia` text NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_noticias`
--

INSERT INTO `tb_noticias` (`pk_id_noticia`, `titulo_noticia`, `fk_id_autor`, `data_noticia`, `noticia`, `foto`) VALUES
(18, 'Godzilla', 2, '2024-11-28 20:32:05', 'Lagarto mata vespa em vídeo incrível que passou no SBT', 'uploads/6748fd755c2b0.jpg'),
(20, 'Fuga de foguete?', 8, '2024-11-28 21:22:46', 'Ladrões fogem em um Fiat Uno de firma a incríveis 300km/h', 'uploads/674909568bd97.jpg'),
(21, 'Zumbis', 2, '2024-11-28 21:50:53', 'Jogadores de LOL estão andando pelas ruas mordendo pessoas com muito raiva, médicos alegam que se trata de um vírus que está se hospedando no cérebro dos gamers.', 'uploads/67490fed7c4ed.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `sexo` char(1) NOT NULL,
  `fone` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `sexo`, `fone`, `email`, `senha`) VALUES
(2, 'Jean', 'M', '5191919191', 'jean@gmail.com', '$2y$10$ZLc5bNj6jcbYwmcftDOejuvlz54i6sDsb66PLXqn58nmMcEFcumkC'),
(3, 'Rodolfo Silva', 'M', '5197979797', 'rodolfo@gmail.com', '$2y$10$adJlPuFsZrLSM.jIjwTR5uHQG4yeiGh18V8l8ZyI0GCvsPg6rvIDy'),
(7, 'Jeferson', 'M', '33', 'jeff@gmail.com', '$2y$10$oS5eIIJ5xZzcArb.JsXJMOFHvBAqbSIPCmpJP8NYeTgOUBpxBCala'),
(8, 'Ana', 'F', '23', 'ana@gmail.com', '$2y$10$GkPapkmm3A2LhMUlO8n3zeumbZvASHS6VHjBOLJ.tnLSrv1f.3sWm');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tb_noticias`
--
ALTER TABLE `tb_noticias`
  ADD PRIMARY KEY (`pk_id_noticia`),
  ADD KEY `fk_id` (`fk_id_autor`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_noticias`
--
ALTER TABLE `tb_noticias`
  MODIFY `pk_id_noticia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tb_noticias`
--
ALTER TABLE `tb_noticias`
  ADD CONSTRAINT `fk_id` FOREIGN KEY (`fk_id_autor`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
