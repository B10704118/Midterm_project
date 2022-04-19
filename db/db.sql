SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+08:00";


CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `mes` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `name` varchar(64)NOT NULL,
  `title` varchar(256) NOT NULL,
  `content` varchar(256) NOT NULL,
  `file` longblob NOT NULL,
  `type` varchar(64) NOT NULL,
  `file_name` varchar(64) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `photo` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `image` longblob NOT NULL,
  `type` varchar(64) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `title` (
  `name` char(64) NOT NULL,
  PRIMARY KEY (name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `title` (`name`) VALUES ("留言板"); 