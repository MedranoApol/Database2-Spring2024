<!-- PART 4: D cartest2.php -->
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>cartest2</title>
</head>
<body>
    <?php 
    //header of the page
    echo '<h1 align="center">Query 4D</h1>';

    //connect to database
    $dbc = @mysqli_connect('localhost', 'root', '', 'carsdb');

    //make query
    $query = 'SELECT owner.owner_name, car.color, make.make_name FROM owner
    JOIN make ON owner.car_make = make.make_id JOIN car ON owner.car_plate = car.id
    ORDER BY owner.owner_name'; 

    //run query
    $result = mysqli_query($dbc, $query);

    //get the count of rows
    $num = mysqli_num_rows($result);

    if ($num > 0){
        //create table header
        echo '<table align="center" width="50%" border="solid" cellpadding="10">
        <thead>
        <tr align="center">
        <th align="center">owner_name</th>
        <th align=”center”>color</th>
        <th align=”center”>make_name</th>
        </tr>
        </thead>
        <tbody>';

        //shows all values in car table
        while ($row = mysqli_fetch_assoc($result)) 
            echo '<tr><td align="center">' . $row['owner_name'] . '</td>
                      <td align="center">' . $row['color'] . '</td>
                      <td align="center">' . $row['make_name'] . '</td></tr>';
        echo '</tbody></table>';

        mysqli_free_result($result); //free up space

    } elseif ($result) { //empty query result

        echo "Query returned zero results";
        mysqli_free_result($result); //free up space

    } else { //error with query
        echo "Error retrieving query result: " . mysqli_error($dbc);
    }

    mysqli_close($dbc)
    ?>
</body>
</html>