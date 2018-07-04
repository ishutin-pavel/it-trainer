<?php
// define("DATABASE_HOST", "localhost");
// define("DATABASE_USERNAME", "root");
// define("DATABASE_PASSWORD", "");
// define("DATABASE_NAME", "trainer");

// mysql_connect(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD) or die ("<p>Ошибка подключения к базе данных: " . mysql_error() . "</p>");

// mysql_select_db(DATABASE_NAME)
//   or die ("<p>Ошибка при выборе базы данных " . DATABASE_NAME . mysql_error() . "</p>");


$user = 'root';
$password = '';
$db = new PDO('mysql:host=localhost;dbname=trainer', $user, $password);