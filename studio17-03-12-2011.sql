-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Dez 03, 2011 as 08:36 AM
-- Versão do Servidor: 5.1.39
-- Versão do PHP: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: 'studio17'
--

-- --------------------------------------------------------

--
-- Estrutura da tabela 'categorias'
--

DROP TABLE IF EXISTS categorias;
CREATE TABLE IF NOT EXISTS categorias (
  id int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  clicks int(11) DEFAULT '0',
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela 'categorias'
--

INSERT INTO categorias (id, `name`, clicks) VALUES
(1, 'Wedding Street', 10),
(2, 'Boudoir', 4),
(3, 'Casamentos', 5),
(4, 'E-session', 4),
(5, 'Trash the dress', 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela 'clientes'
--

DROP TABLE IF EXISTS clientes;
CREATE TABLE IF NOT EXISTS clientes (
  id int(11) NOT NULL,
  nome varchar(100) DEFAULT NULL,
  cpf varchar(20) DEFAULT NULL,
  rg varchar(20) DEFAULT NULL,
  logradouro varchar(100) DEFAULT NULL,
  numero varchar(10) DEFAULT NULL,
  complemento varchar(40) DEFAULT NULL,
  bairro varchar(100) DEFAULT NULL,
  cidade varchar(100) DEFAULT NULL,
  estado varchar(2) DEFAULT NULL,
  cep varchar(9) NOT NULL,
  telefone varchar(15) NOT NULL,
  celular varchar(15) DEFAULT NULL,
  email varchar(100) DEFAULT NULL,
  login varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  ativo enum('S','N') DEFAULT NULL,
  created int(11) NOT NULL,
  modified int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela 'clientes'
--


-- --------------------------------------------------------

--
-- Estrutura da tabela 'clientes_fotos'
--

DROP TABLE IF EXISTS clientes_fotos;
CREATE TABLE IF NOT EXISTS clientes_fotos (
  clienteid int(11) NOT NULL,
  foto_id int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela 'clientes_fotos'
--


-- --------------------------------------------------------

--
-- Estrutura da tabela 'ensaios_fotograficos'
--

DROP TABLE IF EXISTS ensaios_fotograficos;
CREATE TABLE IF NOT EXISTS ensaios_fotograficos (
  id int(11) NOT NULL AUTO_INCREMENT,
  foto_id int(11) NOT NULL,
  created datetime NOT NULL,
  modifed datetime NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela 'ensaios_fotograficos'
--

INSERT INTO ensaios_fotograficos (id, foto_id, created, modifed) VALUES
(1, 8, '2011-12-02 07:31:17', '2011-12-02 07:31:17'),
(2, 9, '2011-12-02 07:31:17', '2011-12-02 07:31:17'),
(3, 10, '2011-12-02 07:31:17', '2011-12-02 07:31:17'),
(4, 11, '2011-12-02 07:31:17', '2011-12-02 07:31:17');

-- --------------------------------------------------------

--
-- Estrutura da tabela 'eventos'
--

DROP TABLE IF EXISTS eventos;
CREATE TABLE IF NOT EXISTS eventos (
  id int(11) NOT NULL AUTO_INCREMENT,
  foto_id int(11) NOT NULL,
  categoria_id int(11) NOT NULL,
  created datetime NOT NULL,
  modified datetime NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela 'eventos'
--

INSERT INTO eventos (id, foto_id, categoria_id, created, modified) VALUES
(1, 3, 1, '2011-11-28 23:46:13', '2011-11-28 23:46:16'),
(2, 4, 2, '2011-12-01 00:24:53', '2011-12-01 00:24:53'),
(3, 5, 3, '2011-12-01 00:24:53', '2011-12-01 00:24:53'),
(4, 6, 4, '2011-12-02 07:31:17', '2011-12-02 07:31:17'),
(5, 7, 5, '2011-12-02 07:31:17', '2011-12-02 07:31:17');

-- --------------------------------------------------------

--
-- Estrutura da tabela 'fotografos'
--

DROP TABLE IF EXISTS fotografos;
CREATE TABLE IF NOT EXISTS fotografos (
  id int(11) NOT NULL AUTO_INCREMENT,
  nome varchar(100) NOT NULL,
  foto varchar(100) DEFAULT NULL,
  descricao text,
  created datetime DEFAULT NULL,
  modified datetime DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela 'fotografos'
--

INSERT INTO fotografos (id, nome, foto, descricao, created, modified) VALUES
(1, 'Fotografo 01', 'fotografo_01.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean in lacus cursus tellus egestas mollis in quis felis. Nunc in augue arcu. Pellentesque tempor, nibh et aliquet eleifend, velit sapien pellentesque nulla, nec porttitor nibh nisi eget lacus. Donec tellus augue, mattis sit amet imperdiet et, ultrices sit amet diam. Fusce tincidunt leo iaculis justo euismod sed suscipit nisl lacinia. Curabitur feugiat suscipit justo blandit venenatis. Donec et lacus tortor, eget tincidunt nisi. Suspendisse nisl ante, suscipit vel eleifend nec, vehicula in massa. Nullam pretium euismod nisl eu suscipit. ', '2011-11-26 06:07:47', '2011-11-26 06:07:50'),
(2, 'Fotografo 01', 'fotografo_02.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean in lacus cursus tellus egestas mollis in quis felis. Nunc in augue arcu. Pellentesque tempor, nibh et aliquet eleifend, velit sapien pellentesque nulla, nec porttitor nibh nisi eget lacus. Donec tellus augue, mattis sit amet imperdiet et, ultrices sit amet diam. Fusce tincidunt leo iaculis justo euismod sed suscipit nisl lacinia. Curabitur feugiat suscipit justo blandit venenatis. Donec et lacus tortor, eget tincidunt nisi. Suspendisse nisl ante, suscipit vel eleifend nec, vehicula in massa. Nullam pretium euismod nisl eu suscipit. ', '2011-11-26 06:08:11', '2011-11-26 06:08:14'),
(3, 'Fotografo 3', 'fotografo_03.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean in lacus cursus tellus egestas mollis in quis felis. Nunc in augue arcu. Pellentesque tempor, nibh et aliquet eleifend, velit sapien pellentesque nulla, nec porttitor nibh nisi eget lacus. Donec tellus augue, mattis sit amet imperdiet et, ultrices sit amet diam. Fusce tincidunt leo iaculis justo euismod sed suscipit nisl lacinia. Curabitur feugiat suscipit justo blandit venenatis. Donec et lacus tortor, eget tincidunt nisi. Suspendisse nisl ante, suscipit vel eleifend nec, vehicula in massa. Nullam pretium euismod nisl eu suscipit. ', '2011-11-26 06:10:55', '2011-11-26 06:11:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela 'fotos'
--

DROP TABLE IF EXISTS fotos;
CREATE TABLE IF NOT EXISTS fotos (
  id int(11) NOT NULL AUTO_INCREMENT,
  foto varchar(100) NOT NULL,
  descricao varchar(255) DEFAULT NULL,
  show_home enum('S','N') DEFAULT NULL,
  created datetime NOT NULL,
  modified datetime NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela 'fotos'
--

INSERT INTO fotos (id, foto, descricao, show_home, created, modified) VALUES
(1, 'foto_001.jpg', 'Description for img01', 'S', '2011-11-23 09:46:36', '2011-11-23 09:46:36'),
(2, 'foto_002.jpg', 'Description for img02', 'S', '2011-11-23 09:46:36', '2011-11-23 09:46:36'),
(3, 'foto_003.jpg', 'Description for img03', 'N', '2011-11-28 23:45:52', '2011-11-28 23:45:57'),
(4, 'foto_004.jpg', 'Description for img04', 'N', '2011-12-01 00:18:55', '2011-12-01 00:18:59'),
(5, 'foto_005.jpg', 'Description for img05', 'N', '2011-12-01 00:18:55', '2011-12-01 00:18:55'),
(6, 'foto_006.jpg', 'Description for img06', 'N', '2011-12-02 07:20:53', '2011-12-02 07:20:53'),
(7, 'foto_007.jpg', 'Description for img07', 'N', '2011-12-02 07:20:53', '2011-12-02 07:20:53'),
(8, 'foto_008.jpg', 'Description for img08', 'N', '2011-12-02 07:21:31', '2011-12-02 07:21:34'),
(9, 'foto_009.jpg', 'Description for img09', 'N', '2011-12-02 07:21:51', '2011-12-02 07:21:57'),
(10, 'foto_010.jpg', 'Description for img10', 'N', '2011-12-02 07:22:22', '2011-12-02 07:22:26'),
(11, 'foto_011.jpg', 'Description for img11', 'N', '2011-12-02 07:22:42', '2011-12-02 07:22:47'),
(12, 'foto_012.jpg', 'Description for img12', 'N', '2011-12-02 07:23:34', '2011-12-02 07:23:36'),
(13, 'foto_013.jpg', 'Description for img13', 'N', '2011-12-02 07:24:23', '2011-12-02 07:24:29'),
(14, 'foto_014.jpg', 'Description for img14', 'N', '2011-12-02 07:24:55', '2011-12-02 07:24:58'),
(15, 'foto_015.jpg', 'Description for img15', 'N', '2011-12-02 07:25:33', '2011-12-02 07:25:37'),
(16, 'foto_016.jpg', 'Description for img16', 'N', '2011-12-02 07:25:53', '2011-12-02 07:25:56');

-- --------------------------------------------------------

--
-- Estrutura da tabela 'menu_admin'
--

DROP TABLE IF EXISTS menu_admin;
CREATE TABLE IF NOT EXISTS menu_admin (
  id int(11) NOT NULL AUTO_INCREMENT,
  nome varchar(100) NOT NULL,
  descricao text,
  `order` int(11) NOT NULL,
  link varchar(100) NOT NULL,
  ativo enum('S','N') NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela 'menu_admin'
--


-- --------------------------------------------------------

--
-- Estrutura da tabela 'paginas'
--

DROP TABLE IF EXISTS paginas;
CREATE TABLE IF NOT EXISTS paginas (
  id int(11) NOT NULL AUTO_INCREMENT,
  titulo varchar(100) NOT NULL,
  permalink varchar(100) NOT NULL,
  conteudo longtext NOT NULL,
  created datetime NOT NULL,
  modified datetime NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY permalink (permalink)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela 'paginas'
--

INSERT INTO paginas (id, titulo, permalink, conteudo, created, modified) VALUES
(1, 'Sobre o studio 17', 'sobre', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet tortor in nunc tempus iaculis eleifend a tellus. In arcu enim, dapibus a sollicitudin quis, suscipit quis tellus. Sed sit amet nisi nulla, in bibendum lorem. Donec tincidunt nulla vel mi ultricies sit amet vulputate libero dictum. Mauris gravida tincidunt eleifend. Phasellus nec nisi arcu, tincidunt euismod lectus. Cras condimentum lacinia elementum. Curabitur ac enim at nisi imperdiet ullamcorper et vitae diam. Vivamus in eros purus, nec feugiat augue. Curabitur euismod dignissim vulputate. Pellentesque eget lacus sapien.\r\n\r\nDonec in augue dolor, vel mattis leo. Proin malesuada dolor a sem cursus ullamcorper. Curabitur non convallis diam. Aenean sodales malesuada sem in imperdiet. In vehicula accumsan diam id convallis. Sed quis ipsum justo. Praesent euismod, nulla ut convallis fringilla, risus risus mattis risus, sed vehicula justo lacus nec libero. Donec facilisis egestas nibh quis lacinia. ', '2011-11-23 10:31:11', '2011-11-23 10:31:14');

-- --------------------------------------------------------

--
-- Estrutura da tabela 'portfolio_fotos'
--

DROP TABLE IF EXISTS portfolio_fotos;
CREATE TABLE IF NOT EXISTS portfolio_fotos (
  id int(11) NOT NULL AUTO_INCREMENT,
  foto_id int(11) NOT NULL,
  created datetime NOT NULL,
  modified datetime NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela 'portfolio_fotos'
--

INSERT INTO portfolio_fotos (id, foto_id, created, modified) VALUES
(1, 14, '2011-12-02 07:31:17', '2011-12-02 07:31:17'),
(2, 15, '2011-12-02 07:31:17', '2011-12-02 07:31:17'),
(3, 16, '2011-12-02 07:31:17', '2011-12-02 07:31:17');

-- --------------------------------------------------------

--
-- Estrutura da tabela 'portfolio_videos'
--

DROP TABLE IF EXISTS portfolio_videos;
CREATE TABLE IF NOT EXISTS portfolio_videos (
  id int(11) NOT NULL AUTO_INCREMENT,
  link_youtube varchar(255) NOT NULL,
  thumbnail varchar(100) DEFAULT NULL,
  descricao text,
  created datetime NOT NULL,
  modified datetime NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela 'portfolio_videos'
--

INSERT INTO portfolio_videos (id, link_youtube, thumbnail, descricao, created, modified) VALUES
(1, 'http://www.youtube.com/watch?v=T6AYQc6BAMw', NULL, NULL, '2011-12-02 07:36:31', '2011-12-02 07:36:34'),
(2, 'http://www.youtube.com/watch?v=U5aAY0FtzMA', NULL, NULL, '2011-12-02 07:36:51', '2011-12-02 07:36:55'),
(3, 'http://www.youtube.com/watch?v=EGtCWjHlqM4', NULL, NULL, '2011-12-02 07:37:20', '2011-12-02 07:37:23'),
(4, 'http://www.youtube.com/watch?v=L2ufDMtWPpo', NULL, NULL, '2011-12-02 07:38:10', '2011-12-02 07:38:10'),
(5, 'http://www.youtube.com/watch?v=07wxZIYhQ64', NULL, NULL, '2011-12-02 07:38:10', '2011-12-02 07:38:10'),
(6, 'http://www.youtube.com/watch?v=MTSH5E4ctxM', NULL, NULL, '2011-12-02 07:38:34', '2011-12-02 07:38:38'),
(7, 'http://www.youtube.com/watch?v=YtyIJQJYu2g', NULL, NULL, '2011-12-02 07:38:34', '2011-12-02 07:38:34'),
(8, 'http://www.youtube.com/watch?v=MiOUmjij7YI', NULL, NULL, '2011-12-02 07:39:54', '2011-12-02 07:39:54');

-- --------------------------------------------------------

--
-- Estrutura da tabela 'usuarios'
--

DROP TABLE IF EXISTS usuarios;
CREATE TABLE IF NOT EXISTS usuarios (
  id int(11) NOT NULL AUTO_INCREMENT,
  nome varchar(100) NOT NULL,
  email varchar(100) NOT NULL,
  cpf varchar(14) NOT NULL,
  telefone varchar(15) DEFAULT NULL,
  celular varchar(15) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  ativo enum('S','N') NOT NULL,
  created datetime NOT NULL,
  modified datetime NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY email (email,cpf)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela 'usuarios'
--

