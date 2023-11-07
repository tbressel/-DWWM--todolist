<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<form action="" method="GET">
    <label for="title_field"></label>
        <input type="text" name="title_videogame" id="title_field" placeholder="videogame title" maxlength="25" required>
    <input type="submit" value="envoyer">
</form>

<?php
// if (isset($_GET['title_videogame'])) {
//     var_dump($_GET);
// }



// $title_videogame = "<h1> Titre </h1>";
// echo $title_videogame;
// echo strip_tags($title_videogame);
// echo htmlspecialchars($title_videogame);
?>

<?php
try {
    $connexion = new PDO(
        'mysql:host=localhost;dbname=BD_GAMEGOGS;charset=utf8mb4',
        'zisquier',
        'pass');
    $connexion -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $getError) {
    echo 'Erreur : ' . $getError->getMessage();
    die(); // Arrêter le script en cas d'erreur de connexion à la base de données.
}


$query = $connexion->prepare('INSERT INTO video_games (title_videogame)
VALUES (:title_videogame)');
// on vérifie les données reçues
$query-> bindValue(':title_videogame', $title_videogame, PDO::PARAM_STR);
// On execute la requête
$query->execute();


// coucou'; INSERT INTO video_games (title_videogame) VALUES ('drogue') --



// $idTest = 7;

// On prepare la requête envoyée dans une variable.
// $query = $connexion->prepare('SELECT * FROM video_games 
//                             WHERE id_videogame = :idTest');

$query = $connexion->prepare('SELECT * FROM video_games');

// on vérifie les données reçues
// $query-> bindValue(':idTest', $idTest, PDO::PARAM_INT);

// On execute la requête
$query->execute();

// var_dump($connexion->lastInsertId());
// var_dump($query->rowCount());

// On fetch les données reçu dans la variable $dataToStore
$data = $query->fetchAll();

echo '<ul>';
    foreach($data as $d) {
        echo '<li>'. $d['id_videogame'].' - '.$d['title_videogame'] . '</li>';
    }
echo '</ul>';
    
?>

<script>
let data = <?php echo json_encode($data); ?>;
localStorage.setItem('myDatabaseData', JSON.stringify(data));
</script>
</body>
</html>
