<?php

include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Config/SessionStart.php'; 
include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Config/Config.php'; 
//*************************************************************************


$equation=$_SESSION['equationval'];
$name=$_SESSION['iname'];
$ch=$_REQUEST['ch'];

$Tch    =   explode("\n",$equation);
$i=0;
//$chaine='';
foreach ($Tch as $row){
    $X =   explode("=",$row);
    if ($X[0]!='') {    
    $rowX[$i]=$X[1]*1;
    $rowY[$i]=$X[0].'='.$X[1];
    
    //$chaine=$chaine.$X[0].'==='.$X[1];
    }

    $i++; 
}
//echo $name.' '.$ch; 

include 'Plot.php';
if ($ch>=10){
PlotPie($rowX,$rowY,$name, $ch);
}else{
PlotLine($rowX,$rowY,$name, $ch);
}  

?>