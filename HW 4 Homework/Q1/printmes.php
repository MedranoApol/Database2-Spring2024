<!-- Question 1B printmes.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Insert Messages</title>
</head>
<body>
    <?php

    //header of page
    echo "<h1 align=\"center\">Messages Submitted</h1>";

    //make connnect to the database
    $dbc = @mysqli_connect("localhost", 'root', '', 'mydb') OR 
    die('Could not connect MySQL: ' . mysqli_connect_error() );

    //make query
    $query = "SELECT * FROM messages";

    //execute query and get results
    $result = mysqli_query($dbc, $query);
    
    $row_count = mysqli_num_rows($result);

    if ($row_count > 0){

        // creates table header
        echo '<table align="center" width=”60%” cellpadding="10">
        <thead>
        <tr align=center>
        <th align=”center”>name</th>
        <th align=”center”>message</th>
        <th align=”center”>date</th>
        </tr>
        </thead>
        <tbody>';
        
        //fetch and display all data in tables
        while ($row = mysqli_fetch_assoc($result)){
            echo '<tr><td align="center">' . $row['name'] . 
            '</td><td align="center">' . $row['message'] . 
            '</td><td align="center">' . $row['date'] .
            '</td></tr>'; 
        }

        //close the table
        echo '</tbody><table>'; 

        mysqli_free_result($result); //free up space
    
    } else if ($result) { //empty result
        
        echo '<p align="center">No Results</p>';
        mysqli_free_result($result);
        
    } else { //it it failed

        //message to user
        echo '<p class="error"><strong>Query failed.</strong></p>';

        //debug message
        echo '<p>' . mysqli_error($dbc) . '<br><br>Query: ' . $q . '</p>';
    }
    
    mysqli_close($dbc);

    ?>
</body>
</html>