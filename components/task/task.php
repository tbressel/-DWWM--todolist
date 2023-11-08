<?php
$query = $connexion->prepare('SELECT * FROM task');
$query->execute();
$taskList = $query->fetchAll();


foreach ($taskList as $task) {
    if ($task['task_state'] === 0) {
        echo "
        <ul>
    <li class=\"main__container\" data-id=\"" . $task['id_task'] . "\">
        <div class=\"left__container\">
            <div class=\"top__container\">
                <a href=\"components/task/task_actions.php?action=done&token=" . $_SESSION['token'] . " &id=" . $task['id_task'] . " \"><span class=\"btn\">☑️</span></a>
                <div class=\"top__container--task_name\">
                    <p>" . $task['task_name'] . "</p>
                </div>
            </div>
            <div class=\"bot__container\">
                <ul class=\"task__action\">
                    <li class=\"btn\">
                        <a href=\"#\">✍🏼</a>
                    </li>
                    <li class=\"btn\">
                        <a href=\"components/task/task_actions.php?action=delete&token=" . $_SESSION['token'] . " &id=" . $task['id_task'] . " \">🗑️</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class=\"right__container\">
            <div class=\"right__container--arrows\">
                <p class=\"btn\">⬆️</p>
                <p class=\"btn\">⬇️</p>
            </div>
        </div>
    </li>
</ul>";
    }
}

?>


