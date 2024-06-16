<?php

function trinary_test($n){
    $r = ($n>30) ? "greater than 30 <br>" 
    : (($n>20) ? "greater than 20 <br>"
    : (($n>10) ? "greater than 10 <br>"
    : "input a number at least greater than 10!"));
    
    echo $n . " : ". $r . "\n";
}

trinary_test(32); //greater 30
trinary_test(21); //greater 20
trinary_test(12); //greater 10
trinary_test(4); //input a number at least greater than 10!

?>