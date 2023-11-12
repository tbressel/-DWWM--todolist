<?php
// $query = $connexion->prepare('SELECT * FROM task WHERE task_state = 0 ORDER BY id_task DESC');
$query = $connexion->prepare('SELECT * FROM task WHERE task_state = 0 ORDER BY task_order DESC');
$query->execute();
$taskList = $query->fetchAll();
if (!empty($taskList)) {
foreach ($taskList as $task) {
?>
    <ul>
        <li class="main__container" data-id="<?= $task['id_task'] ?>">
            <div class="left__container">
                <div class="top__container">
                    <a href="components/task/task_actions.php?action=done&token=<?= $_SESSION['token'] ?>&id=<?= $task['id_task'] ?>"><span class="btn">☑️</span></a>
                    <div class="top__container--task_name">

                        <form action="components/task/task_actions.php" method="POST">
                            <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                            <input type="hidden" name="id_task" value="<?= $task['id_task'] ?>">
                            <input type="hidden" name="action" value="modify">
                            <label for="new_task_name"></label>
                            <input type="text" id="new_task_name" name="new_task_name" value="<?= $task['task_name'] ?>">
                            <input type="submit" value="✒️">
                        </form>
                    </div>
                </div>
                <div class="remind_date">
                <form action="components/task/task_actions.php" method="POST">
                    <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
                    <input type="hidden" name="id_task" value="<?= $task['id_task'] ?>">
                    <input type="hidden" name="action" value="date">
                    <label for="new_date">Date de rappel:</label>

                    <input type="date" id="new_date" name="new_date" value="<?= $task['task_date'] ?>" min="<?= $task['task_date'] ?>">
                    <input type="submit" value="✒️">
                </form>
                </div>
            </div>
            <div class="right__container">

                <div class="right__container--arrows">
                    <p class="btn up_btn">
                        <a href="components/task/change_order.php?action=up&id=<?= $task['id_task'] ?>">⬆️</a>
                    </p>
                    <p class="task__action">
                    <div class="btn">
                        <a href="components/task/task_actions.php?action=delete&token=<?= $_SESSION['token'] ?>&id=<?= $task['id_task'] ?>">🗑️</a>
                    </div>
                    </p>
                    <p class="btn down_btn">
                        <a href="components/task/change_order.php?action=down&id=<?= $task['id_task'] ?>">⬇️</a>
                    </p>
                </div>
            </div>
        </li>
    </ul>
    <?php } } else { ?>
    <div>
        <p class="youpi">🥳</p>
        <h2>YOUPIIIIII !! y'a plus rien à faire !!</h2>
    </div>
<?php } ?>