<?php
require 'php/app_config.php';

if ( isset($_POST['next_id']) ) { $id = $_POST['next_id']; } else { echo "<p>Не передан следующий id</p>";}
if ( !isset($id) ) { $id=1; }


// if ( isset($_GET['id']) ) { $id = $_GET['id']; }
// if ( !isset($id) ) { $id=1; }


if ( isset($_POST['diapason']) ) { $diapason = $_POST['diapason']; }
if ( !isset($diapason) ) { $diapason=1; }

switch ($diapason) {
    case 1:
        if ( $id > 20 ) { $id = 1; };
        break;
    case 2:
        if ( $id < 21 || $id > 40 ) { $id = 21; };
        break;
    case 3:
        if ( $id < 41 || $id > 60 ) { $id = 41; };
        break;
    case 4:
        if ( $id < 61 || $id > 80 ) { $id = 61; };
        break;
    case 5:
        if ( $id < 81 || $id > 100 ) { $id = 81; };
        break;
}
$next_id = $id + 1;

//Запрос к БД для выбора вопроса по ID
$result = mysql_query("SELECT * FROM html WHERE id='$id'");
//Проверка выбора
if (!$result) {
  die("<p>Ошибка при выводе перечня таблиц:" . mysql_error() . "</p>");
}



//Преобразование ресурса в массив.
$row = mysql_fetch_row($result);
//если строка пустая, то:
if ( !$row ) {
  $question = "<p>Все упражнения выполнены. Поздравляю!</p><p>Обновите страницу</p>";
} else {
  $question = $row[1];
  $right_answer = $row[2];
}


?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Тренажер</title>
  <link rel="stylesheet" href="css/style.css">
  
  <script>
    var id, right_answer, user_answer, startTime, endTime, time;


    id = '<?php echo $id; ?>';
    right_answer = '<?php echo $right_answer; ?>';
    startTime = new Date();

  </script>
</head>
<body>
<div class="body_overlay">

<div class="main">

<form action="index.php" class="form" method="POST">
  <div class="question"><?php echo $question; ?></div>
  <input class="answer__input" type="text">
  <input type="hidden" name="next_id" value="<?php echo $next_id; ?>">
  <input class="answer_btn" type="submit" value="Далее">
  <p>Все теги разделены на несколько групп по 20шт. Это сделано для того, чтобы можно было их доводить до автоматизма. Выбирите группу:</p>
    <select name="diapason" id="diapason">
      <option <?php if ( $diapason==1 ) { echo "selected"; } ?> value="1">1-20</option>
      <option <?php if ( $diapason==2 ) { echo "selected"; } ?> value="2">21-40</option>
      <option <?php if ( $diapason==3 ) { echo "selected"; } ?> value="3">41-60</option>
      <option <?php if ( $diapason==4 ) { echo "selected"; } ?> value="4">61-80</option>
      <option <?php if ( $diapason==5 ) { echo "selected"; } ?> value="5">81-100</option>
    </select>
    <p><?php echo "Вопрос номер: " . $id; ?></p>
  
</form>

<code class="history-list"></code>


<script src="https://yastatic.net/jquery/3.1.1/jquery.min.js"></script>
<script src="js/main.js"></script>
</div><!-- main -->

</div><!-- body_overlay -->
</body>
</html>