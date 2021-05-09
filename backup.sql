/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `order_date` date NOT NULL,
  `checkin_date` date NOT NULL,
  `checkout_date` date NOT NULL,
  `status` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'pending',
  `total` decimal(15,2) NOT NULL DEFAULT '0.00',
  `customer_notes` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cancelled_at` datetime DEFAULT NULL,
  `cancellation_notes` text,
  `staff_notes` text,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `FK_bookings_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

DELETE FROM `bookings`;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
INSERT INTO `bookings` (`id`, `user_id`, `order_date`, `checkin_date`, `checkout_date`, `status`, `total`, `customer_notes`, `created_at`, `updated_at`, `cancelled_at`, `cancellation_notes`, `staff_notes`) VALUES
	(1, 1, '2021-05-08', '2021-05-10', '2021-05-11', 'complete', 1347.14, 'semper, tortor eu consectetur interdum, velit erat efficitur velit, ut dignissim erat nisi in sem. Cras at malesuada augue. Suspendisse nec justo iaculis, mollis ex luctus, convallis augue. Proin semper eleifend neque eu convallis. Curabitur porta egestas luctus. Vivamus mauris ipsum, efficitur eu cursus non, tempor pellentesque ante. Sed nec felis accumsan, sagittis lectus non, pellentesque leo. Mauris ut ex mauris. Ut mattis varius pellentesque. Proin cursus, lectus vel viverra placerat, mauris sem feugiat tortor, a tristique ligula urna at dui. Aenean vel viverra massa, ac aliquet felis. Aenean lectus ligula, dictum in consectetur non, pretium nec sem. In eu aliquet elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tellus est, placerat in enim a, egestas rutrum justo. Quisque vel lobortis dolor, eget laoreet velit.', '2021-05-08 04:26:27', '2021-05-09 02:27:32', '2021-05-09 03:31:46', 'Marcos Mercedes', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin et erat mollis, luctus erat sit amet, accumsan felis. Duis luctus sed felis a ultrices. Praesent eget massa rutrum, pretium lorem at, mattis eros. Nam sapien metus, dignissim quis metus a, rutrum laoreet tortor. Pellentesque at metus hendrerit, tempus dolor nec, fringilla mi. Nunc luctus mi ut quam malesuada suscipit. Donec eu ligula diam. Maecenas et sapien eleifend purus aliquam blandit.'),
	(2, 1, '2021-05-08', '2021-05-10', '2021-05-11', 'complete', 1347.14, 'Marcos Mercedes Full Flow', '2021-05-08 05:04:03', '2021-05-09 01:49:46', NULL, NULL, NULL),
	(3, 1, '2021-05-09', '2021-05-10', '2021-05-11', 'fulfilled', 1347.14, 'Clear Cookie', '2021-05-08 05:07:10', '2021-05-09 01:47:01', NULL, NULL, NULL),
	(4, 1, '2021-05-10', '2021-05-10', '2021-05-11', 'cancelled', 1347.14, NULL, '2021-05-08 05:32:15', '2021-05-09 02:30:09', '2021-05-09 03:32:29', 'Ut at placerat sapien, vel maximus magna. In tristique ut diam at suscipit. Sed tincidunt egestas magna, elementum aliquet enim dignissim et. Donec nunc quam, lacinia eu accumsan eu, commodo a turpis. Proin ultricies lectus ligula, eu elementum mauris dictum vitae. Phasellus metus odio, accumsan vitae velit ut, cursus egestas urna. Maecenas dictum dignissim nisi sit amet bibendum. Maecenas velit ligula, pretium id pretium in, commodo quis risus. In dignissim risus ac magna tempus rutrum. Fusce egestas libero non congue mollis. Morbi porta nulla ullamcorper nulla lacinia bibendum.', NULL),
	(5, 1, '2021-05-09', '2021-05-10', '2021-05-12', 'pending', 3297.14, NULL, '2021-05-09 02:33:23', '2021-05-09 02:33:23', NULL, NULL, NULL),
	(6, 1, '2021-05-09', '2021-05-11', '2021-05-12', 'pending', 1797.14, NULL, '2021-05-09 02:42:09', '2021-05-09 02:42:09', NULL, NULL, NULL);
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;

DROP TABLE IF EXISTS `booking_items`;
CREATE TABLE IF NOT EXISTS `booking_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `room_id` int NOT NULL,
  `booking_id` int NOT NULL,
  `total` decimal(15,2) NOT NULL DEFAULT '0.00',
  `checkin_date` date NOT NULL,
  `checkout_date` date NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_booking_items_rooms` (`room_id`),
  KEY `FK_booking_items_bookings` (`booking_id`),
  CONSTRAINT `FK_booking_items_bookings` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`),
  CONSTRAINT `FK_booking_items_rooms` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

DELETE FROM `booking_items`;
/*!40000 ALTER TABLE `booking_items` DISABLE KEYS */;
INSERT INTO `booking_items` (`id`, `room_id`, `booking_id`, `total`, `checkin_date`, `checkout_date`, `created_at`, `updated_at`) VALUES
	(1, 4, 1, 697.14, '2021-05-10', '2021-05-11', '2021-05-08 04:26:27', '2021-05-08 04:26:27'),
	(2, 3, 1, 650.00, '2021-05-10', '2021-05-11', '2021-05-08 04:26:27', '2021-05-08 04:26:27'),
	(3, 4, 2, 697.14, '2021-05-10', '2021-05-11', '2021-05-08 05:04:03', '2021-05-08 05:04:03'),
	(4, 3, 2, 650.00, '2021-05-10', '2021-05-11', '2021-05-08 05:04:03', '2021-05-08 05:04:03'),
	(5, 4, 3, 697.14, '2021-05-10', '2021-05-11', '2021-05-08 05:07:10', '2021-05-08 05:07:10'),
	(6, 3, 3, 650.00, '2021-05-10', '2021-05-11', '2021-05-08 05:07:10', '2021-05-08 05:07:10'),
	(7, 3, 4, 650.00, '2021-05-10', '2021-05-11', '2021-05-08 05:32:15', '2021-05-08 05:32:15'),
	(8, 4, 4, 697.14, '2021-05-10', '2021-05-11', '2021-05-08 05:32:15', '2021-05-08 05:32:15'),
	(9, 4, 5, 697.14, '2021-05-10', '2021-05-11', '2021-05-09 02:33:23', '2021-05-09 02:33:23'),
	(10, 7, 5, 1600.00, '2021-05-11', '2021-05-12', '2021-05-09 02:33:23', '2021-05-09 02:33:23'),
	(11, 6, 5, 1000.00, '2021-05-11', '2021-05-12', '2021-05-09 02:33:23', '2021-05-09 02:33:23'),
	(12, 4, 6, 697.14, '2021-05-11', '2021-05-12', '2021-05-09 02:42:09', '2021-05-09 02:42:09'),
	(13, 5, 6, 1100.00, '2021-05-11', '2021-05-12', '2021-05-09 02:42:09', '2021-05-09 02:42:09');
/*!40000 ALTER TABLE `booking_items` ENABLE KEYS */;

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `quantity` int NOT NULL,
  `max_children` int NOT NULL DEFAULT '0',
  `room_capacity_id` int NOT NULL,
  `room_type_id` int NOT NULL,
  `extra_description` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `price_config` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `gallery` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `name` (`name`) USING BTREE,
  KEY `FK_rooms_room_capacities` (`room_capacity_id`),
  KEY `FK_rooms_room_types` (`room_type_id`),
  CONSTRAINT `FK_rooms_room_capacities` FOREIGN KEY (`room_capacity_id`) REFERENCES `room_capacities` (`id`),
  CONSTRAINT `FK_rooms_room_types` FOREIGN KEY (`room_type_id`) REFERENCES `room_types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

DELETE FROM `rooms`;
/*!40000 ALTER TABLE `rooms` DISABLE KEYS */;
INSERT INTO `rooms` (`id`, `name`, `description`, `quantity`, `max_children`, `room_capacity_id`, `room_type_id`, `extra_description`, `price_config`, `gallery`, `created_at`, `updated_at`) VALUES
	(3, 'Luxury Pool Junior Suites', 'Las suites de lujo de un dormitorio con piscina son las preferidas por las parejas que viajan con un niño; tienen capacidad para tres cómodamente.\r\n\r\nExplore nuestra propiedad en un carrito de golf eléctrico y diríjase al Eden Roc Beach Club para descansar y relajarse junto al mar. Luego regrese a su propia piscina privada para nadar por la noche. Cada día es una maravillosa aventura.', 20, 1, 2, 1, '1 dormitorio con 1 cama king size y sofá cama\r\nOcupación máxima: 3\r\n14 unidades vista jardín / 3 unidades vista laguna\r\n824 pies cuadrados / 77 metros cuadrados de espacio interior con aire acondicionado\r\nPiscina privada y cenador cubierto\r\nDucha de lluvia exterior y zona de spa\r\nUso exclusivo de un carrito de golf para un fácil acceso a todas las actividades en la propiedad\r\nDesayuno americano completo diario servido en el restaurante Mediterraneo\r\nAcceso a un iPad de tecnología inteligente que controla la luz, la televisión y el sonido a través de una aplicación Eden Roc en Cap Cana\r\nAcceso gratuito a 4500 títulos de periódicos y revistas a través de la aplicación PressReader\r\nRopa de cama de lujo y albornoces y zapatillas de felpa de Rivolta Carmignani, certificado por Oeko-Tex® Standard 100 Class II\r\nFelpa edredón y almohadas de plumas de ganso de Hanse\r\nGrandes televisores de pantalla plana LCD de 55 pulgadas con programación satelital dentro de los dormitorios y espacios de estar\r\nSistema de entretenimiento completo de tecnología avanzada con altavoces de sonido envolvente Bose\r\nMesa de trabajo con prácticos puertos y enchufes\r\nConexiones de iPod y iPhone\r\nBañeras de piedra coralina con jacuzzis de mármol\r\nBañera de ducha tipo lluvia contemporánea\r\nEncimeras de lavabo de mármol profundo\r\nAmenidades de baño indulgentes de Acqua di Parma,\r\nCuarto de baño independiente con teléfono\r\nMenú telefónico fácil de usar, servicio de información y mensajes\r\nVestidor de madera de cedro a gran escala con dos entradas independientes, completo con plancha y tabla de planchar\r\nCaja de seguridad electrónica en la habitación\r\nCafetera Nespresso y tetera con una selección de cafés y tés\r\nMinibar de alta calidad\r\nAcceso gratuito a Internet WiFi\r\nTraslados privados desde y hacia el aeropuerto internacional de Punta Cana.\r\n2 unidades se conectan a una suite de lujo de un dormitorio con piscina (1 con vista al jardín y 1 con vista a la laguna) para un máximo de 5 huéspedes', '{"Monday":"650","Tuesday":"650","Wednesday":"650","Thursday":"650","Friday":"650","Saturday":"650","Sunday":"650"}', '["rooms\\/gallery\\/20210505\\/luxury_pool_junior_suites_01.jpg","rooms\\/gallery\\/20210505\\/luxury_pool_junior_suites_02.jpg","rooms\\/gallery\\/20210505\\/luxury_pool_junior_suites_03.jpg","rooms\\/gallery\\/20210505\\/luxury_pool_junior_suites_04.jpg","rooms\\/gallery\\/20210505\\/luxury_pool_junior_suites_05.jpg","rooms\\/gallery\\/20210505\\/luxury_pool_junior_suites_06.jpg"]', '2021-05-05 14:04:50', '2021-05-05 14:04:50'),
	(4, 'Luxury Pool One Bedroom Suites', 'Las suites de lujo de un dormitorio con piscina son las preferidas por las parejas que viajan con un niño; tienen capacidad para tres cómodamente.\r\n\r\nExplore nuestra propiedad en un carrito de golf eléctrico y diríjase al Eden Roc Beach Club para descansar y relajarse junto al mar. Luego regrese a su propia piscina privada para nadar por la noche. Cada día es una maravillosa aventura.', 30, 1, 2, 1, '5 habitaciones con 1 cama king, 2 habitaciones con 2 camas queen o 3 habitaciones con 2 camas individuales. Las 3 suites con camas king size cuentan con sofá cama.\r\nOcupación máxima: 3\r\n6 unidades vista jardín / 2 unidades vista laguna\r\n1.088 pies cuadrados / 102 metros cuadrados de espacio interior con aire acondicionado\r\nPiscina privada y cenador\r\nDucha de lluvia exterior y zona de spa\r\nUso exclusivo de un carrito de golf para un fácil acceso a todas las actividades en la propiedad\r\nDesayuno buffet americano completo diario servido en el restaurante Mediterraneo\r\nAcceso a un iPad de tecnología inteligente que controla la luz, la televisión y el sonido a través de una aplicación Eden Roc en Cap Cana\r\nAcceso gratuito a 4500 títulos de periódicos y revistas a través de la aplicación PressReader\r\nRopa de cama de lujo y albornoces y zapatillas de felpa de Rivolta Carmignani, certificado por Oeko-Tex® Standard 100 Class II\r\nFelpa edredón y almohadas de plumas de ganso de Hanse\r\nGrandes televisores de pantalla plana LCD de 42 pulgadas con programación satelital dentro de los dormitorios y espacios de estar\r\nSistema de entretenimiento completo de tecnología avanzada con altavoces de sonido envolvente Bose\r\nMesa de trabajo con prácticos puertos y enchufes\r\nConexiones de iPod y iPhone\r\nBañeras de piedra coralina con jacuzzis de mármol\r\nBañera de ducha tipo lluvia contemporánea\r\nEncimeras de lavabo de mármol profundo\r\nAmenidades de baño indulgentes de Acqua di Parma.\r\nCuarto de baño independiente con teléfono\r\nMenú telefónico fácil de usar, servicio de información y mensajes\r\nVestidor de madera de cedro a gran escala con dos entradas independientes, completo con plancha y tabla de planchar\r\nCaja de seguridad electrónica en la habitación\r\nCafetera Nespresso y tetera con una selección de cafés y tés\r\nMinibar de alta calidad\r\nAcceso gratuito a Internet WiFi\r\nTraslados privados desde y hacia el aeropuerto internacional de Punta Cana.\r\n2 unidades se conectan a una suite junior de lujo con piscina (1 con vista al jardín y 1 con vista a la laguna) para un máximo de 5 personas.', '{"Monday":"80","Tuesday":"800","Wednesday":"800","Thursday":"800","Friday":"800","Saturday":"800","Sunday":"800"}', '["rooms\\/gallery\\/20210505\\/luxury_pool_one_bedroom_suites_01.jpg","rooms\\/gallery\\/20210505\\/luxury_pool_one_bedroom_suites_02.jpg","rooms\\/gallery\\/20210505\\/luxury_pool_one_bedroom_suites_03.jpg","rooms\\/gallery\\/20210505\\/luxury_pool_one_bedroom_suites_03.jpg","rooms\\/gallery\\/20210505\\/luxury_pool_one_bedroom_suites_04.jpg","rooms\\/gallery\\/20210505\\/luxury_pool_one_bedroom_suites_05.jpg","rooms\\/gallery\\/20210505\\/luxury_pool_one_bedroom_suites_06.jpg"]', '2021-05-05 14:39:32', '2021-05-05 14:39:32'),
	(5, 'Beachfront One Bedroom Suite', 'Las suites de lujo de un dormitorio con piscina frente a la playa son las preferidas por las parejas que viajan con un niño; tienen capacidad para tres cómodamente.\r\n\r\nExplore nuestra propiedad en un carrito de golf eléctrico y diríjase al Eden Roc Beach Club para descansar y relajarse junto al mar. Luego regrese a su propia piscina privada para nadar por la noche. Cada día es una maravillosa aventura.', 10, 1, 2, 1, '5 habitaciones con 1 cama king, 2 habitaciones con 2 camas queen o 3 habitaciones con 2 camas individuales. Las 3 suites con camas king size cuentan con sofá cama.\r\nOcupación máxima: 3\r\n6 unidades vista jardín / 2 unidades vista laguna\r\n1.088 pies cuadrados / 102 metros cuadrados de espacio interior con aire acondicionado\r\nPiscina privada y cenador\r\nDucha de lluvia exterior y zona de spa\r\nUso exclusivo de un carrito de golf para un fácil acceso a todas las actividades en la propiedad\r\nDesayuno buffet americano completo diario servido en el restaurante Mediterraneo\r\nAcceso a un iPad de tecnología inteligente que controla la luz, la televisión y el sonido a través de una aplicación Eden Roc en Cap Cana\r\nAcceso gratuito a 4500 títulos de periódicos y revistas a través de la aplicación PressReader\r\nRopa de cama de lujo y albornoces y zapatillas de felpa de Rivolta Carmignani, certificado por Oeko-Tex® Standard 100 Class II\r\nFelpa edredón y almohadas de plumas de ganso de Hanse\r\nGrandes televisores de pantalla plana LCD de 42 pulgadas con programación satelital dentro de los dormitorios y espacios de estar\r\nSistema de entretenimiento completo de tecnología avanzada con altavoces de sonido envolvente Bose\r\nMesa de trabajo con prácticos puertos y enchufes\r\nConexiones de iPod y iPhone\r\nBañeras de piedra coralina con jacuzzis de mármol\r\nBañera de ducha tipo lluvia contemporánea\r\nEncimeras de lavabo de mármol profundo\r\nAmenidades de baño indulgentes de Acqua di Parma.\r\nCuarto de baño independiente con teléfono\r\nMenú telefónico fácil de usar, servicio de información y mensajes\r\nVestidor de madera de cedro a gran escala con dos entradas independientes, completo con plancha y tabla de planchar\r\nCaja de seguridad electrónica en la habitación\r\nCafetera Nespresso y tetera con una selección de cafés y tés\r\nMinibar de alta calidad\r\nAcceso gratuito a Internet WiFi\r\nTraslados privados desde y hacia el aeropuerto internacional de Punta Cana.\r\n2 unidades se conectan a una suite junior de lujo con piscina (1 con vista al jardín y 1 con vista a la laguna) para un máximo de 5 personas.', '{"Monday":"1100","Tuesday":"1100","Wednesday":"1100","Thursday":"1100","Friday":"1100","Saturday":"1100","Sunday":"1100"}', '["rooms\\/gallery\\/20210505\\/luxury_pool_one_bedroom_suites_03.jpg","rooms\\/gallery\\/20210505\\/luxury_pool_one_bedroom_suites_05.jpg","rooms\\/gallery\\/20210505\\/luxury_pool_one_bedroom_suites_01.jpg","rooms\\/gallery\\/20210505\\/luxury_pool_one_bedroom_suites_02.jpg","rooms\\/gallery\\/20210505\\/luxury_pool_one_bedroom_suites_03.jpg","rooms\\/gallery\\/20210505\\/luxury_pool_one_bedroom_suites_04.jpg","rooms\\/gallery\\/20210505\\/luxury_pool_one_bedroom_suites_06.jpg"]', '2021-05-05 14:47:26', '2021-05-05 14:47:26'),
	(6, 'Luxury Pool Family Suites', 'El lugar perfecto para unas vacaciones inolvidables aquí.\r\n\r\nTraiga a sus hijos y disfrute de todas las actividades en la propiedad, desde esnórquel hasta caminatas y boogie board. Las suites familiares de lujo con piscina de dos dormitorios y dos baños cuentan con un dormitorio principal que se une a un dormitorio secundario con literas.\r\n\r\nY hay un país de las maravillas de exploración justo afuera de tu puerta para niños de todas las edades: sigue la diversión desde la piscina hasta el mar.', 15, 2, 3, 2, '2 recámaras, recámara principal con 1 cama king size y recámara secundaria con dos camas individuales (literas), con baño y regadera individual. Estas suites también cuentan con sofá cama en la sala de estar.\r\nOcupación máxima: 3 adultos + 2 niños (menores de 12 años)\r\n2 unidades con vista al jardín / 1 unidad con vista a la laguna\r\n1.316 pies cuadrados / 123 metros cuadrados de espacio interior con aire acondicionado\r\nPiscina privada y cenador\r\nDucha de lluvia exterior y zona de spa\r\nUso exclusivo de un carrito de golf para un fácil acceso a todas las actividades en la propiedad\r\nDesayuno buffet americano completo todos los días servido en el restaurante Mediterraneo\r\nAcceso a un iPad de tecnología inteligente que controla la luz, la televisión y el sonido a través de una aplicación Eden Roc en Cap Cana\r\nAcceso gratuito a 4500 títulos de periódicos y revistas a través de la aplicación PressReader\r\nRopa de cama de lujo y albornoces y zapatillas de felpa de Rivolta Carmignani, certificado por Oeko-Tex® Standard 100 Class II\r\nFelpa edredón y almohadas de plumas de ganso de Hanse\r\nGrandes televisores de pantalla plana LCD de 42 pulgadas con programación satelital dentro de los dormitorios y espacios de estar\r\nSistema de entretenimiento completo de tecnología avanzada con altavoces de sonido envolvente Bose\r\nMesa de trabajo con prácticos puertos y enchufes\r\nConexiones de iPod y iPhone\r\nBañeras de piedra coralina con jacuzzis de mármol\r\nBañera de ducha tipo lluvia contemporánea\r\nEncimeras de lavabo de mármol profundo\r\nAmenidades de baño indulgentes de Acqua di Parma.\r\nCuarto de baño independiente con teléfono\r\nMenú telefónico fácil de usar, servicio de información y mensajes\r\nVestidor de madera de cedro a gran escala con dos entradas independientes, completo con plancha y tabla de planchar\r\nCaja de seguridad electrónica en la habitación\r\nCafetera Nespresso y tetera con una selección de cafés y tés\r\nMinibar de alta calidad\r\nAcceso gratuito a Internet WiFi\r\nTraslados privados desde y hacia el aeropuerto internacional de Punta Cana.', '{"Monday":"1000","Tuesday":"1000","Wednesday":"1000","Thursday":"1000","Friday":"1000","Saturday":"1000","Sunday":"1000"}', '["rooms\\/gallery\\/20210505\\/luxury_pool_family_suites_01.jpg","rooms\\/gallery\\/20210505\\/luxury_pool_family_suites_02.jpg","rooms\\/gallery\\/20210505\\/luxury_pool_family_suites_03.jpg","rooms\\/gallery\\/20210505\\/luxury_pool_family_suites_04.jpg","rooms\\/gallery\\/20210505\\/luxury_pool_family_suites_05.jpg","rooms\\/gallery\\/20210505\\/Luxury-Pool-Family-Suite_Bunk-Bed_0833.jpg"]', '2021-05-05 14:52:32', '2021-05-05 14:52:32'),
	(7, 'Two Bedroom Villa', 'Las familias que viajan juntas o las parejas que disfrutan del tiempo con amigos encuentran que las villas de dos dormitorios son los lugares de reunión perfectos. Disponibles como un solo nivel o dúplex, las suites cuentan con dos baños y medio, áreas de relajación y una amplia sala de estar, así como una cocina privada.\r\n\r\nDisfrute de cócteles junto a su piscina privada o aventúrese a jugar un partido de golf; todo es en un día de juego.', 12, 2, 3, 2, '2 habitaciones con 1 cama King y 2 camas individuales o 1 cama King y 2 camas Queen, estas suites también tienen sofá cama.\r\nOcupación máxima: 5\r\n2 unidades vista laguna\r\n2.653 pies cuadrados / 239 metros cuadrados y 1.985 pies cuadrados / 185,50 metros cuadrados de espacio interior con aire acondicionado\r\nPiscina privada y cenador\r\nDucha de lluvia exterior y zona de spa\r\nUso exclusivo de dos carritos de golf para un fácil acceso a todas las actividades en la propiedad\r\nDesayuno buffet americano completo todos los días servido en el restaurante principal\r\nAcceso a un iPad de tecnología inteligente que controla la luz, la televisión y el sonido a través de una aplicación Eden Roc en Cap Cana\r\nAcceso gratuito a 4500 títulos de periódicos y revistas a través de la aplicación PressReader\r\nRopa de cama de lujo y albornoces y zapatillas de felpa de Rivolta Carmignani, certificado por Oeko-Tex® Standard 100 Class II\r\nFelpa edredón y almohadas de plumas de ganso de Hanse\r\nGrandes televisores de pantalla plana LCD de 42 pulgadas con programación satelital dentro de los dormitorios y espacios de estar\r\nSistema de entretenimiento completo de tecnología avanzada con altavoces de sonido envolvente Bose\r\nMesa de trabajo con prácticos puertos y enchufes\r\nConexiones de iPod y iPhone\r\nCocina privada para uso del chef / mayordomo *\r\n2 bañeras de piedra coralina con jacuzzis de mármol\r\n2 Bañera de ducha tipo lluvia contemporánea\r\nEncimeras de lavabo de mármol profundo\r\nAmenidades de baño indulgentes de Acqua di Parma.\r\nVestidor de madera de cedro a gran escala con dos entradas independientes, completo con plancha y tabla de planchar\r\nCuarto de baño independiente con teléfono\r\nMenú telefónico fácil de usar, servicio de información y mensajes\r\nCaja de seguridad electrónica en la habitación\r\nCafetera Nespresso y tetera con una selección de cafés y tés\r\nMinibar de alta calidad\r\nAcceso gratuito a Internet WiFi\r\nTraslados privados desde y hacia el aeropuerto internacional de Punta Cana.', '{"Monday":"1600","Tuesday":"1600","Wednesday":"1600","Thursday":"1600","Friday":"1600","Saturday":"1600","Sunday":"1600"}', '["rooms\\/gallery\\/20210505\\/two_bedroom_family_suites_01.jpg","rooms\\/gallery\\/20210505\\/two_bedroom_family_suites_02.jpg","rooms\\/gallery\\/20210505\\/two_bedroom_family_suites_03.jpg","rooms\\/gallery\\/20210505\\/two_bedroom_family_suites_04.jpg","rooms\\/gallery\\/20210505\\/two_bedroom_family_suites_05.jpg","rooms\\/gallery\\/20210505\\/two_bedroom_family_suites_06.jpg","rooms\\/gallery\\/20210505\\/two_bedroom_family_suites_07.jpg","rooms\\/gallery\\/20210505\\/two_bedroom_family_suites_08.jpg","rooms\\/gallery\\/20210505\\/two_bedroom_family_suites_09.jpg","rooms\\/gallery\\/20210505\\/two_bedroom_family_suites_10.jpg","rooms\\/gallery\\/20210505\\/two_bedroom_family_suites_11.jpg","rooms\\/gallery\\/20210505\\/two_bedroom_family_suites_12.jpg","rooms\\/gallery\\/20210505\\/two_bedroom_family_suites_13.jpg","rooms\\/gallery\\/20210505\\/two_bedroom_family_suites_14.jpg"]', '2021-05-05 15:00:33', '2021-05-05 15:00:33'),
	(8, 'One Bedroom Oceanfront Bungalow', 'Con una arquitectura individual y un diseño interior distintivo, las villas crean una conexión significativa con el mar Caribe e inspiran una experiencia rejuvenecedora completa. Las terrazas envolventes son perfectas para cenar al aire libre, donde podrá degustar platos creativos del nuevo chef ejecutivo Adriano Venturini combinados con una deliciosa brisa e impresionantes vistas del océano.\r\n\r\nCada villa también cuenta con una piscina infinita o un jacuzzi con vista a las olas, así como la oportunidad de disfrutar de la mejor experiencia de bienestar con un tratamiento de spa en la villa a cargo de los terapeutas expertos del resort.', 12, 0, 2, 43, '3 unidades\r\nBungalow frente al mar, 1 habitación\r\n800 pies cuadrados / 74 metros cuadrados de espacio interior\r\nCama King\r\nTerraza circundante frente al mar con área para cenar al aire libre y múltiples espacios para sentarse\r\nDesayuno gourmet diario servido en la Villa\r\nServicio de mayordomo personal\r\n1 carrito de golf eléctrico para cuatro pasajeros\r\nBaños rústicos y elegantes con tocadores dobles y ducha separada\r\nLavabo independiente con bidé\r\nAmenidades de baño indulgentes de Acqua di Parma\r\nVestidor espacioso\r\nRopa de cama de lujo y albornoces y zapatillas de felpa de Rivolta Carmignani, certificado por Oeko-Tex® Standard 100 Class II\r\nFelpa edredón y almohadas de plumas de ganso de Hanse\r\nGran pantalla plana LCD de 55 pulgadas\r\nCaja de seguridad eléctrica en la habitación\r\nCafetera Nespresso y tetera\r\nMinibar de alta calidad\r\nWi-Fi complementario\r\nTraslado privado desde y hacia el aeropuerto internacional de Punta Cana.', '{"Monday":"1200","Tuesday":"1200","Wednesday":"1200","Thursday":"1200","Friday":"1200","Saturday":"1200","Sunday":"1200"}', '["rooms\\/gallery\\/20210505\\/Ocean_Villa_By_Eden_Roc__Infinity_Pool_D5A5532.jpg","rooms\\/gallery\\/20210505\\/Ocean_Villa_By_Eden_Roc_Aerial_DJI_0109.jpg","rooms\\/gallery\\/20210505\\/Ocean_Villa_By_Eden_Roc_D5A579.jpg","rooms\\/gallery\\/20210505\\/Ocean_Villa_By_Eden_Roc_D5A5504-Modifier.jpg","rooms\\/gallery\\/20210505\\/Ocean_Villa_By_Eden_Roc_D5A5814.jpg","rooms\\/gallery\\/20210505\\/Ocean_Villa_By_Eden_Roc_Master-Bathroom_D5A5911.jpg","rooms\\/gallery\\/20210505\\/Ocean_Villa_By_Eden_Roc_View_D5A5947.jpg"]', '2021-05-05 15:46:28', '2021-05-05 15:46:28'),
	(9, 'Two Bedroom Oceanfront Bungalow', 'Con una arquitectura individual y un diseño interior distintivo, las villas crean una conexión significativa con el mar Caribe e inspiran una experiencia rejuvenecedora completa. Las terrazas envolventes son perfectas para cenar al aire libre, donde podrá degustar platos creativos del nuevo chef ejecutivo Adriano Venturini combinados con una deliciosa brisa e impresionantes vistas del océano.\r\n\r\nCada villa también cuenta con piscinas infinitas con vistas a las olas rompientes, así como la oportunidad de disfrutar de la mejor experiencia de bienestar con un tratamiento de spa en la villa a cargo de los terapeutas expertos del complejo.', 22, 0, 2, 43, '1 unidad\r\nBungalow frente al mar, 2 habitaciones\r\n1500 pies cuadrados / 139 metros cuadrados\r\nDormitorio principal con cama King y dormitorio secundario con 2 camas dobles\r\nTerraza circundante frente al mar con área para cenar al aire libre y múltiples espacios para sentarse\r\nPiscina privada con vista a la impresionante playa Eden Roc, certificada con Bandera Azul\r\nDesayuno gourmet diario servido en la Villa\r\nServicio de mayordomo personal\r\n2 carros de golf eléctricos para cuatro pasajeros\r\nBaños elegantes y rústicos con tocadores dobles, bañera y ducha separada\r\nLavabo independiente con bidé\r\nAmenidades de baño indulgentes de Acqua di Parma\r\nVestidor espacioso\r\nRopa de cama de lujo y albornoces y zapatillas de felpa de Rivolta Carmignani, certificado por Oeko-Tex® Standard 100 Class II\r\nFelpa edredón y almohadas de plumas de ganso de Hanse\r\nGran pantalla plana LCD de 55 pulgadas\r\nCaja de seguridad eléctrica en la habitación\r\nCafetera Nespresso y tetera\r\nMinibar de alta calidad\r\nWi-Fi complementario\r\nTraslado privado desde y hacia el aeropuerto internacional de Punta Cana.', '{"Monday":"2000","Tuesday":"2000","Wednesday":"2000","Thursday":"2000","Friday":"2000","Saturday":"2000","Sunday":"2000"}', '["rooms\\/gallery\\/20210505\\/Ocean_Villa_By_Eden_Roc_View_8D5A5569.jpg","rooms\\/gallery\\/20210505\\/Ocean_Villa_By_Eden_Roc__Infinity_Pool_D5A5532.jpg","rooms\\/gallery\\/20210505\\/Ocean_Villa_By_Eden_Roc_Exterior_D5A5540.jpg","rooms\\/gallery\\/20210505\\/Ocean_Villa_By_Eden_Roc_D5A579.jpg","rooms\\/gallery\\/20210505\\/Ocean_Villa_By_Eden_Roc_View_D5A5947.jpg","rooms\\/gallery\\/20210505\\/Ocean_Villa_By_Eden_Roc_Master-Bathroom_D5A5911.jpg"]', '2021-05-05 15:50:24', '2021-05-05 15:50:24');
/*!40000 ALTER TABLE `rooms` ENABLE KEYS */;

DROP TABLE IF EXISTS `room_capacities`;
CREATE TABLE IF NOT EXISTS `room_capacities` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `capacity` int NOT NULL,
  `position` int NOT NULL DEFAULT '0',
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `name` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

DELETE FROM `room_capacities`;
/*!40000 ALTER TABLE `room_capacities` DISABLE KEYS */;
INSERT INTO `room_capacities` (`id`, `name`, `capacity`, `position`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'Single', 1, 1, NULL, '2021-04-25 17:19:02', '2021-04-25 17:19:02'),
	(2, 'Standard', 2, 2, NULL, '2021-04-25 17:19:10', '2021-04-25 17:19:10'),
	(3, 'Party', 5, 3, NULL, '2021-04-25 17:20:58', '2021-04-25 17:20:58');
/*!40000 ALTER TABLE `room_capacities` ENABLE KEYS */;

DROP TABLE IF EXISTS `room_types`;
CREATE TABLE IF NOT EXISTS `room_types` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `name` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

DELETE FROM `room_types`;
/*!40000 ALTER TABLE `room_types` DISABLE KEYS */;
INSERT INTO `room_types` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'Junior Suite', 'Suite for people that are close to being broke', '2020-04-17 22:12:54', '2021-04-17 22:12:55'),
	(2, 'Master Suite', 'Master Suite\' </textarea> Description', '2021-04-17 22:13:13', '2021-04-17 22:13:14'),
	(43, 'Presidential Suite', NULL, '2021-04-25 00:10:21', '2021-04-25 00:10:21');
/*!40000 ALTER TABLE `room_types` ENABLE KEYS */;

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `last_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `role` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'customer',
  `phone` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role`, `phone`, `created_at`, `updated_at`, `status`) VALUES
	(1, 'Admin', 'Admin', 'admin@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'admin', '8099985829', '2021-04-09 20:04:27', '2021-04-09 20:04:28', 'active'),
	(2, 'Papo', 'Tico', 'papotico@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'customer', '8095555555', '2021-04-09 20:04:57', '2021-04-09 20:04:57', 'active'),
	(3, 'Jon', 'Doe', 'jon.doe@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'customer', '7865412671', '2021-05-03 22:25:57', '2021-05-03 22:25:57', 'active'),
	(5, 'Customer', 'One', 'customer-one@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'customer', '7865412671', '2021-05-05 23:02:05', '2021-05-05 23:02:05', 'active'),
	(6, 'Customer', 'Two', 'customer-two@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'customer', '8099985829', '2021-05-07 23:42:47', '2021-05-07 23:42:47', 'active'),
	(14, 'Orlin', 'Cury', '', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'customer', '8097904751', '2021-05-09 07:28:25', '2021-05-09 07:28:25', 'active');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
