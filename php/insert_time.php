<?php
if (isset($_POST['id'])) {$id = $_POST['id'];}
if (isset($_POST['time'])) {$time = $_POST['time'];}

if ( isset($id) && isset($time) ) {
  require 'app_config.php';
  $result = mysql_query ("UPDATE html SET time='$time' WHERE id = '$id' ");
  echo "Время успешно обновлено";
} else {
  echo "Не получена нужная информация";
}


?>