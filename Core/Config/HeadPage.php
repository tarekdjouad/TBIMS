<?php

$dr=$_SERVER['HTTP_HOST'];
$a='http://'.$dr.'/TBSIM/Core/Collect/Index.php'; 
$b='http://'.$dr.'/TBSIM/Core/Transformation/Index.php';
$c='http://'.$dr.'/TBSIM/Core/TraceViewer/Index.php';
$d='http://'.$dr.'/TBSIM/Core/Indicator/Index.php';
$e='http://'.$dr.'/TBSIM/Core/Connexion/Logout.php';
$f='http://'.$dr.'/TBSIM/Core/Connexion/Params.php';

?>
<html>
<head>
  
  <title>TBS-IM</title>
  
</head>
<body bgcolor="#818181">
<div id="roundrect1" style="position:absolute; overflow:hidden; 
left:452px; top:6px; width:400px; height:45px; z-index:0">
<img border=0 width="100%" height="100%" alt="" 
src="temps/corps.png">
</div>

<div id="image1" style="position:absolute; overflow:hidden; 
left:500px; top:9px; width:32px; height:32px; z-index:1">
<a href=<?php echo $a;?> title="Collet Module">
<img src="temps/collect.png" 
alt="" title="" border=0 width=32 height=32></a></div>

<div id="image2" style="position:absolute; overflow:hidden; 
left:708px; top:11px; width:32px; height:32px; z-index:2">
<a href=<?php echo $e;?> title="Logout">
<img src="temps/logout.png" 
alt="" title="" border=0 width=32 height=32></a></div>

<div id="image2" style="position:absolute; overflow:hidden; 
left:760px; top:11px; width:32px; height:32px; z-index:2">
<a href=<?php echo $f;?> title="Logout">
<img src="temps/params.png" 
alt="" title="" border=0 width=32 height=32></a></div>


<div id="image3" style="position:absolute; overflow:hidden; 
left:600px; top:11px; width:32px; height:32px; z-index:3">
<a href=<?php echo $d;?> title="Indicator Module">
<img src="temps/stat.png" alt="" title="" border=0 width=32 height=32></a></div>

<div id="image4" style="position:absolute; overflow:hidden; 
left:657px; top:10px; width:32px; height:32px; z-index:4">
<a href=<?php echo $c;?> title="Tracks Data Base">
<img src="temps/trace.png" 
alt="" title="" border=0 width=32 height=32></a></div>

<div id="image5" style="position:absolute; overflow:hidden; 
left:551px; top:10px; width:32px; height:32px; z-index:5">
<a href=<?php echo $b;?> title="Transformation Module">
<img src="temps/transform.png" 
alt="" title="" border=0 width=32 height=32></a></div>


</body>
</html>