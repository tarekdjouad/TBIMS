<?php
include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Config/SessionStart.php'; 
include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Config/Config.php'; 
$DBM=$_SESSION['DB'];

mysql_select_db("$DBM")or die("cannot select DB");
$classname=$_REQUEST['cn'];

//------------------------------------------------------------


  mysql_connect("$servername", "$username", "$Serverpassword")or die("cannot connect");
  mysql_select_db("$DBM")or die("cannot select DB");
//echo $DBM;
  $req="select * from indicatorclass where classname='$classname'";
//  echo $req;
  
  $sql = mysql_query($req) or die ( "Can not connect to indicator class librery " ) ;
//echo $sql;
  $data = mysql_fetch_array ($sql );
       
?>
</head>
<body style="font-family: Tahoma; font-size: 13px; ">
<div id="roundrect1" style="position:absolute; overflow:hidden; 
left:170px; top:31px; width:512px; height:416px; z-index:0">
<img border=0 width="100%" height="100%" alt="" src="temps/cadre4.png"></div>

<div id="text1" style="position:absolute; overflow:hidden; 
left:260px; top:48px; width:150px; height:34px; z-index:1">
<div class="wpmd">
<div><font face="Tahoma" class="ws11">Class Name:</font></div>
</div></div>

<div id="text2" style="position:absolute; overflow:hidden; 
left:260px; top:90px; width:217px; height:34px; z-index:2">
<div class="wpmd">
<div><font face="Tahoma" class="ws11">Transformation Class:</font></div>
</div></div>

<div id="text3" style="position:absolute; overflow:hidden; 
left:260px; top:122px; width:104px; height:32px; z-index:3">
<div class="wpmd">
<div><font face="Tahoma" class="ws11">Equation:</font></div>
</div></div>

<div id="text4" style="position:absolute; overflow:hidden; 
left:260px; top:253px; width:104px; height:32px; z-index:8">
<div class="wpmd">
<div><font face="Tahoma" class="ws11">Comment:</font></div>
</div></div>


<form name="form1" method="POST" action="ManageIndicator.php?pm=6">

<input name="cname" type="text" value=<?php echo "$data[0]";?> 
style="position:absolute;width:200px;left:410px;top:50px;z-index:4">
<input name="ctname" type="text" value=<?php echo "$data[1]";?> 
style="position:absolute;width:200px;left:410px;top:88px;z-index:5">
<textarea name="cequation" style="position:absolute;left:410px;top:122px;width:200px;height:125px;z-index:6"><?php echo "$data[2]";?></textarea>
<textarea name="ccomment" style="position:absolute;left:410px;top:255px;width:200px;height:125px;"><?php echo "$data[3]";?></textarea>

<input name="Send" type="submit" value="Update" style="position:absolute;left:364px;top:403px;">
</form>


</body>
</html>