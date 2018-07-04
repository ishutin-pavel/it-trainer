<?php
require 'php/app_config.php';

if ( isset($_POST['theme_id']) ) {
  $theme_id = $_POST['theme_id'];
  setcookie("theme_id", $theme_id);
} elseif ( isset($_COOKIE["theme_id"]) ) {
  $theme_id = $_COOKIE["theme_id"];
} else {
  $system_error .= "Нет ID темы";
}

//Показывать системные ошибки?
define("SYSTEM_ERROR_SHOW", true);




?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Тренажер</title>
  <link rel="stylesheet" href="css/style.css">
  <script>
    var id, right_answer, user_answer, startTime, endTime, time;
    startTime = new Date();
  </script>
</head>
<body>
<div class="body_overlay">
<div class="logo">
  <a href="/">
    <img src="images/logo.svg" alt="IT-Тренер">
  </a>
</div>
<div class="container">
  <main class="main">

    <form action="do.php" method="POST">
      <div class="boxes">
      <?php
      $st = $db->query("SELECT category_name, category_id FROM category WHERE theme_id = '$theme_id'");
      foreach ($st->fetchAll() as $row) {
      ?>

        <input id="box-<?php print $row['category_id']; ?>" type="checkbox" name="category_list[]" value="<?php print $row['category_id']; ?>">
        <label for="box-<?php print $row['category_id']; ?>"><?php print $row['category_name']; ?></label>

      <?php } ?>
      </div><!-- boxes -->
      <input type="hidden" name="theme" value="<?php print $row['theme_id']; ?>">
      <input type="submit" value="К заданиям">
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