<?php #create a function that make summation

function sum_of_digits($nums) {
    $digit_sum = 0;
    
    //for loop
    for ($i = 0; $i < strlen($nums); $i++){
        $digit_sum += $nums[$i];
    }

    /* foreach loop 
    foreach ($nums as $number) {
        $digit_sum += $number;
    } */
    
    return $digit_sum;
}

echo sum_of_digits("123456789") . "<br>";
echo sum_of_digits("999999") . "<br>";

?>