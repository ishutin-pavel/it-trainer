<?php

//Получение следующего id
if ( isset($_POST['next_id']) ) { $id = $_POST['next_id']; } else { $system_error .= "<p>Не передан следующий id</p>";}
if ( !isset($id) ) { $id=1; }

//Работа по диапазону
if ( isset($_POST['diapason']) ) { $diapason = $_POST['diapason']; }
if ( !isset($diapason) ) { $diapason=1; }

switch ($diapason) {
    case 1:
        if ( $id > 20 ) { $id = 1; };
        $max = 20;
        break;
    case 2:
        if ( $id < 21 || $id > 40 ) { $id = 21; };
        $max = 40;
        break;
    case 3:
        if ( $id < 41 || $id > 60 ) { $id = 41; };
        $max = 60;
        break;
    case 4:
        if ( $id < 61 || $id > 80 ) { $id = 61; };
        $max = 80;
        break;
    case 5:
        if ( $id < 81 || $id > 100 ) { $id = 81; };
        $max = 100;
        break;
}
$next_id = $id + 1;

// Запрос к БД для выбора вопроса по ID
$result = mysql_query("SELECT question, answer FROM html WHERE id='$id'");
//Проверка выборки
if (!$result) {
  $system_error .= "<p>Ошибка при обращении к таблице: " . mysql_error() . "</p>";
} else {
  //Преобразование ресурса в массив.
  $row = mysql_fetch_row($result);
  //если строка пустая, то:
  if ( !$row ) {
    $system_error .= "<p>Упражнение НЕ загружено</p>";
  } else {
    //Разбиваем массив на отдельные переменные
    list($question, $right_answer) = $row;

    //Заменяем скобки '<' и '>' для вывода тега как текст на странице
    $right_answer_output = str_replace("<", "&lt;", $right_answer);
    $right_answer_output = str_replace(">", "&gt;", $right_answer_output);
  }
}//Проверка выборки