<?php
//Работа по спискам
//Проверка существования ID темы
if( !isset($_COOKIE["theme_id"]) ) { $system_error .= "Нет ID темы"; }

//Получение и проверка ID категории
if ( isset($_POST['category_list']) && $_POST['category_list'] != '' ) {
    $category_list = $_POST['category_list'];
    $category_list = implode(",", $category_list);
    setcookie("category_list", $category_list);
} elseif ( isset($_COOKIE["category_list"]) ) {
    $category_list = $_COOKIE["category_list"];
  } else {
    $system_error .= "Нет ID категории\n";
}



//Получаем номер следующего задания
if ( isset($_POST['count']) ) { $count = $_POST['count']; } else { $system_error .= "<p>Не передан номер следующего задания</p>";}
//Если номер следующего задания не передан, то начинаем с нуля
if ( !isset($count) ) { $count = 0; }


//Запрос к БД для выбора заданий в столбце category со значением $category
$st = $db->query("SELECT question, answer FROM exercises WHERE category_id IN($category_list)");


//Проверка выборки
if (!$st) {
  $system_error .= "<p>Ошибка при обращении к таблице: " . mysql_error() . "</p>";
} else {
  //Считаем сколько строк в выборке. Сколько всего заданий?
  $max_st = $db->query("SELECT COUNT(*) FROM exercises WHERE category_id IN($category_list)");
  $max = $max_st->fetchAll();
  $max = $max[0][0];
  //Если счетчик перевалил за максимум, то сбрасываем его на ноль
  if ( $count >= $max || $count == 0 ) { $count = 0; }
  //Преобразование ресурса в массив. Собираем все строки в массив $all_task.
  foreach ($st->fetchAll() as $row) {
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