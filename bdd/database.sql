DROP DATABASE IF EXISTS TODOLIST;
CREATE DATABASE IF NOT EXISTS TODOLIST;
USE TODOLIST;

CREATE TABLE task(
   id_task INT AUTO_INCREMENT,
   task_name VARCHAR(50) NOT NULL,
   task_state BOOLEAN NOT NULL,
   task_order TINYINT NOT NULL,
   task_date DATE NOT NULL,
   PRIMARY KEY(id_task)
);

CREATE TABLE theme(
   id_theme INT AUTO_INCREMENT,
   theme_name VARCHAR(50),
   PRIMARY KEY(id_theme)
);

CREATE TABLE have(
   id_task INT,
   id_theme INT,
   PRIMARY KEY(id_task, id_theme),
   FOREIGN KEY(id_task) REFERENCES task(id_task),
   FOREIGN KEY(id_theme) REFERENCES theme(id_theme)
);

INSERT INTO `task` (`id_task`, `task_name`, `task_state`, `task_order`, `task_date`) VALUES
(1, 'Revoir les cours sur Github', 0, 1, '2023-11-12'),
(2, 'Ecouter Guillaume en cours', 0, 2, '2023-11-13'),
(3, 'Travailler tous les soirs', 0, 3, '2023-11-14'),
(4, 'Ne pas travailler la nuit', 0, 4, '2023-11-15'),
(5, 'Arriver à l heure', 0, 5, '2023-11-16');


INSERT INTO `theme` (`id_theme`,`theme_name`) VALUES
(1,'travail'),
(2,'projet web'),
(3,'maison'),
(4,'recherche de stage'),
(5,'revision'),
(6,'vérification');