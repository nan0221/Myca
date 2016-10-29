<?php
    #used for vote
	header("Content-Type: text/html; charset=utf8");
	include('Connect.php');  //connect DB
    if(isset($_POST["vote"])){
		$postid = $_POST["voteimgid"];
		$popularnum = "SELECT post_popular FROM Img_info WHERE post_id='$postid'";      //select img
		$popularnumres = mysql_query($popularnum);
        $popular = mysql_fetch_assoc($popularnumres);
        $Num = $popular[post_popular];
        $Num = $Num + 1;
        $update = "UPDATE Img_info SET post_popular = '$Num' WHERE post_id = '$postid'";     //uqdate img
        $updateres = mysql_query($update);
        if($updateres){
        	header("location:index.php#popular");
        }
        else{
        	echo "<script>alert('ERROR'); history.go(-1);</script>";
        }
    }
?>



