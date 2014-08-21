<?php

function is_palindrome($string) {
	// Remove spaces from string.
	$string = str_replace(' ', '', $string);
	// Duplicate the string to compare the reversed version.
	$comparisonString = $string;
	// Reverse the letters in the string.
	$reverseString = strrev($comparisonString);

	$compare = strcasecmp($string, $reverseString);

	$amIPalindrome = $compare == 0 ? true : false;

	return $amIPalindrome;

}

$string = "A man a plan a canal panama";

$amIPalindrome = is_palindrome($string);

echo $amIPalindrome . PHP_EOL;

?>