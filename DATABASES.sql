/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE DATABASE IF NOT EXISTS `project` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `project`;

CREATE TABLE IF NOT EXISTS `association` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tele` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `adress` varchar(255) NOT NULL,
  `pass` text NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `ass_hash` (
  `id_ASS` int(11) NOT NULL,
  `HASH_ID` text NOT NULL,
  UNIQUE KEY `id_ASS` (`id_ASS`),
  CONSTRAINT `fk_ASS` FOREIGN KEY (`id_ASS`) REFERENCES `association` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `conversations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `HASH_ID1` varchar(255) NOT NULL,
  `HASH_ID2` varchar(255) NOT NULL,
  `Date_M` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `individus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `date_entre` date DEFAULT NULL,
  `date_N` date DEFAULT NULL,
  `photo` text DEFAULT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `Asso` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `photo` (`photo`) USING HASH,
  KEY `fkAss` (`Asso`),
  CONSTRAINT `fkAss` FOREIGN KEY (`Asso`) REFERENCES `association` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_Conv` int(11) NOT NULL,
  `Expediteur` varchar(255) NOT NULL,
  `Destinataire` varchar(255) NOT NULL,
  `Message` text NOT NULL,
  `Dateenvoi` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `ex_user` (`Expediteur`),
  KEY `de_user` (`Destinataire`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `publication` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `HASH` varchar(255) NOT NULL,
  `discription` text DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `datepub` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_user_pub` (`HASH`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `publication_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `HASH` varchar(255) NOT NULL,
  `id_publication` int(11) NOT NULL,
  `discription` text NOT NULL,
  `date_comment` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_C_USER` (`HASH`),
  KEY `fk_C_Pub` (`id_publication`),
  CONSTRAINT `fk_C_Pub` FOREIGN KEY (`id_publication`) REFERENCES `publication` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `table_suivi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `HASH_ID` varchar(255) NOT NULL,
  `HASH_ID_SUIVI` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `usertable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `genner` char(1) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` text NOT NULL,
  `tele` varchar(10) NOT NULL,
  `photo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `user_hash` (
  `id-user` int(11) NOT NULL,
  `HASH_ID` varchar(255) NOT NULL,
  UNIQUE KEY `id-user` (`id-user`),
  CONSTRAINT `fk_1` FOREIGN KEY (`id-user`) REFERENCES `usertable` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE DEFINER=`root`@`localhost` TRIGGER `ass_hash` AFTER INSERT ON `association` FOR EACH ROW INSERT INTO ass_hash (id_ASS, HASH_ID)
SELECT NEW.id, SHA2(CONCAT('ASS', NEW.id), 256)//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE DEFINER=`root`@`localhost` TRIGGER `d1` AFTER INSERT ON `messages` FOR EACH ROW UPDATE conversations set conversations.Date_M=CURRENT_TIMESTAMP()
WHERE conversations.id=new.id_Conv//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE DEFINER=`root`@`localhost` TRIGGER `user_hash` AFTER INSERT ON `usertable` FOR EACH ROW INSERT INTO user_hash
SELECT NEW.id, SHA2(CONCAT('USER', NEW.id), 256)//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
