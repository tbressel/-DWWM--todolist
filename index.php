<?php
include_once 'includes/_config.php';
require_once 'includes/_functions.php';
include_once 'includes/_head.php';
include 'includes/_dbconnect.php';
?>

<body>

<?php include_once './components/header/header.php';?>
<?php include_once './components/form/form.php';?>
<?php include_once './components/task/task.php';?>

<?php

$task_name = "faire un truc";


$query = $connexion->prepare('INSERT INTO task (task_name) VALUES (:task_name)');
$query->bindValue(':task_name', $task_name, PDO::PARAM_STR);
$query->execute();


?>

<script src="./assets/scripts/script.js"></script>

</body>
</html>
