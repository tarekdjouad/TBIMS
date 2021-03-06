<head>
 <title>pChart 2.x - examples rendering</title>
 <style>
  body       { background-color: #F0F0F0; font-family: tahoma; font-size: 14px; height: 100%; overflow: auto;}
  table      { margin: 0px; padding: 0px; border: 0px; }
  tr         { margin: 0px; padding: 0px; border: 0px; }
  td         { font-family: tahoma; font-size: 11px; margin: 0px; padding: 0px; border: 0px; }
  div.folder { cursor: hand; cursor: pointer; }
  a.smallLinkGrey:link     { text-decoration: none; color: #6A6A6A; }
  a.smallLinkGrey:visited  { text-decoration: none; color: #6A6A6A; }
  a.smallLinkGrey:hover    { text-decoration: underline; color: #6A6A6A; }
  a.smallLinkBlack:link    { text-decoration: none; color: #000000; }
  a.smallLinkBlack:visited { text-decoration: none; color: #000000; }
  a.smallLinkBlack:hover   { text-decoration: underline; color: #000000; }
 </style>
</head>
<body>


<br>
    <li class="topmenu"><b>Create</b></span></a>
	<ul>
		<li><a href="NewTransClasses.php" TARGET='homes'>Transformation Class </a></li>
		<li><a href="NewTrans.php" TARGET='homes'>Transformation</a></li>
	</ul></li>
<br/>

<table><tr><td valign='top'>

<table style="border: 2px solid #FFFFFF;"><tr><td>

<div style='font-size: 11px; padding: 2px; color: #FFFFFF; 
background-color: #666666; border-bottom: 3px solid #484848; 
width: 222px;'>&nbsp;Transformations</div>

<div style='border: 3px solid #D0D0D0; 
border-top: 1px solid #FFFFFF; background-color: #FAFAFA; width: 220px; overflow: auto'>

<div style='padding: 1px; padding-bottom: 3px; color: #000000; background-color:#D0D0D0;'>
 <table>
 <tr>
  <td><img src='temps/application_view_list.png' width=16 height=16 alt=''/></td>
  <td>&nbsp;Click to Explore Tree</td>
 </tr>
</table>
</div>


<?php
include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Config/SessionStart.php';
include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Config/Config.php';
$DBM=$_SESSION['DB'];

mysql_select_db("$DBM")or die("cannot select DB");

$sql = mysql_query( "select cname from transformationclass group by cname" ) 
      or die ( "Can not connect transformation class librery " ) ;
while  ($data = mysql_fetch_array ($sql ) ){
        // afficher la classe
        $classname = $data['cname'] ; //$nom = $mysqlf['nom'] ;             
        echo "<table  noborder cellpadding=0 cellspacing=0>";
        echo " <tr valign=middle>";
        echo "  <td><img src='temps/dash-explorer.png' width=16 height=20 alt=''/></td>";
        echo "  <td><img src='temps/folder.png' width=16 height=16 alt=''/></td>";
        echo "  <td><div class=folder id='' ";
        echo "  onclick='showHideMenu(\"$classname\");'>&nbsp;$classname</div></td>";
        echo " </tr>";
        echo "</table>";
            
            // ensuite sa transformation
            $requette="select tname from classtans where cname='".$classname."'";
            $sql2 = mysql_query($requette ) or die ( "problem in selection " ) ;
             echo "<table id=\"$classname\" style='display: none;' noborder cellpadding=0 cellspacing=0><tr>";
            while ($data2 = mysql_fetch_array ($sql2) ) {
                $group = $classname ;
                $name = $data2['tname'] ;
               
                echo " <tr valign=middle>";
                echo "    <td><img src='temps/dash-explorer-noleaf.png' width=16 height=20 alt=''/></td>";
                echo "    <td><img src='temps/dash-explorer.png' width=16 height=20 alt=''/></td>";
                echo "    <td><img src='temps/application_view_tile.png' width=16 height=16 alt=''/></td>";
                echo "    <td><div id='test2.php'>&nbsp;";
                echo "       <a class=smallLinkGrey href='test2.php' onclick='render(\".php\");'>$name</a>";
                echo "        </div>";
                echo "    </td>";
                echo " </tr>";
               
                 
            }
             echo " </table>"; 
            
}
?>

</body>
<script>
 URL        = "";
 SourceURL  = "";
 LastOpened = "";
 LastScript = "";

 function showHideMenu(Element)
  {
   status = document.getElementById(Element).style.display;
   if ( status == "none" )
    {
     if ( LastOpened != "" && LastOpened != Element ) { showHideMenu(LastOpened); }

     document.getElementById(Element).style.display = "inline";
     document.getElementById(Element+"_main").style.fontWeight = "bold";
     LastOpened = Element;
    }
   else
    {
     document.getElementById(Element).style.display = "none";
     document.getElementById(Element+"_main").style.fontWeight = "normal";
     LastOpened = "";
    }
  }

 function render(PictureName)
  {
   if ( LastScript != "" ) { document.getElementById(LastScript).style.fontWeight = "normal"; }
   document.getElementById(PictureName).style.fontWeight = "bold";
   LastScript = PictureName;

   opacity("render",100,0,100);

   RandomKey = Math.random(100);
   URL       = PictureName + "?Seed=" + RandomKey;
   SourceURL = PictureName;

   ajaxRender(URL);
  }

 function StartFade()
  {
   Loader     = new Image();   
   Loader.src = URL;   
   setTimeout("CheckLoadingStatus()", 200);   
  }

 function CheckLoadingStatus()   
  {   
   if ( Loader.complete == true )   
    {
     changeOpac(0, "render");
     HTMLResult = "<center><img src='" + URL + "' alt=''/></center>";
     document.getElementById("render").innerHTML = HTMLResult;

     opacity("render",0,100,100);
     view(SourceURL);
    }
   else  
    setTimeout("CheckLoadingStatus()", 200);   
  }   

 function changeOpac(opacity, id)   
  {   
   var object = document.getElementById(id).style;   
   object.opacity = (opacity / 100);   
   object.MozOpacity = (opacity / 100);   
   object.KhtmlOpacity = (opacity / 100);   
   object.filter = "alpha(opacity=" + opacity + ")";   
  }   

 function wait()
  {
   HTMLResult = "<center><img src='temps/wait.gif' width=24 height=24 alt=''/><br>Rendering</center>";
   document.getElementById("render").innerHTML = HTMLResult;
   changeOpac(20, "render");
  }

 function opacity(id, opacStart, opacEnd, millisec)
  {
   var speed = Math.round(millisec / 100);
   var timer = 0;

   if(opacStart > opacEnd)
    {
     for(i = opacStart; i >= opacEnd; i--)
      {
       setTimeout("changeOpac(" + i + ",'" + id + "')",(timer * speed));
       timer++;
      }
     setTimeout("wait()",(timer * speed));
    }
   else if(opacStart < opacEnd)
    {
     for(i = opacStart; i <= opacEnd; i++)
      {
       setTimeout("changeOpac(" + i + ",'" + id + "')",(timer * speed));
       timer++;
      }
    }
  }

 function ajaxRender(URL)
  {
   var xmlhttp=false;   
   /*@cc_on @*/  
   /*@if (@_jscript_version >= 5)  
    try { xmlhttp = new ActiveXObject("Msxml2.XMLHTTP"); } catch (e) { try { xmlhttp = new ActiveXObject("Microsoft.XMLHTTP"); } catch (E) { xmlhttp = false; } }  
   @end @*/  
  
   if (!xmlhttp && typeof XMLHttpRequest!='undefined')   
    { try { xmlhttp = new XMLHttpRequest(); } catch (e) { xmlhttp=false; } }   
  
   if (!xmlhttp && window.createRequest)   
    { try { xmlhttp = window.createRequest(); } catch (e) { xmlhttp=false; } }   
  
   xmlhttp.open("GET", URL,true);

   xmlhttp.onreadystatechange=function() { if (xmlhttp.readyState==4) { StartFade();  } }   
   xmlhttp.send(null)   
  }

 function view(URL)
  {
   var xmlhttp=false;   
   /*@cc_on @*/  
   /*@if (@_jscript_version >= 5)  
    try { xmlhttp = new ActiveXObject("Msxml2.XMLHTTP"); } catch (e) { try { xmlhttp = new ActiveXObject("Microsoft.XMLHTTP"); } catch (E) { xmlhttp = false; } }  
   @end @*/  
  
   URL = "index.php?Action=View&Script=" + URL;

   if (!xmlhttp && typeof XMLHttpRequest!='undefined')   
    { try { xmlhttp = new XMLHttpRequest(); } catch (e) { xmlhttp=false; } }   
  
   if (!xmlhttp && window.createRequest)   
    { try { xmlhttp = window.createRequest(); } catch (e) { xmlhttp=false; } }   
  
   xmlhttp.open("GET", URL,true);

   xmlhttp.onreadystatechange=function() { if (xmlhttp.readyState==4) { Result = xmlhttp.responseText; document.getElementById("source").innerHTML = Result.replace("/\<BR\>/");  } }   
   xmlhttp.send(null)   
  }
</script>
</html>
