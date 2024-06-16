<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Read Users</title>   
    </head>
<body>
    <h1>Register</h1>
    <?php
    $page_title = 'Register';

    $fn = "NULL";
    $ln = "NULL";
    $job = "NULL";

    // Check for form submission:
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $errors = []; //Initialize an error array

        // Check for a first name :
        if (empty($_POST['fname'])){
            $errors[] = 'You forgot to enter your first name.';
        } else {
            $fn = trim($_POST['fname']);
        }

        //Check for a last name:
        if (empty($_POST['lname'])){
            $errors[] = 'You forgot to enter your last name.';
        } else {
            $ln = trim($_POST['lname']);
        }
        
        //Check for a job:
        if (empty($_POST['job'])){
                $errors[] = 'You forhot to enter you job.';
        } else {
                $job = trim($_POST['job']);
        }
        if (empty($errors)) {
            foreach ($msg as $errors){
                echo "- $msg" . "</br>";
            }
        }

    //Make Connection  $dbc = @mysqli_connect('localhost', 'root', '', 'namesdb', '3306');
    $dbc = @mysqli_connect('localhost', 'root', '', 'namesdb', '3306');

    //make the query
    $query = "INSERT INTO namestb (fname, lname, job) VALUES ('$fn', '$ln', '$job');";

    //run the query
    $result = @mysqli_query($dbc, $query);

    // only runs if there is result from query
    if (!$dbc){

        echo '<p>System Error</p>
        <p class="error>You could not be registered due to a system error.
        We apologize any inconvenience.</p>';

        //Debugging message:
        echo '<p>' . mysqli_error($dbc) . '<br><br>Query: ' . $query . '</p>';
        
        mysqli_free_result($result);

        include("prepnames.php");
    }

    if(empty($result) || !$dbc){
        
        // creates table header
        echo '<table align="center" width=”60%”>
        <thead>
        <tr align=center>
        <th align=”center”>ID</th>
        <th align=”center”>Name</th>
        <th align=”center”>User</th>
        <th align=”center”>Pass</th>
        </tr>
        </thead>
        <tbody>';
        
        //fetch and display all data in tables
        while ($row = mysqli_fetch_assoc($result)){
            echo '<tr><td align="center">' . $row['ID'] . 
            '</td><td align="center">' . $row['Name'] . 
            '</td><td align="center">' . $row['User'] . 
            '</td><td align="center">' . $row['Pass'] .
            '</td></tr>'; 
        }

        //print a message
        echo "<h1>Thank you!</br>Enter enter more if you wish!<br/></h1>";

        mysqli_free_result($result);
    }
}
?>
    <form action="prepnames.php" method="post">
        <p>First Name: <input type="text" id="fname" size="15" maxlength="20"></p>
        <p>Last Name: <input type="text" id="lname" size="20" maxlength="60"></p>
        <p>Job: <input type="text" id="job" size="15" maxlength="60"></p>
        <p><input type="submit"  value="Submit"></p>
    </form>
</body>
</html>