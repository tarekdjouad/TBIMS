<?php

include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Config/SessionStart.php';
include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Config/Config.php';
$DBM=$_SESSION['DB'];
$c=$_REQUEST['pm'];
  
  
mysql_select_db("$DBM")or die("cannot select DB");


//***********Add new class ok*****************************************************************************

if ($c=='1'){

    $classname=$_REQUEST['ciname'];
    $trans=$_REQUEST['ctname'];
    $funct=$_REQUEST['cequation'];
    $comment=$_REQUEST['ccomment'];    
    
    mysql_query("INSERT INTO `indicatorclass`  
    (  `ClassName` ,  `ClassEquation` ,  `ClassTransfor` ,  `ClassComment` ) 
    VALUES ('$classname', '$funct', '$trans', '$comment'  )" ) ;
 echo " <font face='Tahoma' size='+1'>Indicator class created is done...</font>";
    
}

//************add new indicator ok************************************************************************

if ($c=='2'){
   
$a=$_REQUEST['iname'];
$b=$_REQUEST['cname'];
$c=$_REQUEST['tname'];
$d=$_REQUEST['iequation'];
$e=$_REQUEST['icomment'];
     
    $req="INSERT INTO `indicator` 
    (  `iname` ,  `iequation` ,   `itransformation` ,  `iclass` ,  `ivalues` , `icomment` ) 
     VALUES ('$a', '$d','$c', '$b', 'NULL','$e'  )";   
     
     mysql_query ($req);
     mysql_close();    
     echo " <font face='Tahoma' size='+1'>Indicator created is done...</font>";
    echo"<script>parent.menu.location='ListIndicators.php';</script>"; 
}

//*******************execute transformation : ok*****************************************************************

if ($c=='3'){
    
    //**********************************************************
// mettre à jour l'indicateur'
    $iname=$_REQUEST['iname'];
    $iclass=$_REQUEST['iclass'];
    $tname=$_REQUEST['tname'];
   // echo $itransformation;
    $equation=$_REQUEST['iequation'];
    $icomment=$_REQUEST['icomment'];

   
    //**********************************************************
// charger la transformation
    $tname=$_SESSION['Transformation'];
    $equation=$_REQUEST['iequation'];
  
    mysql_query("TRUNCATE TABLE transformation");
    $req=mysql_query("select * from transall where tname='$tname'");
// remplir ensuite transformation
    while ($row = mysql_fetch_array($req))  {
            $sql1 = "INSERT INTO transformation
            Values ('','$row[0]','$row[1]','$row[2]','$row[3]','$row[4]')";   
            mysql_query($sql1);
    }        
// exécuter la transformation
    include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Transformation/ExecuteTransformation.php';
    $Y='';
    //**********************************************************
// compter ensuite les valaurs des tables 
    mysql_select_db("$DbTrace")or die("cannot select DB");

    $sql = "SHOW TABLES FROM $DbTrace";
    $result = mysql_query($sql);
   
    while ($data = mysql_fetch_array($result)) {  
         $cn= mysql_query("select count(*) from ". $data[0]);
         $val=mysql_fetch_array($cn);
         if ($cn !=' ')
           $Y =$Y.$data[0]."=".$val[0]."\n";
 }
 //**********************************************************
 // avant de faire l'insertion finale, il faut remettre l'ancienne equation''
  $_SESSION['equation']=$Y.$equation;   
 //**********************************************************
   
 // mettre à jour l'indicateur à la fin du calcul' 
  mysql_select_db("$DBM");
  $Z=$Y.$equation;
  $req="UPDATE  `indicator` SET  
        `iequation` ='$Z'  ,
        `itransformation` =  '$tname',
        `iclass` = '$iclass' ,
        `icomment` ='$icomment'   WHERE iname='$iname'" ;
    
    mysql_query ($req);
mysql_close();    
    header('Location: ComputeEquation.php');
   
}    
//****************update indicator********************************************************************

if ($c=='4'){//update
    $iname=$_REQUEST['iname'];
    $iclass=$_REQUEST['iclass'];
    $itransformation=$_REQUEST['itransformation'];
   // echo $itransformation;
    $iequation=$_REQUEST['iequation'];
    $icomment=$_REQUEST['icomment'];

    $req="UPDATE  `indicator` SET  
        `iequation` ='$iequation'  ,
        `itransformation` =  '$itransformation',
        `iclass` = '$iclass' ,
        `icomment` ='$icomment'   WHERE iname='$iname'" ;
    
    mysql_query ($req);
    
    echo " <font face='Tahoma' size='+1'>Indicator Update is done...</font>";
    
    echo"<script>parent.menu.location='ListIndicators.php';</script>";
   
}

//********************delete indicator ok****************************************************************

if ($c=='5'){// delete indicator
  $iclass=$_REQUEST['class'];
  $iname=$_REQUEST['cn'];

     
    mysql_query ( "delete from indicator where iname='$iname' and iclass='$iclass'");
    
    echo " <font face='Tahoma' size='+1'>Delete Indicator is done...</font>";
    
    echo"<script>parent.menu.location='ListIndicators.php';</script>";
   
   }

//********************update class ok****************************************************************

if ($c=='6'){//update class
    $classname=$_REQUEST['cname'];
    $trans=$_REQUEST['ctname'];
    $funct=$_REQUEST['cequation'];
    $comment=$_REQUEST['ccomment'];

    $req="UPDATE  `indicatorclass` SET  
    `ClassEquation` =  '$funct',
    `ClassTransfor` =  '$trans',
    `ClassComment` =  '$comment' WHERE ClassName='$classname'" ;
    mysql_query ($req);
    echo " <font face='Tahoma' size='+1'>Class Update is done...</font>";
    
}

//********************delete class ok****************************************************************

if ($c=='7'){// delete
    $classname=$_REQUEST['cn'];

    mysql_query ( "delete from indicator where iclass='$classname'");
    mysql_query ( "delete from indicatorclass where classname='$classname'");
   echo " <font face='Tahoma' size='+1'>Class Delete is done...</font>";
        
    echo("<script>parent.menu.location='ListIndicators.php';</script>") ; 


}

 echo"<script>parent.menu.location='ListIndicators.php';</script>"; 
?>