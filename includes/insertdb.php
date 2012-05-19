<?php

mysql_connect("jrappdb.db.4982551.hostedresource.com","jrappdb","jR@pP2O!2") or die("Could not connect to MySQL server: ".mysql_error());
mysql_select_db("jrappdb") or die("Could not connect to MySQL database: ".mysql_error());

$date = $_POST['date'];
$km = $_POST['km'];
$time = $_POST['time'];

$query = "INSERT INTO `cycle_data` (date,km,time,notes) VALUES ('$date','$km','$time','$notes')";
$result = mysql_query($query) or die(mysql_error());

echo $result;

?>