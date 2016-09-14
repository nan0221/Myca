<?php
	session_start();
	require_once("twitteroauth/twitteroauth.php"); //Path to twitteroauth library - thanks to https://github.com/abraham/twitteroauth
	
	
	
	// Variables for accessing the database
	// Host for the database, usually this will be localhost (ie. it is hosted in the same place as the rest of your files
	$dbhost = "localhost";
	// Username & password for accessing the database, you can use phpMyAdmin to create users for your database
	// Always create a user specifically for the database & restrict its permissions to only those you need (usually this will only be data actions)
	// This is a security measure as the passwords need to be written here in code
	$dbuser = "";
	$dbpass = "";
	// Database to be accessed - replace this with the name you've given to your database
	$dbname = "webappdemo";
	
	// Use the mysqli extension to create a connection to the database using the above credentials
	$dbconn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	if($dbconn->connect_errno > 0){
		die("Unable to connect to database [".$db->connect_error."]");
	}
	// You can output messages to the error log for debugging purposes
	error_log("All ready to go");
	
	// When this file is called, the first thing we want to do is to see what the todo parameter is set to so we know what action to perform
	// Each action has an associated function that is called with the appropriate data from the request
	// $_POST[] contains the variables sent with the post request
	
	$todo = $_POST['todo'];
	error_log("Are we getting something to do?".$todo);
	switch($todo){
		case "addCombo":
			addCombo($_POST['user'],$_POST['img'],$_POST['url'],$_POST['tweet'], $_POST['tweetAuthor']);
			break;
		case "getTweet":
			getTweet($_POST['search']);
			error_log("Term ".$_POST['search']);
			break;
		case "showCombos":
			showCombos();
			break;
		
	}
	
	// Get a Tweet 
	function getTweet($term){
		// All the API credentials required for Twitter
		// You will need to create your own Twitter App to get this to work from your zone or local server
		// This site has great step-by-step instructions for doing so http://www.webdevdoor.com/php/authenticating-twitter-feed-timeline-oauth/
		
		$consumerkey = "";
		$consumersecret = "";
		$accesstoken = "";
		$accesstokensecret = "";
		
		// Connect to the API
		$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
		error_log("Connection: ".is_null($connection)?" null connection" : " not null");
		// Run an API call - in this case, a search with 1 result
		$tweets = $connection->get("https://api.twitter.com/1.1/search/tweets.json?q=".$term."&count=10");
		// Format as JSON & return. In AJAX applications, PHP uses echo to return data rather than the usual return keyword.
		echo json_encode($tweets);
		
	}
	
	// Function to establish authorised connection to the Twitter API - uses the TwitterOAuth library (link above)
	function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
	  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
	  return $connection;
	}
	
	// Add a combo to the database
	function addCombo($user, $flickr_img, $flickr_url, $tweet, $tweet_url){
		global $dbconn; // use the $dbconn previously created
		
		// As a security measure, it is best to use Prepared statements for interacting with the database
		// This checks that the query is correct & that the associated data is the right data-type
		// It provides protection against SQL injection attacks by verifying the data coming in
		
		$addCombo = $dbconn->prepare("INSERT INTO combos(USER, FLICKR_IMG, FLICKR_URL, TWEET_TEXT, TWEET_URL) VALUES (?,?,?,?,?)");

		//Error checking
		if ( false===$addCombo ) {
		  error_log('Prepare failed (at addCombo): ' . $dbconn->error);
		  return false;
		}
		
		// Bind the data to be inserted to the values required - s stands for string - here we are expecting 5 strings
		// Note these should appear in the same order as the columns specified in the above query - USER, $user | FLICKR_IMG, $flickr_img etc
		if(!$addCombo->bind_param('sssss', $user, $flickr_img, $flickr_url, $tweet, $tweet_url)) {
			error_log( "Binding parameters failed (at addCombo): (" . $addCombo->errno . ") " . $addCombo->error);
			return false;
		}
		
		// Execute the query on the database
		if (!$addCombo->execute()) {
		    error_log("Execute failed (at addCombo): (" . $addCombo->errno . ") " . $addCombo->error);
		    return false;
		}
		
		// Grab the id generated for the inserted data & return it to the JavaScript
		$newId = $addCombo->insert_id;
		error_log("Insert ID ".$newId);
		$addCombo->close();
		echo $newId;

	}
	
	/**
	* Pull all previously saved combos from the database, compile into a JSON compatible array & return it to the JavaScript for display
	*/
	function showCombos(){
		global $dbconn;
		// SELECT everything from the table combos
		$showCombo = $dbconn->prepare("SELECT * FROM combos");
		
		if ( false===$showCombo ) {
		  error_log('Prepare failed (at showCombo): ' . $dbconn->error);
		  return false;
		  }
		  
		if (!$showCombo->execute()) {
		    error_log("Execute failed (at showCombo): (" . $addCombo->errno . ") " . $addCombo->error);
		    return false;
		}
		// Bind the table columns to variables for processing - ID == $id, FLICK_IMG == $flickr_img etc
		$showCombo->bind_result($id, $user, $flickr_img, $flickr_url, $tweet, $tweet_url);
		
		$combos = [];
		
		/** The below iterates over the results of the query - the fetch function grabs a new row in the result set **/
		while($showCombo->fetch()){
				// Construct a JSON compatible array from the result set - in key/value pairs for easy reference.
				$combos[$id] = array('id'=>$id, 'user'=>$user, 'flickr_img'=>$flickr_img, 'flickr_url'=>$flickr_url, 'tweet_text'=>$tweet, 'tweet_author'=>$tweet_url);
			}
		$showCombo->close();
		echo json_encode($combos);
	}
?>