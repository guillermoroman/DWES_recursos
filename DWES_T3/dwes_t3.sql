-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 18, 2023 at 10:55 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dwes_t3`
--

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `correo_electronico` varchar(255) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clientes`
--

INSERT INTO `clientes` (`id`, `correo_electronico`, `telefono`, `nombre`, `direccion`) VALUES
(1, 'mario_bros@example.com', '555-0101', 'Mario', 'Reino Champiñón 1'),
(2, 'luigi_green@example.com', '555-0102', 'Luigi', 'Reino Champiñón 2'),
(3, 'peach_castle@example.com', '555-0103', 'Peach', 'Castillo de Peach'),
(4, 'toad_mushroom@example.com', '555-0104', 'Toad', 'Casa de Toad'),
(5, 'yoshi_dino@example.com', '555-0105', 'Yoshi', 'Isla de Yoshi'),
(6, 'bowser_king@example.com', '555-0106', 'Bowser', 'Castillo de Bowser'),
(7, 'daisy_flower@example.com', '555-0107', 'Daisy', 'Reino de Sarasaland'),
(8, 'wario_gold@example.com', '555-0108', 'Wario', 'Mansión de Wario'),
(9, 'waluigi_tricky@example.com', '555-0109', 'Waluigi', 'Apartamento de Waluigi'),
(10, 'donkeykong_banana@example.com', '555-0110', 'Donkey Kong', 'Jungla DK');

-- --------------------------------------------------------

--
-- Table structure for table `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `fecha_pedido` datetime DEFAULT NULL,
  `detalle_pedido` text DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pizzas`
--

CREATE TABLE `pizzas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `coste` float NOT NULL,
  `precio` float NOT NULL,
  `ingredientes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pizzas`
--

INSERT INTO `pizzas` (`id`, `nombre`, `coste`, `precio`, `ingredientes`) VALUES
(1, 'Margherita', 3, 8, 'Tomate, Mozzarella, Albahaca'),
(2, 'Pepperoni', 3.5, 9, 'Tomate, Mozzarella, Pepperoni'),
(3, 'Hawaiana', 4, 10, 'Tomate, Mozzarella, Jamón, Piña'),
(4, 'Cuatro Quesos', 4.5, 11, 'Mozzarella, Queso Azul, Queso de Cabra, Parmesano'),
(5, 'Vegetariana', 3.8, 9.5, 'Tomate, Mozzarella, Pimiento, Cebolla, Champiñones, Aceitunas'),
(6, 'BBQ Chicken', 4.5, 11, 'Salsa BBQ, Pollo, Cebolla, Mozzarella'),
(7, 'Mexicana', 4, 10.5, 'Tomate, Mozzarella, Jalapeños, Carne Picada, Cebolla'),
(8, 'Marinara', 2.5, 7.5, 'Tomate, Ajo, Orégano'),
(9, 'Quattro Stagioni', 4.5, 11.5, 'Tomate, Mozzarella, Jamón, Champiñones, Alcachofas, Aceitunas'),
(10, 'Carbonara', 4, 10, 'Nata, Mozzarella, Panceta, Cebolla');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `rol` int(11) NOT NULL,
  `correo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `nombre`, `clave`, `rol`, `correo`) VALUES
(1, 'admin', 'Admin', '1234', 1, 'admin@admin.com'),
(2, 'usuario', 'Usuario', '1234', 2, 'usuario@usuario.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo_electronico` (`correo_electronico`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indexes for table `pizzas`
--
ALTER TABLE `pizzas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pizzas`
--
ALTER TABLE `pizzas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
