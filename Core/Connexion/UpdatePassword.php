<?php

include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Config/SessionStart.php';
include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Config/Config.php';
mysql_select_db("$DBUsers")or die("cannot select DB");

$b=$_REQUEST['confpass'];

$sql = "update users Set password = '$b' where username='$TBSUser'";
echo $sql;
// on insere le tuple (mysql_query) et au cas où, on écrira un petit message d'erreur si la requête ne se passe pas bien (or die)
mysql_query($sql) or die ('erro updating acount');


mysql_close();

// 

header('Location: Params.php');
    
?>