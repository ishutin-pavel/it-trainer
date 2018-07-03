<?php
require 'php/app_config.php';

//Показывать системные ошибки?
define("SYSTEM_ERROR_SHOW", true);

//Обработчик
require_once 'php/category.php';
//require_once 'php/parent_category.php';

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

          <form id="form" action="index.php" class="form" method="POST">
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

        <div class="diapason__wrap">
          <span class="diapason__title">Выбирите группу:</span>
          <select form="form" name="category" id="diapason">
            <optgroup label="HTML">
              <option <?php if ( $category=='structure' ) { echo "selected"; } ?> value="structure">Структурные</option>
              <option <?php if ( $category=='element' ) { echo "selected"; } ?> value="element">Остальные элементы</option>
              <option <?php if ( $category=='table' ) { echo "selected"; } ?> value="table">Таблица</option>
              <option <?php if ( $category=='form' ) { echo "selected"; } ?> value="form">Форма</option>
              <option <?php if ( $category=='formatting' ) { echo "selected"; } ?> value="formatting">Форматирование</option>
            </optgroup>
            <optgroup label="CSS">
              <option <?php if ( $category=='font' ) { echo "selected"; } ?> value="font">Шрифты</option>
              <option <?php if ( $category=='css-filter' ) { echo "selected"; } ?> value="css-filter">Фильтры</option>
              <option <?php if ( $category=='transform' ) { echo "selected"; } ?> value="transform">Трансформация</option>
              <option <?php if ( $category=='animation' ) { echo "selected"; } ?> value="animation">Анимация</option>
              <option <?php if ( $category=='transition' ) { echo "selected"; } ?> value="transition">Переходы</option>
              <option <?php if ( $category=='css-media' ) { echo "selected"; } ?> value="css-media">Медиа запросы</option>
            </optgroup>
            <optgroup label="Flex">
              <option <?php if ( $category=='flex' ) { echo "selected"; } ?> value="flex">Все задания</option>
                <option <?php if ( $category=='flex-flow' ) { echo "selected"; } ?> value="flex-flow">flex-flow</option>
                <option <?php if ( $category=='flex-justify-content' ) { echo "selected"; } ?> value="flex-justify-content">justify-content</option>
                <option <?php if ( $category=='flex-align-items' ) { echo "selected"; } ?> value="flex-align-items">align-items</option>
                <option <?php if ( $category=='flex-align-content' ) { echo "selected"; } ?> value="flex-align-content">align-content</option>
            </optgroup>
            <optgroup label="Регулярные выражения">
              <option <?php if ( $category=='regex' ) { echo "selected"; } ?> value="regex">Метасимволы</option>
              <option <?php if ( $category=='quantifiers' ) { echo "selected"; } ?> value="quantifiers">Квантификаторы</option>
              <option <?php if ( $category=='metaposledovatelnosti' ) { echo "selected"; } ?> value="metaposledovatelnosti">Метапоследовательности</option>
              <option <?php if ( $category=='regex-examples' ) { echo "selected"; } ?> value="regex-examples">Примеры</option>
            </optgroup>
            <optgroup label="SQL">
              <option <?php if ( $category=='sql-instructions' ) { echo "selected"; } ?> value="sql-instructions">Инструкции</option>
            </optgroup>
            <optgroup label="Английский">
              <option <?php if ( $category=='english_1' ) { echo "selected"; } ?> value="english_1">list 1</option>
            </optgroup>
          </select>
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