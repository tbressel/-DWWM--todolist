<?php
include '../../includes/_dbconnect.php';
// la tâche n'est ajouté que SI : 
// - une clé 'token' est définie dans le tableau $_POST ET $_SESSION
// ET si 
// - ces données de ces deux clées sont sctrictement identiques
session_start();











        header('Location:../../index.php'); 
        exit();
