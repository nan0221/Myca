<?php
    #used for transfer the data form design.php to other webpage
    header("Content-Type: text/html; charset=utf8");
    header("Access-Control-Allow-Origin: *");
    session_start();  
        $_SESSION["post_add"] = $_POST["address"];
        $_SESSION["imgfrom"] = $_POST["firstimg"];
        $_SESSION["stampfrom"] = $_POST["secondimg"];
        $img = $_POST["firstimg"];
        $stamp = $_POST["secondimg"];
        $t=time();   
        $s1="file1.jpg";
        $s2="file2.jpg";
        $s3="Postimg/";
        $name =$s3.$t.$s1;               //random file name by time()
        $bname = $s3.$t.$s2;
        copy($img, $name);               //save img into server
        copy($stamp, $bname);
        $_SESSION["img_URL"]=$name; 
        $_SESSION["stamp_URL"]=$bname;
        $_SESSION["Greeting"] = $_POST["greeting"];
        $_SESSION["from"] = $_POST['fromwhom'];
        $_SESSION["to"] = $_POST['towhom'];
        header("location:confirm.php");
?>