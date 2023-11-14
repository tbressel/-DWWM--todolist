<?php
include '../../includes/_functions.php';
getIdentification("../../.env");
include '../../includes/_dbconnect.php';
session_start();

// Vérification du token CSRF
// checkCSRF('http://localhost/todolist/');

if (isset($_POST['token']) && isset($_SESSION['token']) && hash_equals($_SESSION['token'], $_POST['token'])) {
    // get data form
    $token = $_POST['token'];
    $id_task = $_POST['id_task'];
    $selected_themes = $_POST['selected_themes'];

    // check if id_task in $_POST exists in task table
    $checkTaskQuery = $connexion->prepare('SELECT * FROM task WHERE id_task = :id_task');
    $checkTaskQuery->bindValue(':id_task', $id_task, PDO::PARAM_INT);
    $checkTaskQuery->execute();
    $taskExists = $checkTaskQuery->fetch();

    if ($taskExists) {
        $connexion->beginTransaction();

        // Insertion des liens avec les thèmes sélectionnés
        if (!empty($selected_themes)) {
            $query = $connexion->prepare("INSERT INTO `have` (id_task, id_theme) VALUES (:id_task, :id_theme)");

            foreach ($selected_themes as $theme_id) {
                $query->bindValue(':id_task', $id_task, PDO::PARAM_INT);
                $query->bindValue(':id_theme', $theme_id, PDO::PARAM_INT);
                $query->execute();
            }

            $_SESSION['notif'] = 'Ajout des theme OK';
        } else {
            $_SESSION['error'] = 'Aucun thème sélectionné.';
        }

        $connexion->commit();
    } else {
        $_SESSION['error'] = 'L\'id_task n\'existe pas dans la table task.';
    }
}

header('Location:../../index.php');
?>
