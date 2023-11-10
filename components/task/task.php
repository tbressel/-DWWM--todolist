<?php
// $query = $connexion->prepare('SELECT * FROM task WHERE task_state = 0 ORDER BY id_task DESC');
$query = $connexion->prepare('SELECT * FROM task WHERE task_state = 0 ORDER BY task_order DESC');
$query->execute();
$taskList = $query->fetchAll();
foreach ($taskList as $task) {
?>
    <ul>
        <li class="main__container" data-id="<?= $task['id_task'] ?>">
            <div class="left__container">
                <div class="top__container">
                    <a href="components/task/task_actions.php?action=done&token=<?= $_SESSION['token'] ?>&id=<?= $task['id_task'] ?>"><span class="btn">☑️</span></a>
                    <div class="top__container--task_name">
                        <p>
                        <form action="components/task/task_actions.php?action=update&token=<?= $_SESSION['token'] ?>&id=<?= $task['id_task'] ?>" method="POST">

                            <input type="text" name="new_task_name" value="<?= $task['task_name'] ?>">
                            <input type="submit" value="Modifier">
                        </form>
                        </p>
                    </div>
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
<?php
}
?>