<!-- PART 2: Q1 shoespr.php -->
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SHOES</title>
</head>
<body>
    <?php 
    //creates header
    echo "<h1 align=\"center\">DATABASE: shoesdb<br>TABLE: shoes</h1>";

    //connect to myPHPadmin SQL Server
    $dbc = @mysqli_connect('localhost', 'root', '');

    //drop database if it exists
    $query = "DROP DATABASE IF EXISTS shoesdb";

    if (!mysqli_query($dbc, $query))
        echo "Error in dropping the database: " . mysqli_error($dbc);

    //query to create DATABASE shoedb
    $query = "CREATE DATABASE shoesdb";

    if (!mysqli_query($dbc, $query))
        echo "Error creating database: " . mysqli_error($dbc);

    //select shoedb to use
    $query = "USE shoesdb";

    if (!mysqli_query($dbc, $query))
        echo "Error selecting database: " . mysqli_error($dbc);

    //query to create TABLE shoes
    $query = "CREATE TABLE IF NOT EXISTS shoes(
        id INT AUTO_INCREMENT,
        type CHAR(1) NOT NULL,
        color VARCHAR(10) NOT NULL,
        size INT(2) NOT NULL,
        PRIMARY KEY (id)
        )";

    if (!mysqli_query($dbc, $query))
        echo "Error creating table: " . mysqli_error($dbc);

    //query to add VALUES to tables
    $query = "INSERT INTO shoes VALUES
    (DEFAULT, 'A', 'blue', 10),
    (DEFAULT, 'A', 'black', 12),
    (DEFAULT, 'B', 'green', 9),
    (DEFAULT, 'C', 'black', 9)
    ";

    if (!mysqli_query($dbc, $query))
        echo "Error inserting data into table: " . mysqli_error($dbc);
    
    // get all values from table to display
    $query = "SELECT * FROM shoes";

    //run the query
    $result = mysqli_query($dbc, $query);

    //count the number of returned rows
    $num = mysqli_num_rows($result);

    if ($num > 0){
        //create table header
        echo '<table align="center" width="50%" border="solid" cellpadding="10">
        <thead>
        <tr align="center">
        <th align="center">id</th>
        <th aligh="center">type</th>
        <th align=”center”>color</th>
        <th align=”center”>size</th>
        </tr>
        </thead>
        <tbody>';

        //adds all values to table
        while ($row = mysqli_fetch_assoc($result)) 
            echo '<tr><td align="center">' . $row['id'] . '</td>
                      <td align="center">' . $row['type'] . '</td>
                      <td align="center">' . $row['color'] . '</td>
                      <td align="center">' . $row['size'] . '</td></tr>';
        echo '</tbody></table>';

        mysqli_free_result($result); //free up space

    } elseif ($result) { //empty query result

        echo "Query returned zero results";
        mysqli_free_result($result); //free up space

    } else { //error with query
        echo "Error retrieving query result: " . mysqli_error($dbc);
    }

    mysqli_close($dbc);
    ?>
</body>
</html>