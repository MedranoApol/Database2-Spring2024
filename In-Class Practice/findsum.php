<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Find The Sum</title>
</head>
<body>
    <?php #Finding the sum

    //declare the varations
    $arr = range(1, 9);

    //print arrary
    $size = sizeof($arr);
    echo "<p align=\"center\">";
    for ($i = 0; $i < $arr; $i++){
        echo $arry[$i]."</br>";
    }
    echo "</p>";

    //find the sum
    $sum = array_sum($arr);

    //