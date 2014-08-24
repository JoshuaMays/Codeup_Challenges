<?php


function sumOfSquares($range) {
	$sum = 0;

	for ($i=1; $i<=$range; $i++) {
		// Square iterator then add to sum
		$sum += $i*$i;
	}
	return $sum;
}

function squareOfSum($range) {
	$sum = 0;
	
	for ($i = 1; $i <= $range; $i++) {
		// add iterator to sum
		$sum += $i;
	}	
	// square sum of range
	return $sum *= $sum;
}

$difference = squareOfSum(100) - sumOfSquares(100);

echo $difference;
?>