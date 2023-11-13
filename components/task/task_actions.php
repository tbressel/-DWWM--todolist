<?php
include '../../includes/_functions.php';
getIdentification("../../.env");
include '../../includes/_dbconnect.php';
session_start();

// checkCSRF('../../index.php');

if (isset($_GET['action']) || isset($_POST['action'])) {
    if (isset($_GET['action']) && $_GET['action'] === 'delete') {
        if (isset($_GET['id'])) {
            $id = htmlspecialchars($_GET['id']);
            $query = $connexion->prepare('DELETE FROM task WHERE id_task = :id');
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $isQueryOK = $query->execute();
            showMessages("delete");
        }

        
    } else if (isset($_GET['action']) && $_GET['action'] === 'done' && isset($_GET['id'])) {
        $id = htmlspecialchars($_GET['id']);
        if (!empty($id)) {
            $query = $connexion->prepare('UPDATE task SET task_state = 1 WHERE id_task = :id');
            $query->bindValue(':id', $id, PDO::PARAM_STR);
            $isQueryOK = $query->execute();
            showMessages("done");
        }


    } else if (isset($_GET['action']) && $_GET['action'] === 'todo' && isset($_GET['id'])) {
        $id = htmlspecialchars($_GET['id']);
        if (!empty($id)) {
            $query = $connexion->prepare('UPDATE task SET task_state = 0 WHERE id_task = :id');
            $query->bindValue(':id', $id, PDO::PARAM_STR);
            $isQueryOK = $query->execute();
            showMessages("todo");
        }


    }
    
    else if (isset($_POST['action']) && $_POST['action'] === 'modify' && isset($_POST['id_task'])) {
        $new_task_name = htmlspecialchars($_POST['new_task_name']);
        $id_task = htmlspecialchars($_POST['id_task']);
        $query = $connexion->prepare('UPDATE task SET task_name = :new_task_name WHERE id_task = :id_task');
        $query->bindValue(':new_task_name', $new_task_name, PDO::PARAM_STR);
        $query->bindValue(':id_task', $id_task, PDO::PARAM_INT);
        $isQueryOK = $query->execute();
        showMessages("modify");


    } else if (isset($_POST['action']) && $_POST['action'] === 'date' && isset($_POST['id_task'])) {
        $new_date = htmlspecialchars($_POST['new_date']);
        $id_task = htmlspecialchars($_POST['id_task']);
        $query = $connexion->prepare('UPDATE task SET task_date = :new_date WHERE id_task = :id_task');
        $query->bindValue(':new_date', $new_date, PDO::PARAM_STR);
        $query->bindValue(':id_task', $id_task, PDO::PARAM_INT);
        $isQueryOK = $query->execute();
        showMessages("date");
    }
    else {
        $_SESSION['error'] = 'Aucune action ne peut pas être effectuée';
    }
}
 header('Location:../../index.php');



