<html>

<head>
  <title></title>
</head>

<body>
</body>
<?php

include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Config/Config.php';
$myEmail=$_POST['email'];

mysql_select_db("$DBUsers")or die("cannot select DB");

$subject = $myEmail;

$d = date("d-m-Y").'-'.date("H:i");

$req=mysql_query("insert into UsersRequests 
(mail, task, dt) values 
('$subject','Forget My Password','$d')
");
echo "TBSIM Admin will contact you to send you your acount informations";
mysql_close();
?>
</html>