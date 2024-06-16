<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Insert Messages</title>
</head>
<body>
    <?php

    $errors = []; //intialize error array

    //make connnect to the database
    $dbc = @mysqli_connect("localhost", 'root', '', 'mydb') OR die('Could not connect MySQL: ' . mysqli_connect_error() );

    //if post is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        if (empty($_POST["name"])){ //if name was empty
            $errors = "name is required";
        }
        if (empty($_POST["message"])){ //if message was empty
            $errors = "message is required";
        }

        if (empty($errors)){
            $stmt = mysqli_prepare($dbc, "INSERT INTO messages (id, name, message, date) VALUES (DEFAULT, ?, ?, NOW())");

            //bind parameters
            mysqli_stmt_bind_param($stmt, "ss", $name, $message);

            //Set parameters and execute
            $name = mysqli_real_escape_string($dbc, trim($_POST['name']));
            $message = mysqli_real_escape_string($dbc, trim($_POST['message']));

            //execute statement
            if (mysqli_stmt_execute($stmt)) {
                echo "New record inserted successfully</br>";
            } else {
                echo "Error: " . mysqli_error($dbc);
            }
            
            // Close statement
            mysqli_stmt_close($stmt);
        }

    }

    //close connecition
    mysqli_close($dbc);

    // Display errors from NULL values
    if (!empty($errors)) {
        echo "<h3>Error List:</h3>";
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
    }

    ?>

    <h1>Submit Messages</h1>
        <form action="insertmes.php" method="post">
            <p><label for="name">Name:</label><br>
            <input type="text" id="name" name="name"></p>
            <p><label for="message">Message:</label><br>
            <input type="text" id="message" name="message"></p>
            <input type="submit" value="Submit">
    </form>
</body>
</html>