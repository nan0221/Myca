<?php
#used for logout
session_start();
if(isset($_POST["logout"])){
    unset($_SESSION['Username']);     //Clear session
    unset($_SESSION['auth']);
    header("location: index.php");
    exit;
}
?>