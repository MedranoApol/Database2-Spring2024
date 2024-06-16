<!--Q6A Add Blog Entries to Database-->
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>add_en</title>
</head>
<body>
<h1>Add Blog Entry</h1>
<form action="add_en.php" method="post">
<p><label>Insert Title: <input type="text" name="title" space="20" maxlength="100"></label></p>
<p><label>Insert Entry: <textarea name="entry" rows="5" cols="50"></textarea></label></p>
<p><label>Date: <input type="date" name="date"></label></p>
<p><input type="submit" name="Submit" value="Add Entry"></p>
<?php
$errors = []; // Initialize an empty array to store errors

// Create the databse connection
$dbc = @mysqli_connect("localhost", 'root', '') OR die('Could not connect MYSQL: '. mysqli_connect_error());

$query = "CREATE DATABASE IF NOT EXISTS myblog";

if (!mysqli_query($dbc, $query))
        echo "Error creating database: " . mysqli_error($dbc);

$query = "USE myblog";
if (!mysqli_query($dbc, $query))
        echo "Error creating database: " . mysqli_error($dbc);

$query = "CREATE TABLE IF NOT EXISTS entries(
    id INT AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    entry VARCHAR(255) NOT NULL,
    date DATE NOT NULL,
    PRIMARY KEY (id)
)";

if (!mysqli_query($dbc, $query))
    echo "Error creating database: " . mysqli_error($dbc);

// If form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if empty of each part of form
    if (!isset($_POST['title']) && empty($_POST['title'])) {
        $errors[] = "Title is required";
    }
    if (!isset($_POST['entry']) && empty($_POST['entry'])) {
        $errors[] = "Entry is required";
    }
    if (!isset($_POST['date']) && empty($_POST['date'])) {
        $errors[] = "Date is required";
    }

    // If there are no errors, proceed with insertion
    if (empty($errors)){
        $stmt = mysqli_prepare($dbc, "INSERT INTO entries (title, entry, date) VALUES (?, ?, ?)");

        // Bind parameters
        mysqli_stmt_bind_param($stmt, "sss", $title, $entry, $date);

        // Set parameters and execute
        $title = mysqli_real_escape_string($dbc, trim($_POST['title']));
        $entry = mysqli_real_escape_string($dbc, trim($_POST['entry']));
        $date = date('Y-m-d', strtotime($_POST['date']));

        if (mysqli_stmt_execute($stmt)) {
            echo "<br>SUCCESS<br><br>";
            echo '<p>Entry Title: ' . $title . '<br>
            Entry Text: ' . $entry . '<br></p>';
            echo "<p><a href=\"alter_en.php?id=" . mysqli_insert_id($dbc) . "\">Alter the Entry Text</a></p>";
            
        } else {
            echo "Error: " . mysqli_error($dbc);
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
}

// Display errors from NULL values
if (!empty($errors)) {
    echo "<h3>Error List:</h3>";
    echo "<ul>";
    foreach ($errors as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul>";
}

// Close connection
mysqli_close($dbc);
?>
</body>
</html>