

<?php
include '../../includes/_dbconnect.php';
// la tâche n'est ajouté que SI : 
// - une clé 'token' est définie dans le tableau $_POST ET $_SESSION
// ET si 
// - ces données de ces deux clées sont sctrictement identiques


session_start();

 
// Supprime une tâche
if (isset($_GET['id_task'])) {
    $id_task = $_GET['id_task'];

    // requête 
    $query = $connexion->prepare('DELETE FROM task WHERE id_task = :id_task');
    $query->bindValue(':id_task', $id_task, PDO::PARAM_INT);
    $query->execute();
}

header('Location:../../index.php'); 
exit();

?>
