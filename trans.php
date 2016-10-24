<?php
    header("Content-Type: text/html; charset=utf8");
    session_start();
//    if(isset($_POST["done"])){  
        $_SESSION["post_add"] = $_POST["address"];
        $img = $_POST["firstimg"];
        $stamp = $_POST["secondimg"];
        copy($img, 'Postimg/file1.jpg');
        copy($stamp, 'Postimg/file2.jpg');
        $_SESSION["img_URL"]="http://deco1800-pg2.uqcloud.net/Postimg/file1.jpg";
        $_SESSION["stamp_URL"]="http://deco1800-pg2.uqcloud.net/Postimg/file2.jpg";
        $_SESSION["Greeting"] = $_POST["greeting"];
        $_SESSION["from"] = $_POST['fromwhom'];
        $_SESSION["to"] = $_POST['towhom'];
        header("location:confirm.php");
//    }

?>