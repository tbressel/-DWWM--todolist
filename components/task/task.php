<?php
$query = $connexion->prepare('SELECT * FROM task');
$query->execute();
$taskList = $query->fetchAll();

foreach ($taskList as $task) {
    echo "

    <div class=\"main__container\">
        <div class=\"left__container\">
            <div class=\"top__container\">
                <input type=\"checkbox\" id=\"task_state\">
                <div class=\"top__container--task_name\">
                    <p>" . $task['task_name'] . "</p>
                </div>
            </div>
            <div class=\"bot__container\">
                <ul class=\"task__action\">
                    <li class=\"btn\">
                        <p class=\"btn__update\">Update</p>
                    </li>
                    <li class=\"btn\">
                        <p class=\"btn__delete\">Delete</p>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class=\"right__container\">
            <div class=\"right__containter--arrows\">
                <p><img src=\"../../assets/svg/angles-up-solid.svg\" alt=\"\"></p>
                <p><img src=\"../../assets/svg/angles-down-solid.svg\" alt=\"\"></p>
            </div>
        </div>
    </div>";
}
?>


