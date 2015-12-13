<html>

<head>
  
</head>

<body>

<?php
// On appelle la session
session_start();

// On écrase le tableau de session
$_SESSION = array();

// On détruit la session
session_destroy();
header('Location: http://'.$_SERVER['HTTP_HOST'].'/TBSIM/Core/Connexion/IndexConnexion.php');
          
?>
thanks to use TBSIM
</body>

</html>
