<?php

include_once 'includes/_config.php';
include 'includes/_functions.php';
include_once 'includes/_head.php';

getIdentification("./.env");

include 'includes/_dbconnect.php';

session_start();
generateToken();

?>

<body>

<?php
if (isset($_SESSION['notif'])) {
    echo "<div class=\"notification\">" . urldecode($_SESSION['notif']) . "</div>";
    unset($_SESSION['notif']);
}

if (isset($_SESSION['error'])) {
    echo "<div class=\"error\">" . urldecode($_SESSION['error']) . "</div>";
    unset($_SESSION['error']);
}
?>

<?php include './components/header/header.php';?>
<?php include './components/form/form.php';?> 
<?php include './components/label/label.php';?> 


<div id="tasksList__container" class="">
    <?php include './components/task/task.php';?>
</div>


<div id="tasksDone__container" class="hidden">
    <?php include './components/task/donetasks.php';?>
</div>


<script src="./assets/scripts/script.js"></script>

</body>
</html>

