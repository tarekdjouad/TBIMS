<?php

include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Config/Config.php';
mysql_connect("$servername", "$username", "$Serverpassword")or die("cannot connect to mysql server");
//mysql_select_db("$DBUsers")or die("cannot select DB");

$query="CREATE DATABASE IF NOT EXISTS ".$DBUsers;
            
if (mysql_query($query)) {
            
    mysql_select_db("$DBUsers"); 
            
mysql_query("CREATE TABLE `users` (
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `canlogin` varchar(60) NOT NULL
) ");

mysql_query("INSERT INTO `users` (`username`, `password`, `email`, `canlogin`) VALUES 
('admin', 'admin', 'admin@tbsim.com', 'true');");

mysql_query("CREATE TABLE `usersrequests` (
  `mail` varchar(60) NOT NULL,
  `task` varchar(60) NOT NULL,
  `dt` varchar(50) NOT NULL
) ");
}
?>
