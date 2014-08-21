<?php

function is_palindrome($string) {
	// Remove punctuation from string.
	$string = preg_replace("/\p{P}/u", "", $string);
	// Remove spaces from string.
	$string = str_replace(' ', '', $string);
	// Duplicate the string to compare the reversed version.
	$comparisonString = $string;
	// Reverse the letters in the string.
	$reverseString = strrev($comparisonString);
	// Compare the two strings
	$compare = strcasecmp($string, $reverseString);
	// set a boolean variable true if we have a palindrome, false if not.
	$amIPalindrome = $compare == 0 ? true : false;

	return $amIPalindrome;

}

$string = "A dog! A panic in a pagoda!";

$amIPalindrome = is_palindrome($string);

echo $amIPalindrome . PHP_EOL;

?>