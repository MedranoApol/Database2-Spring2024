<!--Q6B Add Blog Entries to Database-->
<!-- Accessed From add_en.php -->
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Entry</title>
</head>
<body>
    <?php
    //insert header
    echo '<h1>Update a entry</h1>';
    
    // Check for a valid user ID, through GET or POST:
    if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) {
        $id = $_GET['id']; //accessed through href link
    } else if ((isset($_POST['id'])) && (is_numeric($_POST['id']))) {
        $id = $_POST['id']; //if id is gained from form submission
    } else {    
        echo '<p class="error">This page has been accessed in error.</p>';
        exit();
    }

    $dbc = @mysqli_connect('localhost', 'root', '', 'myblog');

    // Check if the form has been sumbitted:
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $error = ""; //intialize error string

        // Check for new entry has input:
        if (empty($_POST['new_entry'])) {
            $error = 'Please insert a new entry';
        } else {
            $new_entry = mysqli_real_escape_string($dbc, trim($_POST['new_entry']));
        }

        if (empty($errors)) { // if there are no errors
                
            // Make the query:
            $query = "UPDATE entries SET entry='$new_entry'
                WHERE id=$id";
                $result = @mysqli_query($dbc, $query);
                if (mysqli_affected_rows($dbc) == 1) {
                    //print a message:
                    echo '<p>The entry has been updated.</p>';
                } else {
                    echo '<p class="error">The entry could not be  due updated due to a system error.
                    We apologize for any inconvenience.</p>'; // Public message.   
                    echo '<p>' . mysqli_error($dbc) . '<br>Query: ' . $query . '</p>';
                    // Debugging message
                }
        } else { //Report the errors.

            echo '<p class="error">The following error occurred:<br>'
            . $error . '</p><p>Please try again.</p>';
        }
    } 

    //Retrieve the id's entry
    $query = "SELECT entry FROM entries WHERE id=$id";
    $result = @mysqli_query($dbc, $query);

    if (mysqli_num_rows($result) == 1) {

        //Get the users's information:
        $row = mysqli_fetch_assoc($result);

        // Create the form:
        echo '<form action="alter_en.php" method="post">
        <p>Old entry: &nbsp&nbsp'. $row['entry'] . '</p>
        <p>New entry: <textarea name="new_entry" rows="5" cols="50"></textarea></p>
        <p><input type="submit" name="submit" value="Submit"></p>
        <input type="hidden" name="id" value="' . $id .'"></form>';  

    } else {
        echo '<p class="error">This page has been accessed in error.</p>';
    }

    //gives you link to return to add_en.php
    echo '<p><a href="add_en.php">Return to add_en.php</a></p>';

    mysqli_close($dbc);
?>
</body>
</html>