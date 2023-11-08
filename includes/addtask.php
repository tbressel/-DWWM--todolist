
<?php
include '_dbconnect.php';
// la tâche n'est ajouté que SI : 
// - une clé 'token' est définie dans le tableau $_POST ET $_SESSION
// ET si 
// - ces données de ces deux clées sont sctrictement identiques
var_dump($connexion);


session_start();


var_dump($_SESSION);
var_dump($_POST);


if (isset($_POST['token']) && isset($_SESSION['token']) && $_SESSION['token'] === $_POST['token']) {

 $task_name = strip_tags($_POST['task_name']);

    if (strlen($task_name) > 0) {
        // on prépare la requête en récupérant la variable $task_name du formulaire dans le PDO
         $query = $connexion->prepare('INSERT INTO task (task_name, task_state, task_priority)
     VALUES (:task_name,0,0)');



// METHODE 1
        // protection contre la faillt XSS
         $query->bindValue(':task_name', $task_name, PDO::PARAM_STR);

        // on execute la requête
         $query->execute();
     }
// METHODE 2
            // on utilise pas bindValue si on utilise les paramètre de execute
           // on execute la requête
            // $query->execute([
            //    'task_name'=> $task
            // ]);
        }

