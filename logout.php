<?php
session_start();

if(isset($_POST["logout"])){
    unset($_SESSION['Username']);
    unset($_SESSION['auth']);
    header("location: index.php");
    exit;
}
?>