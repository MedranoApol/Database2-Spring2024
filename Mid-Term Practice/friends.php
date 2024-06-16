<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Friends Form</title>
</head>
<body>
<?php
    echo '<h1>Are We Friends??</h1>';

    echo '<form action="friends.php" method="post" autocomplete="off">
    <p><label>Name: <input type="text" name="name" size="15" maxlength="30" placeholder="Anonymous"></label></p>
    <p><label>Relationship: 
    <input type="radio" name="friend" value="Friend">Friend
    <input type="radio" name="friend" value="Foe">Foe
    </label></p>';

    $years = range(2002, 2024);
    echo '<p><label>First Met: <select name="year">';
    foreach ($years as $value){
        echo "<option value=\"$value\">$value</option>";
    }
    echo '</select></label></p>
    <p><input type="submit" name="Submit" value="Submit"></p>';

    $error = [];

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (!empty($_POST["name"]))
        {
            $name = $_POST["name"];
        } 
        else
        {
            $name = "Anonymous";
        }

        if (!empty($_POST["friend"]))
        {
            $friend = $_POST["friend"];
        } 
        else
        {
            $error[] = "Relationship cannot be empty";
        }

        if (!empty($_POST["year"]))
        {
            $year = $_POST["year"];
        }
        else
        {
            $error[] = "Date Met cannot be empty";
        }

        if (!empty($error))
        {
            echo '<h2>Error(s):</h2><p><ul>';
            foreach ($error as $errorMsg)
            {
                echo '<li>' . $errorMsg . '</li>';
            }
            echo '</ul></p>';
        }
        else
        {
            $dbc = @mysqli_connect('localhost', 'root', '', 'myfriends') OR die('Could not connect MySQL: ' . mysqli_connect_error() );

            $stmt = mysqli_prepare($dbc, "INSERT INTO friends (id, name, relationship, year) VALUES (DEFAULT, ?, ?, ?)");

            mysqli_stmt_bind_param($stmt, "ssi", $name, $friend, $year);

            $name = mysqli_real_escape_string($dbc, trim($_POST['name']));
            $friend = mysqli_real_escape_string($dbc, trim($_POST['friend']));
            $year = mysqli_real_escape_string($dbc, trim($_POST['year']));

            if (mysqli_stmt_execute($stmt))
            {
                echo 'New record inserted successfully</br>';
            }
            else
            {
                echo "Error: " . mysqli_error($dbc);
            }

            mysqli_stmt_close($stmt);
            mysqli_close($dbc);
        }
    }
?>
</body>
</html>
