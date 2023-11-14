<?php
include '../../includes/_functions.php';
getIdentification("../../.env");
include '../../includes/_dbconnect.php';
session_start();

// Vérification du token CSRF
// checkCSRF('http://localhost/todolist/');

if (isset($_POST['token']) && isset($_SESSION['token']) && hash_equals($_SESSION['token'], $_POST['token'])) {
    // Récupération des données du formulaire
    $token = $_POST['token'];
    $id_task = $_POST['id_task'];
    $selected_themes = $_POST['selected_themes'];

    // Vérification si l'ID de tâche existe dans la table task
    $checkTaskQuery = $connexion->prepare('SELECT COUNT(*) FROM task WHERE id_task = :id_task');
    $checkTaskQuery->bindValue(':id_task', $id_task, PDO::PARAM_INT);
    $checkTaskQuery->execute();
    $taskExists = $checkTaskQuery->fetchColumn();

    if ($taskExists) {
        // Insertion des liens avec les thèmes sélectionnés
        if (!empty($selected_themes)) {
            $placeholders = rtrim(str_repeat('(?, ?), ', count($selected_themes)), ', ');
            $query = $connexion->prepare("INSERT INTO `have` (id_task, id_theme) VALUES $placeholders");

            foreach ($selected_themes as $index => $theme_id) {
                $query->bindValue(2 * $index + 1, $id_task, PDO::PARAM_INT);
                $query->bindValue(2 * $index + 2, $theme_id, PDO::PARAM_INT);
            }

            $query->execute();

            $_SESSION['notif'] = 'Liens entre la tâche et les thèmes ajoutés avec succès.';
        } else {
            $_SESSION['error'] = 'Aucun thème sélectionné.';
        }
    } else {
        $_SESSION['error'] = 'L\'ID de tâche fourni n\'existe pas dans la table task.';
    }
}

header('Location:../../index.php');
?>
