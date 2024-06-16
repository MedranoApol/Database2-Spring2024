<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Calculator</title>
</head>
<body>
    <?php #Script 1.8 Numbers
    //display heading
    echo '<h1 align="center">Calculate Cost of Purchase</h1>';

    //set variables
    $price = 119.95;
    $quantity = 30;
    $taxrate = 0.05;

    //calculate total
    $total = $quantity * $price;
    $total += ($total * $taxrate);

    //format answer
    $total = number_format($total, 2);

    //display numbers
    echo '<p style="color:orange;font-size:20px;" align="center"><strong>Price per widget:</strong> '.$price."</br>";
    echo '<strong>Quantity of widgets:</strong> '.$quantity."</br>";
    echo '<strong>Tax Rate of widgets:</strong> '.$taxrate."</br>";
    echo '<strong>Total Cost: '.$total."</strong></br></p>";
    ?>
</body>
</html>