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


