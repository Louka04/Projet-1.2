CREATE TABLE `taches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `categorie` varchar(50) NOT NULL,
  `statut` varchar(20) NOT NULL DEFAULT 'en_cours',
  `date_creation` datetime DEFAULT current_timestamp(),
  `date_fin` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci

