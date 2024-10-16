-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-08-2024 a las 14:50:12
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbsoporte`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id`, `user_name`, `name`, `password`) VALUES
(1, 'admin1', 'Javier Matti', '123456'),
(2, 'admin2', 'Luis Fernandez', '123456');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prequest`
--

CREATE TABLE `prequest` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contactno` varchar(11) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `services` text DEFAULT NULL,
  `others` varchar(255) DEFAULT NULL,
  `query` longtext DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `posting_date` date DEFAULT NULL,
  `remark` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket`
--

CREATE TABLE `ticket` (
  `id` int(11) NOT NULL,
  `user_id` varchar(300) DEFAULT NULL,
  `subject` varchar(300) DEFAULT NULL,
  `task_type` varchar(300) DEFAULT NULL,
  `ticket` longtext DEFAULT NULL,
  `attachment` varchar(300) DEFAULT NULL,
  `status` varchar(300) DEFAULT NULL,
  `admin_remark` longtext DEFAULT NULL,
  `posting_date` timestamp NULL DEFAULT current_timestamp(),
  `admin_remark_date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `admin_id` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ticket`
--

INSERT INTO `ticket` (`id`, `user_id`, `subject`, `task_type`, `ticket`, `attachment`, `status`, `admin_remark`, `posting_date`, `admin_remark_date`, `admin_id`) VALUES
(18, '45', 'revisión de drivers de audio', 'Soporte Técnico', 'revisión de drivers de audio', NULL, 'closed', 'solicitud atendida', '2024-07-25 14:20:59', '2024-07-25 15:16:00', '1'),
(19, '56', 'instalacion de paquetes de adobe', 'Soporte Técnico', 'instalacion de paquetes de adobe', NULL, 'closed', 'solicitud atendida', '2024-07-25 16:22:35', '2024-07-25 16:26:46', '1'),
(20, '34', 'instalación de impresora en red', 'Soporte Técnico', 'instalación de impresora en red', NULL, 'closed', 'solicitud atendida', '2024-07-30 20:56:01', '2024-07-30 20:59:49', '1'),
(21, '7', 'configuración de password en windows 10', 'Soporte Técnico', 'configuración de password en windows 10', NULL, 'closed', 'solicitud atendida', '2024-07-30 21:00:36', '2024-07-30 21:01:34', '1'),
(22, '7', 'configuracion de impresora en red ', 'Soporte Técnico', 'configuracion de impresora en red ', NULL, 'closed', 'solicitud atendida', '2024-07-30 21:01:05', '2024-07-30 21:01:30', '1'),
(23, '34', 'Asignación de horarios Biométrico CRC y Biométrico FCBCB', 'Soporte Técnico', 'Configurar y reasignar el horario de invierno a los usuarios', NULL, 'closed', 'Se reasignó los ajustes según solicitud', '2024-07-31 22:43:42', '2024-08-01 16:02:29', '2'),
(24, '31', 'Soporte Sistema de Correspondencia', 'Soporte Técnico', 'Derivación erronea, asignar la derivación correcta porfavor', NULL, 'closed', 'Solicitud atendida', '2024-08-01 15:45:23', '2024-08-01 16:04:11', '2'),
(25, '6', 'Accesos Biométrico', 'Soporte Técnico', 'Mediante la presente, solicito pueda habilitar mi acceso al biométrico de la Fundación Cultural del Banco Central de Bolivia para realizar como especifica en los términos de referencia de mi contrato', NULL, 'closed', 'Se creó los accesos correctamente. Solicitud atendida', '2024-08-01 19:24:51', '2024-08-01 19:26:39', '2'),
(26, '5', 'Instalación de Impresora HP LaserJet Pro 400 serie M401', 'Soporte Técnico', 'Instalación de Impresora HP LaserJet Pro 400 serie M401', NULL, 'closed', 'solicitud atendida', '2024-08-01 20:26:53', '2024-08-01 20:27:44', '1'),
(27, '37', 'Instalación de Impresora HP LaserJet Pro 400 serie M401', 'Soporte Técnico', 'Instalación de Impresora HP LaserJet Pro 400 serie M401\r\n', NULL, 'closed', 'solicitud atendida', '2024-08-01 20:27:34', '2024-08-01 20:27:51', '1'),
(28, '23', 'parche adobe premiere', 'Soporte Técnico', 'parche adobe premiere', NULL, 'closed', 'solicitud atendida', '2024-08-02 19:39:17', '2024-08-02 21:25:58', '1'),
(29, '23', 'mantenimiento de impresora l1800', 'Soporte Técnico', 'mantenimiento de impresora l1800', NULL, 'closed', 'solicitud atendida', '2024-08-02 19:40:42', '2024-08-02 21:26:03', '1'),
(30, '36', 'generacion de qr para redes sociales', 'Soporte Técnico', 'generacion de qr para redes sociales', NULL, 'closed', 'solicitud atendida', '2024-08-02 20:06:16', '2024-08-02 21:26:08', '1'),
(31, '36', 'parche de adobe para activacion del producto', 'Soporte Técnico', 'parche de adobe para activacion del producto', NULL, 'closed', 'solicitud atendida', '2024-08-02 20:07:00', '2024-08-02 21:26:11', '1'),
(32, '23', 'parche adobe premiere', 'Soporte Técnico', 'Mi programa Adobe premiere dejó de funcionar porque quiere actualización, por lo que no logro editar video, solicito revisar mi máquina por favor.', NULL, 'closed', 'Solicitud atendida en linea', '2024-08-05 19:39:43', '2024-08-08 15:20:26', '2'),
(33, '4', 'Solicitud de desarchivo de hoja de ruta 3278', 'Soporte Técnico', 'Solicitud de desarchivo de hoja de ruta 3278', NULL, 'closed', 'solicitud atendida', '2024-08-07 14:50:09', '2024-08-07 14:52:03', '1'),
(34, '8', 'Soporte sistema SIGA', 'Soporte Técnico', 'Backup del Sistema SIGA, correspondiente a Publicaciones y Tienda de la gestión 2021 y 2022', NULL, 'closed', 'Se recuperó los datos correspondientes y se envió el enlace del sistema para fines consiguientes.', '2024-08-07 16:09:13', '2024-08-07 16:10:06', '2'),
(35, '43', 'Crear codigo QR', 'Soporte Técnico', 'Subir en la página web el Libro de la 8va Convocatoria de Letras e Imágenes de Nuevo Tiempo y crear QR de enlace', NULL, 'closed', 'Se realizo las gestiones según solicitud', '2024-08-07 20:30:39', '2024-08-07 21:15:54', '2'),
(36, '11', 'Subir contenido a la pagina web', 'Soporte Técnico', 'Por favor en el marco de la normativa vigente, se solicita la difusión del documento adjunto en la pestaña de planificación de la pagina web de la entidad.', NULL, 'closed', 'Se publicó el documento para su difusión', '2024-08-08 14:09:48', '2024-08-08 14:31:56', '2'),
(37, '15', 'Soporte impresora', 'Soporte Técnico', 'Revisión y cambio de toners', NULL, 'closed', 'Se sustituyó los tónners de manera correcta. Solicitud atendida', '2024-08-08 14:11:10', '2024-08-08 14:32:31', '2'),
(38, '32', 'Escaneado OCR de libro', 'Soporte Técnico', 'digitalización de documento bibliografico en formato OCR', NULL, 'closed', 'solicitud atendida', '2024-08-08 15:59:13', '2024-08-08 15:59:48', '1'),
(39, '44', 'atasco de papel en la impresora', 'Soporte Técnico', 'atasco de papel en la impresora', NULL, 'closed', 'solicitud atendida', '2024-08-13 15:56:11', '2024-08-13 15:56:34', '1'),
(40, '47', 'habilitación de carpeta compartida', 'Soporte Técnico', 'habilitación de carpeta compartida', NULL, 'closed', 'Solicitud atendida', '2024-08-13 22:05:12', '2024-08-13 22:07:50', '1'),
(41, '4', 'Trasmisión en vivo', 'Soporte Técnico Externo(comision)', 'Apoyo técnico en la trasmisión en vivo por las redes sociales, actividad Firma de Convenio de Donación', NULL, 'closed', 'solicitud atendida', '2024-08-14 12:28:55', '2024-08-15 16:04:51', '1'),
(42, '46', 'Habilitación de equipos multimedia en sala de reuniones', 'Soporte Técnico', 'Habilitación de equipos multimedia en sala de reuniones', NULL, 'closed', 'solicitud atendida', '2024-08-14 22:44:41', '2024-08-14 22:47:20', '1'),
(43, '31', 'revisión de conexion hdmi de monitores', 'Soporte Técnico', 'revisión de conexion hdmi de monitores', NULL, 'closed', 'solicitud atendida', '2024-08-14 22:46:08', '2024-08-14 22:47:24', '1'),
(44, '58', 'apoyo en configuración de documento excel', 'Soporte Técnico', 'apoyo en configuración de documento excel', NULL, 'closed', 'solicitud atendida', '2024-08-14 22:46:52', '2024-08-14 22:47:27', '1'),
(45, '20', 'Solicitud de video de grabación zoom de taller capacitacion de POA 2025', 'Soporte Técnico', 'Solicitud de video de grabación zoom de taller capacitacion de POA 2025', NULL, 'closed', 'solicitud atendida', '2024-08-15 16:06:01', '2024-08-15 16:06:18', '1'),
(46, '31', 'fallo en el cable de poder del Case', 'Soporte Técnico', 'fallo en el cable de poder del Case', NULL, 'closed', 'solicitud atendida', '2024-08-15 20:28:47', '2024-08-15 20:29:19', '1'),
(47, '45', 'Instalación de autocad 2021', 'Soporte Técnico', 'Instalación de autocad 2021', NULL, 'closed', 'solicitud atendida', '2024-08-16 19:37:20', '2024-08-16 19:38:04', '45'),
(48, '45', 'Reinstalacion y formateo de Computadora por falla de sistema operativo', 'Soporte Técnico', 'Reinstalacion y formateo de Computadora por falla de sistema operativo', NULL, 'closed', 'solicitud atendida', '2024-08-16 19:37:51', '2024-08-16 19:38:00', '45'),
(49, '23', 'parche adobe premiere', 'Soporte Técnico', 'Ya no puedo usar Adobe Premiere', NULL, 'closed', 'solicitud atendida', '2024-08-19 13:55:17', '2024-08-19 15:07:00', '1'),
(50, '23', 'parche adobe premiere', 'Soporte Técnico', 'Mi Adoble Premiere no funciona.', NULL, 'closed', 'solicitud atendida en el ticket 49', '2024-08-19 14:09:52', '2024-08-19 15:07:12', '1'),
(51, '17', 'recarga de tinta y mantenimiento a impresora Epson l380', 'Soporte Técnico', 'recarga de tinta y mantenimiento a impresora Epson l380', NULL, 'closed', 'solicitud atendida', '2024-08-19 15:09:39', '2024-08-19 15:13:34', '1'),
(52, '9', 'fallo de conexion de impresora', 'Soporte Técnico', 'fallo de conexion de impresora', NULL, 'closed', 'solicitud atendida incidente del dia 16/8/2024', '2024-08-19 15:10:51', '2024-08-19 15:13:57', '1'),
(53, '43', 'habilitación de impresora compartida del area de culturas', 'Soporte Técnico', 'habilitación de impresora compartida del area de culturas', NULL, 'closed', 'solicitud atendida', '2024-08-19 15:11:26', '2024-08-19 15:14:10', '1'),
(54, '26', 'falla de conexion de monitor', 'Soporte Técnico', 'falla de conexion de monitor', NULL, 'closed', 'solicitud atendida', '2024-08-19 19:32:35', '2024-08-19 19:33:02', '1'),
(55, '26', 'falla de conexion de escanner', 'Soporte Técnico', 'falla de conexion de escanner', NULL, 'closed', 'solicitud atendida', '2024-08-19 19:32:47', '2024-08-19 19:32:58', '1'),
(56, '42', 'habilitacion de carpeta compartida en archivo ', 'Soporte Técnico', 'habilitacion de carpeta compartida en archivo ', NULL, 'closed', 'solicitud atendida', '2024-08-20 15:09:13', '2024-08-20 15:10:35', '1'),
(57, '34', 'Solicitud de cable de red para conexion a equipo portatil', 'Soporte Técnico', 'Solicitud de cable de red para conexion a equipo portatil', NULL, 'closed', 'solicitud atendida', '2024-08-20 15:10:21', '2024-08-20 15:10:30', '1'),
(58, '4', 'falla de conexion a internet y telefono', 'Soporte Técnico', 'falla de conexion a internet y telefono', NULL, 'closed', 'solicitud atendida', '2024-08-23 16:07:20', '2024-08-23 16:08:59', '1'),
(59, '13', 'falla de conexion a internet', 'Soporte Técnico', 'falla de conexion a internet', NULL, 'closed', 'solicitud atendida', '2024-08-23 16:08:03', '2024-08-23 16:09:02', '1'),
(60, '56', 'falla de conexion a internet y telefono', 'Soporte Técnico', 'falla de conexion a internet y telefono', NULL, 'closed', 'solicitud atendida', '2024-08-23 16:08:47', '2024-08-23 16:09:05', '1'),
(61, '57', 'Solicitud de revision de camaras de seguridad para de verificación de marcado de biometrico', 'Soporte Técnico', 'Solicitud de revision de camaras de seguridad para de verificación de marcado de biometrico', NULL, 'closed', 'solicitud atendida', '2024-08-23 20:16:17', '2024-08-23 20:16:30', '57'),
(62, '34', 'Configuración de impresion de documento pdf', 'Soporte Técnico', 'Configuración de impresion de documento pdf', NULL, 'closed', 'solicitud atendida\r\n', '2024-08-26 16:16:11', '2024-08-26 16:16:27', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `alt_email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `posting_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `user_name`, `name`, `email`, `alt_email`, `password`, `mobile`, `gender`, `address`, `status`, `posting_date`) VALUES
(1, 'testusername', 'testuser', 'testuser@example.com', 'altuser@example.com', '123456', '1234567890', 'male', '123 Test St', 1, '2024-07-15 00:00:00'),
(2, '6799225', 'Adrian Villarreal', 'adrian.villarreal@example.com', 'alt_adrian.villarreal@example.com', '6799225', '1234567890', 'Masculino', 'Default Address', 1, '2024-07-17 22:44:35'),
(3, '4796382', 'Adriana Sandalio Viscarra', 'adriana.sandalio@example.com', 'alt_adriana.sandalio@example.com', '4796382', '1234567890', 'Femenino', 'Default Address', 1, '2024-07-17 22:44:35'),
(4, '4922527', 'Ángela Aduviri Arroyo', 'angela.aduviri@example.com', 'alt_angela.aduviri@example.com', '4922527', '1234567890', 'Femenino', 'Default Address', 1, '2024-07-17 22:44:35'),
(5, '4329603', 'Beatriz Lidia Mamani Abelo', 'beatriz.mamani@example.com', 'alt_beatriz.mamani@example.com', '4329603', '1234567890', 'Femenino', 'Default Address', 1, '2024-07-17 22:44:35'),
(6, '3407802', 'Carola Gutierrez Soto', 'carola.gutierrez@example.com', 'alt_carola.gutierrez@example.com', '3407802', '1234567890', 'Femenino', 'Default Address', 1, '2024-07-17 22:44:35'),
(7, '2682167', 'Cristobal Apaza Bautista', 'cristobal.apaza@example.com', 'alt_cristobal.apaza@example.com', '2682167', '1234567890', 'Masculino', 'Default Address', 1, '2024-07-17 22:44:35'),
(8, '6736666', 'Daniel Aramayo Villarroel', 'daniel.aramayo@example.com', 'alt_daniel.aramayo@example.com', '6736666', '1234567890', 'Masculino', 'Default Address', 1, '2024-07-17 22:44:35'),
(9, '3358957', 'David Aruquipa Pérez', 'david.aruquipa@example.com', 'alt_david.aruquipa@example.com', '3358957', '1234567890', 'Masculino', 'Default Address', 1, '2024-07-17 22:44:35'),
(10, '6190120', 'Denisse Velásquez Silva', 'denisse.velasquez@example.com', 'alt_denisse.velasquez@example.com', '6190120', '1234567890', 'Femenino', 'Default Address', 1, '2024-07-17 22:44:35'),
(11, '6985867', 'Elian Álvarez Gómez', 'elian.alvarez@example.com', 'alt_elian.alvarez@example.com', '6985867', '1234567890', 'Femenino', 'Default Address', 1, '2024-07-17 22:44:35'),
(12, '3423767', 'Erika Gómez', 'erika.gomez@example.com', 'alt_erika.gomez@example.com', '3423767', '1234567890', 'Femenino', 'Default Address', 1, '2024-07-17 22:44:35'),
(13, '7050731', 'Estefani Huiza Fernández', 'estefani.huiza@example.com', 'alt_estefani.huiza@example.com', '7050731', '1234567890', 'Femenino', 'Default Address', 1, '2024-07-17 22:44:35'),
(14, '3325512', 'Estela Ojeda Loza', 'estela.ojeda@example.com', 'alt_estela.ojeda@example.com', '3325512', '1234567890', 'Femenino', 'Default Address', 1, '2024-07-17 22:44:35'),
(15, '2689803', 'Eustaquio Vera Copa', 'eustaquio.vera@example.com', 'alt_eustaquio.vera@example.com', '2689803', '1234567890', 'Masculino', 'Default Address', 1, '2024-07-17 22:44:35'),
(16, '6123695', 'Evelin Troche Espinoza', 'evelin.troche@example.com', 'alt_evelin.troche@example.com', '6123695', '1234567890', 'Femenino', 'Default Address', 1, '2024-07-17 22:44:35'),
(17, '6876773', 'Franco Villatarco Zambrana', 'franco.villatarco@example.com', 'alt_franco.villatarco@example.com', '6876773', '1234567890', 'Masculino', 'Default Address', 1, '2024-07-17 22:44:35'),
(18, '7008958', 'Gabriela Fuentes Ramos', 'gabriela.fuentes@example.com', 'alt_gabriela.fuentes@example.com', '7008958', '1234567890', 'Femenino', 'Default Address', 1, '2024-07-17 22:44:35'),
(19, '2543742', 'Grover Choque Quispe', 'grover.choque@example.com', 'alt_grover.choque@example.com', '2543742', '1234567890', 'Masculino', 'Default Address', 1, '2024-07-17 22:44:35'),
(20, '5480490', 'Guadalupe Chávez Choque', 'guadalupe.chavez@example.com', 'alt_guadalupe.chavez@example.com', '5480490', '1234567890', 'Femenino', 'Default Address', 1, '2024-07-17 22:44:35'),
(21, '3462509', 'Hector Sempertegui Alvarez', 'hector.sempertegui@example.com', 'alt_hector.sempertegui@example.com', '3462509', '1234567890', 'Masculino', 'Default Address', 1, '2024-07-17 22:44:35'),
(22, '4898121', 'Hernan Sandro Aquino Churqui', 'hernan.aquino@example.com', 'alt_hernan.aquino@example.com', '4898121', '1234567890', 'Masculino', 'Default Address', 1, '2024-07-17 22:44:35'),
(23, '5989585', 'Janela Ingrid Vargas Vasquez', 'janela.vargas@example.com', 'alt_janela.vargas@example.com', '5989585', '1234567890', 'Femenino', 'Default Address', 1, '2024-07-17 22:44:35'),
(24, '8324905', 'Javier Matti Zapana', 'javier.matti@example.com', 'alt_javier.matti@example.com', '8324905', '1234567890', 'Masculino', 'Default Address', 1, '2024-07-17 22:44:35'),
(25, '3487543', 'Juan Ramos', 'juan.ramos@example.com', 'alt_juan.ramos@example.com', '3487543', '1234567890', 'Masculino', 'Default Address', 1, '2024-07-17 22:44:35'),
(26, '9209737', 'Karina Saravia Flores', 'karina.saravia@example.com', 'alt_karina.saravia@example.com', '9209737', '1234567890', 'Femenino', 'Default Address', 1, '2024-07-17 22:44:35'),
(27, '9070081', 'Katerine Isidro Queso', 'katerine.isidro@example.com', 'alt_katerine.isidro@example.com', '9070081', '1234567890', 'Femenino', 'Default Address', 1, '2024-07-17 22:44:35'),
(28, '6080890', 'Livia Armendia Laurel', 'livia.armendia@example.com', 'alt_livia.armendia@example.com', '6080890', '1234567890', 'Femenino', 'Default Address', 1, '2024-07-17 22:44:35'),
(29, '5762453', 'Luis Alberto Fernandez Orellana', 'luis.fernandez@example.com', 'alt_luis.fernandez@example.com', '5762453', '1234567890', 'Masculino', 'Default Address', 1, '2024-07-17 22:44:35'),
(30, '4791448', 'Luis Arequipa Apaza', 'luis.arequipa@example.com', 'alt_luis.arequipa@example.com', '4791448', '1234567890', 'Masculino', 'Default Address', 1, '2024-07-17 22:44:35'),
(31, '4909891', 'Luis Daniel Amezaga Bejarano', 'luis.amezaga@example.com', 'alt_luis.amezaga@example.com', '4909891', '1234567890', 'Masculino', 'Default Address', 1, '2024-07-17 22:44:35'),
(32, '2220126', 'Luis Oporto Ordonez', 'luis.oporto@example.com', 'alt_luis.oporto@example.com', '2220126', '1234567890', 'Masculino', 'Default Address', 1, '2024-07-17 22:44:35'),
(33, '4741713', 'Mabel Belzu García', 'mabel.belzu@example.com', 'alt_mabel.belzu@example.com', '4741713', '1234567890', 'Femenino', 'Default Address', 1, '2024-07-17 22:44:35'),
(34, '2630284', 'Magali Macias Bohorquez', 'magali.macias@example.com', 'alt_magali.macias@example.com', '2630284', '1234567890', 'Femenino', 'Default Address', 1, '2024-07-17 22:44:35'),
(35, '5078422', 'Magali Uribe García', 'magali.uribe@example.com', 'alt_magali.uribe@example.com', '5078422', '1234567890', 'Femenino', 'Default Address', 1, '2024-07-17 22:44:35'),
(36, '6185880', 'María Alejandra Cornejo Valdez', 'maria.cornejo@example.com', 'alt_maria.cornejo@example.com', '6185880', '1234567890', 'Femenino', 'Default Address', 1, '2024-07-17 22:44:35'),
(37, '6081183', 'Maria Delina Carvajal Duran', 'maria.carvajal@example.com', 'alt_maria.carvajal@example.com', '6081183', '1234567890', 'Femenino', 'Default Address', 1, '2024-07-17 22:44:35'),
(38, '4376835', 'Maria Guadalupe Quintanilla Quelca', 'maria.quintanilla@example.com', 'alt_maria.quintanilla@example.com', '4376835', '1234567890', 'Femenino', 'Default Address', 1, '2024-07-17 22:44:35'),
(39, '3375385', 'Mariana Vargas Toro', 'mariana.vargas@example.com', 'alt_mariana.vargas@example.com', '3375385', '1234567890', 'Femenino', 'Default Address', 1, '2024-07-17 22:44:35'),
(40, '5974311', 'Marianela Espana Mita', 'marianela.espana@example.com', 'alt_marianela.espana@example.com', '5974311', '1234567890', 'Femenino', 'Default Address', 1, '2024-07-17 22:44:35'),
(41, '4844721', 'Mario Marca Honorio', 'mario.marca@example.com', 'alt_mario.marca@example.com', '4844721', '1234567890', 'Masculino', 'Default Address', 1, '2024-07-17 22:44:35'),
(42, '3484596', 'Marisabel Zubieta Salas', 'marisabel.zubieta@example.com', 'alt_marisabel.zubieta@example.com', '3484596', '1234567890', 'Femenino', 'Default Address', 1, '2024-07-17 22:44:35'),
(43, '4878229', 'Mary Carmen Molina Ergueta', 'mary.molina@example.com', 'alt_mary.molina@example.com', '4878229', '1234567890', 'Femenino', 'Default Address', 1, '2024-07-17 22:44:35'),
(44, '6144712', 'Mauricio Fernando Castillo Arratia', 'mauricio.castillo@example.com', 'alt_mauricio.castillo@example.com', '6144712', '1234567890', 'Masculino', 'Default Address', 1, '2024-07-17 22:44:35'),
(45, '6783260', 'Melina Maribel Maldonado Rios', 'melina.maldonado@example.com', 'alt_melina.maldonado@example.com', '6783260', '1234567890', 'Femenino', 'Default Address', 1, '2024-07-17 22:44:35'),
(46, '2150176', 'Pablo Ernesto Mansilla Salinas', 'pablo.mansilla@example.com', 'alt_pablo.mansilla@example.com', '2150176', '1234567890', 'Masculino', 'Default Address', 1, '2024-07-17 22:44:35'),
(47, '8412357', 'Patricia Humana Lluta', 'patricia.humana@example.com', 'alt_patricia.humana@example.com', '8412357', '1234567890', 'Femenino', 'Default Address', 1, '2024-07-17 22:44:35'),
(48, '3336972', 'Pavel Pérez Armata', 'pavel.perez@example.com', 'alt_pavel.perez@example.com', '3336972', '1234567890', 'Masculino', 'Default Address', 1, '2024-07-17 22:44:35'),
(49, '4262272', 'Ramiro Marquez Gallardo', 'ramiro.marquez@example.com', 'alt_ramiro.marquez@example.com', '4262272', '1234567890', 'Masculino', 'Default Address', 1, '2024-07-17 22:44:35'),
(50, '4842254', 'Reyna Roque Ortega', 'reyna.roque@example.com', 'alt_reyna.roque@example.com', '4842254', '1234567890', 'Femenino', 'Default Address', 1, '2024-07-17 22:44:35'),
(51, '2058080', 'Ricardo Aguilar Asin', 'ricardo.aguilar@example.com', 'alt_ricardo.aguilar@example.com', '2058080', '1234567890', 'Masculino', 'Default Address', 1, '2024-07-17 22:44:35'),
(52, '4918718', 'Rita Lizeth Quiroz Suarez', 'rita.quiroz@example.com', 'alt_rita.quiroz@example.com', '4918718', '1234567890', 'Femenino', 'Default Address', 1, '2024-07-17 22:44:35'),
(53, '3251519', 'Rolando Paniagua Espinoza', 'rolando.paniagua@example.com', 'alt_rolando.paniagua@example.com', '3251519', '1234567890', 'Masculino', 'Default Address', 1, '2024-07-17 22:44:35'),
(54, '3388610', 'Rolando Pereira Gamez', 'rolando.pereira@example.com', 'alt_rolando.pereira@example.com', '3388610', '1234567890', 'Masculino', 'Default Address', 1, '2024-07-17 22:44:35'),
(55, '8264230', 'Rosa Adelaida Quispe Calle', 'rosa.quispe@example.com', 'alt_rosa.quispe@example.com', '8264230', '1234567890', 'Femenino', 'Default Address', 1, '2024-07-17 22:44:35'),
(56, '6965732', 'Silvia Condori Mamani', 'silvia.condori@example.com', 'alt_silvia.condori@example.com', '6965732', '1234567890', 'Femenino', 'Default Address', 1, '2024-07-17 22:44:35'),
(57, '4985716', 'Silvia Huanca Calle', 'silvia.huanca@example.com', 'alt_silvia.huanca@example.com', '4985716', '1234567890', 'Femenino', 'Default Address', 1, '2024-07-17 22:44:35'),
(58, '3431083', 'Willy Quispe Lipa', 'willy.quispe@example.com', 'alt_willy.quispe@example.com', '3431083', '1234567890', 'Masculino', 'Default Address', 1, '2024-07-17 22:44:35'),
(59, '4831236', 'Yecid Gustavo Sanchez Velasco', 'yecid.sanchez@example.com', 'alt_yecid.sanchez@example.com', '4831236', '1234567890', 'Masculino', 'Default Address', 1, '2024-07-17 22:44:35'),
(60, '4848702', 'Yussela Saleth Goyzueta Ramos', 'yussela.goyzueta@example.com', 'alt_yussela.goyzueta@example.com', '4848702', '1234567890', 'Femenino', 'Default Address', 1, '2024-07-17 22:44:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usercheck`
--

CREATE TABLE `usercheck` (
  `id` int(11) NOT NULL,
  `logindate` varchar(255) DEFAULT '',
  `logintime` varchar(255) DEFAULT '',
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT '',
  `ip` varbinary(16) DEFAULT NULL,
  `mac` varbinary(16) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usercheck`
--

INSERT INTO `usercheck` (`id`, `logindate`, `logintime`, `user_id`, `username`, `email`, `ip`, `mac`, `city`, `country`) VALUES
(12, '2024/07/17', '04:14:53am', 29, 'Luis Alberto Fernandez Orellana', '5762453', 0x3139322e3136382e312e3238, 0x4e6f6d62726520646520686f73742e20, '', ''),
(13, '2024/07/17', '04:54:08am', 24, 'Javier Matti Zapana', '8324905', 0x3139322e3136382e312e3735, 0x4e6f6d62726520646520686f73742e20, '', ''),
(14, '2024/07/25', '07:49:33pm', 45, 'Melina Maribel Maldonado Rios', '6783260', 0x3139322e3136382e312e313531, 0x4e6f6d62726520646520686f73742e20, '', ''),
(15, '2024/07/25', '07:50:33pm', 45, 'Melina Maribel Maldonado Rios', '6783260', 0x3139322e3136382e312e313531, 0x4e6f6d62726520646520686f73742e20, '', ''),
(16, '2024/07/25', '09:51:32pm', 56, 'Silvia Condori Mamani', '6965732', 0x3139322e3136382e312e313237, 0x4e6f6d62726520646520686f73742e20, '', ''),
(17, '2024/07/25', '09:52:05pm', 56, 'Silvia Condori Mamani', '6965732', 0x3139322e3136382e312e313237, 0x4e6f6d62726520646520686f73742e20, '', ''),
(18, '2024/07/25', '10:01:12pm', 13, 'Estefani Huiza Fernández', '7050731', 0x3139322e3136382e312e3835, 0x4e6f6d62726520646520686f73742e20, '', ''),
(19, '2024/07/30', '02:25:36am', 34, 'Magali Macias Bohorquez', '2630284', 0x3139322e3136382e312e313035, 0x4e6f6d62726520646520686f73742e20, '', ''),
(20, '2024/07/30', '02:30:09am', 7, 'Cristobal Apaza Bautista', '2682167', 0x3139322e3136382e312e3735, 0x4e6f6d62726520646520686f73742e20, '', ''),
(21, '2024/08/01', '09:11:25pm', 34, 'Magali Macias Bohorquez', '2630284', 0x3139322e3136382e312e3530, 0x4e6f6d62726520646520686f73742e20, '', ''),
(22, '2024/08/01', '09:14:04pm', 31, 'Luis Daniel Amezaga Bejarano', '4909891', 0x3139322e3136382e312e3530, 0x4e6f6d62726520646520686f73742e20, '', ''),
(23, '2024/08/01', '09:30:40pm', 34, 'Magali Macias Bohorquez', '2630284', 0x3139322e3136382e312e3530, 0x4e6f6d62726520646520686f73742e20, '', ''),
(24, '2024/08/01', '09:33:29pm', 31, 'Luis Daniel Amezaga Bejarano', '4909891', 0x3139322e3136382e312e3530, 0x4e6f6d62726520646520686f73742e20, '', ''),
(25, '2024/08/01', '12:53:59am', 6, 'Carola Gutierrez Soto', '3407802', 0x3139322e3136382e312e3530, 0x4e6f6d62726520646520686f73742e20, '', ''),
(26, '2024/08/01', '12:56:09am', 6, 'Carola Gutierrez Soto', '3407802', 0x3139322e3136382e312e3530, 0x4e6f6d62726520646520686f73742e20, '', ''),
(27, '2024/08/01', '01:56:29am', 5, 'Beatriz Lidia Mamani Abelo', '4329603', 0x3139322e3136382e312e3735, 0x4e6f6d62726520646520686f73742e20, '', ''),
(28, '2024/08/01', '01:57:16am', 37, 'Maria Delina Carvajal Duran', '6081183', 0x3139322e3136382e312e3735, 0x4e6f6d62726520646520686f73742e20, '', ''),
(29, '2024/08/02', '01:08:36am', 23, 'Janela Ingrid Vargas Vasquez', '5989585', 0x3139322e3136382e3130302e3737, 0x4e6f6d62726520646520686f73742e20, '', ''),
(30, '2024/08/02', '01:35:30am', 36, 'María Alejandra Cornejo Valdez', '6185880', 0x3139322e3136382e3130302e313131, 0x4e6f6d62726520646520686f73742e20, '', ''),
(31, '2024/08/05', '01:08:20am', 23, 'Janela Ingrid Vargas Vasquez', '5989585', 0x3139322e3136382e3130302e3737, 0x4e6f6d62726520646520686f73742e20, '', ''),
(32, '2024/08/07', '08:19:40pm', 4, 'Ángela Aduviri Arroyo', '4922527', 0x3139322e3136382e312e3735, 0x4e6f6d62726520646520686f73742e20, '', ''),
(33, '2024/08/07', '09:37:15pm', 57, 'Silvia Huanca Calle', '4985716', 0x3139322e3136382e312e3530, 0x4e6f6d62726520646520686f73742e20, '', ''),
(34, '2024/08/07', '09:37:47pm', 8, 'Daniel Aramayo Villarroel', '6736666', 0x3139322e3136382e312e3530, 0x4e6f6d62726520646520686f73742e20, '', ''),
(35, '2024/08/07', '02:42:23am', 43, 'Mary Carmen Molina Ergueta', '4878229', 0x3139322e3136382e312e3530, 0x4e6f6d62726520646520686f73742e20, '', ''),
(36, '2024/08/08', '07:38:36pm', 11, 'Elian Álvarez Gómez', '6985867', 0x3139322e3136382e312e3530, 0x4e6f6d62726520646520686f73742e20, '', ''),
(37, '2024/08/08', '07:40:41pm', 15, 'Eustaquio Vera Copa', '2689803', 0x3139322e3136382e312e3530, 0x4e6f6d62726520646520686f73742e20, '', ''),
(38, '2024/08/08', '09:28:38pm', 32, 'Luis Oporto Ordonez', '2220126', 0x3139322e3136382e312e3735, 0x4e6f6d62726520646520686f73742e20, '', ''),
(39, '2024/08/13', '09:26:00pm', 44, 'Mauricio Fernando Castillo Arratia', '6144712', 0x3139322e3136382e312e3735, 0x4e6f6d62726520646520686f73742e20, '', ''),
(40, '2024/08/13', '03:34:30am', 47, 'Patricia Humana Lluta', '8412357', 0x3139322e3136382e312e3638, 0x4e6f6d62726520646520686f73742e20, '', ''),
(41, '2024/08/14', '05:54:45pm', 4, 'Ángela Aduviri Arroyo', '4922527', 0x3139322e3136382e312e3530, 0x4e6f6d62726520646520686f73742e20, '', ''),
(42, '2024/08/14', '04:14:10am', 46, 'Pablo Ernesto Mansilla Salinas', '2150176', 0x3139322e3136382e312e3735, 0x4e6f6d62726520646520686f73742e20, '', ''),
(43, '2024/08/14', '04:15:37am', 31, 'Luis Daniel Amezaga Bejarano', '4909891', 0x3139322e3136382e312e3735, 0x4e6f6d62726520646520686f73742e20, '', ''),
(44, '2024/08/14', '04:16:31am', 58, 'Willy Quispe Lipa', '3431083', 0x3139322e3136382e312e3735, 0x4e6f6d62726520646520686f73742e20, '', ''),
(45, '2024/08/15', '09:35:25pm', 20, 'Guadalupe Chávez Choque', '5480490', 0x3139322e3136382e312e3735, 0x4e6f6d62726520646520686f73742e20, '', ''),
(46, '2024/08/15', '01:58:20am', 31, 'Luis Daniel Amezaga Bejarano', '4909891', 0x3139322e3136382e312e3735, 0x4e6f6d62726520646520686f73742e20, '', ''),
(47, '2024/08/16', '01:07:00am', 45, 'Melina Maribel Maldonado Rios', '6783260', 0x3139322e3136382e312e3735, 0x4e6f6d62726520646520686f73742e20, '', ''),
(48, '2024/08/19', '07:24:49pm', 23, 'Janela Ingrid Vargas Vasquez', '5989585', 0x3139322e3136382e3130302e3737, 0x4e6f6d62726520646520686f73742e20, '', ''),
(49, '2024/08/19', '08:38:59pm', 17, 'Franco Villatarco Zambrana', '6876773', 0x3139322e3136382e312e3735, 0x4e6f6d62726520646520686f73742e20, '', ''),
(50, '2024/08/19', '08:40:37pm', 9, 'David Aruquipa Pérez', '3358957', 0x3139322e3136382e312e3735, 0x4e6f6d62726520646520686f73742e20, '', ''),
(51, '2024/08/19', '08:41:10pm', 43, 'Mary Carmen Molina Ergueta', '4878229', 0x3139322e3136382e312e3735, 0x4e6f6d62726520646520686f73742e20, '', ''),
(52, '2024/08/19', '08:42:35pm', 47, 'Patricia Humana Lluta', '8412357', 0x3139322e3136382e312e3735, 0x4e6f6d62726520646520686f73742e20, '', ''),
(53, '2024/08/19', '01:02:22am', 26, 'Karina Saravia Flores', '9209737', 0x3139322e3136382e312e3735, 0x4e6f6d62726520646520686f73742e20, '', ''),
(54, '2024/08/20', '08:38:53pm', 42, 'Marisabel Zubieta Salas', '3484596', 0x3139322e3136382e312e3735, 0x4e6f6d62726520646520686f73742e20, '', ''),
(55, '2024/08/20', '08:39:59pm', 34, 'Magali Macias Bohorquez', '2630284', 0x3139322e3136382e312e3735, 0x4e6f6d62726520646520686f73742e20, '', ''),
(56, '2024/08/23', '09:36:59pm', 4, 'Ángela Aduviri Arroyo', '4922527', 0x3139322e3136382e312e3735, 0x4e6f6d62726520646520686f73742e20, '', ''),
(57, '2024/08/23', '09:37:51pm', 13, 'Estefani Huiza Fernández', '7050731', 0x3139322e3136382e312e3735, 0x4e6f6d62726520646520686f73742e20, '', ''),
(58, '2024/08/23', '09:38:33pm', 56, 'Silvia Condori Mamani', '6965732', 0x3139322e3136382e312e3735, 0x4e6f6d62726520646520686f73742e20, '', ''),
(59, '2024/08/23', '01:45:47am', 57, 'Silvia Huanca Calle', '4985716', 0x3139322e3136382e312e3735, 0x4e6f6d62726520646520686f73742e20, '', ''),
(60, '2024/08/26', '09:45:12pm', 34, 'Magali Macias Bohorquez', '2630284', 0x3139322e3136382e312e3735, 0x4e6f6d62726520646520686f73742e20, '', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `prequest`
--
ALTER TABLE `prequest`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usercheck`
--
ALTER TABLE `usercheck`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `prequest`
--
ALTER TABLE `prequest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `usercheck`
--
ALTER TABLE `usercheck`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


CREATE TABLE `repository` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `repository` (`name`, `description`) VALUES
('Fundación Cultural del Banco Central de Bolivia', 'Repositorio para la Fundación Cultural del Banco Central de Bolivia'),
('Archivo y Bibliotecas Nacionales de Bolivia', 'Repositorio para Archivo y Bibliotecas Nacionales de Bolivia'),
('Casa de la Libertad', 'Repositorio para Casa de la Libertad'),
('Casa de la Moneda', 'Repositorio para Casa de la Moneda'),
('Museo Nacional de Etnografía y Folklore (La Paz)', 'Repositorio para el Museo Nacional de Etnografía y Folklore en La Paz'),
('Museo Nacional de Arte', 'Repositorio para el Museo Nacional de Arte'),
('Centro de la Cultura Plurinacional', 'Repositorio para el Centro de la Cultura Plurinacional'),
('Centro de la Revolución Cultural', 'Repositorio para el Centro de la Revolución Cultural'),
('Casa Museo Marina Nuñez del Prado', 'Repositorio para la Casa Museo Marina Nuñez del Prado');


ALTER TABLE `user` ADD COLUMN `repository_id` int(11) DEFAULT NULL;
ALTER TABLE `admin` ADD COLUMN `repository_id` int(11) DEFAULT NULL;
ALTER TABLE `ticket` ADD COLUMN `repository_id` int(11) DEFAULT NULL;

-- Agregar las claves foráneas (opcional, para mantener la integridad referencial)
ALTER TABLE `user` ADD CONSTRAINT `fk_user_repository` FOREIGN KEY (`repository_id`) REFERENCES `repository`(`id`);
ALTER TABLE `admin` ADD CONSTRAINT `fk_admin_repository` FOREIGN KEY (`repository_id`) REFERENCES `repository`(`id`);
ALTER TABLE `ticket` ADD CONSTRAINT `fk_ticket_repository` FOREIGN KEY (`repository_id`) REFERENCES `repository`(`id`);
