<?php

include './includes/_functions.php';
getIdentification(".env");
include './includes/_dbconnect.php';
session_start();

header('content-type:application/json');

echo json_encode([
    'result' => true,
    'message' => 'Entrée dans le JSON'
]);


$inputJSON = file_get_contents('php://input');
$inputData = json_decode($inputJSON, true);



if ((isset($_GET['action']) || isset($_POST['action'])) || (isset($inputData['action']) || isset($inputData['action']))) {

    echo json_encode([
        'result' => true,
        'message' => 'Entrée dans la condition principale'
    ]);

    // ------------------------------------------------------------------------------
    // --------------------------     DELETE TASK       -----------------------------
    // ------------------------------------------------------------------------------
    if (isset($_GET['action']) && $_GET['action'] === 'delete') {

        echo json_encode([
            'result' => true,
            'message' => 'Effacer une tache'
        ]);

        if (isset($_GET['id'])) {

            $id = htmlspecialchars($_GET['id']);

            if(empty($id)) {                
                echo json_encode([
                    'result' => false,
                    'message' => 'Tâche inconnue'
                ]);   
                exit;             
            }

            $connexion->beginTransaction();

            $query = $connexion->prepare('DELETE FROM have WHERE id_task = :id');
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $isQueryOK = $query->execute();

            $query = $connexion->prepare('DELETE FROM task WHERE id_task = :id');
            $query->bindValue(':id', $id, PDO::PARAM_INT);
            $isQueryOK = $query->execute();

            showMessages("delete");
            $resultat = $connexion->commit();
        }
        exit;
    }
    // ------------------------------------------------------------------------------
    // --------------------------     DONE TASK       -----------------------------
    // ------------------------------------------------------------------------------ 
    else if (isset($_GET['action']) && $_GET['action'] === 'done' && isset($_GET['id'])) {

        $id = htmlspecialchars($_GET['id']);

        if (!empty($id)) {
            $query = $connexion->prepare('UPDATE task SET task_state = 1 WHERE id_task = :id');
            $query->bindValue(':id', $id, PDO::PARAM_STR);
            $isQueryOK = $query->execute();

            showMessages("done");
        }
    }  
    // ------------------------------------------------------------------------------
    // --------------------------     TODO TASK       -----------------------------
    // ------------------------------------------------------------------------------ 
    else if (isset($_GET['action']) && $_GET['action'] === 'todo' && isset($_GET['id'])) {

        $id = htmlspecialchars($_GET['id']);

        if (!empty($id)) {
            $query = $connexion->prepare('UPDATE task SET task_state = 0 WHERE id_task = :id');
            $query->bindValue(':id', $id, PDO::PARAM_STR);
            $isQueryOK = $query->execute();
            
            showMessages("todo");
        }
    }
    // ------------------------------------------------------------------------------
    // --------------------------     MODIFY TASK NAME       ------------------------
    // ------------------------------------------------------------------------------ 
    else if (isset($inputData['action']) && $inputData['action'] === 'modify' && isset($inputData['id_task'])) {

        echo json_encode([
            'result' => true,
            'message' => 'Modification dune tache'
        ]);



        $new_task_name = htmlspecialchars($inputData['new_task_name']);
        $id_task = htmlspecialchars($inputData['id_task']);

        $query = $connexion->prepare('UPDATE task SET task_name = :new_task_name WHERE id_task = :id_task');
        $query->bindValue(':new_task_name', $new_task_name, PDO::PARAM_STR);
        $query->bindValue(':id_task', $id_task, PDO::PARAM_INT);
        $isQueryOK = $query->execute();

        showMessages("modify");
    } 
    // ------------------------------------------------------------------------------
    // --------------------------     MODIFY DATE       ------------------------
    // ------------------------------------------------------------------------------ 
    else if (isset($inputData['action']) && $inputData['action'] === 'modify' && isset($inputData['id_task'])) {

        echo json_encode([
            'result' => true,
            'message' => 'Modification dune DATE'
        ]);



        $new_task_name = htmlspecialchars($inputData['new_task_name']);
        $id_task = htmlspecialchars($inputData['id_task']);

        $query = $connexion->prepare('UPDATE task SET task_name = :new_task_name WHERE id_task = :id_task');
        $query->bindValue(':new_task_name', $new_task_name, PDO::PARAM_STR);
        $query->bindValue(':id_task', $id_task, PDO::PARAM_INT);
        $isQueryOK = $query->execute();

        showMessages("modify");
    } 
    // ------------------------------------------------------------------------------
    // --------------------------     MODIFY ORDER TASK       ------------------------
    // ------------------------------------------------------------------------------ 
    else if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] === "up" || $_GET['action'] === "down") {
    
        // get datas from GET
        $task_id = $_GET['id'];
        $task_action = $_GET['action'];
    
        // Get id_order data by the id_task selected on DOM
        $currentOrder = $connexion->prepare('SELECT task_order FROM task WHERE id_task = :task_id');
        $currentOrder->bindValue(':task_id', $task_id, PDO::PARAM_INT);
        $currentOrder->execute();
        $currentOrderResult = $currentOrder->fetch();
    
        // get int number from task_order of the chosen task    
        $currentOrder = $currentOrderResult['task_order'];
    
        // Prepare down or up query depends of the user action
     if ($task_action === 'down') {
    
        // If $currentOrder > next task_order
            $changeOrderQuery = $connexion->prepare('SELECT id_task, task_order FROM task 
                                   WHERE task_order < :current_order 
                                   ORDER BY task_order DESC LIMIT 1');
        } else {
        // If $currentOrder < next task_order    
            $changeOrderQuery = $connexion->prepare('SELECT id_task, task_order FROM task 
                                  WHERE task_order > :current_order 
                                  ORDER BY task_order ASC LIMIT 1');
        };
    
         $changeOrderQuery->bindValue(':current_order', $currentOrder, PDO::PARAM_INT);
         $changeOrderQuery->execute();
         $nextTaskResult = $changeOrderQuery->fetch();
    
    // Update the order with current order and next order
        if ($nextTaskResult) {
            $nextTaskId = $nextTaskResult['id_task'];
            $nextTaskOrder = $nextTaskResult['task_order'];
    
            // Update first task with next one
            $updateFirstTaskOrderWithNextTask = $connexion->prepare('UPDATE task SET task_order = :next_order WHERE id_task = :task_id');
            $updateFirstTaskOrderWithNextTask->bindValue(':next_order', $nextTaskOrder, PDO::PARAM_INT);
            $updateFirstTaskOrderWithNextTask->bindValue(':task_id', $task_id, PDO::PARAM_INT);
            $updateFirstTaskOrderWithNextTask->execute();
    
            // Update next task with first task
            $updateNextTaskOrderWithFirstTask = $connexion->prepare('UPDATE task SET task_order = :current_order WHERE id_task = :next_task_id');
            $updateNextTaskOrderWithFirstTask->bindValue(':current_order', $currentOrder, PDO::PARAM_INT);
            $updateNextTaskOrderWithFirstTask->bindValue(':next_task_id', $nextTaskId, PDO::PARAM_INT);
            $updateNextTaskOrderWithFirstTask->execute();
        }

    } 
     // ------------------------------------------------------------------------------
    // --------------------------     ADD TASK       ------------------------
    // ------------------------------------------------------------------------------ 
    else if (isset($inputData['action']) && $inputData['action'] === 'add') {

        echo json_encode([
            'result' => true,
            'message' => 'On ajoute '
        ]);



        $task_name = htmlspecialchars($inputData['task_name']);
    
        // check the length of the data
        if (strlen($task_name) > 0) {
            $connexion->beginTransaction();
    
            $max_order = getMaxOrder($connexion);
                    
            $task_date = new DateTime();
            $task_date = $task_date->format('Y-m-d');
            // query preparation with PDO datas
            $query = $connexion->prepare('INSERT INTO task (task_name, task_state, task_order, task_date)
                                            VALUES (:task_name,0,:max_order,:task_date)');
            // alias variables with PDO syntax against SQL injection code
            $query->bindValue(':task_name', $task_name, PDO::PARAM_STR);
            $query->bindValue(':max_order', $max_order, PDO::PARAM_INT);
            $query->bindValue(':task_date', $task_date, PDO::PARAM_STR);
            // query execution get into antoher variable for check into getMessages function
            $isQueryOK = $query->execute();
    
            $connexion->commit();
    
            showMessages("add");
    
        } else {
            $_SESSION['error'] = 'Il faut saisire un texte';
        }
    }

} else {
    $_SESSION['error'] = 'Aucune action ne peut être effectuée';
}

exit;

