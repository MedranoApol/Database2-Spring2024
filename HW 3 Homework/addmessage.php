<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Read Users</title>   
    </head>
<body>
<?php

$errors = []; // Initialize an empty array to store errors

// Create the databse connection
$dbc = @mysqli_connect("localhost", 'root', '', 'mydb');

//Check connection
if (!$dbc) {
    die("Connection failed: " . mysqli_connect_error());
}

// If form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if empty of each part of form
    if (empty($_POST['name'])) {
        $errors[] = "name is required";
    }
    if (empty($_POST['message'])) {
        $errors[] = "message is required";
    }

    // If there are no errors, proceed with insertion
    if (empty($errors)){
        $stmt = mysqli_prepare($dbc, "INSERT INTO messages (name, message) VALUES (?, ?)");

        // Bind parameters
        mysqli_stmt_bind_param($stmt, "ss", $name, $message);

        // Set parameters and execute
        $name = $_POST['name'];
        $message = $_POST['message'];

        if (mysqli_stmt_execute($stmt)) {
            echo "New record inserted successfully</br>";
        } else {
            echo "Error: " . mysqli_error($dbc);
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
}

// Close connection
mysqli_close($dbc);
?>

<h1>Register</h1>
    <form align="center" action="addmessage.php" method="post">
        <p>Name: <input type="text" id="name" name="name" size="15" maxlength="20"></p>
        <p><label>Comments: <textarea
name="message" rows="3"
cols="40"></textarea></label></p>
        <p><input type="submit" name="Submit" value="Register"></p>
    </form>
</body>
</html>