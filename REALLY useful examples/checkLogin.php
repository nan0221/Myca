<?php
$dsn         = 'mysql:dbname=user;host=localhost';
$db_user     = "123";
$db_password = "123";

try {
    $conn = new PDO($dsn, $db_user, $db_password);
}
catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

session_start();

$username = $_POST['username'];
$password = $_POST['password'];

if (isset($_POST['submit'])) {
    if ($username == "" && $password == "") {
        
        $_SESSION['error'] = "Nothing Entered";
        header('location: login.php');
    } else {
        $stmt  = "SELECT * FROM account WHERE username=? AND password=?";
        $query = $conn->prepare($stmt);
        $query->bindParam(1, $username);
        $query->bindParam(2, $password);
        
        $query->execute();
        
        if ($query->rowCount() == 1) {
            $_SESSION["auth"]     = true;
            $_SESSION['error']    = "";
            $_SESSION["username"] = $username;
            
            echo "success";
            header('location: management.php');
            // echo $_SESSION["auth"];
            exit;
        } else {
            echo "error";
            $_SESSION['error'] = "error Username or Password!!";
            header('location: login.php');
        }
    }
} else {
    // error message
    $_SESSION['error'] = "something wrong";
    header('location: login.php');
}
?>