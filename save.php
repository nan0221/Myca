<?php
    header("Content-Type: text/html; charset=utf8");
    include('Connect.php');
    session_start();
    if(isset($_POST["confirm"])){  
        $post_add = $_POST["address"];
        $post_popular = 0;
        $post_date = date("Y-m-d");
        $img_URL = $_POST["firstimg"];
        $stamp_URL = $_POST["secondimg"];
        $Greeting = $_POST["greeting_check"];
        $Uname = $_SESSION['Username'];
        $from = $_POST['fromwhom_check'];
        $to = $_POST['towhom_check'];
        $id = "select Uid from User_info where Uname='$Uname'";
        $U_idres = mysql_query($id);
        $row = mysql_fetch_assoc($U_idres) ;
        $post64_URL = $_POST["frontimgdata"];
        $postb64_URL = $_POST["backimgdata"];
        $t=time();   
        $s1=".png";
        $s2="b.png";
        $name =$t.$s1;
        $bname = $t.$s2;
        list($type, $post64_URL) = explode(';', $post64_URL);
        list(, $post64_URL)      = explode(',', $post64_URL);
        $post64_URL = base64_decode($post64_URL); 
        list($type, $postb64_URL) = explode(';', $postb64_URL);
        list(, $postb64_URL)      = explode(',', $postb64_URL);
        $postb64_URL = base64_decode($postb64_URL);
        file_put_contents('Postimg/'.$name, $post64_URL);
        file_put_contents('Postimg/'.$bname, $postb64_URL);
        $postfp = "http://deco1800-pg2.uqcloud.net/Postimg/".$name;
        $postbp = "http://deco1800-pg2.uqcloud.net/Postimg/".$bname;
        $_SESSION['imgfront'] = $postfp;
        $_SESSION['imfback'] = $postbp;                                                                                                                                        
        if($_SESSION['auth']){
            $q1="insert into Img_info(post_id,U_id,post_add,post_popular,post_date,post_URL,postb_URL,img_URL,stamp_URL,Greeting,fromwhom,towhom) values (null,'$row[Uid]','$post_add','$post_popular','$post_date','$postfp','$postbp','$img_URL','$stamp_URL','$Greeting','$from','$to')";
            $savereslut1=mysql_query($q1);
            if($savereslut1){     
                header("location: share.php"); 
            }
            else{
                echo "<script>alert('can not save into the DB'); history.go(-1);</script>";
            }   

        }
        else{
            $q2="insert into Img_info(post_id,U_id,post_add,post_popular,post_date,post_URL,postb_URL,img_URL,stamp_URL,Greeting,fromwhom,towhom) values (null,null,'$post_add','$post_popular','$post_date','$postfp','$postbp','$img_URL','$stamp_URL','$Greeting','$from','$to')";
            $savereslut2=mysql_query($q2);
            if($savereslut2){
                header("Location:share.php"); 
            }
            else{
                echo "<script>alert('can not save into the DB'); history.go(-1);</script>";
            }   
        }
    }
?>