<html>
<head>
<script LANGUAGE="JavaScript">
/*
SCRIPT EDITE SUR L'EDITEUR JAVASCRIPT
http://www.editeurjavascript.com
*/
if (parent.frames.length > 0)
	{
	window.top.location.href = location.href;
	}
</script>

	<TITLE>TBSIM : Collect Module </TITLE>
</head>

<FRAMESET ROWS="10%,*" >
<FRAME NAME ="head" SRC=<?php
	echo "'http://".$_SERVER['HTTP_HOST']."/TBSIM/Core/Config/HeadPage.php'"
?>
 scrolling="no"  frameborder="0" frameborder="0">
<FRAMESET COLS="23%,*">
	<FRAME NAME = "menu" SRC="Panel.php" scrolling="no" frameborder="0" >
	<FRAME  NAME="homes" SRC="Mains.php"  scrolling="yes" frameborder="0">
</FRAMESET>
</FRAMESET>

</html>
