<?php
$dsn         = 'mysql:dbname=Mycauser;host=localhost';
$db_user     = "root";
$db_password = "root";

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
        //header('location: index.html');
    } else {
        $stmt  = "SELECT * FROM User_info WHERE UName=? AND UPassword=?";
        $query = $conn->prepare($stmt);
        $query->bindParam(1, $username);
        $query->bindParam(2, $password);
        
        $query->execute();
        
        if ($query->rowCount() == 1) {
            $_SESSION["auth"]     = true;
            $_SESSION['error']    = "";
            $_SESSION["username"] = $username;
            
            echo "success";
            // header('location: index.html');
            // echo $_SESSION["auth"];
            exit;
        } else {
            echo "error";
            $_SESSION['error'] = "error Username or Password!!";
            // header('location: index.html');
        }
    }
} else {
    // error message
    $_SESSION['error'] = "something wrong";
    // header('location: index.html');
}
?>