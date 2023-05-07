-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
<<<<<<< HEAD
-- Tiempo de generación: 07-05-2023 a las 22:57:12
=======
-- Tiempo de generación: 27-03-2023 a las 04:39:41
>>>>>>> 2790b7a75acebd8407557a46b1e33ac06803e2f6
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `libreria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL,
  `categoria` varchar(25) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `categoria`) VALUES
(6, 'Aventura'),
(3, 'Ciencia Ficción'),
(1, 'Ficción Adolescente'),
(5, 'Novela contemporánea'),
(4, 'Poesía '),
(25, 'Poesia Gotica'),
(7, 'Poesía Neoburguesa'),
(9, 'poesia turca'),
(2, 'Romance');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `ciudad` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `masInf` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `idUsuario`, `name`, `phone`, `ciudad`, `address`, `masInf`, `created`, `modified`, `status`) VALUES
(1, 2, 'Libreria Papiro', '3022589741', 'Cali', 'Cali', '----', '2022-02-17 08:21:25', '2018-02-17 08:21:25', '1'),
(2, 1, 'Nikol Alexandra Ram&iacute;rez Ramos', '3209549367', 'Tunja', 'Cr3 #23-20', 'Bloque 4 Apartamento 103', '2023-03-15 19:36:25', '2023-03-15 19:36:25', '1'),
(3, 37, 'Dennis Jessenia Morato Quintero ', '3123262225', 'Tokio', 'Carrera 21 #6-75 Sur', 'Vivo', '2023-03-24 16:26:54', '2023-03-24 16:26:54', '1'),
(10, 41, 'Like Crazy', '3219403341', 'Tunja', 'Cr5 #95-30', '----', '2023-03-27 00:46:09', '2023-03-27 00:46:09', '1'),
<<<<<<< HEAD
(11, 10, 'Pepe', '9840923482', 'Bogot&aacute;', 'Cr5 #95-30', '----', '2023-03-27 01:28:03', '2023-03-27 01:28:03', '1'),
(12, 42, 'Cepillo II Cepillin', '3219403341', 'Barranquilla', 'Carrera 21 #6-75 Sur', '----', '2023-03-27 17:05:46', '2023-03-27 17:05:46', '1'),
(13, 14, 'Nikol', '3219403341', 'Tunja', 'Cr5 #95-30', '----', '2023-03-30 14:48:06', '2023-03-30 14:48:06', '1'),
(14, 47, 'Dennis Jessenia Morato Quintero ', '3123262225', 'Buenos Aires', 'mz 15 -67', 'Es un edificio grande', '2023-05-04 13:47:43', '2023-05-04 13:47:43', '1');
=======
(11, 10, 'Pepe', '9840923482', 'Bogot&aacute;', 'Cr5 #95-30', '----', '2023-03-27 01:28:03', '2023-03-27 01:28:03', '1');
>>>>>>> 2790b7a75acebd8407557a46b1e33ac06803e2f6

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editorial`
--

CREATE TABLE `editorial` (
  `idEditorial` int(11) NOT NULL,
  `nombreEditorial` varchar(25) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `editorial`
--

INSERT INTO `editorial` (`idEditorial`, `nombreEditorial`) VALUES
(5, 'Booket'),
(7, 'Carvajal Ediciones'),
(16, 'Cosmo Editorial'),
(3, 'Espasa'),
(1, 'Flower'),
(8, 'Luna Libros'),
(4, 'Lunwerg Editores'),
(11, 'Nueva Luz'),
(9, 'Panamericana Editorial'),
(6, 'Panini'),
(2, 'Planeta'),
(10, 'Vicens Vives');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `idEstado` int(11) NOT NULL,
  `estado` varchar(25) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`idEstado`, `estado`) VALUES
(1, 'Habilitado'),
(2, 'Inhabilitado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foro`
--

CREATE TABLE `foro` (
  `id` int(7) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `nombreLibro` varchar(200) COLLATE utf8mb4_spanish2_ci NOT NULL DEFAULT '',
  `autorLibro` varchar(200) COLLATE utf8mb4_spanish2_ci NOT NULL DEFAULT '',
  `descripcion` text COLLATE utf8mb4_spanish2_ci NOT NULL,
  `idEstado` int(7) NOT NULL,
  `fecha` datetime NOT NULL,
  `respuestas` int(11) NOT NULL DEFAULT 0,
  `identificador` int(7) NOT NULL DEFAULT 0,
  `ult_respuesta` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `foro`
--

INSERT INTO `foro` (`id`, `idUsuario`, `nombreLibro`, `autorLibro`, `descripcion`, `idEstado`, `fecha`, `respuestas`, `identificador`, `ult_respuesta`) VALUES
(1, 1, 'Perdón a la lluvia', ' Sara Búho', 'Perd&oacute;n a la lluvia es un conjunto de tormentas que no supimos navegar. Un viaje por todos los naufragios, por todo lo mal entendido. Una vuelta al dolor en brazos de la nostalgia. Un intento de convertir los recuerdos en alas, y que dejen de ser cadenas. Un paso atr&aacute;s para recuperar lo que es valioso y qued&oacute; perdido en la huida, y tambi&eacute;n para sanar lo que un d&iacute;a no supimos c&oacute;mo. En estas p&aacute;ginas los lectores se asomar&aacute;n a un cuidado cuaderno de notas &iacute;ntimas, acompa&ntilde;adas de frases manuscritas y dibujos originales de la propia Sara B&uacute;ho. Al igual que en sus anteriores poemarios, y en palabras de Gioconda Belli, &laquo;permanecer&aacute;n sus versos rond&aacute;ndote mientras vuelan fr&aacute;giles pero contundentes frente a tus ojos&raquo;.', 1, '2014-11-22 00:00:00', 3, 0, '2014-11-22 00:00:00'),
(2, 7, '---', '---', 'El libro est&aacute; dividido en tres partes, cada una de ellas supone una etapa en el proceso de superaci&oacute;n personal que llev&oacute; a cabo el autor (&laquo;el fin&raquo;, &laquo;la transici&oacute;n&raquo; y &laquo;el principio&raquo;) ejemplificada con la evoluci&oacute;n de la larva hasta convertirse en la mariposa.', 1, '2015-11-22 00:00:00', 0, 1, '2015-11-22 00:00:00'),
(4, 10, 'Los Siete Maridos de Evelyn Hugo', 'Taylor Jenkins Reid', 'Evelyn Hugo, el &iacute;cono de Hollywood que se ha recluido en su edad madura, decide al fin contar la verdad sobre su vida llena de glamour y de esc&aacute;ndalos. Pero cuando elige para ello a Monique Grant, una periodista desconocida, nadie se sorprende m&aacute;s que la misma Monique. &iquest;Por qu&eacute; ella? &iquest;Por qu&eacute; ahora? Monique no est&aacute; precisamente en su mejor momento. Su marido la abandon&oacute;, y su vida profesional no avanza. Aun ignorando por qu&eacute; Evelyn la ha elegido para escribir su biograf&iacute;a, Monique est&aacute; decidida a aprovechar esa oportunidad para dar impulso a su carrera. Convocada al lujoso apartamento de Evelyn, Monique escucha fascinada mientras la actriz le cuenta su historia. Desde su llegada a Los &Aacute;ngeles en los a&ntilde;os 50 hasta su decisi&oacute;n de abandonar su carrera en el espect&aacute;culo en los 80 &mdash;y, desde luego, los siete maridos que tuvo en ese tiempo&mdash; Evelyn narra una historia de ambici&oacute;n implacable, amistad inesperada, y un gran amor prohibido. Monique empieza a sentir una conexi&oacute;n muy real con la actriz legendaria, pero cuando el relato de Evelyn se acerca a su fin, resulta evidente que su vida se cruza con la de Monique de un modo tr&aacute;gico e irreversible. &laquo;Fascinante, desgarradora y llena del glamour de la Vieja Hollywood, Los siete maridos de Evelyn Hugo es una de las novelas m&aacute;s cautivantes.&raquo;', 1, '2015-11-22 00:00:00', 0, 0, '2015-11-22 00:00:00'),
(5, 15, 'Lucky Boy (libro en Inglés)', 'Shanthi Sekeran', 'Two women. Two possible futures. One lucky boy. Eighteen years old and fizzing with optimism, Solimar Castro Valdez embarks on a perilous journey across the Mexican border. Weeks later, she arrives in Berkeley, California, dazed by first love found then lost, and pregnant. This was not the plan. Undocumented and unmoored, Soli discovers that her son, Mr. Ignacio, can become her touchstone, and motherhood her identity in a world where she&#039;s otherwise invisible. Kavya Reddy has created a beautiful life in Berkeley, but then she can&#039;t get pregnant and that beautiful life seems suddenly empty. When Soli is placed in immigrant detention, Ignacio comes under Kavya&#039;s care and she finally gets to be the singing, storytelling kind of mother she dreamed of being. But she builds her love on a fault line, her heart wrapped around someone else&#039;s child. &quot;Nacho&quot; to Soli, and &quot;Iggy&quot; to Kavya, the boy is steeped in love, but his destiny and that of his two mothers teeters between two worlds as Soli fights to get back to him. Lucky Boy is a moving and revelatory ode to the ever-changing boundaries of love. &quot;Swept me away and took a little piece of my heart with it. It&#039;s a perfect book.&quot; Edan Lepucki , New York Times bestselling author of California &quot;A heartfelt and moving novel that challenges the true meaning of home. A deeply beautiful book.&quot; Molly Antopol, author of The UnAmericans', 1, '2015-11-22 00:00:00', 0, 0, '2015-11-22 00:00:00'),
(27, 1, 'Foro', 'Administrador', 'Este es un foro de prueba por administrador', 1, '2005-12-22 00:00:00', 0, 0, '2005-12-22 00:00:00'),
(33, 37, 'Perdón a la lluvia -', ' Sara Búho', 'Descripci&oacute;n del libro', 1, '2014-02-23 00:00:00', 0, 0, '2014-02-23 00:00:00'),
(34, 1, 'Prueba', 'autor', 'descripci&oacute;n', 1, '2014-02-23 00:00:00', 0, 0, '2014-02-23 00:00:00'),
<<<<<<< HEAD
(36, 37, 'change pt.2', 'Fool Me Twice', 'Que les importa solo que sepan que compre el libro y est&aacute; bueno  ', 1, '2024-03-23 00:00:00', 0, 0, '2024-03-23 00:00:00'),
(40, 1, 'El gato que amaba los libros', 'Sosuke Natsukawa', 'Hab&iacute;a un gato aficionado a los libros, hacia referencia a que el gato era m&aacute;s aut&oacute;nomo y m&aacute;s independientes que nosotros los humanos. Que buen Libro!!!!', 2, '2005-05-23 00:00:00', 0, 0, '2005-05-23 00:00:00');
=======
(36, 37, 'change pt.2', 'Fool Me Twice', 'Que les importa solo que sepan que compre el libro y est&aacute; bueno  ', 1, '2024-03-23 00:00:00', 0, 0, '2024-03-23 00:00:00');
>>>>>>> 2790b7a75acebd8407557a46b1e33ac06803e2f6

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro`
--

CREATE TABLE `libro` (
  `idLibro` int(11) NOT NULL,
  `nombreLibro` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `autor` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcionLibro` text COLLATE utf8_spanish2_ci NOT NULL,
  `precioLibro` int(20) NOT NULL,
  `cantidad` int(3) NOT NULL,
  `idEditorial` int(11) NOT NULL,
  `paginas` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `publicacion` varchar(25) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `idPais` int(11) DEFAULT NULL,
  `idTematica` int(11) NOT NULL,
  `ISBN` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `idEstado` int(11) NOT NULL,
  `img` varchar(40) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `libro`
--

INSERT INTO `libro` (`idLibro`, `nombreLibro`, `autor`, `descripcionLibro`, `precioLibro`, `cantidad`, `idEditorial`, `paginas`, `publicacion`, `idPais`, `idTematica`, `ISBN`, `idCategoria`, `idEstado`, `img`) VALUES
(1, 'De vuelta al mercado del usado', 'Varios Autores', 'El libro recoge 20 testimonios de hombres y mujeres que han tenido que afronatar diferentes situaciones despu&eacute;s del matrimonio: desde salir a &quot;levantar&quot; a los 50 a&ntilde;os hasta salir del closet; desde salir con una mujer 20 a&ntilde;os m&aacute;s joven hasta buscar en apps el amor nuevamente; desde separarse a los 70 para volverse a casar hasta llevar m&aacute;s de 10 a&ntilde;os buscando una pareja sin &eacute;xito.  \r\n\r\nSon testimonios divertidos que, a su vez, se convierten en reflexiones sobre el amor, la amistad, la maternidad, la paternidad y, claro, el matrimonio. ', 49000, 20, 2, '154', '2023', 73, 2, '9786287611733', 5, 1, '/img/1683156674.jpg'),
(2, 'T&uacute; y yo, invencibles', 'Alice Kellen', 'Lucas es familiar, impulsivo y transparente. Juliette es fuerte, introspectiva y liberal.\r\n\r\n&Eacute;l vive en Vallecas, trabaja en un taller de coches junto a su mejor amigo y por las tardes tocan en un grupo de m&uacute;sica que marcar&aacute; el curso de sus vidas para siempre. Ella ha crecido con su abuela en un barrio acomodado, pero sue&ntilde;a con ser independiente, volar alto y dejar huella en el coraz&oacute;n de alguien.\r\n\r\nUna noche de 1978, en pleno estallido de la movida madrile&ntilde;a, sus caminos se cruzan. Entonces surge la atracci&oacute;n, el deseo, el amor. Un amor radiactivo que lo arrolla todo a su paso mientras los dos se vuelven inseparables en un ambiente desenfrenado lleno de cambios, atrapados entre el &eacute;xito y el fracaso, la luz y la oscuridad, el perd&oacute;n y el orgullo.\r\n\r\nPero Lucas es imperfecto. Y Juliette guarda secretos.\r\n\r\n&iquest;Es eterna la pasi&oacute;n? &iquest;Se pueden olvidar la mentira y la traici&oacute;n sin que queden esquirlas? &iquest;Qu&eacute; ocurre cuando dos meteoritos que prometieron ser invencibles colisionan? Su amor es imperfecto, pero es su amor imperfecto', 65000, 41, 2, '408', '2022', 140, 2, '9786287611498', 2, 1, '/img/1683157137.jpg'),
(3, 'Lumpen', 'Aixa Bonilla', '  Lumpen pone voz a los desgarradas vivencias de los excluidos, de aquellos que nunca se encuentran en su sitio, que navegan por la vida en una vieja barca sin adivinar el rumbo. Es un libro tan sagaz como conmovedor, cuajado de referencias urbanas, filos&oacute;ficas, pero tambi&eacute;n de los medios de comunicaci&oacute;n, la televisi&oacute;n, el cine y de la cultura pop en general. Sus textos son peque&ntilde;os golpes con un ritmo &aacute;gil y din&aacute;mico que recuerda mucho a los &laquo;Spoken Words&raquo;, recitales po&eacute;ticos que combinan la palabra, su entonaci&oacute;n, su ritmo, con distintos elementos teatrales. Lumpen puede ser le&iacute;do como una performance de la vertiginosa vida de una marginada que lleva toda la vida intentando encajar en un mundo que le resulta inc&oacute;modo, dif&iacute;cil, a veces inadmisible.  ', 90454, 2, 3, '104', '2022', 73, 2, '9788467066678', 4, 1, '/img/lumpen.jpg'),
(4, 'Por culpa de los Ramones', 'Manuel Carre&ntilde;o', 'Manuel Carre&ntilde;o naci&oacute; en una familia de clase media alta bogotana. Desde que tiene memoria en su casa sonaba m&uacute;sica. No la m&uacute;sica que le gustar&iacute;a en la adultez, por supuesto, pero entre boleros, rancheras y canciones ochenteras de Menudo, poco a poco descubri&oacute; el rockandroll como un paraguas que lo salvar&iacute;a siempre de tiempos dif&iacute;ciles. Entre lluvias y d&iacute;as de sol, este libro se lee cantando: a veces de dolor porque la vida est&aacute; hecha de eso, pero tambi&eacute;n de ternura y compasi&oacute;n por los amigos y la vida compartida. \r\nEn este bell&iacute;simo recuento atravesado por canciones, amores, despedidas, depresiones, adicciones, amistades, conciertos y duelos, Manuel, periodista musical conocido por programas como &quot;La silla el&eacute;ctrica&quot;, en la frecuencia joven 99.1 y &quot;La clase&quot;, en Radi&oacute;nica, profesor de una c&eacute;lebre c&aacute;tedra sobre &quot;Rock y pol&iacute;tica&quot;, y m&uacute;sico aficionado con su banda Los Pussylanimes, reconstruye una memoria afectiva que no se entender&iacute;a sin la presencia inequ&iacute;voca de Miguel Mateos, el punk de The Clash, los tr&aacute;nsitos de Bowie, las canciones r&aacute;pidas de Ramones, y la salvaci&oacute;n de la tristeza gracias a Pulp. \r\nDesde los a&ntilde;os ochenta, hasta la segunda d&eacute;cada del siglo XXI cuando una pandemia nos cambi&oacute; para siempre, este libro nos demuestra que las canciones no curan pero s&iacute; nos permiten vivir y ensanchar el horizonte y las posibilidades ps&iacute;quicas; que el rock es uno de los fen&oacute;menos culturales m&aacute;s importantes de los &uacute;ltimos setenta a&ntilde;os; que varias generaciones tienen escritas en la piel las canciones de The Beatles, los Rolling Stones, Soda St&eacute;reo, Caifanes, Pearl Jam, Nirvana, Pixies, The Jesus and Mary Chain, Aterciopelados, 2 Minutos, I.R.A., Interpol o Idles; y que cada vez que o&iacute;mos una canci&oacute;n o una melod&iacute;a que nos gusta podemos volver a ese bar de los quince a&ntilde;os en donde una banda de muchachos so&ntilde;aba con ser como Red Hot Chili Peppers. \r\nEste es un libro para quien considera que el pasado no qued&oacute; atr&aacute;s sino que lo llevamos a cuestas, como testimonio de lo que hemos sido, y quiz&aacute;s de lo que seremos. ', 49000, 4, 2, '160', '2022', 137, 4, '9786280002903', 9, 1, '/img/1683157433.jpg'),
(6, 'El Mapa De Los Anhelos', 'Alice Kellen', '&iquest;Y si te diesen un mapa para descubrir qui&eacute;n eres? &iquest;Seguir&iacute;as la ruta marcada hasta el final? Imagina que est&aacute;s destinada a salvar a tu hermana, pero al final ella muere y la raz&oacute;n de tu existencia se desvanece. Eso es lo que le ocurre a Grace Peterson, la chica que siempre se ha sentido invisible, la que nunca ha salido de Nebraska, la que colecciona palabras y ve pasar los d&iacute;as refugiada en la monoton&iacute;a. Hasta que llega a sus manos el juego de El mapa de los anhelos y, siguiendo las instrucciones, lo primero que debe hacer es encontrar a alguien llamado Will Tucker, del que nunca ha o&iacute;do hablar y que est&aacute; a punto de embarcarse con ella en un viaje directo al coraz&oacute;n, lleno de vulnerabilidades y sue&ntilde;os olvidados, anhelos y afectos inesperados. Pero &iquest;es posible avanzar cuando los secretos comienzan a pesar demasiado? &iquest;Qui&eacute;n es qui&eacute;n en esta historia?', 43200, 34, 3, '490', '2022', 8, 2, '9786280001651', 1, 1, '/img/1683155457.jpg'),
(7, 'Perd&oacute;n a la lluvia', 'Sara B&uacute;ho', 'Perd&oacute;n a la lluvia es un conjunto de tormentas que no supimos navegar. Un viaje por todos los naufragios, por todo lo mal entendido. Una vuelta al dolor en brazos de la nostalgia. Un intento de convertir los recuerdos en alas, y que dejen de ser cadenas. Un paso atr&aacute;s para recuperar lo que es valioso y qued&oacute; perdido en la huida, y tambi&eacute;n para sanar lo que un d&iacute;a no supimos c&oacute;mo. En estas p&aacute;ginas los lectores se asomar&aacute;n a un cuidado cuaderno de notas &iacute;ntimas, acompa&ntilde;adas de frases manuscritas y dibujos originales de la propia Sara B&uacute;ho. Al igual que en sus anteriores poemarios, y en palabras de Gioconda Belli, &laquo;permanecer&aacute;n sus versos rond&aacute;ndote mientras vuelan fr&aacute;giles pero contundentes frente a tus ojos&raquo;.', 115287, 43, 3, '120', '2022', 241, 2, '9788418820755', 25, 1, '/img/1683155671.jpg'),
(8, 'Flores', 'Nieves Pulido', 'Flores es un breve y delicado libro compuesto por 42 poemas. Este poemario de Nieves Pulido, de clara influencia oriental, explora las correspondencias y tensiones que se dan entre poema y naturaleza, lenguaje y realidad. Ordenados a modo de manual botánico, los poemas van acompañados por las bellas ilustraciones de Eire (Irlanda Tambascio), que aparecen como una auténtica y logradísima reproducción de las flores originales.', 90454, 12, 3, '80', '2022', 73, 2, '9788467065510', 4, 1, '/img/flores.jpg'),
(9, 'eighteen ', 'Alberto Ramos', 'Alberto Ramos tenía solo 15 años cuando decidió meter en una maleta su esperanza y voluntad, abandonar Málaga y establecerse en Estocolmo, buscando una nueva vida. Y realizar su sueño de estudiar en el extranjero su bachillerato internacional. El instituto está situado en Södertälje, un peculiar municipio de Estocolmo con una gran influencia del cristianismo (católico y ortodoxo) e ideologías inflexibles y totalitarias por su población proveniente de las diásporas asiria (assyrier/syrianer) y árabe. La resultante homofobia extrema de ese fuerte choque cultural hizo que lo que para Alberto comenzó como una aventura se transformara en una pesadilla que duró tres años. El joven tuvo que enfrentarse a continuos episodios de abusos, intimidaciones, desprecios y bullying por parte de sus compañeros debido a su orientación sexual. Las denuncias ante la policía no tuvieron efecto y fue entonces cuando decidió hacerlo públicamente a través de sus redes sociales, llegando así a los medios de comunicación. Estos se hicieron eco del caso. Le pusieron una pulsera de seguridad para estar conectado con la policía, comenzaron a ir agentes al instituto, la directora decidió llenar todo el instituto de banderas LGTB…', 90454, 20, 3, '248', '2021', 73, 2, '9788467061291', 4, 1, '/img/eighteen.jpg'),
(10, 'Anhelo ', 'Tracy Wolff', ' Primer volumen de la adictiva Serie Crave.\r\n\r\nUna chica capaz de vencer al miedo. Un vampiro marcado por su oscuro pasado. Dos seres solitarios cuyos caminos se cruzan en el lugar más frío de la Tierra.\r\n\r\nMi mundo cambió en el instante en el que pisé el instituto Katmere. Aquí todo resulta extraño: la escuela, los alumnos, las asignaturas; y yo no soy más que una simple mortal entre ellos, dioses... o monstruos. Todavía no sé a qué bando pertenezco, si es que pertenezco a alguno, sólo sé que lo que parece unirlos a todos es su odio hacia mí.\r\n\r\nPero entre ellos está Jaxon Vega, un vampiro que esconde oscuros secretos y que no ha sentido nada durante un siglo. Algo en él me atrae, apenas lo conozco, pero sé que hay algo roto en su interior que de alguna manera encaja con lo que hay roto en mí. Acercarme a él puede significar el fin del mundo, pero empiezo a sospechar que alguien me ha traído a este lugar a propósito, y tengo que descubrir por qué.\r\n\r\n«Vampiros, hombres lobo, dragones… ¡Lo tiene todo! Es imposible de soltar.» Andrea Izquierdo (@andreorowling) ', 110173, 10, 5, '672', '2022', 241, 2, '9788408232995', 5, 1, '/img/Anhelo.jpg'),
(11, 'Los crímenes de Chopin', 'Blue Jeans', 'En varias casas de Sevilla se han producido una serie de robos que preocupan a toda la ciudad. El ladrón, al que apodan «Chopin» porque siempre deja una partitura del famoso compositor para firmar el robo, se lleva dinero, joyas y diferentes artículos de valor. Una noche aparece un cadáver en el salón de una de esas viviendas y la tensión aumenta.\r\n\r\nNikolai Olejnik es un joven polaco que llegó a España con su abuelo hace varios años. Desde que este murió, está solo y sobrevive a base de delinquir. Fue un niño prodigio en su país y su mayor pasión es tocar el piano. De repente, todo se complica y se convierte en el principal sospechoso de un asesinato. Niko acude al despacho de Celia Mayo, detective privado, a pedirle ayuda y allí conoce a Triana, la hija de Celia. La joven enseguida llama su atención, aunque no es el mejor momento para enamorarse.\r\nBlanca Sanz apenas lleva cinco meses trabajando en el periódico El Guadalquivir cuando recibe una extraña llamada en la que le filtran datos sobre el caso Chopin, que nadie más conoce. Desde ese momento se obsesiona con todo lo relacionado con la investigación e intenta averiguar quién está detrás de aquellos robos. \r\n\r\nIntriga, misterio, amor y crímenes son la base de esta novela ambientada en las enigmáticas calles de Sevilla, en la que el lector formará parte de la investigación. ¿Conseguirás adivinar quién es el culpable?', 113928, 6, 2, '512', '2022', 173, 2, '9786123197599', 5, 1, '/img/chopin.jpg'),
(12, 'Los hombres de Federico', 'Ana Bernal', '   Un año después, las mujeres de Federico se reúnen de nuevo en la Huerta de San Vicente ante la llamada de Novia, pero ellas ya no son las mismas y el entorno también ha cambiado por un paisaje sombrío y bañado en rojo. El encuentro se complicará cuando las protagonistas descubran que García Lorca creó un manuscrito sobre sus nuevas vidas que deja una puerta abierta a que otros personajes se adueñen de la historia. Las mujeres se darán cuenta de que algo no va bien cuando ocurran situaciones extrañas en la casa y su angustia irá en aumento con los rumores de que los hombres de Federico (las antiguas parejas o amantes de ellas) quieren llegar hasta el lugar con propósitos desconocidos. Solo la magia y mantenerse juntas podrán ayudarlas a enfrentarse a la incertidumbre y a los peligros que les depara esa imprevista llegada.   ', 122334, 8, 4, '170', '2022', 73, 2, '9788418820861', 5, 1, '/img/federico.jpg'),
(13, 'Sueño ', 'Iván Sánchez', ' Mientras un hombre misterioso no puede despertar de un terrible sueño en el que inquietantes escenas de desamor se van solapando, la hermosa Sofía viaja a un enclave paradisiaco para intentar resolver las dudas que pesan sobre su relación tras más de una década junto a su pareja. Sus largos paseos por la isla y un fascinante hombre llamado Alexandro le harán revivir sensaciones hace tiempo olvidadas y replantearse en qué consiste el amor y las razones que la han llevado hasta allí.\r\n\r\nEntretanto, la joven Danae, disgustada por tener que pasar las vacaciones alejada de su mejor amiga, descubre lo que significa que, por primera vez, se te desboque el corazón.\r\n\r\nUna novela intimista y reflexiva, a veces desgarradora, otras ilusionante y evocadora, sobre la naturaleza de las relaciones de pareja y las distintas etapas del amor.\r\n\r\nA veces, la verdadera naturaleza del amor se manifiesta solo a través de los sueños. ', 111593, 12, 2, '208', '2022', 73, 2, '9788408263432', 5, 1, '/img/Sueño.jpg'),
(15, 'La Canción de Aquiles', 'Madeline Miller', 'Grecia en la era de los héroes. Patroclo, un príncipe joven y torpe, ha sido exiliado al reino de Ftía, donde vive a la sombra del rey Peleo y su hijo divino, Aquiles. Aquiles, el mejor de los griegos, es todo lo que no es Patroclo: fuerte, apuesto, hijo de una diosa. Un día Aquiles toma bajo su protección al lastimoso príncipe y ese vínculo provisional da paso a una sólida amistad mientras ambos se convierten en jóvenes habilidosos en las artes de la guerra. Pero el destino nunca está lejos de los talones de Aquiles. Cuando se extiende la noticia del rapto de Helena de Esparta, se convoca a los hombres de Grecia para asediar la ciudad de Troya. Aquiles, seducido por la promesa de un destino glorioso, se une a la causa, y Patroclo, dividido entre el amor y el miedo por su compañero, lo sigue a la guerra. Poco podía imaginar que los años siguientes iban a poner a prueba todo cuanto habían aprendido y todo cuanto valoraban profundamente.', 95749, 100, 2, '230', '2021', 146, 2, '9786075508054', 2, 1, '/img/aquiles.jpg'),
<<<<<<< HEAD
(16, 'People Pt.2', 'Agust D', ' So time is yet ', 30000, 45, 1, '34', '1450', 3, 5, '3452764578234', 1, 2, '/img/1449378000.jpg'),
(18, 'Change Pt.2', 'Fool me twice', '  f  ', 300, 98, 1, '43', '1500', 5, 9, '4523576522311', 5, 2, '/img/1668975860.jpg'),
(19, 'La Teor&iacute;a de los Archipi&eacute;lagos', 'Alice Kellen', '&laquo;La teor&iacute;a de los archipi&eacute;lagos viene a decir que todos somos islas, llegamos solos a este mundo y nos vamos exactamente igual, pero necesitamos tener otras islas alrededor para sentirnos felices en medio de ese mar que une tanto como separa. Yo siempre he pensado que ser&iacute;a una isla peque&ntilde;ita, de esas en las que hay tres palmeras, una playa, dos rocas y poco m&aacute;s; me he sentido invisible durante gran parte de mi vida. Pero entonces apareciste t&uacute;, que sin duda ser&iacute;as una isla volc&aacute;nica llena de grutas y flores. Y es la primera vez que me pregunto si dos islas pueden tocarse en la profundidad del oc&eacute;ano, aunque nadie sea capaz de verlo. Si eso existe, si entre los corales y sedimentos y lo que sea que nos ancla en medio del mar hay un punto de uni&oacute;n, sin duda somos t&uacute; y yo. Y, si no es as&iacute;, estamos tan cerca que estoy convencido de poder llegar nadando hasta ti&raquo;.', 190000, 17, 2, '90', '2022', 192, 2, '0912744822351', 5, 1, '/img/1670289097.jpg'),
(20, 'Libro de prueba 2', 'My Sanity', '   Este es el segundo libro de prueba   ', 90000, 56, 1, '123', '1912', 5, 1, '0912742821123', 3, 2, '/img/1670290923.png'),
(21, '1', 'Years Ago', '       1       ', 111000, 22, 1, '1', '1100', 14, 5, '1111111111111', 1, 2, ''),
(24, 'Hectic', 'Everyting Change', '        3        ', 2323232, 33, 1, '333', '2543', 14, 5, '3323234214642', 1, 1, '/img/portadaPredeterminada.jpg'),
(25, 'Ma City', 'BTS', '    El lugar que m&aacute;s me gusta en el mundo\r\nNaturaleza y ciudad, lugares para construir\r\nPara m&iacute;, me gusta m&aacute;s el parque Lake que el r&iacute;o Han\r\nIncluso si eres peque&ntilde;o, me abrazas tan pl&aacute;cidamente\r\nCuando se siente como si me fuera a olvidar de mis ra&iacute;ces\r\nEn ese lugar, encuentro el yo que se hab&iacute;a desvanecido\r\nRecuerdo tu aroma y todo\r\nEres mi verano, oto&ntilde;o, invierno y cada primavera    ', 120000, 10, 1, '90', '2015', 58, 4, '9013061312343', 3, 2, '/img/1674325593.jpg'),
(26, 'Inner Child', 'V', ' The smiling kid,\r\nThe child who used to just laugh brightly\r\nWhen I see you like that\r\nI keep laughing\r\n \r\nThe tingling sun and that summer&#039;s air\r\nThe grey-lit streets&#039; sounds that were so cold\r\nI draw in a breath and knock at your door ', 109000, 5, 1, '210', '2020', 58, 2, '9020022212764', 4, 2, '/img/1674329922.jpg'),
(27, 'Inner Child', 'Dennis', '  Libro de aventura por Dennis  ', 156999, 10, 1, '583', '2023', 7, 2, '89234787898373', 6, 2, '/img/1676379244.jpg'),
(29, 'El retrato de Dorian Gray', 'Oscar Wilde', 'Dorian Gray es un hombre que busca la inmortalidad y para encontrarla, para no envejecer jam&aacute;s y no perder esa belleza de la que tanto alardea tiene que matar. En una reflexi&oacute;n bastante profunda acerca del bien y del mal Oscar Wilde nos ense&ntilde;a lo que puede ocurrir si llegamos a aspirar a ser Dios.', 36000, 60, 2, '277', '1890', 180, 2, '9789583001437', 3, 1, '/img/1680141988.jpg'),
(33, 'Muebles Viejos', 'Roberto Pombo', 'Roberto Pombo es quiz&aacute;s el analista pol&iacute;tico mejor informado del pa&iacute;s. &Eacute;l que m&aacute;s se ha acercado a las intimidades del poder en Colombia. En este libro, el periodista utiliza ese conocimiento privilegiado para dirigirse a los expresidentes de Colombia mediante cartas personales. Esto dice de dos de ellos:\r\n\r\n \r\n\r\nDe C&eacute;sar Gaviria: &ldquo;Me parece muy triste que un personaje tan importante como usted est&eacute; teniendo un final pol&iacute;tico tan triste y l&aacute;nguido. Aferrado a un poder y a un partido que casi ya ni existen; reivindicando, desde el oficialismo liberal un apego a la burocracia y al manzanillismo. Y las maneras, presidente, el estilo arrogante y poco sosegado, a veces la falta de compostura&rdquo;.\r\n\r\nDe Andr&eacute;s Pastrana: &quot;Me apena ver el energ&uacute;meno en el que se ha ido convirtiendo sin que lo fuera nunca, con unas obsesiones y unos delirios ideol&oacute;gicos, unos odios apasionados y ciegos, que nadie que lo hubiera conocido de antes podr&iacute;a creer si no lo viera en acci&oacute;n: vociferante, intransigente, irreconocible&rdquo;.', 12345, 5, 1, '235', '2003', 241, 6, '9876543212345', 6, 2, '/img/1680899968.jpg'),
(38, 'Inner Child', 'V', ' 그때 우리\r\n참 많이 힘들었지\r\n너무나 먼 저 하늘의 별\r\n올려보면서\r\n그때의 넌\r\n은하수를 믿지 않아\r\n하지만 난 봐버렸는 걸\r\n은색 galaxy\r\n아팠을 거야\r\n너무 힘들었을 거야\r\n끝없는 빛을\r\n쫓아 난 달렸거든\r\n아릿해와 그 여름날의 공기\r\n너무 차갑던 잿빛 거리의 소리\r\n숨을 마시고 네 문을 두드리네 ', 150000, 12, 1, '150', '2020', 58, 2, '9030111993218', 4, 2, '/img/1681255771.jpg'),
(68, 'I&#039;m Nothing Without Your Love', 'Jimin Ha Sung Woon', 'I wanna be with you\r\nAnd I wanna stay with you\r\nJust like the stars shining bright\r\nYou&#039;re glowing once more\r\nRight here beside you\r\nI&#039;m still walking wherever you go\r\nYou will live forever in me\r\nBreathing deeply, within me\r\nJust take it all\r\nI&#039;m nothing without your love\r\nI promise I&#039;ll never leave your love\r\nMy heart is beating &#039;cause of you', 98000, 13, 1, '223', '2022', 58, 4, '7912347382497', 4, 1, '/img/1681441036.jpg'),
(69, 'People Pt.2', 'Agust D', 'That&#039;s why I&#039;m the cautious type\r\nI want, a sincere connection with others\r\nForever&#039;s something like a sand castle, you know\r\nIt comes crumbling down at the calmest of waves', 108000, 12, 10, '256', '2023', 58, 15, '3748328378753', 4, 1, '/img/1681441448.jpg'),
(76, 'Palabras para sanar', 'rupi kaur', 'rupi kaur nos introduce en su mundo de escritura y creatividad a trav&eacute;s de su cuarta obra, sanar con palabras, en la que revela el poder curativo de las palabras y explica c&oacute;mo el acto de escribir ha sido una experiencia cat&aacute;rtica que la ayud&oacute; a sanar. En este viaje hacia una misma, nos propone una autoexploraci&oacute;n consciente y liberadora a trav&eacute;s de la escritura.\r\n  Esta colecci&oacute;n de ejercicios de escritura guiada ideados por la autora invita a explorar temas como el trauma, la p&eacute;rdida, la angustia, el amor o la sanaci&oacute;n convirti&eacute;ndose en una poderosa herramienta de creatividad y autoconocimiento. Solo te pide que no tengas miedo a mostrarte vulnerable y honesta, tanto contigo misma como con la p&aacute;gina. No necesitas ser escritora para emprender este camino; solo necesitas comenzar a escribir, eso es todo.', 65000, 12, 2, '320', '2023', 188, 4, '9786287582569', 4, 1, '/img/1683157959.jpg'),
(77, 'La mujer que mov&iacute;a monta&ntilde;as', 'Salom&oacute;n Ganitsky', 'Este libro reconstruye la vida de una mujer adelantada a su tiempo que pens&oacute; que era posible, desde la empresa, contribuir a la cultura y las artes en un pa&iacute;s con inmensas necesidades. L&iacute;a de Ganitsky fue a la vez mecenas, empresaria y una figura eminente para la sociedad colombiana del siglo pasado. Como si fuera un mosaico, en estas p&aacute;ginas se re&uacute;nen los testimonios de personas que conocieron a L&iacute;a en los distintos &aacute;mbitos en que dej&oacute; huella: el familiar, el laboral, el social, el cultural, el art&iacute;stico y de ellos resulta evidente su tes&oacute;n, su capacidad para el trabajo, su habilidad para las relaciones interpersonales, sus niveles de exigencia, su deseo de estudiar y aprender, su talento para la cocina, su don de liderazgo y su inmensa sensibilidad art&iacute;stica y human&iacute;stica.\r\nCreadora de Asociaci&oacute;n Colombo-China, cofundadora del Teatro Libre de Bogot&aacute; e impulsora de la Colecci&oacute;n Sim&oacute;n y Lola Guberek, que dej&oacute; una estupendo cat&aacute;logo editorial en los a&ntilde;os setenta y ochenta del siglo XX, L&iacute;a adem&aacute;s cre&oacute; el Colegio Menorah y su vida, como se lee en esta p&aacute;ginas, fue una conjunci&oacute;n fascinante de inteligencia y sensibilidad.', 59000, 8, 2, '288', '2022', 200, 15, '9786287568563', 5, 1, '/img/1683158117.jpg');
=======
(16, 'e', 'That', ' e ', 3, 45, 1, '34', '43', 3, 5, '3', 1, 1, '/img/1449378000.jpg'),
(18, 'Change Pt.2', 'Fool me twice', ' f ', 3, 98, 1, '43', '4', 5, 9, '4', 5, 1, '/img/1668975860.jpg'),
(19, 'Libro de prueba', 'Think I Lose', ' Esta descripción es de prueba ', 190000, 17, 1, '90', '2022', 30, 4, '091274482', 3, 1, '/img/1670289097.jpg'),
(20, 'Libro de prueba 2', 'My Sanity', 'Este es el segundo libro de prueba', 90000, 56, 1, '123', '0912', 5, 1, '0912742821', 3, 1, '/img/1670290923.png'),
(21, '1', 'Years Ago', '1', 1, 22, 1, '1', '1', 14, 5, '1', 1, 1, '/img/1670291077.png'),
(24, '3', 'Everyting Change', '3', 2323232, 33, 1, '333', '543', 14, 5, '332323', 1, 1, '/img/PortadaPredeterminada.jpg'),
(25, 'Ma City', 'BTS', '   El lugar que más me gusta en el mundo\r\nNaturaleza y ciudad, lugares para construir\r\nPara mí, me gusta más el parque Lake que el río Han\r\nIncluso si eres pequeño, me abrazas tan plácidamente\r\nCuando se siente como si me fuera a olvidar de mis raíces\r\nEn ese lugar, encuentro el yo que se había desvanecido\r\nRecuerdo tu aroma y todo\r\nEres mi verano, otoño, invierno y cada primavera   ', 120000, 10, 1, '90', '2015', 58, 4, '20130613', 3, 1, '/img/1674325593.jpg'),
(26, 'Inner Child', 'V', 'The smiling kid,\nThe child who used to just laugh brightly\nWhen I see you like that\nI keep laughing\n \nThe tingling sun and that summer&#039;s air\nThe grey-lit streets&#039; sounds that were so cold\nI draw in a breath and knock at your door', 109000, 5, 1, '210', '2020', 58, 2, '20200222', 4, 1, '/img/1674329922.jpg'),
(27, 'Inner Child', 'Dennis', ' Libro de aventura por Dennis ', 156999, 10, 1, '583', '2023', 7, 2, '8923478789837329', 6, 1, '/img/1676379244.jpg');
>>>>>>> 2790b7a75acebd8407557a46b1e33ac06803e2f6

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden`
--

CREATE TABLE `orden` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `total_price` float(10,2) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` enum('1','0','2') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `orden`
--

INSERT INTO `orden` (`id`, `customer_id`, `total_price`, `created`, `modified`, `status`) VALUES
(6, 1, 122334.00, '2022-06-12 12:46:58', '2022-06-12 12:46:58', '1'),
(7, 1, 133654.00, '2022-06-12 13:08:08', '2022-06-12 13:08:08', '1'),
(8, 1, 303091.00, '2023-03-15 17:07:50', '2023-03-15 17:07:50', '0'),
<<<<<<< HEAD
(13, 2, 288087.00, '2023-03-15 22:04:00', '2023-03-15 22:04:00', '2'),
(14, 2, 90454.00, '2023-03-22 11:52:13', '2023-03-22 11:52:13', '2'),
(15, 2, 180908.00, '2023-03-24 09:13:51', '2023-03-24 09:13:51', '0'),
(16, 3, 369336.00, '2023-03-24 10:31:17', '2023-03-24 10:31:17', '0'),
(17, 3, 212788.00, '2023-03-24 10:40:19', '2023-03-24 10:40:19', '2'),
(18, 11, 642186.00, '2023-03-26 19:58:17', '2023-03-26 19:58:17', '1'),
(19, 12, 2522686.00, '2023-03-27 10:06:07', '2023-03-27 10:06:07', '1'),
(20, 12, 559449.00, '2023-03-27 11:47:03', '2023-03-27 11:47:03', '1'),
(21, 13, 190000.00, '2023-03-30 07:48:16', '2023-03-30 07:48:16', '1'),
(22, 13, 115287.00, '2023-03-30 07:50:38', '2023-03-30 07:50:38', '1'),
(23, 2, 12345.00, '2023-04-24 11:45:07', '2023-04-24 11:45:07', '1'),
(24, 2, 12345.00, '2023-04-24 11:46:52', '2023-04-24 11:46:52', '1'),
(25, 2, 12345.00, '2023-04-24 11:49:18', '2023-04-24 11:49:18', '1'),
(26, 2, 12345.00, '2023-04-24 11:52:16', '2023-04-24 11:52:16', '1'),
(27, 2, 12345.00, '2023-04-25 09:45:55', '2023-04-25 09:45:55', '1'),
(28, 2, 12345.00, '2023-04-25 10:39:25', '2023-04-25 10:39:25', '1'),
(29, 14, 130000.00, '2023-05-04 06:48:19', '2023-05-04 06:48:19', '1');
=======
(13, 2, 288087.00, '2023-03-15 22:04:00', '2023-03-15 22:04:00', '0'),
(14, 2, 90454.00, '2023-03-22 11:52:13', '2023-03-22 11:52:13', '0'),
(15, 2, 180908.00, '2023-03-24 09:13:51', '2023-03-24 09:13:51', '1'),
(16, 3, 369336.00, '2023-03-24 10:31:17', '2023-03-24 10:31:17', '1'),
(17, 3, 212788.00, '2023-03-24 10:40:19', '2023-03-24 10:40:19', '1'),
(18, 11, 642186.00, '2023-03-26 19:58:17', '2023-03-26 19:58:17', '1');
>>>>>>> 2790b7a75acebd8407557a46b1e33ac06803e2f6

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_articulos`
--

CREATE TABLE `orden_articulos` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `orden_articulos`
--

INSERT INTO `orden_articulos` (`id`, `order_id`, `product_id`, `quantity`) VALUES
(1, 6, 12, 1),
(2, 7, 3, 1),
(3, 7, 6, 1),
(4, 8, 13, 1),
(5, 8, 15, 2),
(7, 13, 7, 1),
(8, 13, 6, 4),
(9, 14, 3, 1),
(10, 15, 9, 1),
(11, 15, 3, 1),
(12, 16, 27, 1),
(13, 16, 20, 1),
(14, 16, 12, 1),
(15, 16, 18, 1),
(16, 17, 3, 1),
(17, 17, 12, 1),
(18, 18, 26, 1),
(19, 18, 25, 1),
(20, 18, 13, 2),
<<<<<<< HEAD
(21, 18, 19, 1),
(22, 19, 24, 1),
(23, 19, 26, 1),
(24, 19, 9, 1),
(25, 20, 7, 1),
(26, 20, 6, 4),
(27, 20, 3, 3),
(28, 21, 19, 1),
(29, 22, 7, 1),
(30, 25, 33, 1),
(31, 26, 33, 1),
(32, 27, 33, 1),
(33, 28, 33, 1),
(34, 29, 2, 2);
=======
(21, 18, 19, 1);
>>>>>>> 2790b7a75acebd8407557a46b1e33ac06803e2f6

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE `pais` (
  `idPais` int(11) NOT NULL,
  `nombrePais` varchar(25) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`idPais`, `nombrePais`) VALUES
(1, 'Afganistán'),
(2, 'Islas Gland'),
(3, 'Albania'),
(4, 'Alemania'),
(5, 'Andorra'),
(6, 'Angola'),
(7, 'Anguilla'),
(8, 'Antártida'),
(9, 'Antigua y Barbuda'),
(10, 'Antillas Holandesas'),
(11, 'Arabia Saudí'),
(12, 'Argelia'),
(13, 'Argentina'),
(14, 'Armenia'),
(15, 'Aruba'),
(16, 'Australia'),
(17, 'Austria'),
(18, 'Azerbaiyán'),
(19, 'Bahamas'),
(20, 'Bahréin'),
(21, 'Bangladesh'),
(22, 'Barbados'),
(23, 'Bielorrusia'),
(24, 'Bélgica'),
(25, 'Belice'),
(26, 'Benin'),
(27, 'Bermudas'),
(28, 'Bhután'),
(29, 'Bolivia'),
(30, 'Bosnia y Herzegovina'),
(31, 'Botsuana'),
(32, 'Isla Bouvet'),
(33, 'Brasil'),
(34, 'Brunéi'),
(35, 'Bulgaria'),
(36, 'Burkina Faso'),
(37, 'Burundi'),
(38, 'Cabo Verde'),
(39, 'Islas Caimán'),
(40, 'Camboya'),
(41, 'Camerún'),
(42, 'Canadá'),
(43, 'República Centroafricana'),
(44, 'Chad'),
(45, 'República Checa'),
(46, 'Chile'),
(47, 'China'),
(48, 'Chipre'),
(49, 'Isla de Navidad'),
(50, 'Ciudad del Vaticano'),
(51, 'Islas Cocos'),
(52, 'Colombia'),
(53, 'Comoras'),
(54, 'República Democrática del'),
(55, 'Congo'),
(56, 'Islas Cook'),
(57, 'Corea del Norte'),
(58, 'Corea del Sur'),
(59, 'Costa de Marfil'),
(60, 'Costa Rica'),
(61, 'Croacia'),
(62, 'Cuba'),
(63, 'Dinamarca'),
(64, 'Dominica'),
(65, 'República Dominicana'),
(66, 'Ecuador'),
(67, 'Egipto'),
(68, 'El Salvador'),
(69, 'Emiratos Árabes Unidos'),
(70, 'Eritrea'),
(71, 'Eslovaquia'),
(72, 'Eslovenia'),
(73, 'España'),
(74, 'Islas ultramarinas de Est'),
(75, 'Estados Unidos'),
(76, 'Estonia'),
(77, 'Etiopía'),
(78, 'Islas Feroe'),
(79, 'Filipinas'),
(80, 'Finlandia'),
(81, 'Fiyi'),
(82, 'Francia'),
(83, 'Gabón'),
(84, 'Gambia'),
(85, 'Georgia'),
(86, 'Islas Georgias del Sur y '),
(87, 'Ghana'),
(88, 'Gibraltar'),
(89, 'Granada'),
(90, 'Grecia'),
(91, 'Groenlandia'),
(92, 'Guadalupe'),
(93, 'Guam'),
(94, 'Guatemala'),
(95, 'Guayana Francesa'),
(96, 'Guinea'),
(97, 'Guinea Ecuatorial'),
(98, 'Guinea-Bissau'),
(99, 'Guyana'),
(100, 'Haití'),
(101, 'Islas Heard y McDonald'),
(102, 'Honduras'),
(103, 'Hong Kong'),
(104, 'Hungría'),
(105, 'India'),
(106, 'Indonesia'),
(107, 'Irán'),
(108, 'Iraq'),
(109, 'Irlanda'),
(110, 'Islandia'),
(111, 'Israel'),
(112, 'Italia'),
(113, 'Jamaica'),
(114, 'Japón'),
(115, 'Jordania'),
(116, 'Kazajstán'),
(117, 'Kenia'),
(118, 'Kirguistán'),
(119, 'Kiribati'),
(120, 'Kuwait'),
(121, 'Laos'),
(122, 'Lesotho'),
(123, 'Letonia'),
(124, 'Líbano'),
(125, 'Liberia'),
(126, 'Libia'),
(127, 'Liechtenstein'),
(128, 'Lituania'),
(129, 'Luxemburgo'),
(130, 'Macao'),
(131, 'ARY Macedonia'),
(132, 'Madagascar'),
(133, 'Malasia'),
(134, 'Malawi'),
(135, 'Maldivas'),
(136, 'Malí'),
(137, 'Malta'),
(138, 'Islas Malvinas'),
(139, 'Islas Marianas del Norte'),
(140, 'Marruecos'),
(141, 'Islas Marshall'),
(142, 'Martinica'),
(143, 'Mauricio'),
(144, 'Mauritania'),
(145, 'Mayotte'),
(146, 'México'),
(147, 'Micronesia'),
(148, 'Moldavia'),
(149, 'Mónaco'),
(150, 'Mongolia'),
(151, 'Montserrat'),
(152, 'Mozambique'),
(153, 'Myanmar'),
(154, 'Namibia'),
(155, 'Nauru'),
(156, 'Nepal'),
(157, 'Nicaragua'),
(158, 'Níger'),
(159, 'Nigeria'),
(160, 'Niue'),
(161, 'Isla Norfolk'),
(162, 'Noruega'),
(163, 'Nueva Caledonia'),
(164, 'Nueva Zelanda'),
(165, 'Omán'),
(166, 'Países Bajos'),
(167, 'Pakistán'),
(168, 'Palau'),
(169, 'Palestina'),
(170, 'Panamá'),
(171, 'Papúa Nueva Guinea'),
(172, 'Paraguay'),
(173, 'Perú'),
(174, 'Islas Pitcairn'),
(175, 'Polinesia Francesa'),
(176, 'Polonia'),
(177, 'Portugal'),
(178, 'Puerto Rico'),
(179, 'Qatar'),
(180, 'Reino Unido'),
(181, 'Reunión'),
(182, 'Ruanda'),
(183, 'Rumania'),
(184, 'Rusia'),
(185, 'Sahara Occidental'),
(186, 'Islas Salomón'),
(187, 'Samoa'),
(188, 'Samoa Americana'),
(189, 'San Cristóbal y Nevis'),
(190, 'San Marino'),
(191, 'San Pedro y Miquelón'),
(192, 'San Vicente y las Granadi'),
(193, 'Santa Helena'),
(194, 'Santa Lucía'),
(195, 'Santo Tomé y Príncipe'),
(196, 'Senegal'),
(197, 'Serbia y Montenegro'),
(198, 'Seychelles'),
(199, 'Sierra Leona'),
(200, 'Singapur'),
(201, 'Siria'),
(202, 'Somalia'),
(203, 'Sri Lanka'),
(204, 'Suazilandia'),
(205, 'Sudáfrica'),
(206, 'Sudán'),
(207, 'Suecia'),
(208, 'Suiza'),
(209, 'Surinam'),
(210, 'Svalbard y Jan Mayen'),
(211, 'Tailandia'),
(212, 'Taiwán'),
(213, 'Tanzania'),
(214, 'Tayikistán'),
(215, 'Territorio Británico del '),
(216, 'Territorios Australes Fra'),
(217, 'Timor Oriental'),
(218, 'Togo'),
(219, 'Tokelau'),
(220, 'Tonga'),
(221, 'Trinidad y Tobago'),
(222, 'Túnez'),
(223, 'Islas Turcas y Caicos'),
(224, 'Turkmenistán'),
(225, 'Turquía'),
(226, 'Tuvalu'),
(227, 'Ucrania'),
(228, 'Uganda'),
(229, 'Uruguay'),
(230, 'Uzbekistán'),
(231, 'Vanuatu'),
(232, 'Venezuela'),
(233, 'Vietnam'),
(234, 'Islas Vírgenes Británicas'),
(235, 'Islas Vírgenes de los Est'),
(236, 'Wallis y Futuna'),
(237, 'Yemen'),
(238, 'Yibuti'),
(239, 'Zambia'),
(240, 'Zimbabue'),
(241, '- Ninguno -');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `idRespuesta` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idForo` int(11) NOT NULL,
  `respuesta` varchar(255) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`idRespuesta`, `idUsuario`, `idForo`, `respuesta`, `fecha`) VALUES
(6, 1, 1, '123', '2023-03-20 20:06:56'),
(7, 39, 34, 'sdasdasd', '2023-03-20 20:19:45'),
(8, 39, 34, 'sdasdasdaa1', '2023-03-20 20:21:37'),
(9, 39, 34, 'prueba 1', '2023-03-20 20:24:12'),
(10, 39, 34, 'prueba 1', '2023-03-20 20:25:32'),
<<<<<<< HEAD
=======
(11, 39, 34, 'prueba 11345982374', '2023-03-20 20:30:04'),
(12, 39, 34, 'prueba 11345982371', '2023-03-20 20:30:49'),
(13, 39, 34, 'prueba 11345982372', '2023-03-20 20:32:14'),
(14, 39, 34, 'prueba 1134598', '2023-03-20 20:33:09'),
(15, 39, 34, 'prueba 113', '2023-03-20 20:35:27'),
(16, 39, 34, 'prueba 113w', '2023-03-20 20:39:32'),
(17, 39, 34, 'prueba 113waaa', '2023-03-20 20:40:30'),
(18, 39, 34, 'prueba 113waaaaa', '2023-03-20 20:44:16'),
(19, 39, 34, 'prueba 113waaaaa', '2023-03-20 20:44:49'),
>>>>>>> 2790b7a75acebd8407557a46b1e33ac06803e2f6
(20, 39, 34, 'baaa', '2023-03-20 23:53:50'),
(21, 37, 33, 's', '2023-03-20 23:57:20'),
(22, 37, 34, 'asl}', '2023-03-21 00:32:21'),
(23, 37, 4, 'hola, me encantÃ³ el libro\r\n', '2023-03-21 04:25:01'),
(24, 37, 4, 'hola, me encantÃ³ el libro\r\n', '2023-03-21 04:26:30'),
(25, 37, 4, 'a', '2023-03-21 04:26:46'),
(26, 37, 4, 'v', '2023-03-21 04:29:32'),
(27, 37, 4, 'v', '2023-03-21 04:32:15'),
(28, 37, 4, 'zz', '2023-03-21 04:32:43'),
<<<<<<< HEAD
=======
(29, 37, 4, 'v', '2023-03-21 04:33:54'),
(30, 37, 27, 'v', '2023-03-21 04:34:20'),
(31, 37, 27, 'vv', '2023-03-21 04:34:37'),
(32, 37, 27, 'v', '2023-03-21 04:36:51'),
(33, 37, 5, 'vvvb', '2023-03-21 04:37:12'),
(34, 37, 5, 'vbv', '2023-03-21 04:39:46'),
>>>>>>> 2790b7a75acebd8407557a46b1e33ac06803e2f6
(35, 37, 33, 'bv', '2023-03-21 04:43:00'),
(36, 37, 33, 'gg', '2023-03-21 04:46:35'),
(37, 37, 33, 'gggokgogk', '2023-03-21 04:46:58'),
(38, 39, 34, 'Holaaaaaaaaaa Nikol', '2023-03-21 12:51:26'),
(39, 39, 1, 'Comentario', '2023-03-21 12:51:45'),
(40, 39, 33, 'fgggf', '2023-03-21 12:59:58'),
<<<<<<< HEAD
(42, 39, 1, 'ghhghgh', '2023-03-21 13:37:08'),
(43, 14, 1, ':)', '2023-03-22 15:44:13'),
(44, 1, 1, 'lel viejo zancaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2023-03-30 13:13:19'),
(45, 1, 1, '', '2023-04-07 15:55:31'),
(53, 1, 2, 'hola\r\n', '2023-04-24 15:42:22'),
(54, 1, 2, 'mayonesa', '2023-04-24 15:45:07'),
(55, 1, 27, 'Hola', '2023-05-03 20:57:09'),
(56, 47, 36, 'No! El libro es muy bueno ', '2023-05-04 11:50:03'),
(62, 1, 34, 'puto', '2023-05-06 22:25:01');
=======
(41, 39, 5, 'g', '2023-03-21 13:03:42'),
(42, 39, 1, 'ghhghgh', '2023-03-21 13:37:08'),
(43, 14, 1, ':)', '2023-03-22 15:44:13');
>>>>>>> 2790b7a75acebd8407557a46b1e33ac06803e2f6

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `idRol` int(11) NOT NULL,
  `rolUsuario` varchar(25) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idRol`, `rolUsuario`) VALUES
(1, 'Administrador'),
(2, 'Empleado'),
(3, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tematica`
--

CREATE TABLE `tematica` (
  `idTematica` int(11) NOT NULL,
  `tematica` varchar(30) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tematica`
--

INSERT INTO `tematica` (`idTematica`, `tematica`) VALUES
(4, 'Arte'),
(15, 'Biográficos y autobiográficos'),
(12, 'Booket'),
(3, 'Ciencias'),
(20, 'Ciencias'),
(6, 'Cómics'),
(11, 'Derecho'),
(13, 'Didáctico y lúdico'),
(9, 'Economía'),
(10, 'Fotografía'),
(1, 'Historia'),
(5, 'Idiomas'),
(7, 'Informática'),
(2, 'Literatura'),
(8, 'Medicina'),
(21, 'Nikol'),
(17, 'Religioso'),
(14, 'Técnico'),
(16, 'Viajes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nombreUsuario` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `apellidoUsuario` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `correoUsuario` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `idRol` int(25) NOT NULL,
  `usuario` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `contrasenaUsuario` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `idEstado` int(11) NOT NULL,
  `idPais` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombreUsuario`, `apellidoUsuario`, `correoUsuario`, `idRol`, `usuario`, `contrasenaUsuario`, `idEstado`, `idPais`) VALUES
(1, 'Nikol', 'Ramírez', 'nikol@admin.com', 1, 'Nikol', 'HgLesw==', 1, 52),
(2, 'Papiro', 'Libreria', 'libreriaPapiro@admin.com', 1, 'Papiro', 'HgLesw==', 1, 241),
(3, 'Alexandra', 'Ramos', 'Alexandra@gmail.com', 1, 'Alexandra', 'HgLesw==', 1, 96),
(6, 'Dennis', 'Morato', 'dennis@gmail.com', 3, 'Dennis', 'HwnctaM=', 1, 16),
(7, 'Jessenia', 'Quintero', 'dennisquintero@gmail.com', 3, 'Jk', 'HwnctaPl', 1, 114),
(8, 'N', 'R', 'nr@gmail.com', 3, 'nr', 'QEnes6Xndg==', 1, 52),
(9, 'Julian', 'Lopez', 'julian@gmail.com', 3, 'Julian', 'HwnctaM=', 1, 70),
(10, 'Pepe', 'Ramírez', 'pepe1@gmail.com', 3, 'Pepe', 'HgLesw==', 1, 115),
(11, 'Jaime', 'Surita', 'jaimesurita@gmail.com', 3, 'JaimeSur', 'Gw3YuQ==', 1, 113),
(12, 'Neil', 'Armstrong', 'Neil@hotmail.com', 3, 'Neil', 'HgLesw==', 2, 127),
(13, 'John', 'Glenn', 'JohnGlenn@gmail.com', 3, 'JohnGlenn', 'HgLetA==', 1, 236),
(14, 'Wild', 'Flower', 'nikolr9.29@gmail.com', 3, 'WildFlower', 'Hwnc', 1, 52),
(15, 'V', 'T', 'v@gmail.com', 3, 'V', 'HgLesw==', 1, 82),
(19, 'Stream', 'Indigo', 'y@gmail.com', 3, 'Yun', 'V0I=', 1, 14),
(20, 'el sonas', 'cra', 'diego@gmail.com', 3, 'sonas', 'HwnctaM=', 1, 52),
(28, 'Dos', 'Dos Dos', '2@gmail.com', 3, '2', 'HAndsw==', 2, 227),
(29, 'Veintitr&eacute;s', 'Veintitr&eacute;s', '23456789@gmail.com', 3, '23', 'HAg=', 2, 11),
(30, 'f', 'f', 'sf@gmail.com', 3, 'f', 'SF2J5w==', 1, 16),
(34, '&lt;h1&gt; Nikol &lt;/h1&', '&lt;b&gt;  Ram&iacute;rez', 'noooooooooo@gmail.com', 3, 'Noooooooooooo', 'HgLesw==', 1, 13),
(35, '&lt;h1&gt; Nikol &lt;/h1&', '&lt;b&gt;  Ram&iacute;rez', 'so@gmail.com', 3, 'soooo', 'HgLXtg==', 1, 10),
(36, '&lt;h1&gt; Sexy &lt;/h1&a', '&lt;b&gt;  Nukim', 'sexynukim@gmail.com', 3, 'SexyNukim', 'HgLesw==', 1, 131),
(37, 'Dennis', 'Morato', 'dennis23@gmail.com', 3, 'Dennis23', 'Hwnc', 1, 24),
(38, 'Nikol', 'Ram&iacute;rez', 'nnnn@gmail.com', 3, 'Nnn', 'HgLesw==', 1, 241),
(39, 'Alexandraa', 'Ramoss', 'Alexandraa@gmail.com', 3, 'Alexandraa', 'HgLesw==', 1, 241),
<<<<<<< HEAD
(41, 'Like', 'Crazy', 'likeCrazy@gmail.com', 3, 'LikeCrazy', 'QlKE5NWhIgJg', 1, 241),
(42, 'Cepillo II', 'Cepillin', 'holasoygerman@gmail.com', 3, 'ZapatosSucios2', 'HwnctaM=', 1, 241),
(43, 'Nikol', 'Ram&iacute;rez', 'nik@1gmail.com', 3, 'Nikolll', 'HgLesw==', 1, 241),
(44, 'Like Crazy', 'FACE', 'e@gmail.com', 3, 'like', 'YlKE5NWhIgJg', 1, 241),
(45, 'Nikol', 'Ram&iacute;rez', 'sharp@gmail.com', 3, 'sharp', 'DQ==', 1, 241),
(46, 'aaa', 'a', 'a@gmail.com', 3, 'a', 'Tw==', 1, 241),
(47, 'Dennis Jessenia  ', 'Morato Quintero', 'd@gmail.com', 3, 'DJ', 'al6B7/+gA0ks', 1, 241);
=======
(41, 'Like', 'Crazy', 'likeCrazy@gmail.com', 3, 'LikeCrazy', 'QlKE5NWhIgJg', 1, 241);
>>>>>>> 2790b7a75acebd8407557a46b1e33ac06803e2f6

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`),
  ADD KEY `categoria` (`categoria`) USING BTREE;

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `editorial`
--
ALTER TABLE `editorial`
  ADD PRIMARY KEY (`idEditorial`),
  ADD KEY `nombreEditorial` (`nombreEditorial`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`idEstado`);

--
-- Indices de la tabla `foro`
--
ALTER TABLE `foro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idEstado` (`idEstado`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `libro`
--
ALTER TABLE `libro`
  ADD PRIMARY KEY (`idLibro`),
  ADD UNIQUE KEY `ISBN` (`ISBN`),
  ADD KEY `idEditorial` (`idEditorial`),
  ADD KEY `idTematica` (`idTematica`),
  ADD KEY `idPais` (`idPais`),
  ADD KEY `idCategoria` (`idCategoria`),
  ADD KEY `libro` (`idEstado`);

--
-- Indices de la tabla `orden`
--
ALTER TABLE `orden`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indices de la tabla `orden_articulos`
--
ALTER TABLE `orden_articulos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`idPais`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`idRespuesta`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idForo` (`idForo`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `tematica`
--
ALTER TABLE `tematica`
  ADD PRIMARY KEY (`idTematica`),
  ADD KEY `tematica` (`tematica`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD UNIQUE KEY `correoUsuario` (`correoUsuario`),
  ADD KEY `idRol` (`idRol`),
  ADD KEY `idPais` (`idPais`),
  ADD KEY `idEstado` (`idEstado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
<<<<<<< HEAD
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
=======
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
>>>>>>> 2790b7a75acebd8407557a46b1e33ac06803e2f6

--
-- AUTO_INCREMENT de la tabla `editorial`
--
ALTER TABLE `editorial`
  MODIFY `idEditorial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `idEstado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `foro`
--
ALTER TABLE `foro`
<<<<<<< HEAD
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
=======
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
>>>>>>> 2790b7a75acebd8407557a46b1e33ac06803e2f6

--
-- AUTO_INCREMENT de la tabla `libro`
--
ALTER TABLE `libro`
  MODIFY `idLibro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT de la tabla `orden`
--
ALTER TABLE `orden`
<<<<<<< HEAD
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
=======
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
>>>>>>> 2790b7a75acebd8407557a46b1e33ac06803e2f6

--
-- AUTO_INCREMENT de la tabla `orden_articulos`
--
ALTER TABLE `orden_articulos`
<<<<<<< HEAD
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
=======
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
>>>>>>> 2790b7a75acebd8407557a46b1e33ac06803e2f6

--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `idPais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=242;

--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
<<<<<<< HEAD
  MODIFY `idRespuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
=======
  MODIFY `idRespuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
>>>>>>> 2790b7a75acebd8407557a46b1e33ac06803e2f6

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tematica`
--
ALTER TABLE `tematica`
  MODIFY `idTematica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
<<<<<<< HEAD
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
=======
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
>>>>>>> 2790b7a75acebd8407557a46b1e33ac06803e2f6

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `foro`
--
ALTER TABLE `foro`
  ADD CONSTRAINT `foro_ibfk_1` FOREIGN KEY (`idEstado`) REFERENCES `estado` (`idEstado`),
  ADD CONSTRAINT `foro_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Filtros para la tabla `libro`
--
ALTER TABLE `libro`
  ADD CONSTRAINT `libro` FOREIGN KEY (`idEstado`) REFERENCES `estado` (`idEstado`),
  ADD CONSTRAINT `libro_ibfk_1` FOREIGN KEY (`idEditorial`) REFERENCES `editorial` (`idEditorial`),
  ADD CONSTRAINT `libro_ibfk_2` FOREIGN KEY (`idTematica`) REFERENCES `tematica` (`idTematica`),
  ADD CONSTRAINT `libro_ibfk_3` FOREIGN KEY (`idPais`) REFERENCES `pais` (`idPais`),
  ADD CONSTRAINT `libro_ibfk_4` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`);

--
-- Filtros para la tabla `orden`
--
ALTER TABLE `orden`
  ADD CONSTRAINT `orden_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `orden_articulos`
--
ALTER TABLE `orden_articulos`
  ADD CONSTRAINT `orden_articulos_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orden` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD CONSTRAINT `respuestas_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `respuestas_ibfk_2` FOREIGN KEY (`idForo`) REFERENCES `foro` (`id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `roles` (`idRol`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`idPais`) REFERENCES `pais` (`idPais`),
  ADD CONSTRAINT `usuario_ibfk_3` FOREIGN KEY (`idEstado`) REFERENCES `estado` (`idEstado`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
