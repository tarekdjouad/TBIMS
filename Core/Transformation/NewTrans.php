
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<body bgcolor="#FFFFFF">
<div id="shape1" style="position:absolute; overflow:hidden; left:138px; top:15px; 
width:645px; height:192px; z-index:0"><img border="0" width="100%" height="100%" 
alt="" src="temps/shape2.png""></div>

<div id="text1" style="position:absolute; overflow:hidden; left:270px; top:60px; 
width:276px; height:37px; z-index:1">
<div class="wpmd">
<div><font face="Tahoma" class="ws11" size="-1">Transformation Name:</font></div>
</div></div>

<div id="text2" style="position:absolute; overflow:hidden; 
left:270px; top:99px; width:310px; height:37px; z-index:2">
<div class="wpmd">
<div><font face="Tahoma" class="ws11" size="-1">Transformation Class Name:</font></div>
</div></div>

<form action="ManageMenue.php?pm=7" method="POST"  name="aform">
  <input name="transname" type="text" style="position:absolute;width:200px;left:454px;top:56px;z-index:3">
  <select name="transclass" style="position:absolute;left:454px;top:97px;width:200px;z-index:4">
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
<input name="Send" type="submit" value="Create" style="position:absolute;left:478px;top:157px;z-index:5">

</form>


</body>
</html>