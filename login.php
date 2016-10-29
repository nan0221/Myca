<?php
    header("Content-Type: text/html; charset=utf8");
    #used for login
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
                session_start();
                $_SESSION['Username'] = "$name";
                $_SESSION['auth'] = true;
                $URL= $_POST['URL'];
                header("location:$URL");
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
    #used for signup
    else if (isset($_POST['signup'])){
        if(!isset($_POST['signup'])){
            exit("ERROR");
        }                                     //Judfe submit option
        $name=$_POST['name'];                 //Get signup username
        $password=$_POST['password'];         //Get signup password
        include('Connect.php');               //connect to DB
        $sql_check = "select Uname from User_info where UName = '$_POST[name]'";  
        $result2 = mysql_query($sql_check);    
        $num = mysql_num_rows($result2);  
        if($num){              
            echo "<script>alert('Sorry, username has been registed, please try another username'); history.go(-1);</script>";  
        } else{
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
    }
?>