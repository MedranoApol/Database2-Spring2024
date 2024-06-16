<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Read Users</title>   
    </head>
<body>
    <?php
    //prints title of page
    echo '<h1 align="center">Registered Users</h1>';   

    //make connection to database 
    $dbc = @mysqli_connect('localhost', 'root', '', 'userdb', '3306');

    if (!$dbc){
        echo ("Connection failed: " . mysqli_connect_error());
        die(include("prepnames"));
    }

    //make the query
    $query = "SELECT * FROM userinfo";

    //run the query
    $result = @mysqli_query($dbc, $query);


    // only runs if there is result from query
    if (!$result){
        
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

        //close the table
        echo '</tbody><table>';

        //free up the resources
        mysqli_free_result($result);

    } else { //if there is no result

        // Public message with debugginning me
        echo '<p class="error">The current users could not be retrived. We apologize for any inconvenience.</p>';
        echo '<p>' . mysqli_error($dbc) . '<br><br>Query: ' . $query . '</p';    

    }

    //close  the database connection.
    mysqli_close($dbc);

    ?>
    </body>
</html>
