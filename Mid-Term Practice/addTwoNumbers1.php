<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>addTwoNumbers1</title>
</head>
<body>
    <h1>Addition Calculator</h1>
<form action="addTwoNumbers1.php" method="post" autocomplete="off">
    <p><label>Number 1: <input type="text" name="num1" size="10" maxlength="15"></label></p>
    <p><label>Number 2: <input type="text" name="num2" size="10" maxlength="15"></label></p>
    <p><input type="submit" name="Submit" value="Add the Numbers"></p>
</form>
<?php
    $errors = [];

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        
        if (!empty($_POST["num1"]))
        {
            $num1 = $_POST["num1"];
        }
        else
        {
            $errors[] = "Number 1 is empty";
        }

        if (!empty($_POST["num2"]))
        {
            $num2 = $_POST["num2"];
        }
        else
        {
            $errors[] = "Number 2 is empty";
        }

        if (!empty($errors)){
            echo "<p><strong>Error(s)</strong></p><ul>";
            foreach ($errors as $errorMsg)
            {
                echo "<li>$errorMsg</li>";
            }
            echo "</ul>";
        }
        else
        {
            echo "<h2>The result:</h2>";
            $total = $num1 + $num2;
            echo "<p> $num1 + $num2 = $total</p>";
        }
    }
?>
</body>
</html>