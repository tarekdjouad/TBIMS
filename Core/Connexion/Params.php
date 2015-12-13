<head>
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
</head>
<div align=center>
<font face='tahoma'>

<?php
include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Config/HeadPage.php';

include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Config/SessionStart.php';
include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Config/Config.php';


mysql_connect("$servername", "$username", "$Serverpassword")or die("cannot connect");
mysql_select_db("$DBUsers")or die("cannot select DB");

$sql = "SELECT * FROM users";
$s=mysql_query($sql);
?>
<body>
<br><br><br>
<hr size="2" width="900" align="left">






<div id="roundrect1" style="position:absolute; overflow:hidden; left:350px; top:143px; width:432px; height:250px; z-index:0"><img border=0 width="100%" height="100%" alt="" src="temps/cadre.png"></div>

<div id="text1" style="position:absolute; overflow:hidden; left:356px; top:172px; width:179px; height:34px; z-index:4">
<div class="wpmd">
<div><font face="Tahoma" class="ws11">Current Password:</font></div>
</div></div>

<div id="text2" style="position:absolute; overflow:hidden; left:357px; top:227px; width:155px; height:34px; z-index:5">
<div class="wpmd">
<div><font face="Tahoma" class="ws11">New Password:</font></div>
</div></div>

<div id="text3" style="position:absolute; overflow:hidden; left:358px; top:276px; width:180px; height:34px; z-index:6">
<div class="wpmd">
<div><font face="Tahoma" class="ws11">Confirm Password:</font></div>
</div></div>

<form name="form1" method="POST" action="UpdatePassword.php" style="margin:0px">
<input name="pass" type="text" style="position:absolute;width:200px;left:546px;top:172px;z-index:1">
<input name="confpass" type="text" style="position:absolute;width:200px;left:546px;top:287px;z-index:2">
<input name="confpass2" type="text" style="position:absolute;width:200px;left:547px;top:225px;z-index:3">
<input name="formbutton1" type="submit" value="Update" style="position:absolute;left:503px;top:329px;z-index:7">
</form>






<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<hr size="2" width="900" align="left">
<br><br>

<?php

if ($TBSUser=='admin'){
echo "<form method='post' action='ConfirmUsers.php' name='aform'>";

echo "TBSIM : List of Users";

echo "
<p align='center'>
<table border=0 style='font-family:Verdana;' ><tr align='center'>
<td bgcolor='D6DFE7'><b><span style='font-size:12pt;'>
                      <font color='0000ff' face='Times new roman'>User Name
                      </font>
                      </span></b>
                      </td>
<td width='150' bgcolor='D6DFE7'><b><span style='font-size:12pt;'>
                      <font color='0000ff' face='Times new roman'>Password
                      </font>
                      </span></b>
                      </td>
<td width='150' bgcolor='D6DFE7'><b><span style='font-size:12pt;'>
                      <font color='0000ff' face='Times new roman'>Email
                      </font>
                      </span></b>
                      </td>
<td width='150' bgcolor='D6DFE7'><b><span style='font-size:12pt;'>
                      <font color='0000ff' face='Times new roman'>Can Use TBSIM
                      </font>
                      </span></b>
                      </td>

<td width='150' bgcolor='D6DFE7'><b><span style='font-size:12pt;'>
                      <font color='0000ff' face='Times new roman'>Delete User
                      </font>
                      </span></b>
                      </td>
                           
                      ";
while ($row = mysql_fetch_row($s)) 
{
    $n='';
    if ($row[3]=="true") $n='checked';
echo "<tr align='center'> 
<td bgcolor='CECFCE'><span style='font-size:12pt;'>
                      <font color='black' face='Times new roman'>".$row[0]."
					  </font>
					  </span>
					  </td>
<td bgcolor='CECFCE'><span style='font-size:12pt;'>
                      <font color='black' face='Times new roman'>".$row[1]."
					  </font>
					  </span>
					  </td>
<td bgcolor='CECFCE'><span style='font-size:12pt;'>
                      <font color='black' face='Times new roman'>".$row[2]."
					  </font>
					  </span>
					  </td>
<td bgcolor='CECFCE'><span style='font-size:12pt;'>
                      <font color='black' face='Times new roman'>
                      <input type=\"checkbox\" name=\"validate[]\" value=".$row[0]."  ".$n." />

					  </font>
					  </span>
					  </td>

<td bgcolor='CECFCE'><span style='font-size:12pt;'>
                      <font color='black' face='Times new roman'>
                      <input type=\"checkbox\" name=\"DelUser[]\" value=".$row[0]." />

					  </font>
					  </span>
					  </td>

</p>";

}
echo "</table>";
echo "</body>";
echo "<br><br>";
echo "<input type='submit' value='Update List' align='center'>";
echo "</form>";
echo "<br><br><br>";
echo "<hr size='2' width='900' align='left'>";
echo "<br><br>";

$sql = "SELECT * FROM usersrequests";
$s=mysql_query($sql);

echo "TBSIM : List requests";

echo "
<p align='center'>
<table border=0><tr align='center'>
<td bgcolor='D6DFE7'><b><span style='font-size:12pt;'>
                      <font color='0000ff' face='Times new roman'>User Email
                      </font>
                      </span></b>
                      </td>
<td width='150' bgcolor='D6DFE7'><b><span style='font-size:12pt;'>
                      <font color='0000ff' face='Times new roman'>Message
                      </font>
                      </span></b>
                      </td>
<td width='150' bgcolor='D6DFE7'><b><span style='font-size:12pt;'>
                      <font color='0000ff' face='Times new roman'>Time
                      </font>
                      </span></b>
                      </td>                           
                      ";
while ($row = mysql_fetch_row($s)) 
{
echo "<tr align='center'> 
<td bgcolor='CECFCE'><span style='font-size:12pt;'>
                      <font color='black' face='Times new roman'>".$row[0]."
					  </font>
					  </span>
					  </td>
<td bgcolor='CECFCE'><span style='font-size:12pt;'>
                      <font color='black' face='Times new roman'>".$row[1]."
					  </font>
					  </span>
					  </td>
<td bgcolor='CECFCE'><span style='font-size:12pt;'>
                      <font color='black' face='Times new roman'>".$row[2]."
					  </font>
					  </span>
					  </td>

</p>";
}
}
echo "</table>";
mysql_close();
?>

</body>
<br><br>
<br><br><br>
<hr size="2" width="900" align="left">
<br><br>