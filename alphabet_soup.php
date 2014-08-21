<?php 

function alphabetSoup($str) {
	// convert string to array
	$arrayFromString = explode(" ", $str);

	// Supply empty array to hold alphabetized words
	$savingArray = [];
	foreach ($arrayFromString as $words) {
		$workingArray = [];

		// Grab first word in the array to work with it.
		$grabWord = array_shift($arrayFromString);

		// Convert word into array of its letters
		$wordArray = str_split($grabWord);

		// Alphabetically sort the letters, case-insensitive.
		natcasesort($wordArray);

		// Convert sorted letter array into a string holding the "word"
		$alphebatizedWord = implode($wordArray);

		// Add the alphabetized word to the saving array. 
		array_push($savingArray, $alphebatizedWord);

	}
	// Convert alphabetized word array back into a string.
	$alphabetizedString = implode(" ", $savingArray);

	return $alphabetizedString;
}

$str = 'This is a longer sentence than hello world';

$str = alphabetSoup($str);

echo $str . PHP_EOL;

?>