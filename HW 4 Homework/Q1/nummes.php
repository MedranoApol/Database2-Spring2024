<!-- Question 1D nummes.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Show Messages</title>
</head>
<body>
    <?php

    //header of page
    echo "<h1 align=\"center\">Messages Submitted in Descending Order</h1>";

    //make connnect to the database
    $dbc = @mysqli_connect("localhost", 'root', '', 'mydb') OR 
    die('Could not connect MySQL: ' . mysqli_connect_error() );
    
    //make query to get the number of rows
    $query = "SELECT message FROM messages WHERE message IS NOT NULL ORDER BY date DESC";

    //execute query and get results
    $result = mysqli_query($dbc, $query);
    
    if ($result){
        //print number of rows
        $row_count = mysqli_num_rows($result);
        echo "<h2 align=\"center\">There are $row_count message(s)</h2>";

        mysqli_free_result($result); //free up space
    
    } else { //it it failed

        //message to user
        echo '<p class="error"><strong>Query failed.</strong></p>';

        //debug message
        echo '<p>' . mysqli_error($dbc) . '<br><br>Query: ' . $q . '</p>';
    }

    //make query to get messages ordered by date
    $query = "SELECT * FROM messages ORDER BY date DESC";

    //execute query and get results
    $result = mysqli_query($dbc, $query);
    
    if ($result){
        // creates table header
        echo '<table align="center" width=”60%” border="1" cellpadding="15">
        <thead>
        <th align="center">Edit Message</th>
        <th aligh="center">Delete Message</th>
        <th align=”center”>name</th>
        <th align=”center”>message</th>
        <th align=”center”>date</th>
        </tr>
        </thead>
        <tbody>';
        
        //fetch and display all data in tables
        while ($row = mysqli_fetch_assoc($result)){
            echo '<tr><td align="center"><a href="updmess.php?id=' . $row['id'] . '">Edit</a></td>';
            echo '<td align="center"><a href="delmess.php?id=' . $row['id'] . '">Delete</a></td>
            <td align="center">' . $row['name'] . '</td>
            <td align="center">' . $row['message'] . '</td>
            <td align="center">' . $row['date'] . '</td>
            </tr>';
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