-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07-Fev-2023 às 22:06
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

-- --------------------------------------------------------

--
-- Estrutura da tabela `empreendimentos`
--

CREATE TABLE `empreendimentos` (
  `id` int(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `empresa_id` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `individuo` varchar(255) NOT NULL,
  `data_hora_add` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

CREATE TABLE `empresa` (
  `id` int(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `individuo` varchar(255) NOT NULL,
  `data_hora_add` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `filtros`
--

CREATE TABLE `filtros` (
  `id` int(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `data_hora_add` varchar(255) NOT NULL,
  `individuo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `finalidade`
--

CREATE TABLE `finalidade` (
  `id` int(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `individuo` varchar(255) NOT NULL,
  `data_hora_add` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `historico_adm`
--

CREATE TABLE `historico_adm` (
  `id` int(255) NOT NULL,
  `id_adm` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `data_add` varchar(255) NOT NULL,
  `item` varchar(255) NOT NULL,
  `info_mais` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `prioridade`
--

CREATE TABLE `prioridade` (
  `id` int(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `individuo` varchar(255) NOT NULL,
  `data_hora_add` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `individuo` varchar(255) NOT NULL,
  `data_hora_add` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `senha`, `tipo`, `status`, `individuo`, `data_hora_add`) VALUES
(1, 'santana', '202cb962ac59075b964b07152d234b70', 'adm', 'adm', '', '');

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
-- Índices para tabela `historico_adm`
--
ALTER TABLE `historico_adm`
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
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `desenhos`
--
ALTER TABLE `desenhos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `desenhos_temp`
--
ALTER TABLE `desenhos_temp`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `empreendimentos`
--
ALTER TABLE `empreendimentos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `filtros`
--
ALTER TABLE `filtros`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `finalidade`
--
ALTER TABLE `finalidade`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `historico_adm`
--
ALTER TABLE `historico_adm`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `historico_desenhos`
--
ALTER TABLE `historico_desenhos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `lixo_desenhos`
--
ALTER TABLE `lixo_desenhos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `prioridade`
--
ALTER TABLE `prioridade`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `violacao`
--
ALTER TABLE `violacao`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
