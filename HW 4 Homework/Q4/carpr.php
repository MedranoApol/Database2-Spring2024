<!-- PART 4: A & B carpr.php -->
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>carsdb</title>
    <style>
        table {
            border-collapse: collapse;
            border: 1px solid gray;
            width: 50%;
            float: center;
            margin: 10px;
        }
    </style>
</head>
<body>
    <?php 
    //connect to myPHPadmin SQL Server
    $dbc = @mysqli_connect('localhost', 'root', '');

    //drop database if it exists
    $query = "DROP DATABASE IF EXISTS carsdb";

    if (!mysqli_query($dbc, $query))
        echo "Error in dropping the database: " . mysqli_error($dbc);

    //query to create DATABASE cardb
    $query = "CREATE DATABASE carsdb";

    if (!mysqli_query($dbc, $query))
        echo "Error creating database: " . mysqli_error($dbc);

    //select cardb to use
    $query = "USE carsdb";

    if (!mysqli_query($dbc, $query))
        echo "Error selecting database: " . mysqli_error($dbc);

    //query to create TABLE car
    $query = "CREATE TABLE IF NOT EXISTS car(
        id INT AUTO_INCREMENT,
        license_plate VARCHAR(6) NOT NULL,
        color VARCHAR(10) NOT NULL,
        PRIMARY KEY (id)
        )";

    if (!mysqli_query($dbc, $query))
        echo "Error creating car table: " . mysqli_error($dbc);

    //query to add VALUES to car TABLE 
    $query = "INSERT INTO car VALUES
    (DEFAULT, '578456', 'blue'),
    (DEFAULT, '578866', 'blue'),
    (DEFAULT, '578956', 'white'),
    (DEFAULT, '598456', 'black'), 
    (DEFAULT, '679997', 'black')";

    if (!mysqli_query($dbc, $query))
        echo "Error inserting data into car table: " . mysqli_error($dbc);

    //query to create make TABLE 
    $query = "CREATE TABLE IF NOT EXISTS make(
        make_id INT AUTO_INCREMENT,
        make_name VARCHAR(20) NOT NULL,
        PRIMARY KEY (make_id)
        )";

    if (!mysqli_query($dbc, $query))
        echo "Error creating make table: " . mysqli_error($dbc);

    //query to add VALUES to make table 
    $query = "INSERT INTO make VALUES
    (DEFAULT, 'volvo'),
    (DEFAULT, 'bmw'),
    (DEFAULT, 'mercedes'),
    (DEFAULT, 'ford'), 
    (DEFAULT, 'honda')";

    if (!mysqli_query($dbc, $query))
        echo "Error inserting data into make table: " . mysqli_error($dbc);


    //query to create owner TABLE
    $query = "CREATE TABLE IF NOT EXISTS owner(
        id INT AUTO_INCREMENT PRIMARY KEY,
        owner_name VARCHAR(20) NOT NULL,
        car_plate INT,
        car_make INT,
        FOREIGN KEY (car_plate) REFERENCES car(id),
        FOREIGN KEY (car_make) REFERENCES make(make_id)
        )";
    
    if (!mysqli_query($dbc, $query))
        echo "Error creating owner table: " . mysqli_error($dbc);

    //query to add VALUES to car TABLE 
    $query = "INSERT INTO owner VALUES
    (DEFAULT, 'peter', 1, 2),
    (DEFAULT, 'paul', 3, 1),
    (DEFAULT, 'ann', 4, 4),
    (DEFAULT, 'mary', 2, 3)";

    if (!mysqli_query($dbc, $query))
        echo "Error inserting data into make table: " . mysqli_error($dbc);
    
    // get all values from car table to display
    $query = "SELECT * FROM car";

    //run the query
    $result = mysqli_query($dbc, $query);

    //count the number of returned rows
    $num = mysqli_num_rows($result);

    if ($num > 0){
        //create table header
        echo '<table align="left" width="50%" border="solid" cellpadding="10">
        <thead>
        <tr align="center">
        <th align="center">id</th>
        <th aligh="center">license_plate</th>
        <th align=”center”>color</th>
        </tr>
        </thead>
        <tbody>';

        //shows all values in car table
        while ($row = mysqli_fetch_assoc($result)) 
            echo '<tr><td align="center">' . $row['id'] . '</td>
                      <td align="center">' . $row['license_plate'] . '</td>
                      <td align="center">' . $row['color'] . '</td></tr>';
        echo '</tbody></table>';

        mysqli_free_result($result); //free up space

    } elseif ($result) { //empty query result

        echo "Query returned zero results";
        mysqli_free_result($result); //free up space

    } else { //error with query
        echo "Error retrieving query result: " . mysqli_error($dbc);
    }

    // get all values from make table to display
    $query = "SELECT * FROM make";

    //run the query
    $result = mysqli_query($dbc, $query);

    //count the number of returned rows
    $num = mysqli_num_rows($result);

    if ($num > 0){
        //create table header
        echo '<table align="left" width="50%" border="solid" cellpadding="10">
        <thead>
        <tr align="center">
        <th align="center">make_id</th>
        <th aligh="center">make_name</th>
        </tr>
        </thead>
        <tbody>';

        //adds all values to table
        while ($row = mysqli_fetch_assoc($result)) 
            echo '<tr><td align="center">' . $row['make_id'] . '</td>
                      <td align="center">' . $row['make_name'] . '</td></tr>';
        echo '</tbody></table>';

        mysqli_free_result($result); //free up space

    } elseif ($result) { //empty query result

        echo "Query returned zero results";
        mysqli_free_result($result); //free up space

    } else { //error with query
        echo "Error retrieving query result: " . mysqli_error($dbc);
    }

    // get all values from table to display
    $query = "SELECT * FROM owner";

    //run the query
    $result = mysqli_query($dbc, $query);

    //count the number of returned rows
    $num = mysqli_num_rows($result);

    if ($num > 0){
        //create table header
        echo '<table align="left" width="50%" border="solid" cellpadding="10">
        <thead>
        <tr align="center">
        <th align="center">id</th>
        <th aligh="center">owner_name</th>
        <th align=”center”>car_plate</th>
        <th align=”center”>car_make</th>
        </tr>
        </thead>
        <tbody>';

        //adds all values to table
        while ($row = mysqli_fetch_assoc($result)) 
            echo '<tr><td align="center">' . $row['id'] . '</td>
                      <td align="center">' . $row['owner_name'] . '</td>
                      <td align="center">' . $row['car_plate'] . '</td>
                      <td align="center">' . $row['car_make'] . '</td></tr>';
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
    <div style="position: relative; width: 600px; height: 800px;">    
    <div style="position: absolute; bottom: 5px;">  
    <a href="index.html">Return to Index</a>
    </div>
    </div>
</body>
</html>