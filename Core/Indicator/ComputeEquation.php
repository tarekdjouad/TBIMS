<?php
include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Config/SessionStart.php';
include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Config/Config.php';
$DBM=$_SESSION['DB'];
$iname=$_REQUEST['iname'];
$equation=$_REQUEST['equation'];
$equationval=$_REQUEST['equationval'];



$_SESSION['equation']=$equation;
$_SESSION['equationval']=$equationval;
    $_SESSION['iname']=$iname;
    
    
if (isset ($_REQUEST['ComputeValues'])){

$X='';
$Val='';
include('evalmath.class.php');
$equation = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $equation);
$equation=str_replace(' ','',$equation);
$m = new EvalMath;
$m->suppress_errors = true;

$Tch    =   explode("\n",$equation);

foreach ($Tch as $value){

  $X =   explode("=",$value);
  $res=$m->evaluate($value);  
 // echo $res."<br>";
 if ($X[0]!='')
      $Val=$Val.$X[0]."=".$res."\n";
}
$Val = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $Val);
$Val=str_replace(' ','',$Val);

 mysql_select_db("$DBM");
 
  $req="UPDATE  `indicator` SET  `iequation` ='$equation',`ivalues` ='$Val' WHERE iname='$iname'" ;    
  mysql_query ($req);
mysql_close();    
header('Location: LoadIndicator.php?cn='.$iname);

}
else
{
    
echo "<html>";

echo "<body>";
echo "<div id='image1' style='position:absolute; overflow:hidden; left:443px; top:130px; width:105px; height:99px; z-index:0'>
<a href='IndicatorView.php?ch=13'   target='iFrame1'>
<img src='temps/p1.PNG' alt='' title='' border=0 width=105 height=99></a></div>";

echo "<div id='image2' style='position:absolute; overflow:hidden; left:442px; top:29px; width:107px; height:98px; z-index:1'>
<a href='IndicatorView.php?ch=12'   target='iFrame1'>
<img src='temps/p2.PNG' alt='' title='' border=0 width=107 height=98></a><</div>";

echo "<div id='image4' style='position:absolute; overflow:hidden; left:11px; top:129px; width:104px; height:98px; z-index:2'>
<a href='IndicatorView.php?ch=11'   target='iFrame1'>
<img src='temps/p3.PNG' alt='' title='' border=0 width=104 height=98></a><</div>";

echo "<div id='image5' style='position:absolute; overflow:hidden; left:229px; top:130px; width:104px; height:98px; z-index:3'>
<a href='IndicatorView.php?ch=1'   target='iFrame1'>
<img src='temps/l0.PNG' alt='' title='' border=0 width=104 height=98></a><</div>";

echo "<div id='image6' style='position:absolute; overflow:hidden; left:335px; top:131px; width:106px; height:97px; z-index:4'>
<a href='IndicatorView.php?ch=3'   target='iFrame1'>
<img src='temps/l1.PNG' alt='' title='' border=0 width=106 height=97></a><</div>";

echo "<div id='image7' style='position:absolute; overflow:hidden; left:551px; top:130px; width:108px; height:98px; z-index:5'>
<a href='IndicatorView.php?ch=2'   target='iFrame1'>
<img src='temps/l2.PNG' alt='' title='' border=0 width=106 height=96 style='border:#808080 1px solid'></a><</div>";

echo "<div id='image8' style='position:absolute; overflow:hidden; left:119px; top:29px; width:108px; height:98px; z-index:6'>
<a href='IndicatorView.php?ch=5'   target='iFrame1'>
<img src='temps/l3.PNG' alt='' title='' border=0 width=108 height=98></a><</div>";

echo "<div id='image9' style='position:absolute; overflow:hidden; left:120px; top:130px; width:106px; height:97px; z-index:7'>
<a href='IndicatorView.php?ch=6'   target='iFrame1'>
<img src='temps/l4.PNG' alt='' title='' border=0 width=106 height=97></a><</div>";

echo "<div id='image10' style='position:absolute; overflow:hidden; left:230px; top:29px; width:104px; height:98px; z-index:8'>
<a href='IndicatorView.php?ch=9'   target='iFrame1'>
<img src='temps/l5.PNG' alt='' title='' border=0 width=104 height=98></a><</div>";

echo "<div id='image11' style='position:absolute; overflow:hidden; left:336px; top:29px; width:104px; height:98px; z-index:9'>
<a href='IndicatorView.php?ch=4'   target='iFrame1'>
<img src='temps/l6.PNG' alt='' title='' border=0 width=104 height=98></a><</div>";

echo "<div id='image3' style='position:absolute; overflow:hidden; left:11px; top:29px; width:104px; height:96px; z-index:10'>
<a href='IndicatorView.php?ch=7'   target='iFrame1'>
<img src='temps/l7.PNG' alt='' title='' border=0 width=104 height=96></a><</div>";

echo "<div id='iFrame1' style='position:absolute; left:10px; top:343px; z-index:11'>";
echo "<iframe name='iFrame1' width='733' height='319' src='' scrolling='No' 
frameborder='0' BORDERCOLOR='#C0C0C0'></iframe>";
echo "</div>";

echo "</body>";
echo "</html>";
echo "</body>";
echo "</html>";
}

?>