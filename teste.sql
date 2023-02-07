-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03-Fev-2023 às 18:33
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `teste`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `corte`
--

CREATE TABLE `corte` (
  `id` int(255) NOT NULL,
  `id_desenho` varchar(255) NOT NULL,
  `cortador` varchar(255) NOT NULL,
  `data_add` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `corte`
--

INSERT INTO `corte` (`id`, `id_desenho`, `cortador`, `data_add`, `status`) VALUES
(1, '475', 'marcos', '02/02/2023 16:25:58', 'inicio'),
(2, '475', 'marcos', '02/02/2023 16:26:10', 'finalizado'),
(3, '477', 'marcos', '03/02/2023 14:09:25', 'inicio'),
(4, '477', 'marcos', '03/02/2023 14:10:01', 'finalizado'),
(5, '478', 'marcos', '03/02/2023 14:11:13', 'inicio'),
(6, '478', 'marcos', '03/02/2023 14:12:07', 'finalizado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `desenhos`
--

CREATE TABLE `desenhos` (
  `id` int(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `caminho` varchar(255) NOT NULL,
  `desenhista` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `prioridade` varchar(255) NOT NULL,
  `finalidade` varchar(255) NOT NULL,
  `empreendimento` varchar(255) NOT NULL,
  `empresa` varchar(255) NOT NULL,
  `cortador` varchar(255) NOT NULL,
  `data_hora_add` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `desenhos`
--

INSERT INTO `desenhos` (`id`, `nome`, `caminho`, `desenhista`, `status`, `prioridade`, `finalidade`, `empreendimento`, `empresa`, `cortador`, `data_hora_add`) VALUES
(468, '5.dxf', 'Z:/wl_desenhos/login/config/db/', 'ian', 'apagado', '1', 'MOBILIï¿½RIO', 'oi', 'fg', '', '31/01/2023 19:26:36'),
(469, '2.dxf', 'Z:/wl_desenhos/login/config/login/', 'ian', 'apagado', '1', 'MOBILIï¿½RIO', 'oi', 'fg', '', '31/01/2023 19:26:38'),
(470, 'k.dxf', 'Z:/wl_desenhos/login/config/login/', 'ian', 'apagado', '1', 'MOBILIï¿½RIO', 'oi', 'fg', '', '31/01/2023 19:26:38'),
(471, 'verifica_login.dxf', 'Z:/wl_desenhos/login/config/login/', 'ian', 'apagado', '1', 'MOBILIï¿½RIO', 'oi', 'fg', '', '31/01/2023 19:26:39'),
(472, 'bulma.min.dxf', 'Z:/wl_desenhos/login/css/', 'ian', 'cortado', '1', 'MOBILIï¿½RIO', 'oi', 'fg', 'marcos', '31/01/2023 19:26:39'),
(473, '1.dxf', 'Z:/wl_desenhos/login/css/', 'ian', 'cortado', '1', 'MOBILIï¿½RIO', 'oi', 'fg', 'marcos', '31/01/2023 19:26:41'),
(474, '2.dxf', 'Z:/wl_desenhos/login/', 'ian', 'apagado', '1', 'MOBILIï¿½RIO', 'oi', 'fg', '', '31/01/2023 19:26:41'),
(475, '5.dxf', 'Z:/wl_desenhos/login/', 'ian', 'cortado', '1', 'MOBILIï¿½RIO', 'oi', 'fg', 'marcos', '31/01/2023 19:26:41'),
(476, 'index.dxf', 'Z:/wl_desenhos/login/', 'ian', 'apagado', '1', 'MOBILIï¿½RIO', 'oi', 'fg', '', '31/01/2023 19:26:42'),
(477, 'painel.dxf', 'Z:/wl_desenhos/login/', 'ian', 'cortado', '1', 'MOBILIï¿½RIO', 'oi', 'fg', 'marcos', '31/01/2023 19:26:42'),
(478, '1.dxf', 'Z:/wl_desenhos/', 'ian', 'cortado', '2', 'ESTRUTURA', 'torre1', 'fg', 'marcos', '31/01/2023 23:43:53'),
(479, '5.dxf', 'Z:/wl_desenhos/', 'ian', 'corte', '2', 'ESTRUTURA', 'torre1', 'fg', '', '31/01/2023 23:47:31'),
(480, 'k.dxf', 'Z:/wl_desenhos/', 'ian', 'corte', '1', 'ESTRUTURA', 'torre1', 'fg', '', '31/01/2023 23:49:06'),
(481, 'index.dxf', 'Z:/wl_desenhos/', 'ian', 'corte', '1', 'MOBILIï¿½RIO', 'torre1', 'fg', '', '31/01/2023 23:50:47'),
(482, '2.dxf', 'Z:/wl_desenhos/', 'ian', 'corte', '1', 'ESTRUTURA', 'torre1', 'fg', '', '02/02/2023 14:24:41'),
(484, 'bulma.min.dxf', 'Z:/wl_desenhos/login/', 'ian', 'corte', '1', 'ESTRUTURA', 'torre1', 'fg', '', '02/02/2023 16:09:25'),
(485, 'k.dxf', 'Z:/wl_desenhos/login/', 'ian', 'corte', '1', 'ESTRUTURA', 'torre1', 'fg', '', '02/02/2023 20:34:04'),
(486, 'conexao.dxf', 'Z:/wl_desenhos/login/login/config/db/', 'carlos', 'corte', '2', 'PAISAGISMO', 'torre1', 'fg', '', '02/02/2023 18:57:08'),
(487, 'login.dxf', 'Z:/wl_desenhos/login/login/config/login/', 'carlos', 'corte', '2', 'PAISAGISMO', 'torre1', 'fg', '', '02/02/2023 18:57:10'),
(488, 'logout.dxf', 'Z:/wl_desenhos/login/login/config/login/', 'carlos', 'corte', '2', 'PAISAGISMO', 'torre1', 'fg', '', '02/02/2023 18:57:11'),
(489, 'verifica_login.dxf', 'Z:/wl_desenhos/login/login/config/login/', 'carlos', 'corte', '2', 'PAISAGISMO', 'torre1', 'fg', '', '02/02/2023 18:57:12'),
(490, 'bulma.min.dxf', 'Z:/wl_desenhos/login/login/css/', 'carlos', 'corte', '2', 'PAISAGISMO', 'torre1', 'fg', '', '02/02/2023 18:57:12'),
(491, 'login.dxf', 'Z:/wl_desenhos/login/login/css/', 'carlos', 'corte', '2', 'PAISAGISMO', 'torre1', 'fg', '', '02/02/2023 18:57:13'),
(492, '1.dxf', 'Z:/wl_desenhos/login/login/', 'carlos', 'corte', '2', 'PAISAGISMO', 'torre1', 'fg', '', '02/02/2023 18:57:14'),
(493, '5.dxf', 'Z:/wl_desenhos/login/login/', 'carlos', 'corte', '2', 'PAISAGISMO', 'torre1', 'fg', '', '02/02/2023 18:57:14'),
(494, 'index.dxf', 'Z:/wl_desenhos/login/login/', 'carlos', 'corte', '2', 'PAISAGISMO', 'torre1', 'fg', '', '02/02/2023 18:57:15'),
(495, 'painel.dxf', 'Z:/wl_desenhos/login/login/', 'carlos', 'corte', '2', 'PAISAGISMO', 'torre1', 'fg', '', '02/02/2023 18:57:15'),
(496, '5.dxf', 'Z:/wl_desenhos/login/css/', 'ian', 'corte', '1', 'ESTRUTURA', 'torre1', 'fg', '', '03/02/2023 13:56:50'),
(497, 'index.dxf', 'Z:/wl_desenhos/login/css/', 'ian', 'corte', '1', 'ESTRUTURA', 'oiu', 'embraed', '', '03/02/2023 13:56:51'),
(498, 'k.dxf', 'Z:/wl_desenhos/login/css/', 'ian', 'corte', '1', 'ESTRUTURA', 'torre1', 'fg', '', '03/02/2023 13:56:51'),
(499, '1.dxf', 'Z:/wl_desenhos/login/config/', 'ian', 'corte', '3', 'ESTRUTURA', 'torre1', 'fg', '', '03/02/2023 13:58:53'),
(500, 'k.dxf', 'Z:/wl_desenhos/login/config/', 'ian', 'corte', '2', 'PAISAGISMO', 'oiu', 'embraed', '', '03/02/2023 14:03:17'),
(501, '5.dxf', 'Z:/wl_desenhos/login/config/db/', 'ian', 'corte', '1', 'ESTRUTURA', 'oiu', 'embraed', '', '03/02/2023 14:04:45'),
(502, 'index.dxf', 'Z:/wl_desenhos/login/config/db/', 'ian', 'corte', '3', 'ESTRUTURA', 'oiu', 'embraed', '', '03/02/2023 18:06:43');

-- --------------------------------------------------------

--
-- Estrutura da tabela `desenhos_temp`
--

CREATE TABLE `desenhos_temp` (
  `id` int(255) NOT NULL,
  `diretorio` varchar(255) NOT NULL,
  `individuo` varchar(255) NOT NULL,
  `data_add` varchar(255) NOT NULL,
  `data_finalizado` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `destino` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `desenhos_temp`
--

INSERT INTO `desenhos_temp` (`id`, `diretorio`, `individuo`, `data_add`, `data_finalizado`, `status`, `destino`) VALUES
(56, 'Z:/temp/72225/', 'ian', '31/01/2023 19:26:02', '31/01/2023 19:26:42', 'finalizado', 'Z:/wl_desenhos/'),
(57, 'Z:/temp/50078/', 'ian', '31/01/2023 19:43:22', '31/01/2023 23:44:10', 'finalizado', 'Z:/wl_desenhos/'),
(58, 'Z:/temp/49569/', 'ian', '31/01/2023 19:43:33', '31/01/2023 23:43:54', 'finalizado', 'Z:/wl_desenhos/'),
(59, 'Z:/temp/26455/', 'ian', '31/01/2023 19:47:01', '31/01/2023 23:47:30', 'finalizado', 'Z:/wl_desenhos/'),
(60, 'Z:/temp/34641/', 'ian', '31/01/2023 19:47:10', '31/01/2023 23:47:33', 'finalizado', 'Z:/wl_desenhos/'),
(61, 'Z:/temp/18269/', 'ian', '31/01/2023 19:48:32', '31/01/2023 23:48:56', 'finalizado', 'Z:/wl_desenhos/'),
(62, 'Z:/temp/82919/', 'ian', '31/01/2023 19:48:43', '31/01/2023 23:49:08', 'finalizado', 'Z:/wl_desenhos/'),
(63, 'Z:/temp/60099/', 'ian', '31/01/2023 19:50:17', '31/01/2023 23:50:46', 'finalizado', 'Z:/wl_desenhos/'),
(64, 'Z:/temp/15774/', 'ian', '31/01/2023 19:50:30', '31/01/2023 23:50:47', 'finalizado', 'Z:/wl_desenhos/'),
(65, 'Z:/temp/4766/', 'ian', '02/02/2023 14:24:28', '02/02/2023 14:24:42', 'finalizado', 'Z:/wl_desenhos/'),
(66, 'Z:/temp/32384/', 'ian', '02/02/2023 15:45:39', '02/02/2023 20:13:29', 'finalizado', 'Z:/wl_desenhos/'),
(67, 'Z:/temp/99562/', 'ian', '02/02/2023 15:57:22', '02/02/2023 20:13:31', 'finalizado', 'Z:/wl_desenhos/'),
(68, 'Z:/temp/52984/', 'ian', '02/02/2023 15:57:53', '02/02/2023 20:13:32', 'finalizado', 'Z:/wl_desenhos/'),
(69, 'Z:/temp/32111/', 'ian', '02/02/2023 16:00:43', '02/02/2023 20:13:34', 'finalizado', 'Z:/wl_desenhos/'),
(70, 'Z:/temp/24648/', 'ian', '02/02/2023 16:01:39', '02/02/2023 20:13:37', 'finalizado', 'Z:/wl_desenhos/'),
(71, 'Z:/temp/23251/', 'ian', '02/02/2023 16:02:51', '02/02/2023 16:06:11', 'finalizado', 'Z:/wl_desenhos/'),
(72, 'Z:/temp/80552/', 'ian', '02/02/2023 16:08:58', '02/02/2023 16:09:04', 'finalizado', 'Z:/wl_desenhos/'),
(73, 'Z:/temp/85030/', 'ian', '02/02/2023 16:09:16', '02/02/2023 16:09:26', 'finalizado', 'Z:/wl_desenhos/login/'),
(74, 'Z:/temp/5176/', 'ian', '02/02/2023 16:13:57', '02/02/2023 20:34:05', 'finalizado', 'Z:/wl_desenhos/login/'),
(75, 'Z:/temp/85740/', 'carlos', '02/02/2023 18:55:28', '02/02/2023 18:57:15', 'finalizado', 'Z:/wl_desenhos/login/'),
(76, 'Z:/temp/86713/', 'carlos', '02/02/2023 18:57:35', '', 'processando', 'Z:/wl_desenhos/login/'),
(77, 'Z:/temp/87258/', 'ian', '03/02/2023 13:55:57', '03/02/2023 13:56:51', 'finalizado', 'Z:/wl_desenhos/login/css/'),
(78, 'Z:/temp/59843/', 'ian', '03/02/2023 13:57:19', '03/02/2023 13:57:31', 'finalizado', 'Z:/wl_desenhos/login/config/'),
(79, 'Z:/temp/14057/', 'ian', '03/02/2023 13:58:05', '03/02/2023 17:59:15', 'finalizado', 'Z:/wl_desenhos/login/config/'),
(80, 'Z:/temp/70762/', 'ian', '03/02/2023 13:58:44', '03/02/2023 13:58:54', 'finalizado', 'Z:/wl_desenhos/login/config/'),
(81, 'Z:/temp/47882/', 'ian', '03/02/2023 14:02:49', '03/02/2023 18:03:33', 'finalizado', 'Z:/wl_desenhos/login/config/'),
(82, 'Z:/temp/53851/', 'ian', '03/02/2023 14:03:03', '03/02/2023 14:03:18', 'finalizado', 'Z:/wl_desenhos/login/config/'),
(83, 'Z:/temp/26893/', 'ian', '03/02/2023 14:04:04', '03/02/2023 18:05:39', 'finalizado', 'Z:/wl_desenhos/login/config/db/'),
(84, 'Z:/temp/2501/', 'ian', '03/02/2023 14:04:24', '03/02/2023 14:04:46', 'finalizado', 'Z:/wl_desenhos/login/config/db/'),
(85, 'Z:/temp/12813/', 'ian', '03/02/2023 14:04:58', '03/02/2023 18:06:44', 'finalizado', 'Z:/wl_desenhos/login/config/db/');

-- --------------------------------------------------------

--
-- Estrutura da tabela `empreendimentos`
--

CREATE TABLE `empreendimentos` (
  `id` int(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `empresa_id` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `empreendimentos`
--

INSERT INTO `empreendimentos` (`id`, `nome`, `empresa_id`, `status`) VALUES
(1, 'torre1', '1', 'ativo'),
(2, 'oiu', '2', 'ativo'),
(3, 'oi', '1', 'ativo'),
(4, 'oi', '2', 'ativo'),
(5, 'oi1', '2', 'ativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

CREATE TABLE `empresa` (
  `id` int(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `empresa`
--

INSERT INTO `empresa` (`id`, `nome`, `status`) VALUES
(1, 'fg', 'ativo'),
(2, 'embraed', 'ativo'),
(3, 'wew', 'ativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `filtros`
--

CREATE TABLE `filtros` (
  `id` int(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `data_add` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `filtros`
--

INSERT INTO `filtros` (`id`, `nome`, `status`, `data_add`) VALUES
(1, 'zip', 'ativo', ''),
(2, 'dxf', 'ativo', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `finalidade`
--

CREATE TABLE `finalidade` (
  `id` int(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `finalidade`
--

INSERT INTO `finalidade` (`id`, `nome`, `status`) VALUES
(1, 'MOBILIÁRIO', 'ativo'),
(2, 'ESTRUTURA', 'ativo'),
(3, 'PAISAGISMO', 'ativo'),
(4, 'ACABAMENTO', 'ativo'),
(5, 'ESTOQUE', 'ativo'),
(6, 'MINIATURAS', 'ativo'),
(7, 'INTERNOS', 'ativo'),
(8, 'teste', 'ativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `historico_desenhos`
--

CREATE TABLE `historico_desenhos` (
  `id` int(255) NOT NULL,
  `id_desenhos` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `data_hora_add` varchar(30) NOT NULL,
  `data_hora_mod` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `individuo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `historico_desenhos`
--

INSERT INTO `historico_desenhos` (`id`, `id_desenhos`, `nome`, `data_hora_add`, `data_hora_mod`, `status`, `individuo`) VALUES
(74, ' ', ' ', ' ', '31/01/2023 19:23:48', '  => apagado', 'ian'),
(75, '468', 'conexao.dxf', '31/01/2023 19:26:36', '31/01/2023 19:30:04', 'corte => corte', 'ian'),
(76, '468', 'k.dxf', '31/01/2023 19:26:36', '31/01/2023 19:35:11', 'corte => corte', 'ian'),
(77, '473', 'login.dxf', '31/01/2023 19:26:41', '31/01/2023 19:37:01', 'corte => corte', 'ian'),
(78, '470', 'logout.dxf', '31/01/2023 19:26:38', '31/01/2023 19:38:02', 'corte => corte', 'ian'),
(79, '473', 'k.dxf', '31/01/2023 19:26:41', '31/01/2023 19:38:25', 'corte => corte', 'ian'),
(80, '468', '5.dxf', '31/01/2023 19:26:36', '31/01/2023 19:42:29', 'corte => apagado', 'santana'),
(81, '469', 'login.dxf', '31/01/2023 19:26:38', '31/01/2023 19:42:45', 'corte => corte', 'santana'),
(82, '469', 'login.dxf', '31/01/2023 19:26:38', '02/02/2023 14:27:07', 'corte => corte', 'ian'),
(83, '469', '2.dxf', '31/01/2023 19:26:38', '02/02/2023 14:39:11', 'corte => apagado', 'ian'),
(84, '470', 'k.dxf', '31/01/2023 19:26:38', '02/02/2023 14:39:32', 'corte => apagado', 'ian'),
(85, '471', 'verifica_login.dxf', '31/01/2023 19:26:39', '02/02/2023 15:04:38', 'corte => apagado', 'ian'),
(86, '472', 'bulma.min.dxf', '31/01/2023 19:26:39', '02/02/2023 15:14:40', 'corte => cortado', 'marcos'),
(87, '473', '1.dxf', '31/01/2023 19:26:41', '02/02/2023 15:15:52', 'corte => cortado', 'marcos'),
(88, '474', '1.dxf', '31/01/2023 19:26:41', '02/02/2023 15:24:58', 'corte => corte', 'ian'),
(89, '474', '2.dxf', '31/01/2023 19:26:41', '02/02/2023 16:15:33', 'corte => apagado', 'ian'),
(90, '475', '5.dxf', '31/01/2023 19:26:41', '02/02/2023 16:26:10', 'corte => cortado', 'marcos'),
(91, '476', 'index.dxf', '31/01/2023 19:26:42', '03/02/2023 14:08:48', 'corte => apagado', 'ian'),
(92, '477', 'painel.dxf', '31/01/2023 19:26:42', '03/02/2023 14:10:01', 'corte => cortado', 'marcos'),
(93, '478', '1.dxf', '31/01/2023 23:43:53', '03/02/2023 14:12:07', 'corte => cortado', 'marcos');

-- --------------------------------------------------------

--
-- Estrutura da tabela `lixo_desenhos`
--

CREATE TABLE `lixo_desenhos` (
  `id` int(255) NOT NULL,
  `id_desenho` varchar(255) NOT NULL,
  `caminho` varchar(255) NOT NULL,
  `nome_desenho` varchar(255) NOT NULL,
  `data_add` varchar(255) NOT NULL,
  `individuo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `lixo_desenhos`
--

INSERT INTO `lixo_desenhos` (`id`, `id_desenho`, `caminho`, `nome_desenho`, `data_add`, `individuo`) VALUES
(11, ' ', 'Z:/lixo/ 31-01-2023--19-23-48/', ' ', '31/01/2023 19:23:51', 'ian'),
(12, '468', 'Z:/lixo/wl_desenhos/login/config/db/31-01-2023--19-42-29/', '5.dxf', '31/01/2023 19:42:34', 'santana'),
(13, '469', 'Z:/lixo/wl_desenhos/login/config/login/02-02-2023--14-39-11/', '2.dxf', '02/02/2023 14:39:16', 'ian'),
(14, '470', 'Z:/lixo/wl_desenhos/login/config/login/02-02-2023--14-39-32/', 'k.dxf', '02/02/2023 14:39:33', 'ian'),
(15, '471', 'Z:/lixo/wl_desenhos/login/config/login/02-02-2023--15-04-38/', 'verifica_login.dxf', '02/02/2023 15:04:41', 'ian'),
(16, '474', 'Z:/lixo/wl_desenhos/login/02-02-2023--16-15-33/', '2.dxf', '02/02/2023 16:15:35', 'ian'),
(17, '476', 'Z:/lixo/wl_desenhos/login/03-02-2023--14-08-48/', 'index.dxf', '03/02/2023 14:08:50', 'ian');

-- --------------------------------------------------------

--
-- Estrutura da tabela `prioridade`
--

CREATE TABLE `prioridade` (
  `id` int(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `prioridade`
--

INSERT INTO `prioridade` (`id`, `nome`, `status`) VALUES
(1, '1', 'ativo'),
(2, '2', 'ativo'),
(3, '3', 'ativo'),
(4, '4', 'ativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `senha`, `tipo`, `status`) VALUES
(2, 'ian', '202cb962ac59075b964b07152d234b70', 'desenhista', 'ativo'),
(3, 'marcos', '202cb962ac59075b964b07152d234b70', 'cortador', 'ativo'),
(4, 'santana', '202cb962ac59075b964b07152d234b70', 'adm', 'adm'),
(6, 'ian2', '202cb962ac59075b964b07152d234b70', 'adm', 'ativo'),
(7, 'carlos', '202cb962ac59075b964b07152d234b70', 'desenhista', 'ativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `violacao`
--

CREATE TABLE `violacao` (
  `id` int(255) NOT NULL,
  `individuo` varchar(255) NOT NULL,
  `causa` varchar(255) NOT NULL,
  `data` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `violacao`
--

INSERT INTO `violacao` (`id`, `individuo`, `causa`, `data`) VALUES
(4, 'santana', 'Tentou subistituir uma deseho(id = ) com um arquivo nÃ£o permitido, arquivo(1.exe), local()', '03/02/2023 14:22:00');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `corte`
--
ALTER TABLE `corte`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `desenhos`
--
ALTER TABLE `desenhos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `desenhos_temp`
--
ALTER TABLE `desenhos_temp`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `empreendimentos`
--
ALTER TABLE `empreendimentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `filtros`
--
ALTER TABLE `filtros`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `finalidade`
--
ALTER TABLE `finalidade`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `historico_desenhos`
--
ALTER TABLE `historico_desenhos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `lixo_desenhos`
--
ALTER TABLE `lixo_desenhos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `prioridade`
--
ALTER TABLE `prioridade`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `violacao`
--
ALTER TABLE `violacao`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `corte`
--
ALTER TABLE `corte`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `desenhos`
--
ALTER TABLE `desenhos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=503;

--
-- AUTO_INCREMENT de tabela `desenhos_temp`
--
ALTER TABLE `desenhos_temp`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT de tabela `empreendimentos`
--
ALTER TABLE `empreendimentos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `filtros`
--
ALTER TABLE `filtros`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `finalidade`
--
ALTER TABLE `finalidade`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `historico_desenhos`
--
ALTER TABLE `historico_desenhos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT de tabela `lixo_desenhos`
--
ALTER TABLE `lixo_desenhos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `prioridade`
--
ALTER TABLE `prioridade`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `violacao`
--
ALTER TABLE `violacao`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
