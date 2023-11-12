DROP DATABASE IF EXISTS TODOLIST;
CREATE DATABASE IF NOT EXISTS TODOLIST;
USE TODOLIST;

CREATE TABLE `task` (
  `id_task` smallint NOT NULL AUTO_INCREMENT,
  `task_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `task_state` tinyint UNSIGNED DEFAULT NULL,
  `task_order` smallint NOT NULL,
  `task_date` DATE,
  PRIMARY KEY (`id_task`)
);

INSERT INTO `task` (`id_task`, `task_name`, `task_state`, `task_order`, `task_date`) VALUES
(1, 'Revoir les cours sur Github', 0, 1, '2023-11-12'),
(2, 'Ecouter Guillaume en cours', 0, 2, '2023-11-13'),
(3, 'Travailler tous les soirs', 0, 3, '2023-11-14'),
(4, 'Ne pas travailler la nuit', 0, 4, '2023-11-15'),
(5, 'Arriver à l heure', 0, 5, '2023-11-16');

ALTER TABLE `task`
  MODIFY `id_task` smallint NOT NULL AUTO_INCREMENT;