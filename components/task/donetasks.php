<?php
// $query = $connexion->prepare('SELECT * FROM task WHERE task_state = 0 ORDER BY id_task DESC');
$query = $connexion->prepare('SELECT * FROM task WHERE task_state = 1 ORDER BY task_order DESC');
$query->execute();
$taskList = $query->fetchAll();
if (!empty($taskList)) {

    foreach ($taskList as $task) {
?>
        <ul>
            <li class="main__container" data-id="<?= $task['id_task'] ?>">
                <div class="left__container">
                    <div class="top__container">
                        <!-- <a href="components/task/task_actions.php?action=todo&token=<?= $_SESSION['token'] ?>&id=<?= $task['id_task'] ?>"><span class="btn">✅</span></a> -->
                        <button class="js-todo-btn" type="button" data-id="<?= $task['id_task'] ?>">✅</button>

                        <div class="top__container--task_name">
                            <p><?= $task['task_name'] ?></p>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    <?php }
} else { ?>
    <div>
        <p class="youpi">😓</p>
        <h2>RIEN est fait, tout reste à faire ...</h2>
    </div>
<?php } ?>