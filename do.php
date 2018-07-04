<?php
require 'php/app_config.php';
//Показывать системные ошибки?
define("SYSTEM_ERROR_SHOW", true);
//Обработчик
require_once 'php/category-2.php';


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
  <div class="row">

    <div class="col-lg-3">
      <aside class="rules">
        <div class="rules__title">Правила</div>
        <div class="rules__text">
        <p>Введите ответ и нажмите <kbd>Enter</kbd></p>
        <p>Цель: довести до автоматизма.</p>
        <p>Теги разделены на группы.</p>
        </div>
      </aside>
    </div><!-- col -->

    <div class="col-lg-6">

      <div class="main">
          <form id="form" action="do.php" class="form" method="POST">
            <div class="question"><?php echo $question; ?></div>
            <input class="answer__input" type="text" name="answer" autocomplete="off" autofocus>
            <input type="hidden" name="count" value="<?php echo $count; ?>">
            <input type="hidden" name="right_answer" value="<?php echo $right_answer; ?>">
          </form>

        <div class="right_answer" style="display: none;">
          <span class="right_answer__label">Правильный ответ: </span>
          <code><?php echo $right_answer_output; ?></code> 
        </div>


<?php
//print_r($_COOKIE);
  //Вывод системных ошибок
  if( isset($system_error) && SYSTEM_ERROR_SHOW ) {
    echo "<div class='system_error'>";
    echo $system_error;
    echo "</div>";
  }
?>

      </div><!-- main -->

    </div><!-- col -->

    <div class="col-lg-3">
      <aside class="status">
        <h3 class="status__title">Статус</h3>
        <p><?php echo "Вопрос номер: " . $count . "/" . $max; ?></p>

        <div class="progress">
          <progress class="progress__bar" max="<?php echo $max;?>" value="<?php echo $count; ?>"></progress>
        </div>

        <div class="restart__wrap">
          <a href="#" class="btn btn-primary restart">Сначала</a>
        </div>

      </aside>

    </div><!-- col -->

  </div><!-- row -->
  <div class="row for-tests" style="">

  </div><!-- row для тестов -->
</div><!-- container -->




<script src="js/jquery.min.js"></script>
<!-- <script src="js/bootstrap.min.js"></script> -->
<script src="js/jquery.matchHeight.js"></script>
<script src="js/main.js"></script>
</div><!-- main -->

</div><!-- body_overlay -->
</body>
</html>