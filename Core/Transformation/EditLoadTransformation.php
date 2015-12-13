<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
</head>

<body>

<?php
include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Config/SessionStart.php';
include $_SERVER['DOCUMENT_ROOT'].'/TBSIM/Core/Config/Config.php';
$DBM=$_SESSION['DB'];
$choix=$_REQUEST['pm'];
mysql_select_db("$DBM")or die("cannot select in edittr DB");

//**Delete line from trans********************************************************
if ($choix=='5') {
  
    if($_POST['id']) {
        $id=mysql_escape_String($_POST['id']);
        $sql = "delete from transformation where Nt='$id'";
        mysql_query($sql);
    }
}
//****update line after modifs******************************************************
if ($choix=='6') {
  
  if($_POST['id']) {
    $id=mysql_escape_String($_POST['id']);
    
    $name=mysql_escape_String($_POST['name']);
    $category=mysql_escape_String($_POST['category']);
    $price=mysql_escape_String($_POST['price']);
    $discount=mysql_escape_String($_POST['discount']);
    $add=mysql_escape_String($_POST['add']);
    $sql = "update transformation set ts='$name',td='$category',Nom_op='$price',Nom_par='$discount',Add_par='$add' where Nt='$id'";
    mysql_query($sql);
  }
}
//*************load grid*********************************************
if ($choix=='7') {
if($_POST['page']) {
    $page = $_POST['page'];
    $cur_page = $page;
    $page -= 1;
    $per_page = 1000; // Per page
    $previous_btn = true;
    $next_btn = true;
    $first_btn = true;
    $last_btn = true;
    $start = $page * $per_page;
    $query_pag_data = "select Nt,ts,td,Nom_op,Nom_par,Add_par from transformation LIMIT $start, $per_page";
    $result_pag_data = mysql_query($query_pag_data) or die('MySql Error' . mysql_error());
    $tabledata = "";
    $tablehead="<table border='0' bgcolor='#E6E6FA' style='border-width:1; border-color:#E6E6FA; border-style:solid;' align='center'>
    
    <tr bgcolor='#EAEAD8'><th>Trace Source</th><th>trace Distination</th><th>Operation Name</th><th>Params Name</th><th>Add Param</th><th>Edit</th></tr>";
    $i=0;
    while($row = mysql_fetch_array($result_pag_data))  {
        $i=$i+1;
        if (fmod($i,2)==0){
        $id=$row['Nt'];
        $name=htmlentities($row['ts']);
        $category=htmlentities($row['td']);
        $price=htmlentities($row['Nom_op']);
        $discount=htmlentities($row['Nom_par']);
        $add= htmlentities($row['Add_par']);
        $tabledata.="
        <tr  id='$id' class='edit_tr'>
        <td bgcolor='white' class='edit_td'>
                           
        <span id='one_$id' class='text'>$name</span>
        <input type='text' value='$name' class='editbox' id='one_input_$id' />
        </td>
        <td bgcolor='white' class='edit_td' >
        <span id='two_$id' class='text'>$category</span> 
        <input type='text' value='$category' class='editbox' id='two_input_$id'/>
        </td>
        <td bgcolor='white' class='edit_td' >
        <span id='three_$id' class='text'>$price</span> 
        <input type='text' value='$price' class='editbox' id='three_input_$id'/>
        </td>
        
        <td bgcolor='white' class='edit_td' >
        <span id='four_$id' class='text'>$discount</span> 
        <input type='text' value='$discount' class='editbox' id='four_input_$id'/>
        </td>
        <td bgcolor='white' class='edit_td' >
        <span id='five_$id' class='text'>$add</span> 
        <input type='text' value='$add' class='editbox' id='five_input_$id'/>
        </td>
        
        <td td bgcolor='#F0FFF0'><a href='#' class='delete' id='$id'>X</a></td></tr>";
        }else{
        $id=$row['Nt'];
        $name=htmlentities($row['ts']);
        $category=htmlentities($row['td']);
        $price=htmlentities($row['Nom_op']);
        $discount=htmlentities($row['Nom_par']);
        $add= htmlentities($row['Add_par']);
        $tabledata.="
        <tr  id='$id' class='edit_tr'>
        <td bgcolor='white' class='edit_td'>
                           
        <span id='one_$id' class='text'>$name</span>
        <input type='text' value='$name' class='editbox' id='one_input_$id' />
        </td>
        <td bgcolor ='white' class='edit_td' >
        <span id='two_$id' class='text'>$category</span> 
        <input type='text' value='$category' class='editbox' id='two_input_$id'/>
        </td>
        <td bgcolor='white' class='edit_td' >
        <span id='three_$id' class='text'>$price</span> 
        <input type='text' value='$price' class='editbox' id='three_input_$id'/>
        </td>
        
        <td bgcolor='white' class='edit_td' >
        <span id='four_$id' class='text'>$discount</span> 
        <input type='text' value='$discount' class='editbox' id='four_input_$id'/>
        </td>
        <td bgcolor='white' class='edit_td' >
        <span id='five_$id' class='text'>$add</span> 
        <input type='text' value='$add' class='editbox' id='five_input_$id'/>
        </td>
        
        <td td bgcolor='white'><a href='#' class='delete' id='$id'>X</a></td></tr>";    
            
        }
    }
    $finaldata = "<table width='80%'>".$tablehead.$tabledata."</table>"; // Content for Data
    /* Total Count */
    $query_pag_num = "SELECT COUNT(*) AS count FROM transformation";
    $result_pag_num = mysql_query($query_pag_num);
    $row = mysql_fetch_array($result_pag_num);
    $count = $row['count'];
    $no_of_paginations = ceil($count / $per_page);
    
    echo $finaldata;
}
}
?>
</font></body></html>