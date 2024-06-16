<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Calculator</title>
</head>
<body>
<h1 align="center">Calculator</h1>

<form action="calculator.php" method="post" autocomplete="off">
<p align="center"><label>Number 1: <input type="text" name="num1" size="10" maxlength="15"></label></p>
<p align="center"><label>Number 2: <input type="text" name="num2" size="10" maxlength="15"></label></p>
<p align="center"><label>Operation: <select name="operation">
    <option value="addition">Addition</option>
    <option value="subtraction">Subtraction</option>
    <option value="multiplication">Multiplication</option>
    <option value="division">Division</option>
</select></label></p>

<p align="center"><input type="submit" name="Submit" value="Calculate"></p>
<?php # Add two numbers together
    $error = [];

    if ($_SERVER["REQUEST_METHOD"] == "POST"){

        if (!empty($_POST["num1"])){
            $num1 = $_POST["num1"];

        } else {
            $error[] = "Number 1 input box is empty\n";
        }

        if (!empty($_POST["num2"])){
            $num2 = $_POST["num2"];

        } else {
            $error[] = "Number 2 input box is empty\n";
        }

        $operation = $_POST["operation"];

        if (!empty($error)){
            echo "<p align=\"center\">Error(s):</br>";
            foreach ($error as $errorMsg) {
                echo "$errorMsg</br>";
            }
            echo "</p>";
        } else {
            echo '<p align="center"><br>Previous Computation:</br></p>';
            echo '<p align="center"><big>';
            if ($operation == "multiplication"){
                $total = $num1 * $num2;
                echo "$num1 x $num2 = $total";
            } elseif ($operation == "division") {
                $total = $num1 / $num2;
                echo "$num1 ÷ $num2 = $total";
            } elseif ($operation == "subtraction"){
                $total = $num1 - $num2;
                if ($num2 < 0)
                    echo "$num1 - ($num2) = $total";
                else
                    echo "$num1 - $num2 = $total";
            } else {
                $total = $num1 + $num2;
                echo "$num1 + $num2 = $total";
            }
            echo '</big></p>';
        }
    } //end if there is value posted
?>
</form>
</body>
</html>