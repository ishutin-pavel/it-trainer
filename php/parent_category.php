<?php
//Работа по спискам
//Получаем список из формы
if ( isset($_POST['category']) ) { $category = $_POST['category']; }


//Если список не передан, то ставим по умолчанию
if ( !isset($parent_category) ) { $parent_category='flex'; }

$parent_category_result = mysql_query("SELECT DISTINCT parent_category FROM exercises WHERE category='$category'");


$parent_category_row = mysql_fetch_row($parent_category_result);
$parent_category = $parent_category_row[0];
echo $parent_category;


//Получаем номер следующего задания
if ( isset($_POST['count']) ) { $count = $_POST['count']; } else { $system_error .= "<p>Не передан номер следующего задания</p>";}
//Если номер следующего задания не передан, то начинаем с нуля
if ( !isset($count) ) { $count = 0; }


//Запрос к БД для выбора заданий в столбце category со значением $category
$result = mysql_query("SELECT question, answer FROM exercises WHERE parent_category='$parent_category' ORDER BY question");

//Проверка выборки
if (!$result) {
  $system_error .= "<p>Ошибка при обращении к таблице: " . mysql_error() . "</p>";
} else {
  //Считаем сколько строк в выборке. Сколько всего заданий?
  $max = mysql_num_rows($result);
  //Если счетчик перевалил за максимум, то сбрасываем его на ноль
  if ( $count >= $max || $count == 0 ) { $count = 0; }
  //Преобразование ресурса в массив. Собираем все строки в массив $all_task.
  while ( $row = mysql_fetch_assoc($result) ) {
   $all_tasks[] = $row;
  }

  //Получаем массив с текущим заданием
  $current_task = $all_tasks[$count];
  //Увеличиваем счетчик
  ++$count;

  //если строка пустая, то cохраняем ошибку
  if ( !$current_task ) {
    $system_error .= "<p>Упражнение НЕ загружено</p>";
  } else {
    //Разбиваем массив на отдельные переменные
    $question = $current_task['question'];
    $right_answer = $current_task['answer'];
    //Преобразуем специальные HTML-сущности в соответствующие символы.
    $question = htmlspecialchars($question);
    $right_answer_output = htmlspecialchars($right_answer);
  }
}//Проверка выборки