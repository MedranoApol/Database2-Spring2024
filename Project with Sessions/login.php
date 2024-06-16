<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<?php
require 'createDatabase.php';

$errors = []; // Initialize an empty array to store errors

// Create the databse connection
$dbc = @mysqli_connect("localhost", 'root', '', 'mydb') OR die('Could not connect MYSQL: '. mysqli_connect_error());

// If form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    // Check if empty of each part of form
    if (empty($_POST['name']) && !isset($_POST['name'])) 
    {
        $errors[] = "Name is required";
    }
    else 
    {
        $name = mysqli_real_escape_string($dbc, strtolower(trim($_POST['name'])));
    }

    // If there are no errors, proceed with insertion
    if (empty($errors))
    {
        // Make the query:
        $query = "SELECT name FROM messages WHERE name='$name'";
        $result = @mysqli_query($dbc, $query);

        if (!mysqli_query($dbc, $query))
            echo "Error inserting data into messages table: " . mysqli_error($dbc);

    
        if (mysqli_num_rows($result) <= 0)
        {
            echo '<h1>NOT IN</h1>';
        }
        else 
        {
            session_start();
            $_SESSION['name'] = $name;
            //user will be logged in to the website
            header("Location: loggedin.php");
        } 
    } 
    else 
    { //Report the errors.
        echo "<h3>Error List:</h3>";
        echo "<ul>";
        foreach ($errors as $error) 
        {
            echo "<li>$error</li>";
        }
        echo "</ul>";
    }
    
}
// Close connection
mysqli_close($dbc);
?>
<h1>Login</h1>
<form action="login.php" method="post">
<p>Name: <input type="text" id="name" name="name" size="15" maxlength="20" autocomplete="off"></p>
<p><input type="submit" name="Submit" value="login"> <input type="reset" name="Reset" value="reset"></p>
</form>
</body>
</html>