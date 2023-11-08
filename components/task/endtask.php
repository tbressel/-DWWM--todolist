
<?php
include '../../includes/_dbconnect.php';
// la tâche n'est ajouté que SI : 
// - une clé 'token' est définie dans le tableau $_POST ET $_SESSION
// ET si 
// - ces données de ces deux clées sont sctrictement identiques

session_start();

$id = strip_tags($_GET['id']);

var_dump($id);
var_dump($_GET);

   if (strlen($id) > 0) {
       // on prépare la requête en récupérant la variable $task_name du formulaire dans le PDO
        $query = $connexion->prepare('UPDATE task SET task_state = 1 WHERE id_task = :id');

       // protection contre la faillt XSS
        $query->bindValue(':id', $id, PDO::PARAM_STR);

       // on execute la requête
        $query->execute();
    }


       header('Location:../../index.php'); 
       exit();
