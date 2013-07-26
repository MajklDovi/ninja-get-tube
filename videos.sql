SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
CREATE TABLE IF NOT EXISTS `videos` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL DEFAULT '',
  `image` varchar(256) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL DEFAULT '',
  `author` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_slovak_ci NOT NULL DEFAULT '',
  `description` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_slovak_ci NOT NULL DEFAULT '',
  `link` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_slovak_ci NOT NULL DEFAULT '',
  `p` varchar(20) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin2 COLLATE=latin2_czech_cs AUTO_INCREMENT=16 ;
INSERT INTO `videos` (`id`, `title`, `image`, `author`, `description`, `link`, `p`) VALUES
(3, 'Just Jack - Doctor Doctor (Fred Falke remix)', 'http://i1.ytimg.com/vi/3f3n4DZvaIg/default.jpg', 'sndsfthndrgrnd', 'Choon.', 'http://www.youtube.com/watch?v=3f3n4DZvaIg', '3f3n4DZvaIg'),
(4, 'James LaBrie - Slightly Out Of Reach', 'http://i1.ytimg.com/vi/Dm6jm_hAbWc/default.jpg', 'cemeteryroads', 'James LaBrie, frome the album Elements Of Persuasion, the song Slightly Out Of Reach.', 'http://www.youtube.com/watch?v=Dm6jm_hAbWc', 'Dm6jm_hAbWc'),
(5, 'Dream Theater - Forsaken [Live 2008]', 'http://i1.ytimg.com/vi/gkcAqknKBO4/default.jpg', 'roadrunnerrecords', 'Â© 2008 WMG\nForsaken [Live 2008]', 'http://www.youtube.com/watch?v=gkcAqknKBO4', 'gkcAqknKBO4'),
(9, 'Eva - Nightwish', 'http://i1.ytimg.com/vi/tspgqtWA4HA/default.jpg', 'wishofthenightnicky', 'Eva by Nightwish, an absolutely amazing song. The first song to be revealed since the beginning of the new Nightwish era.', 'http://www.youtube.com/watch?v=tspgqtWA4HA', 'tspgqtWA4HA'),
(14, 'Dream Theater - Wither', 'http://i1.ytimg.com/vi/-boKk8uhmcY/default.jpg', 'dreamtheater', '© 2009 WMG\r\nWither (Video)', 'http://www.youtube.com/watch?v=-boKk8uhmcY', '-boKk8uhmcY'),
(15, 'Dream Theater - Another Day', 'http://i1.ytimg.com/vi/LYtiDCXLAcQ/default.jpg', 'dreamtheater', '© 2008 WMG\r\nAnother Day (Video)', 'http://www.youtube.com/watch?v=LYtiDCXLAcQ', 'LYtiDCXLAcQ');