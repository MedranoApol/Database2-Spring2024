<?php $errors = []; // Initialize an empty array to store errors
$dbc = @mysqli_connect("localhost", 'root', '', 'namesdb') OR    die("Connection failed: " . mysqli_connect_error());

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
        $fname = real_mysqli_string($dbc,$_POST['fname']);
        $lname = real_mysqli_string($dbc, $_POST['lname']);
        $job = real_mysqli_string($dbc, $_POST['job']);

        if (mysqli_stmt_execute($stmt)) {
            echo "New record inserted successfully</br>";
            echo 'Last Executed Statement:</br></br> 
            <strong>INSERT INTO namestb (fname, lname, job) VALUES ('.$fname. ", ". $lname .", ".$job.');</strong>';
        } mysqli_stmt_close($stmt);
    }
}

// Fetch and display all the records
$query = "SELECT fname, lname, job FROM namestb";
$result = mysqli_query($dbc, $query);

if (mysqli_num_rows($result) > 0) {
    echo "<h2>Records:</h2>";
    echo "<ul>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<li>" . $row["fname"] . " " . $row["lname"] . " - " . $row["job"] . "</li>";
    }
    echo "</ul>";
} else {
    echo "0 results";
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

<h1>Register</h1>
    <form action="prepnames.php" method="post">
        <p>First Name: <input type="text" id="fname" name="fname" size="15" maxlength="20"></p>
        <p>Last Name: <input type="text" id="lname" name="lname" size="20" maxlength="60"></p>
        <p>Job: <input type="text" id="job" name="job" size="15" maxlength="60"></p>
        <p><input type="submit" name="Submit" value="Register"></p>
    </form>
</body>
</html>