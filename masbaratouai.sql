-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-12-2014 a las 18:46:27
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `masbaratouai`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `idAdmin` int(11) NOT NULL AUTO_INCREMENT,
  `nombreAdmin` varchar(24) NOT NULL,
  `passAdmin` varchar(24) NOT NULL,
  `emailAdmin` varchar(24) NOT NULL,
  PRIMARY KEY (`idAdmin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`idAdmin`, `nombreAdmin`, `passAdmin`, `emailAdmin`) VALUES
(1, 'josegodoy', '123456', 'josegodoy@alumnos.uai.cl'),
(2, 'pedro', '123456', 'pedroydiego@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombreCategoria` varchar(11) NOT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `nombreCategoria`) VALUES
(1, 'Panes'),
(2, 'Bebidas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `edificio`
--

CREATE TABLE IF NOT EXISTS `edificio` (
  `idEdificio` int(11) NOT NULL AUTO_INCREMENT,
  `nombreEdificio` varchar(11) NOT NULL,
  PRIMARY KEY (`idEdificio`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `edificio`
--

INSERT INTO `edificio` (`idEdificio`, `nombreEdificio`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C'),
(4, 'D'),
(5, 'E');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `local`
--

CREATE TABLE IF NOT EXISTS `local` (
  `idLocal` int(11) NOT NULL AUTO_INCREMENT,
  `seudonimoLocal` varchar(30) NOT NULL,
  `nombreLocal` varchar(30) NOT NULL,
  `edificio_idEdificio` int(11) NOT NULL,
  `descripcionLocal` longtext NOT NULL,
  PRIMARY KEY (`idLocal`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `local`
--

INSERT INTO `local` (`idLocal`, `seudonimoLocal`, `nombreLocal`, `edificio_idEdificio`, `descripcionLocal`) VALUES
(1, 'La cueva del lol', 'Subterra', 1, 'Ubicado abajo del casino.'),
(2, 'HotSpot', 'HotSpot', 1, 'Ubicado al fondo del campus del A'),
(3, 'Hoyo', 'Anfitriato', 1, 'Ubicado en el anfiteatro ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `idLog` int(11) NOT NULL AUTO_INCREMENT,
  `FechaLog` datetime NOT NULL,
  `LogLog` longtext NOT NULL,
  `admin_idAdmin` int(11) NOT NULL,
  PRIMARY KEY (`idLog`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `idProducto` int(11) NOT NULL AUTO_INCREMENT,
  `nombreProducto` varchar(50) NOT NULL,
  `precioProducto` int(11) NOT NULL,
  `skuProducto` int(11) NOT NULL,
  `local_idLocal` int(11) NOT NULL,
  `categoria_idCategoria` int(11) NOT NULL,
  `imgProducto` varchar(90) NOT NULL,
  PRIMARY KEY (`idProducto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idProducto`, `nombreProducto`, `precioProducto`, `skuProducto`, `local_idLocal`, `categoria_idCategoria`, `imgProducto`) VALUES
(1, 'Coca-cola 350cc', 650, 6547897, 1, 2, 'IMG\\cocacola350.jpg'),
(2, 'Pepsi', 980, 6549645, 1, 2, 'IMG\\pepsi350.png'),
(3, 'McCola', 120, 654897, 1, 1, 'IMG\\mccola.jpg'),
(4, 'Coca Cola 350cc', 610, 6498416, 3, 2, 'IMG\\cocacola350.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
