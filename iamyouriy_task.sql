
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


DROP TABLE IF EXISTS `task`;
CREATE TABLE `task` (
  `id_task` int(10) NOT NULL,
  `usr_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `task_desc` text NOT NULL,
  `complet` int(11) NOT NULL DEFAULT '0',
  `is_edit` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `task`
  ADD PRIMARY KEY (`id_task`);

ALTER TABLE `task`
  MODIFY `id_task` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

