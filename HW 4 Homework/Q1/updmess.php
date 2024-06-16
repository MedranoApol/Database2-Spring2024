<!--1E updmess.php -->
<!--accessed from nummes.php-->
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Message</title>
</head>
<body>
    <?php
    //insert header
    echo '<h1>Update a Message</h1>';
    
    // Check for a valid user ID, through GET or POST:
    if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) {
        $id = $_GET['id']; //accessed through href link
    } else if ((isset($_POST['id'])) && (is_numeric($_POST['id']))) {
        $id = $_POST['id']; //if id is gained from form submission
    } else {    
        echo '<p class="error">This page has been accessed in error.</p>';
        exit();
    }

    $dbc = @mysqli_connect('localhost', 'root', '', 'mydb');

    // Check if the form has been sumbitted:
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $error = ""; //intialize error string

        // Check for new message has input:
        if (empty($_POST['new_message'])) {
            $error = 'Please insert a new message';
        } else {
            $new_message = mysqli_real_escape_string($dbc, trim($_POST['new_message']));
        }

        if (empty($errors)) { // if there are no errors
                
            // Make the query:
            $query = "UPDATE messages SET message='$new_message'
                WHERE id=$id";
                $result = @mysqli_query($dbc, $query);
                if (mysqli_affected_rows($dbc) == 1) {
                    //print a message:
                    echo '<p>The message has been updated.</p>';
                } else {
                    echo '<p class="error">The message could not be  due updated due to a system error.
                    We apologize for any inconvenience.</p>'; // Public message.   
                    echo '<p>' . mysqli_error($dbc) . '<br>Query: ' . $query . '</p>';
                    // Debugging message
                }
        } else { //Report the errors.

            echo '<p class="error">The following error occurred:<br>'
            . $error . '</p><p>Please try again.</p>';
        }
    } 

    //Retrieve the id's message
    $query = "SELECT message FROM messages WHERE id=$id";
    $result = @mysqli_query($dbc, $query);

    if (mysqli_num_rows($result) == 1) {

        //Get the users's information:
        $row = mysqli_fetch_assoc($result);

        // Create the form:
        echo '<form action="updmess.php" method="post">
        <p>Old Message: &nbsp&nbsp'. $row['message'] . '</p>
        <p>New Message: <input type="text" name="new_message" size="15"
        maxlength="15"></p>
        <p><input type="submit" name="submit" value="Submit"></p>
        <input type="hidden" name="id" value="' . $id .'"></form>';  

    } else {
        echo '<p class="error">This page has been accessed in error.</p>';
    }

    //gives you link to return to nummes.php
    echo '<p><a href="nummes.php">Return to nummes.php</a></p>';

    mysqli_close($dbc);
?>
</body>
</html>