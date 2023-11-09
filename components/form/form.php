<?php
echo '
<div id="addform" class="addform__container">
    <form action="components/task/addtask.php" method="POST">
        <label for="task_field">Task Name:</label>
        <input type="text" name="task_name" id="task_field" placeholder="Enter a new task" maxlength="25" required>
        <input type="hidden" name="token" value="' . $_SESSION['token'] . '">
        <input type="submit" value="Envoyer">
    </form>
</div>';
?>
