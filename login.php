<?PHP
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
            //$rows=mysql_num_rows($result);                                                  //Return result
            if($result){//0 false 1 true
                header("refresh:0;url=index.html");   //If login success jump to welcome.html page
                    exit;
            }
            else{
                echo "Wrong Username or Passward";      //Else 
                echo "
                <script>
                    setTimeout(function(){window.location.href='index.html';},2000);
                </script>
                ";                                      //jump to login page after 0.5sec
            }      
        }
        else{                                              //If username or passward is empty
            echo "You must provide your Username or Passward";
            echo "
            <script>
                setTimeout(function(){window.location.href='index.html';},2000);
            </script>";     //jump to login page after 0.5sec
        }
        //mysql_close();      //Close DB
    }
    else if (isset($_POST['signup'])){
        header("Content-Type: text/html; charset=utf8");
        if(!isset($_POST['signup'])){
        exit("ERROR");
        }                                     //Judfe submit option
        $name=$_POST['name'];                 //Get signup username
        $password=$_POST['password'];         //Get signup password
        include('Connect.php');               //connect to DB
        if ($name && $passowrd){
            $q="insert into User_info(Uid,UName,UPassword) values (null,'$name','$password')";// Add value into DB
            $reslut=mysql_query($q,$con);         //Run ql
            if (!$reslut){
                die('Error: ' . mysql_error());   //If run error
            }else{
            echo "Signup Success";                //If signup success
            }
        }
        else{
            echo "please provied your username and password";
        }
        //mysql_close($con);                        //Close DB
    }
        ?>