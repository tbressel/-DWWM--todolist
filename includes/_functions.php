<?php
/**
 * Return the current page name including its path
 *
 * @return string
 */
function getCurrentPageName(): string
{
    return  basename($_SERVER['SCRIPT_NAME']);
}


/**
 * Get array from data for current page data
 *
 * @param array $pages
 * @return array
 */
function getCurrentPageData(array $pages): ?array
{
    // foreach($pages as $page){
    //     if($page['file'] === getCurrentPageName()){
    //        return $page;
    //     }
    // }
    // return NULL;

    return current(array_filter($pages, fn ($p) => $p['file'] === getCurrentPageName()));
}

/**
 * Generate style sheet links
 *
 * @param array $styleSheetFiles
 * @return string
 */
function generateStyleSheetLinks(array $styleSheetFiles): string
{
    return implode('', array_map(fn ($cssFile) => "<link rel=\"stylesheet\" href=\"{$cssFile}\">", $styleSheetFiles));
}


function getLanguageType(array $pages): string 
{
    return $lang = implode("", array_column($pages,'language'));

};


function generateToken() {
    // Si le jeton n'est pas défini OU que l'heure actuelle est supérieure à l'heure d'expiration du jeton
    // alors on régénère un jeton ET une nouvelle heure d'expiration
    if (!isset($_SESSION['token']) || time() > $_SESSION['tokenExpire']) {
        $_SESSION['token'] = bin2hex(random_bytes(32)); // Génère un jeton de 64 caractères (32 octets)
        $_SESSION['tokenExpire'] = time() + 15 * 60;
    }
}




function checkCSRF(string $url): void 
{
    if (!isset($_SERVER['HTTP_REFERER']) || !str_contains($_SERVER['HTTP_REFERER'], 'http://localhost/todolist/')) {
        $_SESSION['error'] = 'error_referer';
    } else if (
        !isset($_SESSION['token']) || !isset($_REQUEST['token']) || $_REQUEST['token'] !== $_SESSION['token'] || $_SESSION['tokenExpire'] < time()
    ) {
        $_SESSION['error'] = 'error_token';
    }

    if (isset($_SESSION['error'])) {
        header('Location: ' . $url);
        exit;
    }
}


function bddConnexion() {
    try {
        $connexion = new PDO(
            'mysql:host=localhost;dbname=TODOLIST;charset=utf8mb4',
            'zisquier',
            'pass');
        $connexion -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $connexion;
    
    } catch (PDOException $getError) {
        echo 'Erreur : ' . $getError->getMessage();
        die();
    }
}


function getMaxOrder ($connexion) {
    $query = $connexion->prepare('SELECT MAX(task_order) AS max_order FROM task');
    $query->execute();
    $queryResult = $query->fetch();
    $max_order = $queryResult['max_order'];
    var_dump($queryResult);
    return $max_order + 1;
}




function showMessages(string $action): void
{
    global $isQueryOK;
    global $query;
    switch ($action) {
        case "delete":
            if ($isQueryOK && $query->rowCount() === 1) {
                $_SESSION['notif'] = 'La tâche a bien été effacée';
            } else {
                $_SESSION['error'] = 'Erreur lors de la suppression de tâche';
            }
            break;
        case "done":
            if ($isQueryOK && $query->rowCount() === 1) {
                $_SESSION['notif'] = 'Tâche effecutéd';
            } else {
                $_SESSION['error'] = 'Cette tâche ne peut pas être effectuée';
            }
            break;
            case "todo":
                if ($isQueryOK && $query->rowCount() === 1) {
                    $_SESSION['notif'] = 'Revoici cette tâche à effectuer';
                } else {
                    $_SESSION['error'] = 'Cette tâche ne peut pas être effectuée encore';
                }
                break;
        case "modify":
            if ($isQueryOK && $query->rowCount() === 1) {
                $_SESSION['notif'] = 'Tâche modifié';
            } else {
                $_SESSION['error'] = 'Cette tâche ne peut pas être modifiée';
            }
            break;
        case "add":
        if ($isQueryOK && $query->rowCount() === 1) {
            $_SESSION['notif'] = 'Tâche créée';
        } else {
            $_SESSION['error'] = 'Erreur lors de la création de tâche';
        }
        break;
        case "date":
        if ($isQueryOK && $query->rowCount() === 1) {
            $_SESSION['notif'] = 'La date à été changée';
        } else {
            $_SESSION['error'] = 'Erreur dans la modification de la date';
        }
        break;
    }
}
