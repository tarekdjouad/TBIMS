<body bgcolor="#FFFFFF">
<font face="tahoma" size="-1">

<?php

//*************************************************************************************************

include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Config/SessionStart.php';
include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Config/Config.php';
   $DBM=$_SESSION['DB'];
//*************************************************************************************************
$t1=$_POST["from"];
$t2=$_POST["to"];

if ( empty ($t1) or empty ($t2)){
      echo"<br>You must specify collcting time interval before starting collecting data!!<br>";
      exit;
}

if ( empty ($_POST['selectt'])){
      echo"<br> You must choose Your Course Before starting collecting data<br>";
      exit;
}


$CourseName=$_POST['selectt'];
$temps1= strtotime("$t1");
$temps2= strtotime("$t2");

//*************************************************************************************************

mysql_query("CREATE DATABASE IF NOT EXISTS $DbTrace ");

mysql_select_db("$DbTrace")or die("Cannot connect to  $DbTrace database");

mysql_query("CREATE TABLE IF NOT EXISTS `primarytrace` (
  `ObservedID` varchar(60) NOT NULL,
  `UserID` varchar(60) NOT NULL,
  `ObservedType` varchar(60) NOT NULL,
  `ToolID` varchar(60) NOT NULL,
  `TimeVal` bigint(20) NOT NULL,
  `ObservedVal` text NOT NULL,
  `Comment` varchar(60) NOT NULL)
 ") or die("can not create primartrace");

//*************************************************************************************************

// Connect to server and select database.
//mysql_connect("$servername", "$username", "$Serverpassword")or die("Cannot connect to the server");
mysql_select_db("$dbmoodle")or die("Cannot connect to  Moodle database");

//receive time informations sent from checkboxes

$sql=("SELECT  `id` FROM  `mdl_course` WHERE  `fullname`= '$CourseName'");
$idcourse = mysql_query($sql);
$TempCourse= mysql_fetch_array($idcourse);
$idc=$TempCourse['id'] ;


//**************************************************************************************************
//init db tracks


   mysql_select_db($DbTrace);
   $sqlA = "SHOW TABLES FROM $DbTrace";
      $resultA = mysql_query($sqlA);
      while ($rowA = mysql_fetch_row($resultA)) {
        if ($rowA[0]!='primarytrace') {
            $sqlB= 'drop table '.$rowA[0];
            mysql_query($sqlB);    
        } 

      }
      
   mysql_query("TRUNCATE TABLE primarytrace ");

//**************************************************************************************************
// Start Collect

//Chat Enter***************************************************************************************

if (isset($_POST['ch2'])) {
mysql_select_db("$dbmoodle")or die("Cannot connect to  Moodle database");
$req=mysql_query("SELECT  `id`, `userid`, `message`,`chatid`,`timestamp` FROM `mdl_chat_messages` WHERE (`timestamp` >= '$temps1') and (`timestamp`<= '$temps2') and (`message`='enter') and `chatid` in (select `id` from `mdl_chat` where `course`='$idc')");


mysql_select_db("$DbTrace")or die("cannot find $dbTrace Model");


while ($data = mysql_fetch_row($req)){

        $A='ChatEnter'.$data[0];
        $B=$data[1];
        $C='ChatEnter';
        $D='ToolChat'.$data[3];
        $E=$data[4];
        $F=$data[2];

        $requete="Insert into `primarytrace` (`ObservedID`,`UserID`,`ObservedType`,`ToolId`,`TimeVal`,`ObservedVal`)
                  values ('$A','$B','$C','$D','$E','$F')";

        mysql_query($requete) or die ("error in chatEnter Collecting");
}
}
//Chat Exit***************************************************************************************

if (isset($_POST['ch9'])) {
mysql_select_db("$dbmoodle")or die("Cannot connect to  Moodle database");
$req=mysql_query("SELECT  `id`, `userid`, `message`,`chatid`,`timestamp` FROM `mdl_chat_messages` WHERE (`timestamp` >= '$temps1') and (`timestamp`<= '$temps2') and (`message`='exit') and `chatid` in (select `id` from `mdl_chat` where `course`='$idc')");

mysql_select_db("$DbTrace")or die("cannot find $dbTrace Model");

while ($data = mysql_fetch_row($req)){

        $A='ChatExit'.$data[0];
        $B=$data[1];
        $C='ChatExit';
        $D='ToolChat'.$data[3];
        $E=$data[4];
        $F=$data[2];


        $requete="Insert into `primarytrace` (`ObservedID`,`UserID`,`ObservedType`,`ToolId`,`TimeVal`,`ObservedVal`)
                  values ('$A','$B','$C','$D','$E','$F')";
        mysql_query($requete) or die ("error in chatExit Collecting");

}
}
//Chat Message ***************************************************************************************

if (isset($_POST['ch11'])) {
mysql_select_db("$dbmoodle")or die("Cannot connect to  Moodle database");

$req=mysql_query("SELECT  `id`, `userid`, `message`,`chatid`,`timestamp` FROM `mdl_chat_messages` WHERE (`timestamp` >= '$temps1') and (`timestamp`<= '$temps2') and (`message`<>'exit') and (`message`<>'enter') and `chatid` in (select `id` from `mdl_chat` where `course`='$idc')");

mysql_select_db("$DbTrace")or die("cannot find $dbTrace Model");

while ($data = mysql_fetch_row($req)){
        $A='ChatMessage'.$data[0];
        $B=$data[1];
        $C='ChatMessage';
        $D='ToolChat'.$data[3];
        $E=$data[4];
        $F=addslashes($data[2]);

        $requete="Insert into `primarytrace` (`ObservedID`,`UserID`,`ObservedType`,`ToolId`,`TimeVal`,`ObservedVal`)
                  values ('$A','$B','$C','$D','$E','$F')";
        mysql_query($requete) or die ("error in chatmessage Collecting");

}
}
//***************************************************************************************
//Private Message ***************************************************************************************

if (isset($_POST['ch4'])) {
mysql_select_db("$dbmoodle")or die("Cannot connect to  Moodle database");

$req=mysql_query("SELECT  `id`, `useridfrom`, `useridto`, `timecreated`, `smallmessage` FROM `mdl_message` WHERE (`TimeCreated` >= '$temps1') and (`TimeCreated`<= '$temps2') ");
mysql_select_db("$DbTrace")or die("cannot find $dbTrace Model");

while ($data = mysql_fetch_row($req)){
        $A='PrivateMessage'.$data[0];
        $B=$data[1];
        $C='PrivateMessage';
        $D=$data[2];
        $E=$data[3];
        $F=addslashes($data[4]);

        $requete="Insert into `primarytrace` (`ObservedID`,`UserID`,`ObservedType`,`ToolId`,`TimeVal`,`ObservedVal`,`comment`)
                  values ('$A','$B','$C','','$E','$F','$D')";
        mysql_query($requete) or die ("error in privatemessage Collecting");

}
}

//***************************************************************************************
//Resource View ***************************************************************************************

if (isset($_POST['ch6'])) {
mysql_select_db("$dbmoodle")or die("Cannot connect to  Moodle database");

$req=mysql_query(
"SELECT  `id`, `userid`, `time`,`info` 
FROM `mdl_log` WHERE 
(`time` >= '$temps1') and (`time`<= '$temps2') and (`module`='page') and (`action`='view') and (`course`='$idc')")
or die(mysql_error());

mysql_select_db("$DbTrace")or die("cannot find $dbTrace Model");

while ($data = mysql_fetch_row($req)){
        $A='ResourceView'.$data[0];
        $B=$data[1];
        $C='ResourceView';
        $D='ToolResource'.$data[3];
        $E=$data[2];

        $requete="Insert into `primarytrace` (`ObservedID`,`UserID`,`ObservedType`,`ToolId`,`TimeVal`,`ObservedVal`)
                  values ('$A','$B','$C','$D','$E','')";
        mysql_query($requete) or die ("error in resourceview Collecting");

}
}
//

//***************************************************************************************
//login ***************************************************************************************

if (isset($_POST['ch21'])) {
mysql_select_db("$dbmoodle")or die("Cannot connect to  Moodle database");

$req=mysql_query("SELECT  `id`, `userid`, `time` FROM `mdl_log` WHERE (`time` >= '$temps1') and (`time`<= '$temps2') and (`action`='login')");

mysql_select_db("$DbTrace")or die("cannot find $dbTrace Model");

while ($data = mysql_fetch_row($req)){
        $A='Login'.$data[0];
        $B=$data[1];
        $C='login';

        $E=$data[2];

        $requete="Insert into `primarytrace` (`ObservedID`,`UserID`,`ObservedType`,`ToolId`,`TimeVal`,`ObservedVal`)
                  values ('$A','$B','$C','','$E','')";
        mysql_query($requete) or die ("error in login Collecting");

}
}
//logOut ***************************************************************************************

if (isset($_POST['ch22'])) {
mysql_select_db("$dbmoodle")or die("Cannot connect to  Moodle database");

$req=mysql_query("SELECT  `id`, `userid`, `time` FROM `mdl_log` WHERE (`time` >= '$temps1') and (`time`<= '$temps2') and (`action`='logout')");

mysql_select_db("$DbTrace")or die("cannot find $dbTrace Model");

while ($data = mysql_fetch_row($req)){
        $A='Logout'.$data[0];
        $B=$data[1];
        $C='logout';

        $E=$data[2];

        $requete="Insert into `primarytrace` (`ObservedID`,`UserID`,`ObservedType`,`ToolId`,`TimeVal`,`ObservedVal`)
                  values ('$A','$B','$C','','$E','')";
        mysql_query($requete) or die ("error in logout Collecting");

}
}
//Upload***********************************************************************************************

if (isset($_POST['ch5'])) {
mysql_select_db("$dbmoodle")or die("Cannot connect to  Moodle database");

$req=mysql_query("SELECT  `id`, `userid`, `time`,`info`  FROM `mdl_log` WHERE (`time` >= '$temps1') and (`time`<= '$temps2') and (`action`='upload')");

mysql_select_db("$DbTrace")or die("cannot find $dbTrace Model");

while ($data = mysql_fetch_row($req)){
        $A='Upload'.$data[0];
        $B=$data[1];
        $C='Upload';

        $E=$data[2];
        $F=$data[3];
        $requete="Insert into `primarytrace` (`ObservedID`,`UserID`,`ObservedType`,`ToolId`,`TimeVal`,`ObservedVal`)
                  values ('$A','$B','$C','','$E','$F')";
        mysql_query($requete) or die ("error in upload Collecting");

}
}
//Forum Post Message******ERROR*****************************************************************************************

if (isset($_POST['ch20'])) {

mysql_select_db("$dbmoodle")or die("Cannot connect to  Moodle database");

$req=mysql_query( "
SELECT
`mdl_forum_posts`.`id` ,
`mdl_forum_discussions`.`forum` ,
`mdl_forum_posts`.`userid` ,
`mdl_forum_posts`.`discussion` ,
`mdl_forum_posts`.`message` ,
`mdl_forum_posts`.`created`
FROM  `mdl_forum_posts` ,`mdl_forum_discussions`
WHERE `mdl_forum_posts`.`discussion` =  `mdl_forum_discussions`.`id`
AND   `mdl_forum_discussions`.`course`='$idc'
AND   `mdl_forum_posts`.`created` >= '$temps1'
AND   `mdl_forum_posts`.`created` <=  '$temps2'");

mysql_select_db("$DbTrace")or die("cannot find $dbTrace Model");


//id    forum   userid  discussion      message  created
//ObservedID 0`,`UserID 2`,`ObservedType`,`ToolId 1`,`TimeVal 5`,`ObservedVal 4 comment  3`
while ($data = mysql_fetch_row($req)){
        $A='ForumPostMessage'.$data[0];
        $B=$data[2];
        $C='ForumPostMessage';
        $D='ToolForum'.$data[1];
        $E=$data[5];
        $F=addslashes($data[4]);
        $G='Disucussion'.$data[3];
        $requete="Insert into `primarytrace` (`ObservedID`,`UserID`,`ObservedType`,`ToolId`,`TimeVal`,`ObservedVal`,`comment` )
                  values ('$A','$B','$C','$D','$E','$F', '$G')";
        mysql_query($requete) or die ("error in ForumPost Collecting");

}
}
//*******************************************************************************************
if (isset($_POST['ch10'])) {
mysql_select_db("$dbmoodle")or die("Cannot connect to  Moodle database");

$req=mysql_query("SELECT  `id`, `userid`, `time`,`info`  FROM `mdl_log` WHERE (`time` >= '$temps1') and (`time`<= '$temps2') and (`module`='forum') and (`action`='view forum')");

mysql_select_db("$DbTrace")or die("cannot find $dbTrace Model");

while ($data = mysql_fetch_row($req)){
        $A='ForumView'.$data[0];
        $B=$data[1];
        $C='ForumView';
        $D='ToolForum'.$data[3];
        $E=$data[2];

        $requete="Insert into `primarytrace` (`ObservedID`,`UserID`,`ObservedType`,`ToolId`,`TimeVal`)
                  values ('$A','$B','$C','$D','$E')";
        mysql_query($requete) or die ("error in ForumView Collecting");

}
}
//BUG ICI*******************************************************************************************
if (isset($_POST['ch8'])) {
mysql_select_db("$dbmoodle")or die("Cannot connect to  Moodle database");

$req=mysql_query
("
SELECT  `id`, `userid`, `pageid`, `Content` , `timecreated`
from `mdl_wiki_versions` where 
`timecreated`>='$temps1'  and 
`timecreated`<='$temps2' and 
`pageid` in (select `id` from `mdl_wiki_pages` where `subwikiid` 
             in ( select `id` from `mdl_wiki` where `course`='$idc')
             )"
);


while ($data = mysql_fetch_row($req)){
        $A='EditWiki'.$data[0];
        $B=$data[1];
        $C='EditWiki';
        $E=$data[4]; 
        $F=addslashes($data[3]);        
        $u=$data[2];        

        mysql_select_db("$dbmoodle")or die("Cannot connect to  Moodle database");
        
        $r=mysql_query("SELECT * FROM mdl_wiki where course='$idc' and id in 
        (select subwikiid from mdl_wiki_pages WHERE id ='$u') ") or  die(mysql_error());        
        $d = mysql_fetch_row($r);         
        $D='ToolWiki'.$d[0];
        $G='';
        
        
        $r=mysql_query("SELECT title FROM mdl_wiki_pages WHERE id ='$u' ") or  die(mysql_error());        
        $d = mysql_fetch_row($r);         
        $G=$d[0];
        
        
        
        $requete="Insert into `primarytrace` (`ObservedID`,`UserID`,`ObservedType`,`ToolId`,`TimeVal`,`ObservedVal`,`comment` )
                  values ('$A','$B','$C','$D','$E','$F', '$G')";

        mysql_select_db("$DbTrace")or die("cannot find $dbTrace Model");
        mysql_query($requete) or die ("error in EditWiki Collecting");

}
}
//*******************************************************************************************
if (isset($_POST['ch7'])) {
mysql_select_db("$dbmoodle")or die("Cannot connect to  Moodle database");

$req=mysql_query("
SELECT  `id`, `userid`, `time`, `url`
FROM `mdl_log`
WHERE
(`time` >= '$temps1') and
(`time`<= '$temps2') and
(`action`='view') and
(`module`='wiki')and
(`course`='$idc')");



while ($data = mysql_fetch_row($req)){
        $A='ViewWiki'.$data[0];
        $B=$data[1];
        $C='ViewWiki';
        $E=$data[2];
        $Y=$data[3];
        $X1=explode('?', $Y);
        $X=explode('=', $X1[1]);
        mysql_select_db("$dbmoodle")or die("Cannot connect to  Moodle database");

        if ($X[0]=='id'){
            $D='ToolWiki'.$X[1];
            $F='';
        }
        if ($X[0]=='pageid'){
        
        $req1=mysql_query("

        SELECT subwikiid, title
        FROM  `mdl_wiki_pages`
        WHERE id =  '$X[1]'");
        
         $data1 = mysql_fetch_row($req1);
         $D='ToolWiki'.$data1[0];
         $F=$data1[1];
         //echo "<br>$D=$F<br>";
        }
        
        mysql_select_db("$DbTrace")or die("cannot find $dbTrace Model");
        $requete="Insert into `primarytrace` (`ObservedID`,`UserID`,`ObservedType`,`ToolId`,`TimeVal`,`comment`)
                  values ('$A','$B','$C','$D','$E','$F')";
        mysql_query($requete) or die ("error in EditWiki Collecting");

}
}

//*********************************************************************************************************
mysql_select_db("$DBM")or die("cannot  Model");
       
mysql_query("CREATE TABLE IF NOT EXISTS `mdl_user` (
  `id` varchar(60) NOT NULL,
  `username` varchar(60) NOT NULL,
  `firstname` varchar(60) NOT NULL)") or die("cannot create table") ;


        mysql_select_db("$dbmoodle")or die("Cannot connect to  Moodle database");

        $req1=mysql_query("SELECT id, username, firstname FROM  `mdl_user`");
        
        mysql_select_db("$DBM")or die("cannot  Model");
        
        while ($data1 = mysql_fetch_row($req1)){
        
       mysql_query("TRUNCATE TABLE mdl_user");


        $requete="insert into `mdl_user` (`id`,`username`,`firstname`)
                  values ('$data1[0]','$data1[1]','$data1[2]')";
                  
        mysql_query($requete) or die ("can not insert");

         }



//*****Les outils****************************************************************************************************

mysql_select_db("$DBM")or die("cannot  connect to DBM");
       
mysql_query("CREATE TABLE IF NOT EXISTS `mdl_tools` (
  `id` varchar(60) NOT NULL,
  `toolname` varchar(360) NOT NULL)") or die("cannot create table") ;


mysql_select_db("$dbmoodle")or die("Cannot connect to  Moodle database");

        $req1=mysql_query("SELECT id, name FROM  `mdl_chat` where `course`='$idc'");
        
        mysql_select_db("$DBM")or die("cannot  Model");
       mysql_query("TRUNCATE TABLE mdl_tools");

while ($data1 = mysql_fetch_row($req1)){
        
        $requete="insert into `mdl_tools` (`id`,`toolname`)
                  values ('ToolChat$data1[0]','$data1[1]')";
                  
        mysql_query($requete) or die (mysql_error());

         }

//********************************************

mysql_select_db("$dbmoodle")or die("Cannot connect to  Moodle database");

        $req1=mysql_query("SELECT id, name FROM  `mdl_forum` where `course`='$idc'");
        
        mysql_select_db("$DBM")or die("cannot  Model");

while ($data1 = mysql_fetch_row($req1)){
        
        $requete="insert into `mdl_tools` (`id`,`toolname`)
                  values ('ToolForum$data1[0]','$data1[1]')";
                  
        mysql_query($requete) or die ("can not insert2");

         }
         
//************************************************

mysql_select_db("$dbmoodle")or die("Cannot connect to  Moodle database");

        $req1=mysql_query("SELECT id, name FROM  `mdl_wiki` where `course`='$idc'");
        
        mysql_select_db("$DBM")or die("cannot  Model");

while ($data1 = mysql_fetch_row($req1)){
        
        $requete="insert into `mdl_tools` (`id`,`toolname`)
                  values ('ToolWiki$data1[0]','$data1[1]')";
                  
        mysql_query($requete) or die ("can not inser3t");

         }

//************************************************

mysql_select_db("$dbmoodle")or die("Cannot connect to  Moodle database");

        $req1=mysql_query("SELECT id, name FROM  `mdl_resource` where `course`='$idc'");
        
        mysql_select_db("$DBM")or die (mysql_error());

while ($data1 = mysql_fetch_row($req1)){
        $x=str_replace("'"," ", $data1[1]);
        $requete="insert into `mdl_tools` (`id`,`toolname`)
                  values ('ToolResource$data1[0]','$x')";
                          
        mysql_query($requete) or die (mysql_error());

         }

//*********************************************************************************************************


//**************************************************************************************************


// à la fin on fait le tri

    mysql_select_db("$DbTrace")or die("Cannot connect to  Moodle database");

    mysql_query("Alter Table primarytrace order by `TimeVal` ASC");
    
    $res= mysql_query("select count(*) from primarytrace");
    $val = mysql_fetch_row($res);

    $trans="http://".$_SERVER['HTTP_HOST']."/TBSIM/Core/Transformation/Index.php";
    
    $ViewTrace="http://".$_SERVER['HTTP_HOST']."/TBSIM/Core/TraceViewer/Index.php";
   echo "

          <b>Collet is done with sucess.</b><br><br>
          You have choosed:<br><br>
          <UL>
           <li><b>Course Name : </b> $CourseName"."</li><br>
           <li><b>Time Interval From : </b> ".date('d/m/Y', $temps1)."<b> To:</b> ".date('d/m/Y', $temps2)."</li><br>    
           <li><b>The instances number in Primarry Trace is : </b>$val[0]"."</li>
          </UL>
 
<br>You can go to the <a href='$trans'>Transformation module</a><br>
<br>You can view <a href='$ViewTrace'>Primary Trace</a> in the Traces Database Module<br>       
";
    
           
mysql_close();


?>
</body >
