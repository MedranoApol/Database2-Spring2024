<!--HW5 Q3 : namesdb -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Insert Person</title>   
    </head>
<body>
<h1>Fill Out Form</h1>
    <form action="jobInsert.php" method="post">
        <p>First Name: <input type="text" id="fname" name="fname" size="15" maxlength="20" autocomplete="off"></p>
        <p>Last Name: <input type="text" id="lname" name="lname" size="20" maxlength="60" autocomplete="off"></p>
        <p>Job: <input type="text" id="job" name="job" size="15" maxlength="60" autocomplete="off"></p>
        <p><input type="submit" name="Submit" value="Register"></p>
    </form>
<?php
$errors = []; // Initialize an empty array to store errors

// Create the databse connection
$dbc = @mysqli_connect("localhost", 'root', '') OR die('Could not connect MYSQL: '. mysqli_connect_error());

$query = "CREATE DATABASE IF NOT EXISTS namesdb";

if (!mysqli_query($dbc, $query))
        echo "Error creating database: " . mysqli_error($dbc);

$query = "USE namesdb";
if (!mysqli_query($dbc, $query))
        echo "Error creating database: " . mysqli_error($dbc);

$query = "CREATE TABLE IF NOT EXISTS namestb(
    id INT AUTO_INCREMENT,
    fname VARCHAR(20) NOT NULL,
    lname VARCHAR(20) NOT NULL,
    job VARCHAR(20) NOT NULL,
    PRIMARY KEY (id)
)";

if (!mysqli_query($dbc, $query))
    echo "Error creating database: " . mysqli_error($dbc);

// If form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if empty of each part of form
    if (empty($_POST['fname'])) {
        $errors[] = "First name is required";
    }
    if (empty($_POST['lname'])) {
        $errors[] = "Last name is required";
    }
    if (empty($_POST['job'])) {
        $errors[] = "Job is required";
    }

    // If there are no errors, proceed with insertion
    if (empty($errors)){
        $stmt = mysqli_prepare($dbc, "INSERT INTO namestb (fname, lname, job) VALUES (?, ?, ?)");

        // Bind parameters
        mysqli_stmt_bind_param($stmt, "sss", $fname, $lname, $job);

        // Set parameters and execute
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $job = $_POST['job'];

        if (mysqli_stmt_execute($stmt)) {
            echo "<br>SUCCESS<br><br>";
            echo 'Last Executed Statement:</br></br> 
            <table border="0" cellpadding="10">
            <thead>
            <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Job</th>
            </tr>
            </thead>
            <tbody>';
            echo "<tr><td>$fname</td><td>$lname</td><td>$job</td></tr></tbody></table>";
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