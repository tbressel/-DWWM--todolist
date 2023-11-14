<div id="labelList" class="labelList__container">
    <form action="components/label/addlabels.php" method="POST">
        <?php
        $query = $connexion->prepare('SELECT * FROM theme  ORDER BY theme_name DESC');
        $query->execute();
        $themeList = $query->fetchAll();
      
        if (!empty($themeList)) {
            foreach ($themeList as $theme) { ?>
                <input type="checkbox" class="demo" id="demo<?= $theme['id_theme'] ?>" name="selected_themes[]" value="<?= $theme['id_theme'] ?>">
                <label for="demo<?= $theme['id_theme'] ?>"><?= $theme['theme_name'] ?></label>
        <?php
            }
        }
 ?>
        <input type="submit" value="OK">
        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
        <input type="hidden" id="task-value" name="id_task" value="">
    </form>
</div>
