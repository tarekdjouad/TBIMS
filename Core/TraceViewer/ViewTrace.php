<?php

include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Config/SessionStart.php';
include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Config/Config.php';
$table=$_GET['trname'];

  mysql_connect("$servername", "$username", "$Serverpassword")or die("cannot connect");
  mysql_select_db("$DbTrace")or die("cannot select DB");
   
    $sql = "SELECT * FROM ".$table."";
    
    $s=mysql_query($sql);
    //echo "Track Name:".$table;
    echo "
    <p align='center'>
    <table border=0><tr align='center'>
    <td bgcolor='#C9C994'><b><span style='font-size:10pt;'>
                          <font   face='Tahoma'> Observed Name
                          </font>
                          </span></b>
                          </td>
    <td width='150' bgcolor='#C9C994'><b><span style='font-size:10pt;'>
                          <font   face='Tahoma'>user Id
                          </font>
                          </span></b>
                          </td> 
    <td width='150' bgcolor='#C9C994'><b><span style='font-size:10pt;'>
                          <font   face='Tahoma'>observed Type
                          </font>
                          </span></b>
                          </td>
    <td width='150' bgcolor='#C9C994'><b><span style='font-size:10pt;'>
                          <font   face='Tahoma'>observed Tool
                          </font>
                          </span></b>
                          </td>
    <td width='250' bgcolor='#C9C994'><b><span style='font-size:10pt;'>
                          <font   face='Tahoma'>Time Value
                          </font>
                          </span></b>
                          </td>
    <td width='400' bgcolor='#C9C994'><b><span style='font-size:10pt;'>
                          <font   face='Tahoma'>Observed Value
                          </font>
                          </span></b>
                          </td>
    <td width='250' bgcolor='#C9C994'><b><span style='font-size:10pt;'>
                          <font   face='Tahoma'>Comments
                          </font>
                          </span></b>
                          </td>
                         </p>
                          ";
    while ($row = mysql_fetch_row($s)) 
    {
    $dt = date("d/m/o", $row[4]);
    $tm = date("H:i:s", $row[4]);
    $v=$dt.'-'.$tm;
    echo "<tr align='center'> 
    <td bgcolor='F2F2E6'><span style='font-size:10pt;'>
                          <font color='black' face='Tahoma'>".$row[0]."
    					  </font>
    					  </span>
    					  </td>
    <td bgcolor='F2F2E6'><span style='font-size:10pt;'>
                          <font color='black' face='Tahoma'>".$row[1]."
    					  </font>
    					  </span>
    					  </td>
    <td bgcolor='F2F2E6'><span style='font-size:10pt;'>
                          <font color='black' face='Tahoma'>".$row[2]."
    					  </font>
    					  </span>
    					  </td>
    <td bgcolor='F2F2E6'><span style='font-size:10pt;'>
                          <font color='black' face='Tahoma'>".$row[3]."
    					  </font>
    					  </span>
    					  </td>
    <td bgcolor='F2F2E6'><span style='font-size:10pt;'>
                          <font color='black' face='Tahoma'>".$v."
    					  </font>
    					  </span>
    					  </td>
    <td bgcolor='F2F2E6'><span style='font-size:10pt;'>
                          <font color='black' face='Tahoma'>".$row[5]."
    					  </font>
    					  </span>
    					  </td>
    <td bgcolor='F2F2E6'><span style='font-size:10pt;'>
                          <font color='black' face='Tahoma'>".$row[6]."
    					  </font>
    					  </span>
    					  </td>
    </p>";

}    
//**************************************************************
?>