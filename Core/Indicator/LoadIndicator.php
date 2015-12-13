<?php

include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Config/SessionStart.php';
include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Config/Config.php';
$DBM=$_SESSION['DB'];

$iname=$_REQUEST['cn'];

mysql_select_db("$DBM")or die("cannot select DB");

$sql = mysql_query( "select iequation,itransformation,ivalues from indicator where iname= '$iname'" ) 
or die ( "Can not connect to indicator class librery " ) ;

$data = mysql_fetch_array ($sql );
$equation=$data[0];
$tname=$data[1];
$equationval=$data[2];

$EditTrans="http://".$_SERVER['HTTP_HOST']."/TBSIM/Core/Transformation/ManageMenue.php?pm=11&tname=$tname";                     
?>

<html>
<head>
</head>
<body style="font-family: Tahoma; font-size: 13px; ">
<div id="image1" style="position:absolute; overflow:hidden; 
left:26px; top:88px; width:660px; height:519px; z-index:0">
<img src="temps/img17648906.png"  border="0" width="660" height="519"></div>

<div id="text1" style="position:absolute; overflow:hidden; 
left:63px; top:101px; width:127px; height:34px; z-index:1">
<div class="wpmd">
<div><font face="Tahoma">Indicator Name:</font></div>
</div></div>

<div id="text2" style="position:absolute; overflow:hidden; 
left:63px; top:140px; width:121px; height:31px; z-index:2">
<div class="wpmd">
<div><font face="Tahoma">Equation:</font></div>
</div></div>

<div id="text4" style="position:absolute; overflow:hidden; 
left:403px; top:96px; width:250px; height:24px; z-index:7">
<div class="wpmd">
<div><font face="Tahoma"><a href=<?php echo $EditTrans;?> title="edit" target="_blank"> Edit Related Transformation</a></font></div>
</div></div>

<form name="form1" method="post" action="ComputeEquation.php" enctype="application/x-www-form-urlencoded" style="margin:0px">

<input name="iname" type="text"  style ="position:absolute;width:181px;left:200px;top:93px;z-index:3" value=<?php echo $iname; ?> >

<textarea name="equation" style="position:absolute;left:200px;top:141px;width:410px;height:193px;z-index:6"><?php echo $equation;?></textarea>

<input name="ComputeValues" type="submit" value="Compute Values" style="position:absolute;left:192px;top:563px;z-index:7">

<input name="View" type="submit" value="View Indicator" style="position:absolute;left:420px;top:563px;z-index:8">

<textarea name="equationval" style="position:absolute;left:202px;top:344px;width:410px;height:193px;z-index:10"><?php echo $equationval;?></textarea>

</form>

<div id="text4" style="position:absolute; overflow:hidden; left:0px; top:29px; width:548px; height:38px; z-index:9">
<div class="wpmd">
<div><font face="Tahoma">You can now edit current equation to obtain new values</font></div>
</div></div>

<div id="text5" style="position:absolute; overflow:hidden; left:61px; top:342px; width:135px; height:31px; z-index:11">
<div class="wpmd">
<div><font face="Tahoma">Equation Values:</font></div>
</div></div>


</body>
</html>
