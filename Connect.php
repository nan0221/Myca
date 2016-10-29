<?php
    #used for connect DB
    $server="Localhost";  // Web server
    $db_username="root";//DB user name
    $db_password="94cb4f897376b69c";//DB password
    $db_name = "Mycauser";//DB name

    $con = mysql_connect($server,$db_username,$db_password,$db_name);//Connect DB
    if(!$con){
        die("can't connect".mysql_error());// Connect fail
    } 
    //return $con;
    mysql_select_db('Mycauser',$con);// Name of the DB set at "Mycauser"
?>
