<html>
<body bgcolor="#FFFFFF">
<font face="tahoma" size="-1 pt">
								   
<form name="form1" action="CollectModule.php" method="post">

<hr size="2" width="900" align="left">
<br>
Choose a course name: 

<?php

include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Config/SessionStart.php';
include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Config/Config.php';

mysql_select_db("$dbmoodle")or die("cannot select DB");

$result = mysql_query("SELECT full_name FROM mdl_course");

$dropdown = "<select name='selectt'> <font face='tahoma' size='-1 pt'>";
        while($row = mysql_fetch_assoc($result)) {
          $c=$row['full_name'];
          $dropdown .= "\r\n<option value='$c'> $c </option>";


        }
        $dropdown .= "\r\n</select>";
        echo $dropdown;
  mysql_close();
?>


<br>
<br>
 <label for="from">Select Time from : </label>
 <input type="text" id="from" name="from"/>
 <label for="to">to</label>
 <input type="text" id="to" name="to"/> (Ex: 01 october 2012, or : 10/01/2012)
<br>
<br>

<hr size="2" width="900" align="left">
<br><br>
 
	
	<input type="checkbox" name="ch21" value="login" checked="checked"/> Login<br />
	<input type="checkbox" name="ch22" value="Logout" checked="checked"/> Logout<br />
	<input type="checkbox" name="ch2" value="ChatEnter" checked="checked"/> ChatEnter<br />
	<input type="checkbox" name="ch9" value="ChatExit" checked="checked"/> ChatExit<br />
	<input type="checkbox" name="ch11" value="ChatMessage" checked="checked"/> ChatMessage<br />
	<input type="checkbox" name="ch4" value="PrivateMessage" checked="checked"/> PrivateMessage<br />
	<input type="checkbox" name="ch5" value="Upload" checked="checked"/> Upload<br />
	<input type="checkbox" name="ch10" value="ForumView" checked="checked"/> ForumView<br />
	<input type="checkbox" name="ch20" value="ForumPost" checked="checked"/> ForumPost<br />
	<input type="checkbox" name="ch7" value="WikiView" checked="checked"/> WikiView<br />
	<input type="checkbox" name="ch8" value="WikiEdit" checked="checked"/> WikiEdit<br />
	<input type="checkbox" name="ch6" value="ResourceView" checked="checked"/> ResourceView<br />
    <br>
	<br>		
    <hr size="2" width="900" align="left">

	<input type="submit" value="Start Collect" />
   	<br>
</form>
		
</body>
</html>