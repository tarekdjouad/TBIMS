<?php

  

include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Config/SessionStart.php';
include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Config/Config.php';
  $page="IndexTransformation.php";  
$DBM=$_SESSION['DB'];
 
  $choix=$_REQUEST['pm'];
  
  if (isset ($_REQUEST['fichier']))
     $f=$_REQUEST['fichier'];
  


  mysql_select_db("$DBM")or die("cannot select DB");
  

//***********************************************************************************************************
// Ajouter une ligne dans la grille

if ($choix=='4') {
    
    $cx=$_REQUEST['cc'];
    mysql_query("INSERT INTO `transformation` 
    ( `ts`, `td`, `Nom_op`, `Nom_par`, `Add_par`) VALUES ( NULL, NULL, 'NULL', 'NULL', 'NULL')");
    if ($cx=='1') 
       echo "<META HTTP-EQUIV='Refresh' Content=1;URL='CreateTransClass.php'>"; 
    if ($cx=='2') 
       echo "<META HTTP-EQUIV='Refresh' Content=1;URL='CreateTrans.php'>"; 

}

//***********************************************************************************************************
// Charger les vues: transformation/Classe transformation (page au milieu)

if ($choix=='5'){
    $cx=$_REQUEST['cc'];
    mysql_query("TRUNCATE TABLE transformation");
     if ($cx=='1') 
       echo "<META HTTP-EQUIV='Refresh' Content=1;URL='CreateTransClass.php'>"; 
    if ($cx=='2') 
       echo "<META HTTP-EQUIV='Refresh' Content=1;URL='CreateTrans.php'>"; 
}        
        
//****************************************************************************     
//Créer la Classe de Transformation (Pour la première fois))
     

if ($choix=='6'){
    $classname=$_REQUEST['tname'];
    $_SESSION['CurrentTransClass']=$classname;    
    mysql_query("TRUNCATE TABLE transformation");
    echo "<META HTTP-EQUIV='Refresh' Content=1;URL='CreateTransClass.php'>"; 
} 
//**************************************************************************************************    
// Créer une nouvelle transformation (à partir d'une classe qui existe)

if ($choix=='7'){
    $trsname=$_REQUEST['transname'];
    $classname=$_REQUEST['transclass'];
     mysql_query("insert into classtans Values ('$classname','$trsname')");
     mysql_query("TRUNCATE TABLE transformation");
     
     $req=mysql_query("select * from transformationclass where cname='$classname'");
// remplir transformation
    while ($row = mysql_fetch_array($req))  {
            $sql1 = "INSERT INTO transall
            Values ('$row[0]','$row[1]','$row[2]','$row[3]','$row[4]','$trsname')";   
            mysql_query($sql1);
}
$req=mysql_query("select * from transformationclass where cname='$classname'");
// remplir ensuite la grille de vue
    while ($row = mysql_fetch_array($req))  {
            $sql1 = "INSERT INTO transformation
            Values ('','$row[0]','$row[1]','$row[2]','$row[3]','$row[4]')";   
            mysql_query($sql1);
}  
  
     $_SESSION['CurrentTrans']=$trsname;
       
     // il faut par la suite remplir la table transformation par les valeurs
   echo "<META HTTP-EQUIV='Refresh' Content=1;URL='CreateTrans.php'>"; 
 }
//**************************************************************************************************    
 // enregistrer une transformation qui existe
 
 if ($choix=='8'){
 $trsname=$_SESSION['CurrentTrans'];

// supprimer l'ancienne transformation'

 mysql_query("delete from transall where tname='$trsname'");

 $req=mysql_query("SELECT * FROM transformation");
// à voir l'odre des row'

while ($row = mysql_fetch_array($req))  {
            $sql1 = "INSERT INTO transall
            Values ('$row[1]','$row[2]','$row[3]','$row[4]','$row[5]','$trsname')";   
            mysql_query($sql1);
}
 echo " <font face='Tahoma' size='-1'>Transformation Saved is done...</font>";
    
    echo"<script>parent.menu.location='ListTransformations.php';</script>"; 

} 

//**********************************************************************************************
//enregistrer une transformation classe qui existe

if ($choix=='9'){
 $trcsname=$_SESSION['CurrentTransClass'];
  mysql_query("delete from transformationclass where cname='$trcsname'");
  
 $req=mysql_query("SELECT * FROM transformation");
// à voir l'odre des row'
while ($row = mysql_fetch_array($req))  {
            $sql1 = "INSERT INTO transformationclass
            Values ('$row[1]','$row[2]','$row[3]','$row[4]','$row[5]','$trcsname')";   
            mysql_query($sql1);
}
     //mysql_query("TRUNCATE TABLE transformation");
     //$_SESSION['CurrentTrans']='';  
  echo " <font face='Tahoma' size='-1'>Transformation Class Saved is done...</font>";
    
  echo"<script>parent.menu.location='ListTransformations.php';</script>"; 
 
} 

//**********************************************************************************************
//Charger une classe de transformation

if ($choix=='10'){
    $cname=$_REQUEST['cname'];
    $_SESSION['CurrentTransClass']=$cname;    
    mysql_query("TRUNCATE TABLE transformation");
    $req=mysql_query("select * from transformationclass where cname='$cname'");
// remplir ensuite transformation
    while ($row = mysql_fetch_array($req))  {
            $sql1 = "INSERT INTO transformation
            Values (NULL,'$row[0]','$row[1]','$row[2]','$row[3]','$row[4]')";   
            mysql_query($sql1);
} 

echo "<META HTTP-EQUIV='Refresh' Content=1;URL='CreateTransClass.php'>"; 


}   
//**********************************************************************************************
//Charger une transformation

if ($choix=='11'){
    $tname=$_REQUEST['tname'];
    $_SESSION['CurrentTrans']=$tname;    
    mysql_query("TRUNCATE TABLE transformation");
    $req=mysql_query("select * from transall where tname='$tname'");
// remplir ensuite transformation
    while ($row = mysql_fetch_array($req))  {
            $sql1 = "INSERT INTO transformation
            Values ('','$row[0]','$row[1]','$row[2]','$row[3]','$row[4]')";   
            mysql_query($sql1);
} 

echo "<META HTTP-EQUIV='Refresh' Content=1;URL='CreateTrans.php'>"; 


} 
//**********************************************************************************************
//Supprimer une classe de transformation et toutes les transformations associées

if ($choix=='12'){
    $tname=$_REQUEST['tname'];
    mysql_query("TRUNCATE TABLE transformation");
    mysql_query("delete from transall where tname='$tname'");
    mysql_query("delete from classtans where tname='$tname'");
    $_SESSION['CurrentTrans']=''; 
    echo "<b>Delete Transformation is done with Success...</b>";
    echo "<META HTTP-EQUIV='Refresh' Content=1;URL='Index.php'>"; 
}

//**********************************************************************************************
// Supprimer une transformation


if ($choix=='13'){
    $cname=$_REQUEST['cname'];
    $_SESSION['CurrentTransClass']=$cname;    
    
    mysql_query("TRUNCATE TABLE transformation");
    
    mysql_query("delete from transformationclass where cname='$cname'");
   
    $req=mysql_query("select tname from classtans where cname='$cname'");
// remplir ensuite transformation
    while ($row = mysql_fetch_array($req))  {
            $sql1 = "delete from transall where tname='$row[0]'";   
            mysql_query($sql1);
     } 
   
    mysql_query("delete from classtans where cname='$cname'");
    
    $_SESSION['CurrentTrans']=''; 
    echo "<b>Delete Transformation class is done with Success...</b>";
    echo "<META HTTP-EQUIV='Refresh' Content=1;URL='Index.php'>"; 
}
//**********************************************************************************************
// exécuter transformation
if ($choix=='13'){
include 'ExecuteTransformation.php';
}
//**********************************************************************************************
//Importer une classe


//**********************************************************************************************
//Importer une transformation

//**********************************************************************************************
//Exporter une classe de transformation transformation
//**********************************************************************************************
//Exporter une transformation

//**********************************************************************************************


mysql_close();

?>