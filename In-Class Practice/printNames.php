<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Print Names</title>
</head>
<body>
<?php
    $dbc = mysqli_connect("localhost", "root", "", "userdb") OR die('Could not connect MYSQL: ' . mysqli_connect_error());

    $query = "SELECT * FROM userinfo ORDER BY Name";

    if (!mysqli_query($dbc, $query))
        echo "Error creating database: " . mysqli_error($dbc);
    else
        $result = mysqli_query($dbc, $query);

    $num = mysqli_num_rows($result);

    if ($num > 0)
    {

        while ($row = mysqli_fetch_assoc($result))
        {
            echo '<p>Name: ' . $row['Name'] . '<br>
            Username: ' . $row['User'] . '<br>
            Password: ' . $row['Pass'] . '</p>';        
        }

    }
    elseif($result)
    {
        echo 'There are no results';
    }
    else
    {
        echo 'Error occured retrieving result: ' . mysqli_error($dbc);
    }

    mysqli_close($dbc);
?>
</body>
</html> 