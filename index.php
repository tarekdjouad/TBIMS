<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<!-- DEBUT DU SCRIPT -->
<SCRIPT LANGUAGE="JavaScript">
/*
SCRIPT EDITE SUR L'EDITEUR JAVASCRIPT
http://www.editeurjavascript.com
*/
if (parent.frames.length > 0)
	{
	window.top.location.href = location.href;
	}
</SCRIPT> 
<title>TBS-IM Home page</title>
</head>
<body bgcolor="#E4F1F1">
<?php
include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Config/SessionStart.php';
//include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Config/Config.php';

$dr=$_SERVER['HTTP_HOST'];
$a='http://'.$dr.'/TBSIM/Core/Collect/Index.php'; 
$b='http://'.$dr.'/TBSIM/Core/Transformation/Index.php';
$c='http://'.$dr.'/TBSIM/Core/TraceViewer/Index.php';
$d='http://'.$dr.'/TBSIM/Core/Indicator/Index.php';
$e='http://'.$dr.'/TBSIM/Core/Connexion/Logout.php';

?>
<html>
<head>
  
  <title>TBS-IM</title>
  
</head>
<body>

<div id="roundrect1" style="position:absolute; overflow:hidden; 
left:522px; top:106px; width:329px; height:45px; z-index:0">
     
</div>


<div id="roundrect1" style="position:absolute; overflow:hidden; 
left:452px; top:206px; width:329px; height:45px; z-index:0">
<img border=0 width="100%" height="100%" alt="" 
src="Config/temps/corps.png">
</div>

<div id="image1" style="position:absolute; overflow:hidden; 
left:500px; top:209px; width:32px; height:32px; z-index:1">
<a href=<?php echo $a;?> title="Collet Module">
<img src="Core/Config/temps/collect.png" 
alt="" title="" border=0 width=32 height=32></a></div>

<div id="image2" style="position:absolute; overflow:hidden; 
left:708px; top:211px; width:32px; height:32px; z-index:2">
<a href=<?php echo $e;?> title="Logout">
<img src="Core/Config/temps/logout.png" 
alt="" title="" border=0 width=32 height=32></a></div>

<div id="image3" style="position:absolute; overflow:hidden; 
left:600px; top:211px; width:32px; height:32px; z-index:3">
<a href=<?php echo $d;?> title="Indicator Module">
<img src="Core/Config/temps/stat.png" alt="" title="" border=0 width=32 height=32></a></div>

<div id="image4" style="position:absolute; overflow:hidden; 
left:657px; top:210px; width:32px; height:32px; z-index:4">
<a href=<?php echo $c;?> title="Tracks Data Base">
<img src="Core/Config/temps/trace.png" 
alt="" title="" border=0 width=32 height=32></a></div>

<div id="image5" style="position:absolute; overflow:hidden; 
left:551px; top:210px; width:32px; height:32px; z-index:5">
<a href=<?php echo $b;?> title="Transformation Module">
<img src="Core/Config/temps/transform.png" 
alt="" title="" border=0 width=32 height=32></a></div>


</body>
</html>