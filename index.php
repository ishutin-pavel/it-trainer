<?php
unset($_COOKIE["theme_id"]);

require 'php/app_config.php';

//Показывать системные ошибки?
define("SYSTEM_ERROR_SHOW", true);

//Обработчик
require_once 'php/theme.php';

//Получаем список тем:




?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Тренажер</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="body_overlay">

    <div class="container">
      <div class="logo">
        <a href="/">
          <img src="images/logo.svg" alt="IT-Тренер">
        </a>
      </div>
      
      <main class="main">
<?php

$st = $db->query('SELECT * FROM themes');


?>

<form class="ftheme" action="task-list.php" method="POST">
  <input type="submit" value="Перейти к спискам с заданиями">
  <div class="themes__wrap">
  <?php foreach ($st->fetchAll() as $row) { ?>
  <label class="ftheme__item">
    <img class="ftheme__img" src="<?php print $row['theme_logo']; ?>" alt="<?php print $row['theme_name']; ?>">
    <span class="ftheme__name"><?php print $row['theme_name']; ?></span>
    <input class="ftheme__input" name="theme_id" type="radio" value="<?php print $row['theme_id']; ?>">
  </label>
  <?php } ?>
  </div><!-- themes__wrap -->
</form>

<?php
  //Вывод системных ошибок
  if( isset($system_error) && SYSTEM_ERROR_SHOW ) {
    echo "<div class='system_error'>";
    echo $system_error;
    echo "</div>";
  }
?>

  </main>
</div><!-- container -->




<script src="js/jquery.min.js"></script>
<!-- <script src="js/bootstrap.min.js"></script> -->
<script src="js/jquery.matchHeight.js"></script>
<script src="js/main.js"></script>
</div><!-- main -->

</div><!-- body_overlay -->
</body>
</html>