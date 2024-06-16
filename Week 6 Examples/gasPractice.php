<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GasPractice</title>
</head>
<body>
<?php

function create_radio ( $value, $name = 'gallon_price') {

    echo '<input type="radio" name="' . $name .'" value="' . $value .'"';

    // Check for stickiness:
    if (isset($_POST[$name]) && ($_POST[$name] == $value))
    {
        echo ' checked="checked"';
    }

    // Complete the element
    echo "> $value ";
}

function create_option ( $value, $name = 'efficiency') {

    $efficiency_vals = [ 
        '10' => "Terrible",
        '20' => "Decent",
        '30' => "Very Good",
        '50' => "Outstanding"
    ];
    echo '<option value="' . $value .'"';

    // Check for stickiness:
    if (isset($_POST[$name]) && ($_POST[$name] == $value))
    {
        echo ' selected="selected"';
    }

    // Complete the element
    echo ">" . $efficiency_vals[$value] . "</option>";
}

echo '<h1>Trip Cost Calculator</h1>';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Minimal form validation:
    if (isset($_POST['distance'], $_POST['gallon_price'], $_POST['efficiency']) &&
    is_numeric($_POST['distance']) && is_numeric($_POST['gallon_price']) && is_numeric($_POST['efficiency']))
    {
        // Calculate the results:
        $gallons = $_POST['distance'] / $_POST['efficiency'];
        $dollars = $gallons * $_POST['gallon_price'];
        $hours = $_POST['distance']/65;

        // Print the results:
        echo '<p>The total cost of driving ' . $_POST['distance'] . ' miles, averaging ' .
        $_POST['efficiency'] . ' miles per gallon, and paying an average of $' .
        $_POST['gallon_price'] . ' per gallon, is $' . number_format($dollars, 2) . '.<br>
        If you drive at an average of 65 miles per hour, the trip will take approximately ' . 
        number_format($hours, 2) . ' hours. </p>';

    }
    else  //Invalid submitted values
    {
        echo '<p>Don\'t be dumb. Fill out the form correctly!</p>';
    }
}
?>

<form action="gasPractice.php" method="post">
    <p>Distance (in miles): <input type="number" name="distance" value="
    <?php if (isset($_POST['distance'])) echo $_POST['distance']; ?>"></p>
    <p>Avg. Price Per Gallon:
    <?php 
    create_radio('3.00');
    create_radio('3.50');
    create_radio('4.00');
    ?>
    </p>
    <p>Fuel Efficiency: <select name="efficiency">
    <?php
    create_option('10');
    create_option('20');
    create_option('30');
    create_option('50');
    ?>
    </select></p>
    <p><input type="submit" name="submit" value="Calculate!"></p>
</form>
</body>
</html>