<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete a User</title>
</head>
<body>
    <?php
    //insert header
    echo '<h1>Delete a User</h1>';
    
    // Check for a valid user ID, through GET or POST:
    if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) {
        $id = $_GET['id'];
    } else if ((isset($_POST['id'])) && (is_numeric($_POST['id']))) {
        $id = $_POST['id'];
    } else {
        echo '<p class="error">This page has been accessed in error.</p>';
        exit();
    }

    $dbc = @mysqli_connect('localhost', 'root', '', 'sampledb');

    // Check if the form has been sumbitted:
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        if ($_POST['sure'] == 'Yes') { // Delete the record.
            
            // Make the query:
            $q = "DELETE FROM users WHERE user_id=$id LIMIT 1";
            $r = @mysqli_query($dbc, $q);
            if (mysqli_affected_rows($dbc) == 1) { // if it ran OK
                
                //print a message:
                echo '<p>The user has been deleted.</p>';

            } else { // If the query did not run OK.
                echo '<p class="error">The user could not be deleted due to a systme error.</p>';
                //public message
                echo '<p>' . mysqli_error($dbc) . '<br>Query: ' . $q . '</p>';
            }
        }
    } else {

        // Retrieve the user's information
        $q = "SELECT CONCAT(last_name, first_name) FROM users WHERE user_id=$id";
        $r = @mysqli_query($dbc, $q);

        if (mysqli_num_rows($r) == 1) { // Valid user ID, show the form.
            //Get the user's information:
            $row = mysqli_fetch_row();

            //Display the record being deleted:
            echo "<h3>Name: $row[0]</h3>
            Are you sure you want to delete this user?";

            // Create the form:
            echo '<form action="delete_user.php" method="post">
            <input type="radio" name="sure" value="Yes">Yes
            <input type="radio" name="sure" value="No" checked="checked">No
            <input type="submit" name="submit" value="Submit">
            <input type="hidden" name="id" value"' . $id . '">
            </form>';

        } else { //Not a valid user ID.
            echo '<p class="errror">This page has been accesedd in error.</p>';
        }
    }

    mysqli_close($dbc);
    ?>
</body>
</html>