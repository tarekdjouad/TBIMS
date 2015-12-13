
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<body>
<div id="roundrect1" style="position:absolute; overflow:hidden; 
left:100px; top:52px; width:460px; height:460px; z-index:0">
<img border="0" width="100%" height="100%" alt="" src="temps/cadre.png"></div>

<div id="text1" style="position:absolute; overflow:hidden; 
left:167px; top:71px; width:236px; height:37px; z-index:1">
<div class="wpmd">
<div><font face="Tahoma" size="-1px">Indicator Class Name:</font></div>
</div></div>


<div id="text2" style="position:absolute; overflow:hidden; 
left:167px; top:119px; width:236px; height:37px; z-index:2">

<div class="wpmd">
<div><font face="Tahoma" size="-1px">Transformation Class:</font></div>
</div>
</div>

<form name="form1" method="POST" action="ManageIndicator.php?pm=1" style="margin:0px">
<input name="ciname" type="text" style="position:absolute;width:200px;left:318px;top:70px;z-index:4">
<select name="ctname" style="position:absolute;left:320px;top:119px;width:200px;z-index:5">
<?php
include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Config/SessionStart.php'; 
include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Config/Config.php'; 
$DBM=$_SESSION['DB'];
//echo $DBM;
// corriger ici..................
mysql_select_db("$DBM")or die("cannot select DB");
$sql = mysql_query( "select Cname from transformationclass group by Cname" ) or die ( "Can not connect to transformations class librery " ) ;
while ($data = mysql_fetch_array ($sql ) )
       echo "<option>".$data[0]."</option>";                   
?>
</select>
<input name="Create" type="submit" value="Create" style="position:absolute;left:345px;top:470px;z-index:6">
<textarea name="cequation" style="position:absolute;
left:322px;top:177px;width:200px;height:125px;z-index:8"></textarea>
<textarea name="ccomment" style="position:absolute; 
left:322px;top:318px;width:200px;height:125px;z-index:10"></textarea>
</form>
<div id="text3" style="position:absolute; overflow:hidden; 
left:241px; top:173px; width:102px; height:37px; z-index:7">
<div class="wpmd">
<div><font face="Tahoma" size="-1px">Equation:</font></div>
</div></div>
<div id="text4" style="position:absolute; overflow:hidden; 
left:241px; top:315px; width:102px; height:37px; z-index:9">
<div class="wpmd">
<div><font face="Tahoma" size="-1px">Comment:</font></div>
</div></div>


</body>
</html>
