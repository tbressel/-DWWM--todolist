<?php

session_start();

// si le token n'est pas définit OU que l'heure actuelle est supérieur à l'heure définit du token
// alors on regénère un token PUIS une nouvelle heure d'expiration
if (!isset($_SESSION['token']) || time() > $_SESSION['tokenExpire']) {
    $_SESSION['token'] = md5(uniqid(mt_rand(), true));
    $_SESSION['tokenExpire'] = time() + 15 * 60;
}
?>