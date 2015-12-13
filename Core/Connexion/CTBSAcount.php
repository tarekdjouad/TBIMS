
<?php

include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Config/Config.php';

$tbl_name="users"; // Table name

if (empty($_POST['login']) OR empty($_POST['password']) )
    {
    echo '<font color="red">please enter your username or your password !</font>';
    exit;
    }
$myusername=$_POST['login'];
$mypassword=$_POST['password'];
$mypassword2=$_POST['password2'];
$myEmail=$_POST['email'];

if ($mypassword<>$mypassword2 )
    {
    echo '<font color="red">Your password confrimation is not available !</font>';
    exit;
    }

// Connect to server and select databse.
mysql_select_db("$DBUsers")or die("cannot select DB");

$sql="SELECT * FROM $tbl_name WHERE username='$myusername'";
$result=mysql_query($sql);


// Mysql_num_row is counting table row
$count=mysql_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row


if($count==1){
echo "this acount is already exist, try with an other login";
exit;
mysql_close();
}

//$date = date("d-m-Y");
//$heure = date("H:i");
//$X=$date.' '.$heure;
$sql = "INSERT INTO `users` (`username`, `password`, `email`,`canlogin`)
        VALUES
       ('$myusername', '$mypassword','$myEmail', 'False')";
       


// on insere le tuple (mysql_query) et au cas où, on écrira un petit message d'erreur si la requête ne se passe pas bien (or die)
mysql_query($sql) or die ('error creating TBS acout');

$d = date("d-m-Y").'-'.date("H:i");

$sql = "insert into UsersRequests (mail, task, dt) values ('$myEmail','I need new account','$d')";

// on insere le tuple (mysql_query) et au cas où, on écrira un petit message d'erreur si la requête ne se passe pas bien (or die)
mysql_query($sql) or die ('error creating TBS acout');


echo "your information is sent to admin, you will receive your confirmation acount";

// on ferme la connexion à la base
mysql_close();
?>

</body>

</html>