<?php

$multiples = [];
$sum = 0;

// Check if the numbers between 1 and 1000 are multiples of 3 or 5
for ($i = 1; $i < 1000; $i++) {
    if (($i % 3 == 0) || ($i % 5 == 0)) {
        // save found multiples to array
        array_push($multiples, $i);
    }
}

foreach ($multiples as $number) {
    // Add all of the elements of the multiples array.
    $sum += $number;
}

echo $sum;
?>
