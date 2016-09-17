<h2>We've updated the Page with Database content!</h2>
<p class="lead">We've generated some HTML content with php in another file and updated our page without having to reload!</p>
<div class="page-header">
    <h2>Database Content</h2>
</div>

<?php 

// create a link to the database
$host = "localhost";
$username = "myUser";
$password = "1234";
$database = "dbExample";

$mysqli = new mysqli($host, $username, $password, $database);

// Check the connection
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

echo "<div class='alert alert-success'><strong>Success!</strong> Created a connection to ".$database."</div>";

// Create a query to use on the database
$query = "SELECT * FROM test_table";

// Store the results of the query
$result = $mysqli->query($query);
$entryCount = 0;
// Grab each row of the table as an associative array

?>
    <ul class="list-group">

        <?php 
            while ($row = $result->fetch_assoc()) {
                $entryCount++;
                echo "<li class='list-group-item'>Person with Id of <span class='label label-default'>".
                    $row['id'].
                    "</span> and First name of <span class='label label-default'>". 
                    $row['first_name'].
                    "</span> and Last name of <span class='label label-default'>".
                    $row['last_name'].
                    "</span></li>";
            }

// Close the connection with the database
$mysqli->close();
?>
            <li class="list-group-item">Database Entries<span class="badge"><?php echo $entryCount; ?></span></li>
    </ul>

    <ul class="list-group">
        <?php
        echo "<li class='list-group-item'>hello".$entryCount."</li>";
       ?>
    </ul>