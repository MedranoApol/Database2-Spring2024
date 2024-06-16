<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>SanitizeCalculator</title>
    <meta charset="UTF-8">
</head>
<body>
<?php # Script 13.5 - calculator.php #2 Apol's Edition

    // Check if the form has been submitted:
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {

        // Sanitize the variables:
        $name = (isset($_POST['name']) && !empty($_POST['name'])) ? filter_var($_POST['name'], FILTER_SANITIZE_STRING) : NULL;
        $quantity = (isset($_POST['quantity']) && !empty($_POST['quantity'])) ? filter_var($_POST['quantity'], FILTER_VALIDATE_INT, ['min_range' => 1]) : NULL;
        $price = (isset($_POST['price']) && !empty($_POST['price'])) ? filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : NULL;
        $tax = (isset($_POST['tax']) && !empty($_POST['tax'])) ? filter_var($_POST['tax'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : NULL;

        // All variables should be positive!
        if ( ($quantity > 0) && ($price > 0 ) && ( $tax > 0))
        {
            // Calculate the total:
            $total = $quantity * $price;
            $total += $total * ($tax/100);

            // Print the result
            echo '<p>The total cost of purchasing ' . $quantity . ' widget(s) at $' . 
            number_format($price, 2) . ' each, plus tax, is $' . number_format($total, 2) . '.</p>';

            if (!empty($name))
                echo '<p>Have a great day, ' . $name . "!</p>";
            else
                echo '<p>Have a great day!</p>';
        }
        else
        { // Invalid submitted values

            echo '<p style="font-weight: bold; color: #C00">Please enter a valid quantity, price, and tax rate.</p>';
        }
    }

?>
<form action="sanitizeCalculator.php" method="post">
    <p><label>Name: <input type="text" name="name" value="
    <?php if(isset($_POST["name"])) echo (strip_tags($_POST["name"]));?>"></label></p>
    <p><label>Quantity: <input type="number" name="quantity" step="1" min="1" value="
    <?php if(isset($_POST["quantity"])) echo $_POST["quantity"];?>"></p>
    <p><label>Price: <input type="number" name="price" step="0.01" min="0.01" value="
    <?php if(isset($_POST["price"])) echo $_POST["price"];?>"></p>
    <p><label>Tax (%): <input type="text" name="tax" step="0.01" min="0.01" value="
    <?php if(isset($_POST["tax"])) echo (strip_tags($_POST["tax"]));?>"></p>
    <p><input type="submit" name="submit" value="Calculate!"></p>
</form>
</body>
</html>