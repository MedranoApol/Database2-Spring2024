<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>covert word</title>
</head>
<body>
<?php

function convert_to_digit($word)
{
    $word = explode(";", $word);
    $result = "";

    foreach($word as $value)
    {
        $value = strtolower($value);

        switch(trim($value))
        {
            case 'zero' : {
                $result =  $result . '0';
            } break;
            case 'one' : {
                $result =  $result . '1';
            } break;
            case 'two' : {
                $result = $result . '2';
            } break;
            case 'three' : {
                $result =  $result . '3';
            } break;
            case 'four' : {
                $result = $result . '4';
            } break;
            case 'five' : {
                $result = $result . '5';
            } break;
            case 'six' : {
                $result =  $result . '6';
            } break;
            case 'seven' : {
                $result = $result .  '7';
            } break;
            case 'eight' : {
                $result =  $result . '8';
            } break;
            case 'nine' : {
                $result =  $result . '9';
            } break;
        }
    }
    return ((int)$result);
}

$variable = "One; four; eiGht; six; seven; tHree; zero;";

echo "$variable</br>";

echo convert_to_digit($variable) . "</br>";

?>
</body>
</html>