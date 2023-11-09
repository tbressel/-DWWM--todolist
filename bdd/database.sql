DROP DATABASE IF EXISTS TODOLIST;

CREATE DATABASE IF NOT EXISTS TODOLIST;

USE TODOLIST;


CREATE TABLE `task` (
  `id_task` smallint NOT NULL,
  `task_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `task_state` tinyint UNSIGNED DEFAULT NULL,
  `task_priority` smallint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
​
--
-- Déchargement des données de la table `task`
--
​
INSERT INTO `task` (`id_task`, `task_name`, `task_state`, `task_priority`, `task_order`) VALUES
(1, 'Passer le balais', 0, 1,1),
(2, 'Faire la vaisselle', 0, 2,2),
(3, 'Aspirer le tapis', 0, 3,3),
(4, 'Faire les courses', 0, 4,4),
(5, 'nouvelle taches', 0, 0,5),
(6, 'coucou', 0, 0,6),
(7, 'coucoucouc', 0, 0,7),
(8, 'thomas', 0, 8,8);
​
--
-- Index pour les tables déchargées
--
​
--
-- Index pour la table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id_task`);
​
--
-- AUTO_INCREMENT pour les tables déchargées
--
​
--
-- AUTO_INCREMENT pour la table `task`
--
ALTER TABLE `task`
  MODIFY `id_task` smallint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;
​
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;