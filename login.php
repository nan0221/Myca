<?php
    header("Content-Type: text/html; charset=utf8");
    if(isset($_POST["login"])){
        if(!isset($_POST["login"])){
            exit("ERROR");
        }                               //Judfe submit option 
        include('Connect.php');         //Connect DB
        $name = $_POST['name'];         //Get username
        $passowrd = $_POST['password']; //Get passport
        if ($name && $passowrd){        //If username and password both value
            $sql = "select * from User_info where UName = '$name' and UPassword='$passowrd'";  //Check username and password in sql DB
            $result = mysql_query($sql);                                                    //Run sql
            $rows=mysql_num_rows($result);                                                  //Return result
            if($rows){//0 false 1 true
                echo "<script>alert('Log in success！'); history.go(-1);</script>";
            }
            else{
                echo "<script>alert('Wrong username or password！'); history.go(-1);</script>";
                ;                                      
            }      
        }
        else{                                              //If username or passward is empty
            echo "<script>alert('You must provide your username and password！'); history.go(-1);</script>";     
        }
        mysql_close();      //Close DB
    }
    else if (isset($_POST['signup'])){
        if(!isset($_POST['signup'])){
            exit("ERROR");
        }                                     //Judfe submit option
        $name=$_POST['name'];                 //Get signup username
        $password=$_POST['password'];         //Get signup password
        include('Connect.php');               //connect to DB
        if($name == "" || $password == "")  
        {  
            echo "<script>alert('Please provide username and password！'); history.go(-1);</script>";  
        } 
        else{
            $q="insert into User_info(Uid,UName,UPassword) values (null,'$name','$password')";// Add value into DB
            $reslut=mysql_query($q,$con);         //Run ql
            if (!$reslut){
                die('Error: ' . mysql_error());   //If run error
            }else{
                echo "<script>alert('Signup Success!'); history.go(-1);</script>";
            }
            mysql_close($con);                        //Close DB
        }
    }
?>