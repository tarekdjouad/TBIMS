<?php
include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Config/SessionStart.php'; 
include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Config/Config.php'; 
$DBM=$_SESSION['DB'];
$iname=$_REQUEST['iname'];
$cname=$_REQUEST['cname'];

?>
<html>
<head>


</head>
<body style="font-family: Tahoma; font-size: 13px;">
<b>Step2:</b> Define Transformation Name related to the indicator

<div id="roundrect1" style="position:absolute; overflow:hidden; 
left:94px; top:103px; width:490px; height:150px; z-index:0">
<img border=0 width="100%" height="100%" alt="" src="temps/cadre3.png"></div>

<div id="text1" style="position:absolute; overflow:hidden; 
left:130px; top:120px; width:175px; height:37px; z-index:1">
<div class="wpmd">
<div><font face="Tahoma" class="ws11">Indicator Name:</font></div>
</div></div>

<div id="text2" style="position:absolute; overflow:hidden; 
left:129px; top:164px; width:182px; height:29px; z-index:2">
<div class="wpmd">
<div><font face="Tahoma" class="ws11">Indicator Class:</font></div>
</div></div>

<form method="POST" action="NewIndicatorFormNext2.php" style="margin:0px">
<input name="iname" type="text" style="position:absolute;width:200px;left:270px;top:120px;z-index:4"

value= <?php echo "$iname";?>  >
<input name="cname" type="text" style="position:absolute;left:270px;top:169px;width:200px;z-index:5"
value= <?php echo "$cname" ;?>
  readonly  >
<select name="tname" style="position:absolute;left:270px;top:212px;width:200px;z-index:7" 
onchange='this.form.submit()'>

<?php
mysql_select_db("$DBM")or die("cannot select DB");

$sql = mysql_query( "select ClassTransfor from indicatorclass where ClassName='$cname'" ) 
       or die ( "Can not connect to indicator class librery " ) ;
    $params = mysql_fetch_array ($sql );

// récupérer le nom de la classe de transformation
    
$sql = mysql_query( "select tname from classtans where cname='$params[0]'" ) 
       or die ( "Can not connect to indicator class librery " ) ;


while ($data = mysql_fetch_array ($sql ) )
       echo "<option>".$data[0]."</option>"; 
                  
?> 
</select>

<div id="text3" style="position:absolute; overflow:hidden; 
left:127px; top:207px; width:182px; height:29px; z-index:6">
<div class="wpmd">
<div><font face="Tahoma" class="ws11">Transformation :</font></div>
</div></div>


<input name="Create" type="submit" value="Next ->" 
style="position:absolute;left:500px;top:220px;z-index:6">


</form>


</body>
</html>