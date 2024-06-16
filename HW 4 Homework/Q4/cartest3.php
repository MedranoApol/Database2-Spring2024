<!-- PART 4: E cartest3.php -->
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>cartest3</title>
</head>
<body>
    <?php 
    //header of the page
    echo '<h1 align="center">Query 4E</h1>';

    //connect to database
    $dbc = @mysqli_connect('localhost', 'root', '', 'carsdb');

    //make query
    $query = 'SELECT make_name FROM make WHERE make_id NOT IN (SELECT car_make FROM owner)';

    //run query
    $result = mysqli_query($dbc, $query);

    //get the count of rows
    $num = mysqli_num_rows($result);


    if ($num > 0){
        //create table header
        echo '<table align="center" width="50%" border="solid" cellpadding="10">
        <thead>
        <tr align="center">
        <th align="center">car makes without an owner</th>
        </tr>
        </thead>
        <tbody>';

        //shows all values in car table
        while ($row = mysqli_fetch_assoc($result)) 
            echo '<tr><td align="center">' . $row['make_name'] . '</td></tr>';
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