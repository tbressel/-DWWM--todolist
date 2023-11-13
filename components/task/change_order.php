<?php
include '../../includes/_functions.php';
getIdentification("../../.env");
include '../../includes/_dbconnect.php';
session_start();

if (isset($_GET['id']) && isset($_GET['action'])) {
    $task_id = $_GET['id'];
    $task_action = $_GET['action'];

    // Get id_order by the id_task
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
    }

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

 header('Location:../../index.php');
 
?>
