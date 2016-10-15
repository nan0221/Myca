<?php
    header("Content-Type: text/html; charset=utf8");
    include('Connect.php');
    if(isset($_POST["done"])){     
        if($_SESSION['auth']){
        session_start();  
        $post_add = $_POST["address"];
        $post_popular = 0;
        $post_date = time();
        $post_URL;
        $postb_URL;
        $img_URL = $_POST["firstimg"];
        $stamp_URL = $_POST["secondimg"];
        $Greeting = $_POST["greeting"];
        $Uname = $_SESSION['Username'];
        $id = "select Uid from User_info where Uname='$Uname'";
        $U_id = mysql_query($sid);
        $q1="insert into Img_info(post_id,U_id,post_add,post_popular,post_date,post_URL,postb_URL,img_URL,stamp_URL,Greeting) values (null,'$U_id','$post_add','$post_popular','$post_date','$post_URL','$postb_URL','$img_URL','$stamp_URL','$Greeting')";// Add value into DB
        $savereslut1=mysql_query($q1)
            if($savereslut1){
                echo "<script>alert('Success saving into your Timeline!'); </script>"     //跳转首页？
                header("Location:share.php"); 
            }
            else{
                echo "<script>alert('can not save into the DB'); history.go(-1);</script>"
            }   
        }
        else{
            $q2="insert into Img_info(post_id,U_id,post_add,post_popular,post_date,post_URL,postb_URL,img_URL,stamp_URL,Greeting) values (null,null,'$post_add','$post_popular','$post_date','$post_URL','$postb_URL','$img_URL','$stamp_URL','$Greeting')";
            $savereslut2=mysql_query($q2);
            if($savereslut2){
                echo "<script>alert('Success saving into the DB!'); </script>"     //跳转首页？
                header("Location:share.php"); 
            }
            else{
                echo "<script>alert('can not save into the DB'); history.go(-1);</script>"
            }   
        }
    }
?>