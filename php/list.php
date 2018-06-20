<?php
//Работа по спискам
//Получаем список из формы
if ( isset($_POST['list']) ) { $list = $_POST['list']; }
//Если список не передан, то ставим по умолчанию
if ( !isset($list) ) { $list='structure'; }

//Проверяем есть ли такой список у нас
$list_array = array('structure','element','table','form','formatting');
if ( ! in_array($list, $list_array) ){
  $list='structure';
  $system_error .= "<p>Такого списка тегов нет</p>";
}

//Получаем номер следующего задания
if ( isset($_POST['count']) ) { $count = $_POST['count']; } else { $system_error .= "<p>Не передан номер следующего задания</p>";}
//Если номер следующего задания не передан, то начинаем с нуля
if ( !isset($count) ) { $count = 0; }

//Запрос к БД для выбора всех заданий по тегу $list
$result = mysql_query("SELECT question, answer FROM html WHERE list='$list'");
//Проверка выборки
if (!$result) {
  $system_error .= "<p>Ошибка при обращении к таблице: " . mysql_error() . "</p>";
} else {
  //Считаем сколько строк в выборке. Сколько всего заданий?
  $max = mysql_num_rows($result);
  //Готовим следующий номер задания
  if ( $count >= $max || $count == 0 ) { $count = 0; }
  //Преобразование ресурса в массив.
  while ( $next_row = mysql_fetch_assoc($result) ) {
   $all_row[] = $next_row;
  }
  //Получаем массив с текущим заданием
  $task_array = $all_row[$count];
  //Увеличиваем счетчик
  ++$count;

  //если строка пустая, то:
  if ( !$task_array ) {
    $system_error .= "<p>Упражнение НЕ загружено</p>";
  } else {
    //Разбиваем массив на отдельные переменные
    $question = $task_array['question'];
    $right_answer = $task_array['answer'];

    //Заменяем скобки '<' и '>' для вывода тега как текст на странице
    $right_answer_output = str_replace("<", "&lt;", $right_answer);
    $right_answer_output = str_replace(">", "&gt;", $right_answer_output);
  }
}//Проверка выборки