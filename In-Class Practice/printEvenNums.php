<?php
$numbers = [1, 2, 3, 4, 5];

$even_numbers = array_filter($numbers, 
    function($numbers) 
    { 
        return $numbers % 2 == 0;
    }
);

print_r($even_numbers)

?>