<?php
try {
    $connexion = new PDO(
        'mysql:host=localhost;dbname=TODOLIST;charset=utf8mb4',
        'zisquier',
        'pass');
    $connexion -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $getError) {
    echo 'Erreur : ' . $getError->getMessage();
    die();
}



$query = $connexion->prepare('SELECT * FROM task');
$query->execute();
$data = $query->fetchAll();

echo '<ul>';
    foreach($data as $d) {
        echo '<li>'.$d['task_name'] . '</li>';
    }
echo '</ul>';




// $query = $connexion->prepare('INSERT INTO task (task_name)
// VALUES (:task_name)');

// $query-> bindValue(':task_name', $task_name, PDO::PARAM_STR);

// $query->execute();
?>