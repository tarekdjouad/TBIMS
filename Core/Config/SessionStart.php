<?php

session_start();

if ( isset ($_SESSION['login'] )) {
     $TBSUser=$_SESSION['login'];
     $DbTrace="DB_".$TBSUser;
     
}     
else header('Location: http://'.$_SERVER['HTTP_HOST'].'/TBSIM/Core/Connexion/IndexConnexion.php');


?>
