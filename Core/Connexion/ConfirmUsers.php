<?php

include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Config/SessionStart.php';
include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Config/Config.php';
mysql_select_db("$DBUsers")or die("cannot select DB");

$sql = "update users Set canlogin = 'false'";

// on insere le tuple (mysql_query) et au cas où, on écrira un petit message d'erreur si la requête ne se passe pas bien (or die)
mysql_query($sql) or die ('erro updating acount');

foreach($_POST['validate'] as $ch){


$sql = "update users Set canlogin = 'true' where username='$ch'";

// on insere le tuple (mysql_query) et au cas où, on écrira un petit message d'erreur si la requête ne se passe pas bien (or die)
mysql_query($sql) or die ('erro updating acount');
}


//*****************************************************************************
foreach($_POST['DelUser'] as $ch){


$sql = "delete from users where username='$ch'";

// on insere le tuple (mysql_query) et au cas où, on écrira un petit message d'erreur si la requête ne se passe pas bien (or die)
mysql_query($sql) or die ('erro updating acount');
}

//*****************************************************************************



mysql_close();

// 

header('Location: Params.php');
    
?>