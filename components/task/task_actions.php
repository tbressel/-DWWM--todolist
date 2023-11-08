<?php
include '../../includes/_dbconnect.php';

session_start();

if (isset($_GET['action'])) {

    if ($_GET['action'] == 'delete') {

        // Supprime une tâche
            if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // requête 

            $query = $connexion->prepare('DELETE FROM task WHERE id_task = :id');
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->execute();
        }
    } else if ($_GET['action'] == 'done') {

        $id = strip_tags($_GET['id']);
        if (strlen($id) > 0) {
            // on prépare la requête en récupérant la variable $task_name du formulaire dans le PDO
            $query = $connexion->prepare('UPDATE task SET task_state = 1 WHERE id_task = :id');

            // protection contre la faille XSS
            $query->bindValue(':id', $id, PDO::PARAM_STR);

            // on execute la requête
            $query->execute();
        }
    }
}


header('Location:../../index.php');
