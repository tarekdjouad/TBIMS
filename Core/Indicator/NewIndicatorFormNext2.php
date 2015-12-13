<?php
include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Config/SessionStart.php'; 
include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Config/Config.php'; 
$DBM=$_SESSION['DB'];
$iname=$_REQUEST['iname'];
$cname=$_REQUEST['cname'];
$tname=$_REQUEST['tname'];
$Y='';

mysql_select_db("$DBM")or die("cannot select DB");
// trouver les equations avec le comment de la classe héritée
$reqA=mysql_query("select ClassEquation,ClassComment from indicatorclass where ClassName='$cname'");
$row = mysql_fetch_array($reqA);
$Cequation=$row[0];
$CComment=$row[1];
// Calculer ici les valeurs des variables:

mysql_query("TRUNCATE TABLE transformation");
    $req=mysql_query("select * from transall where tname='$tname'");
// remplir ensuite transformation
    while ($row = mysql_fetch_array($req))  {
            $sql1 = "INSERT INTO transformation
            Values ('','$row[0]','$row[1]','$row[2]','$row[3]','$row[4]')";   
            mysql_query($sql1);
    }        
// exécuter la transformation
    include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Transformation/ExecuteTransformation.php';
    //**********************************************************
// compter ensuite les valaurs des tables 
    mysql_select_db("$DbTrace")or die("cannot select DB");

    $sql = "SHOW TABLES FROM $DbTrace";
    $result = mysql_query($sql);
   
    while ($data = mysql_fetch_array($result)) {  
         $cn= mysql_query("select count(*) from ". $data[0]);
         $val=mysql_fetch_array($cn);
         if ($cn !=' ')
           $Y =$Y.$data[0]."=".$val[0]."\n";
 }
 
 
mysql_close();    


?>
<html>
<head>
</head>
<body style="font-family: Tahoma; font-size: 13px;">
<b>Step3:</b> Indicator Values are generated and equation class is added.
<div id="roundrect1" style="position:absolute; overflow:hidden; 
left:94px; top:103px; width:521px; height:499px; z-index:0">
<img border=0 width="100%" height="100%" alt="" src="temps/roundrect8297109.png"></div>

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

<form method="POST" action="ManageIndicator.php?pm=2" style="margin:0px">
<input name="iname" type="text" style="position:absolute;width:200px;left:290px;top:120px;z-index:4"
value= <?php echo "$iname" ;?>
>

<input name="cname" type="text" style="position:absolute;width:200px;left:290px;top:168px;z-index:8"
value= <?php echo "$cname" ;?>

>
<input name="tname" type="text" style="position:absolute;width:200px;left:290px;top:211px;z-index:9"
value= <?php echo "$tname" ;?>


>


<textarea name="iequation" style="position:absolute; left:290px;top:258px;width:200px;height:125px;z-index:11"><?php echo $Y."\n".$Cequation;?></textarea>
<textarea name="icomment" style="position:absolute;left:290px;top:392px;width:200px;height:125px;z-index:13"><?php echo $CComment;?></textarea>
<input name="Create" type="submit" value="Create" style="position:absolute;left:521px;top:549px;z-index:5">

</form>

<div id="text3" style="position:absolute; overflow:hidden; 
left:127px; top:207px; width:182px; height:29px; z-index:6">
<div class="wpmd">
<div><font face="Tahoma" class="ws11">Transformation:</font></div>
</div></div>

<div id="text4" style="position:absolute; overflow:hidden; 
left:193px; top:259px; width:182px; height:29px; z-index:10">
<div class="wpmd">
<div><font face="Tahoma" class="ws11">Equation:</font></div>
</div></div>

<div id="text5" style="position:absolute; overflow:hidden; 
left:193px; top:393px; width:182px; height:29px; z-index:12">
<div class="wpmd">
<div><font face="Tahoma" class="ws11">Comment:</font></div>
</div></div>


</body>
</html>