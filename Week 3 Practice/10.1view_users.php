<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Database</title>
</head>
<body>
<?php 
    echo '<h1>Registered Users</h1>';

    $dbc = @mysqli_connect('localhost', 'root', '', 'sampledb');

    //Define the query:
    $q = "SELECT last_name, first_name, DATE_FORMAT(registration_date, 
    '%M %d, %Y') AS dr, user_id FROM users ORDER BY registration_date ASC";
    $r = @mysqli_query($dbc, $q);

    //Count the number of returned rows:
    $num = mysqli_num_rows($r);

    if ($num > 0){ //if it ran OK, display the records.

        //Print how many users there are:
        echo "<p>There are currently $num registered users.</p>\n";

        //Table header:
        echo '<table width="60%">
        <thead>
        <tr>
            <th align="left"><strong>Edit</strong></th>
            <th align="left"><strong>Delete</strong></th>
            <th align-"left"><strong>Last Name</strong></th>
            <th align-"left"><strong>First Name</strong></th>
            <th align-"left"><strong>Date Registered</strong></th>
        </tr>
        </thead>
        <tbody>';

        // Fetch and print all the records:
        while ($row = mysqli_fetch_assoc($r)) {
            echo '<tr>
                <td align="left"><a href="edit_user.php?id=' . $row['user_id'] . '">Edit</a></td>
                <td align="left"><a href="delete_user.php?id=' . $row['user_id'] . '">Delete</a></td>
                <td align="left">' . $row['last_name'] . '</td>
                <td align="left">' . $row['first_name'] . '</td>
                <td align="left">' . $row['dr'] . '</td>
                </tr>';
        }

        echo '</tbody></table';
        mysqli_free_result($r);

    } else { // if no records were returned.
        echo '<p class="error">There are currently no registered users.</p>';
    }

    mysqli_close($dbc);
?>
</body>
</html>