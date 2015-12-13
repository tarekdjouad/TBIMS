<?php

//**********************************************************

 if (isset ($_REQUEST['me']))
    include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Config/SessionStart.php';

include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Config/Config.php';
$DBM=$_SESSION['DB'];
$DbTrace="DB_".$TBSUser;
mysql_select_db($DbTrace);
// ************************vider la bd des traces avant l'exécution
//
   $sqlA = "SHOW TABLES FROM $DbTrace";
      $resultA = mysql_query($sqlA);
     while ($rowA = mysql_fetch_row($resultA)) {
        if ($rowA[0]!='primarytrace') {
            $sqlB= 'drop table '.$rowA[0];
            mysql_query($sqlB);    
        } 

      }

// ************************vider la bd des traces avant l'exécution

//**********************************************************

mysql_select_db($DBM)or die ("Cannot connect TBSIM Data base");
$req=mysql_query("SELECT * FROM transformation");

mysql_select_db($DbTrace)or die ("Cannot connect TBSIM Data base");

while ($row = mysql_fetch_array($req))  {
// create destination track
//    $Vtable = mysql_query("SHOW TABLES LIKE".$row[2]);
//    if (!(mysql_fetch_array($Vtable)) {
         mysql_query("CREATE TABLE IF NOT EXISTS ".$row[2]." (
              `ObservedID` varchar(60) NOT NULL,
              `UserID` varchar(60) NOT NULL,
              `ObservedType` varchar(60) NOT NULL,
              `ToolID` varchar(60) NOT NULL,
              `TimeVal` bigint(20) NOT NULL,
              `ObservedVal` text NOT NULL,
              `Comment` varchar(60) NOT NULL)");
                    
        if ($row[3]=='S_User') {

            mysql_select_db($DBM);
            $ru=mysql_query("select id from mdl_user where username='$row[4]'");           
        
            $rfinal = mysql_fetch_array($ru);
            mysql_select_db($DbTrace);
           
            $sql1 = "INSERT INTO ".$row[2]." SELECT * FROM ".$row[1]." WHERE `userid` ='".$rfinal[0]."'";   
            mysql_query($sql1);

        }
        if ($row[3]=='S_Tool') {
            $sql1 = "INSERT INTO ".$row[2]." SELECT * FROM ".$row[1]." WHERE `ToolID` = '".$row[4]."'";   
            mysql_query($sql1);
        }  



  
        if ($row[3]=='S_Type') {
            $sql1 = "INSERT INTO ".$row[2]." SELECT * FROM ".$row[1]." WHERE `ObservedType` = '".$row[4]."'";   
            mysql_query($sql1);

        }
        if ($row[3]=='S_Time') { 
            $words = preg_split("/[\s,]+/",$row[4]);
            $w1=strtotime($words[0]);
            $w2=strtotime($words[2]);
            $sql1 = "INSERT INTO ".$row[2]." SELECT * FROM ".$row[1]." WHERE (`TimeVal` >= '".$w1."') and (`TimeVal` <= '".$w2."')";   
            mysql_query($sql1);

        }
        
        if ($row[3]=='S_TimeInf'){ 
            $w1=strtotime($row[4]);
            $sql1 = "INSERT INTO ".$row[2]." SELECT * FROM ".$row[1]." WHERE (`TimeVal` <= '".$w1."') ";   
            mysql_query($sql1);

        }
        
        if ($row[3]=="S_TimeSup") {
            $w1=strtotime($row[4]); 
            $sql1 = "INSERT INTO ".$row[2]." SELECT * FROM ".$row[1]." WHERE (`TimeVal` >= '".$w1."') ";           
            mysql_query($sql1);

        }

// rewrite Type*******************************************************************************
  if ($row[3]=="R_Type") {
        
            $sql1 = "INSERT INTO ".$row[2]." SELECT * FROM ".$row[1];           
             mysql_query($sql1);
           
            $sql1 = "Update ".$row[2]." set ObservedType = '".$row[5]."' where ObservedType = '".$row[4]."'";          
            mysql_query($sql1);
          
            $sql1 = "Update ".$row[2]." set ObservedID = CONCAT ('RP_',ObservedID)  where ObservedType = '".$row[5]."'" ;          
            mysql_query($sql1);
          
        }

// rewrite Tool*******************************************************************************
  if ($row[3]=="R_Tool") {
        
            $sql1 = "INSERT INTO ".$row[2]." SELECT * FROM ".$row[1];           
             mysql_query($sql1);
           
            $sql1 = "Update ".$row[2]." set ToolID = '".$row[5]."' where ToolID = '".$row[4]."'";          
            mysql_query($sql1);

            $sql1 = "Update ".$row[2]." set ObservedID = CONCAT ('RT_',ObservedID) where ToolID = '".$row[5]."'" ;          
            mysql_query($sql1);

           // mysql_select_db($DBM) or die "Error in connection...";
           // $ru=mysql_query("update mdl_tools set id '".$row[5]."' where id = '".$row[4]."'";
        
          

        }



// Fusion*******************************************************************************
  if ($row[3]=="M_Fusion") {
        
            $sql1 = 
"INSERT INTO ".$row[2]." 
SELECT * FROM ".$row[1]." 
union 
SELECT * FROM ".$row[4]." 
ORDER BY TimeVal";       
    
             mysql_query($sql1);
           
          
        }


// Fusion*******************************************************************************
  if ($row[3]=="R_Maching") {
      $items=explode(";", $row[4]);
      $icounts=count($items);
     echo  $icounts."<br>";
    $s='';
    $i=0; 
       for($i=0;$i < $icounts-1;$i++) 
                 $s=$s.'(ObservedType='.$items[$i].') or ';
     echo $s." (ObservedType = MeInTBS)<br>";

}


//*******************************************************************************
                    
}

 if (isset ($_REQUEST['me'])){
    
    echo "Transformation is done withe success. You can go to the tracks module to view tracks";
 }

?>
