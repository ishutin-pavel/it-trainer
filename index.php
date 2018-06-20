<?php
require 'php/app_config.php';

//Показывать системные ошибки?
define("SYSTEM_ERROR_SHOW", true);

// if ( isset($_GET['id']) ) { $id = $_GET['id']; }
// if ( !isset($id) ) { $id=1; }

//Сколько всего строк в таблице
// $max_resource = mysql_query("SELECT COUNT(1) FROM html");
// $max_array = mysql_fetch_array( $max_resource );
// $max =  $max_array[0];

require_once 'php/list.php';

?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Тренажер</title>
  <link rel="stylesheet" href="css/style.css">
  <script>
    var id, right_answer, user_answer, startTime, endTime, time;
    right_answer = '<?php echo $right_answer; ?>';
    startTime = new Date();
  </script>
</head>
<body>
<div class="body_overlay">

<div class="container">
  <div class="row">

    <div class="col-sm-3">
      <aside class="rules">
        <div class="rules__title">Правила</div>
        <div class="rules__text">
        <p>Введите ответ и нажмите <kbd>Enter</kbd></p>
        <p>Цель: довести до автоматизма.</p>
        <p>Теги разделены на группы.</p>
        </div>
      </aside>
    </div><!-- col -->

    <div class="col-sm-6">

      <div class="main">

          <form id="form" action="index.php" class="form" method="POST">
            <div class="question"><?php echo $question; ?></div>
            <input class="answer__input" type="text">
            <input type="hidden" name="count" value="<?php echo $count; ?>">
          </form>

        <code class="right_answer" style="display: none;">
          <span class="right_answer__label">Правильный ответ: </span>
          <?php echo $right_answer_output; ?>
        </code>


        <?php
        //Вывод системных ошибок
        if( isset($system_error) && SYSTEM_ERROR_SHOW ) {
          echo "<div class='system_error'>";
          echo $system_error;
          echo "</div>";
        }
          ?>

      </div><!-- main -->

    </div><!-- col -->

    <div class="col-sm-3">
      <aside class="status">
        <h3 class="status__title">Статус</h3>
        <p><?php echo "Вопрос номер: " . $count . "/" . $max; ?></p>

        <div class="progress">
          <progress class="progress__bar" max="<?php echo $max;?>" value="<?php echo $count; ?>"></progress>
        </div>

        <div class="diapason__wrap">
          <span class="diapason__title">Выбирите группу:</span>
          <select form="form" name="list" id="diapason">
            <option <?php if ( $list=='structure' ) { echo "selected"; } ?> value="structure">Структурные</option>
            <option <?php if ( $list=='element' ) { echo "selected"; } ?> value="element">Остальные элементы</option>
            <option <?php if ( $list=='table' ) { echo "selected"; } ?> value="table">Таблица</option>
            <option <?php if ( $list=='form' ) { echo "selected"; } ?> value="form">Форма</option>
            <option <?php if ( $list=='formatting' ) { echo "selected"; } ?> value="formatting">Форматирование</option>
          </select>
        </div>
        <div class="restart__wrap">
          <a href="#" class="btn btn-primary restart">Сначала</a>
        </div>
        
      </aside>
    </div><!-- col -->

  </div><!-- row -->


</div><!-- container -->


<script src="js/jquery.min.js"></script>
<!-- <script src="js/bootstrap.min.js"></script> -->
<script src="js/jquery.matchHeight.js"></script>
<script src="js/main.js"></script>
</div><!-- main -->

</div><!-- body_overlay -->
</body>
</html>