<html>
<head>
<head>

<body bgcolor="#FFFFFF" style="font-family:Tahoma; font-size:13px;">

 
<?php 
include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Config/SessionStart.php';
include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Config/Config.php';
 
$dr=$_SERVER['HTTP_HOST'];  
$trsname=$_SESSION['CurrentTrans'];  

echo "<br><b>Current Transfomation:<b> $trsname<br>";

//************************header*************
?>

<hr size="2" width="880" align="left">
<table border='0' width='560' height='45'>
  
<tr>

<div id="shape1" style="position:absolute; overflow:hidden; 
left:390px; top:66px; width:27px; height:26px; z-index:0">
<img border=0 width="100%" height="100%" alt="" src="temps/shape6556812.png"></div>



<div id="shape2" style="position:absolute; overflow:hidden; 
left:478px; top:66px; width:27px; height:26px; z-index:2">
<img border=0 width="100%" height="100%" alt="" src="temps/shape6576000.png"></div>

<div id="shape3" style="position:absolute; overflow:hidden; 
left:419px; top:66px; width:27px; height:26px; z-index:3">
<img border=0 width="100%" height="100%" alt="" src="temps/shape6576281.png"></div>

<div id="shape4" style="position:absolute; overflow:hidden; 
left:449px; top:66px; width:27px; height:26px; z-index:4">
<img border=0 width="100%" height="100%" alt="" src="temps/shape6576515.png"></div>

<!--  -->
<div id="image4" style="position:absolute; overflow:hidden; 
left:394px; top:70px; width:27px; height:27px; z-index:1">

<a href="ManageMenue.php?pm=4&cc=2" title="Add New Row"> 

<img src="temps/c.png" alt="" title="" border=0 >
</a>
</div>
<!--  -->
<div id="image3" style="position:absolute; overflow:hidden; 
left:453px; top:70px; width:17px; height:17px; z-index:5">

<a href="ManageMenue.php?pm=8" title="Save Transformation">

<img src="temps/Save.PNG" alt="" title="" border=0 width=17 height=17>
</a>
</div>
<!--  -->
<div id="image1" style="position:absolute; overflow:hidden; 
left:425px; top:70px; width:16px; height:16px; z-index:6">

<a href="ManageMenue.php?pm=5&cc=2" title="Clear All Rows">

<img src="temps/clearall.PNG" alt="" title="" border=0 width=16 height=16>
</a>
</div>

    
<div id="image2" style="position:absolute; overflow:hidden; 
left:483px; top:70px; width:16px; height:16px; z-index:7">
<a href="ExecuteTransformation.php?me=1" title="Execute Transformation">
<img src="temps/tab.png" alt="" title="" border=0 width=16 height=16></a>
</div>
    
</tr>
        
</table>
<br>
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        
        <script type="text/javascript" src="jquery.min.js"></script> 
		 <script type="text/javascript" src="EditDeletePage.js"></script> 
        

        <style type="text/css">
            body{
                width: 900px;
                margin: 0 auto;
                padding: 0;
				font-family:Tahoma
            }
            #loading{
                width: 100%;
                position: absolute;
                top: 100px;
                left: 100px;
				margin-top:200px;
            }
            #container .pagination ul li.inactive,
            #container .pagination ul li.inactive:hover{
                background-color:#ededed;
                color:#bababa;
                border:1px solid #bababa;
                cursor: default;
            }
            #container .data ul li{
                list-style: none;
                font-family: Tahoma;
                margin: 5px 0 5px 0;
                color: #000;
                font-size: 11px;
            }

            #container .pagination{
                width: 1000px;
                height: 25px;
            }
            #container .pagination ul li{
                list-style: none;
                float: left;
                border: 1px solid #006699;
                padding: 2px 6px 2px 6px;
                margin: 0 3px 0 3px;
                font-family: Tahoma;
                font-size: 11px;
                color: #006699;
                font-weight: bold;
                background-color: #f2f2f2;
            }
            #container .pagination ul li:hover{
                color: #fff;
                background-color: #006699;
                cursor: pointer;
            }
			.go_button
			{
			background-color:#f2f2f2;border:1px solid #006699;color:#cc0000;padding:2px 6px 2px 6px;cursor:pointer;position:absolute;margin-top:-1px;
			}
			.total
			{
			float:right;font-family:Tahoma;color:#999;
			}
			.editbox
			{
			display:none;
			
			}
			td, th
			{
			width:20%;
			text-align:left;;
			padding:5px;
			}
			.editbox
			{
			padding:4px;
			
			}
			
			

        </style>

    </head>
    <body>
		
<body> 

<div id="loading"></div>
    
<div id="container"></div>

<br>
<hr size="2" width="880" align="left">

<b><font >Quick Help and Notations: </font></b> 

<br>
<br>

<!-- ------------------------------------------------------------------------------------------- -->
<strong>1- List of observed types fond in the Primary-Track : </strong><br><br>

<?php
mysql_select_db("$DbTrace")or die("cannot select DB");
$result = mysql_query("SELECT ObservedType FROM primarytrace group by ObservedType");
while ($row = mysql_fetch_row($result))
  echo "- $row[0]<br>"; 

  
?>
<hr size="2" width="880" align="left">
<br>
<strong>2- List of Operators names: </strong> <br><br>
<strong>- S_User    : </strong>it selects observeds related to a specified User<br>
<strong>- S_Tool    : </strong>it selects observeds related to a specified Tool<br>
<strong>- S_Type    : </strong>it selects observeds related to a specified Observed Type<br>
<strong>- S_Time    : </strong>it selects observeds related to a specified Time interval<br>
<strong>- S_TimeSup : </strong>it selects observeds related to a specified Time superior val<br>
<strong>- S_TimeInf : </strong>it selects observeds related to a specified Time infernal val<br> <br>		
</body>
</html>