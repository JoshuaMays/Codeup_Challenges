<?php

function sumOfSquares($number) {
	$sum = 0;

	for ($i=1; $i<=$number; $i++) {
		// Square iterator then add to sum
		$sum += $i*$i;
	}
	return $sum;
}

function squareOfSum($number) {
	$sum = 0;
	
	for ($i = 1; $i <= $number; $i++) {
		// add iterator to sum
		$sum += $i;
	}	
	// square sum of range
	return $sum *= $sum;
}

$number = 10;

$difference = squareOfSum($number) - sumOfSquares($number);

echo $difference;

?>