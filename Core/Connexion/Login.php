
<?php

include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Config/Config.php';

$tbl_name="users"; // Table name
if ( !isset($_POST)or (empty($_POST['login'])) or (empty($_POST['password'])) ) {

      echo '<font color="red">please enter your username or your password !</font>';
      exit;
}
else {

        mysql_select_db("$DBUsers")or die("cannot select DB");

        $myusername=$_POST['login'];
        $mypassword=$_POST['password'];
        $myusername = stripslashes($myusername);
        $mypassword = stripslashes($mypassword);
        $myusername = mysql_real_escape_string($myusername);
        $mypassword = mysql_real_escape_string($mypassword);
        $req=mysql_query("SELECT * FROM users WHERE username='$myusername' and password='$mypassword'");
        $data = mysql_fetch_row($req);
        $count=mysql_num_rows($req);
        if ($count==0){
            echo "Invalid Acount, Try again";
            exit;
        }

        if($count==1){
           if ($data['3']=='true'){   
           $dba='TBS_'.$data['0'];
           $dbb='DB_'.$data['0'];
           //************************************
            $query="CREATE DATABASE IF NOT EXISTS ".$dba;
            
            if (mysql_query($query)) {
            
                    mysql_select_db("$dba"); 
               
                  
 mysql_query("CREATE TABLE IF NOT EXISTS `classtans` (
  `cname` varchar(50) NOT NULL,
  `tname` varchar(50) NOT NULL)");

 mysql_query("CREATE TABLE  IF NOT EXISTS `indicator` (
  `iname` varchar(255) NOT NULL,
  `iequation` varchar(255) NOT NULL,
  `itransformation` varchar(255) NOT NULL,
  `iclass` varchar(255) NOT NULL,
  `ivalues` varchar(255) NOT NULL,
  `icomment` varchar(255) NOT NULL)");

 mysql_query("CREATE TABLE  IF NOT EXISTS `indicatorclass` (
  `ClassName` varchar(255) NOT NULL,
  `ClassEquation` varchar(255) NOT NULL,
  `ClassTransfor` varchar(255) NOT NULL,
  `ClassComment` varchar(255) NOT NULL)");

 mysql_query("CREATE TABLE  IF NOT EXISTS `indicatorvalues` (
  `variable` varchar(100) NOT NULL,
  `varval` int(11) NOT NULL,
  `canuse` varchar(30) NOT NULL)");

 mysql_query("CREATE TABLE  IF NOT EXISTS `mdl_tools` (
  `id` varchar(60) NOT NULL,
  `toolname` varchar(360) NOT NULL)");

 mysql_query("CREATE TABLE  IF NOT EXISTS `mdl_user` (
  `id` varchar(60) NOT NULL,
  `username` varchar(60) NOT NULL,
  `firstname` varchar(60) NOT NULL)");

 mysql_query("CREATE TABLE  IF NOT EXISTS `mdl_users` (
  `id` varchar(60) NOT NULL,
  `username` varchar(60) NOT NULL,
  `firstname` varchar(60) NOT NULL)");


 mysql_query("CREATE TABLE  IF NOT EXISTS `transall` (
  `ts` varchar(100) DEFAULT NULL,
  `td` varchar(100) DEFAULT NULL,
  `Nom_op` varchar(50) DEFAULT NULL,
  `Nom_par` varchar(100) DEFAULT NULL,
  `Add_par` varchar(100) DEFAULT NULL,
  `tname` varchar(50) NOT NULL)");


 mysql_query("CREATE TABLE  IF NOT EXISTS `transformation` (
  `Nt` int(10) NOT NULL AUTO_INCREMENT,
  `ts` varchar(100) DEFAULT NULL,
  `td` varchar(100) DEFAULT NULL,
  `Nom_op` varchar(50) DEFAULT NULL,
  `Nom_par` varchar(100) DEFAULT NULL,
  `Add_par` varchar(100) DEFAULT NULL,
 PRIMARY KEY  (`Nt`))");


 mysql_query("CREATE TABLE  IF NOT EXISTS `transformationclass` (
  `Cts` varchar(100) DEFAULT NULL,
  `Ctd` varchar(100) DEFAULT NULL,
  `CNom_op` varchar(50) DEFAULT NULL,
  `CNom_par` varchar(100) DEFAULT NULL,
  `CAdd_par` varchar(100) DEFAULT NULL,
  `Cname` varchar(50) NOT NULL)");

            }
            else      echo "error in creating '$dba'";
             
              
            $query="CREATE DATABASE IF NOT EXISTS ".$dbb;
             if (mysql_query($query)){echo "ok"; }
             else  echo "error in creating '$dbb'";
            
            //****************************************************************************
            //$_SERVER['DOCUMENT_ROOT']."/TBSIM/lib/files/rep_".$TBSUser."/";
            $dir=$_SERVER['DOCUMENT_ROOT'].'/TBSIM/lib/files/rep_'.$data['0'];
            if(! is_dir($dir))
                 mkdir($dir);                           
               session_start();
               $_SESSION['login'] = $data['0'];
               $_SESSION['DB'] = 'TBS_'.$data['0'];
    
               //****************************************************
               // il faut créer ici l'install des tables'
               header('Location: http://'.$_SERVER['HTTP_HOST'].'/TBSIM/index.php');
              
        }
        else echo "your account is not activated yet by admin";
     }
     mysql_close();
}
?>