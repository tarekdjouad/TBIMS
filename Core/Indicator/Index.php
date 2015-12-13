
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN"
   "http://www.w3.org/TR/html4/frameset.dtd">
<HTML>
<HEAD>
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

	<TITLE>TBSIM : Indicator Computation Module </TITLE>
</HEAD>

<FRAMESET ROWS="10%,*" >
<FRAME NAME ="head" SRC=<?php
	echo "'http://".$_SERVER['HTTP_HOST']."/TBSIM/Core/Config/HeadPage.php'"
?>
 scrolling="no"  frameborder="0" frameborder="0">
<FRAMESET COLS="23%,*">
	<FRAME NAME = "menu" SRC="ListIndicators.php" scrolling="no" frameborder="0">
	<FRAME  NAME="homes" SRC="Mains.php"  scrolling="yes" frameborder="0">
</FRAMESET>
</FRAMESET>
</HTML>
