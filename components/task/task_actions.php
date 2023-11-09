<?php
include '../../includes/_dbconnect.php';

session_start();

if (isset($_GET['action'])) {

    if ($_GET['action'] == 'delete') {

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $query = $connexion->prepare('DELETE FROM task WHERE id_task = :id');
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->execute();
        }
    } else if ($_GET['action'] == 'done') {

        $id = strip_tags($_GET['id']);
        if (strlen($id) > 0) {
            $query = $connexion->prepare('UPDATE task SET task_state = 1 WHERE id_task = :id');
            $query->bindValue(':id', $id, PDO::PARAM_STR);
            $query->execute();
        }
    } else if ($_GET['action'] == 'update') {
        
        if (isset($_POST['new_task_name'], $_POST['id'])) {
            $task_name = strip_tags($_POST['new_task_name']);
            $id = strip_tags($_POST['id']);
            $query = $connexion->prepare('UPDATE task SET task_name = :new_task_name WHERE id_task = :id');
            $query->bindValue(':new_task_name', $task_name, PDO::PARAM_STR);
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $query->execute();
        }
    }
}



header('Location:../../index.php');
