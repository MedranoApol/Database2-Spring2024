<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
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

            errors = [];

            // Check for a first name:
            if (empty($_POST['first_name'])) {
                $erors[] = 'Your forget your first name';
            } else {
                $fn = mysqli_real_escape_string($dbc, trim($_POST['first_name']))
            }

            /* Same shit for last name and email */

            if (empty($errors)) { // if no errors

                //test for unique email email adress:
                $q = "SELECT user_id FROM users WHERE email='$e' AND user_id != $id";
                $r = @mysqli_query($dbc, $q);
                if (mysqli_num_rows($r) == 0) {
                    
                    // Make the query:
                    $q = "UPDATE users SET first_name='$fn', last_name='$ln', email='$e'
                    WHERE user_id=$id LIMIT 1";
                    $r = @mysqli_query($dbc, $q);
                    if (mysqli_affected_rows($dbc) == 1) {
                        //print a message:
                        echo '<p>The user has been edited.</p>';
                    } else {
                        echo '<p class="error">The user could not be edited due to a system error.
                        We apologize for any inconvenience.</p>'; // Public message.   
                        echo '<p>' . mysqli_error($dbc) . '<br>Query: ' . $q . '</p>';
                        // Debugging message
                    }
                } else { // Already registered

                    echo '<p class="error">The email address has already been registered.</p>';
                }
            } else { //Report the errors.

                echo '<p class="error">The following error(s) occurred:<br>';
                foreach ($errors as $msg) { // Print each error.
                        echo " - $msg<br>\n";
                     }
                echo '</p><p>Please try again.</p>';

            } // End of if (empty($errors)) IF.
        } // End of sumbit conditonal

        //Retrieve the user's information
        $q = "SELECT first_name, last_name, email FROM users WHERE user_id=$id";
        $r = @mysqli_query($dbc, $q);

        if (mysqli_num_rows($r) == 1) {

            //Get the users's information:
            $row = mysqli_fetch_row($r);

            // Create the form:
            echo '<form action="edit_user.php" method="post">
            <p>First Name: <input type="text" name="first_name" size="15"
            maxlength="15" value="' . $row[0] . '"></p>
            <p>Last Name: <input type="text" name="last_name" size="15"
            maxlength="15" value="' . $row[1] . '"></p>
            <p>Email Adress: <input type="text" name="email" size="15"
            maxlength="15" value="' . $row[2] . '"></p>
            <p><input type="submit" name="submit" value="Submit"></p>
            <input type="hidden" name="id" value"' . $id .'"></form>';

        } else {
            echo '<p class="error">This page has been accessed in error.</p>';
        }   

        mysqli_close($dbc);
    ?>
</body>
</html>