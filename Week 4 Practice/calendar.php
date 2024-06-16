<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Calendar</title>
</head>
<body>
    <form action="calendar.php" method="post">
    <?php #Script 2.6 Makes 3 Pull Down Menus: Month, Day, Year

    //make the months array:
    $months = [1 => 'Janurary', 'Feburary', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 
    'November', 'Decemeber'];

    //make the days and years arrays
    $days = range(1, 31);
    $years = range(2017, 2027);

    //make the months pull down menu
    echo '<select name="month">';
    foreach ($months as $key => $value){
        echo "<option value=\"$key\">$value</option>\n";
    }
    echo '</select>';

    //make the days pull down menu
    echo '<select name="day">';
    foreach ($days as $value){
        echo "<option value=\"$value\">$value</option>\n";
    }
    echo '</select>';

    //make the years pull down
    echo '<select name="year">';
    foreach ($years as $value){
        echo "<option value=\"$value\">$value</option>\n";
    }
    echo '</select>';
    ?>
    </form>
</body>
</html>