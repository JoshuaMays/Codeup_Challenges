<?php

$file = 'data/diceware.wordlist.txt';
// Empty array to hold final passphrase words
$passphrase = [];
// Empty array to hold dice roll random numbers
$dice = [];
// Open Diceware Wordlist and capture list to $content
$handle = fopen($file, 'r');
$content = fread($handle, filesize($file));
fclose($handle);
// Convert $content string into a traversable array.
$keyValArray = explode(PHP_EOL, $content);

// Capture number of times to roll the dice
function getInput() {
    return trim(fgets(STDIN));
}

// Create 5 random numbers to provide key for the passphrase
function rollDice($diceArray) {
    for ($i=1; $i <= 5; $i++) { 
        $dice[$i] = (string) mt_rand(1,6);
    }
    // Stringify the random numbers.
    $diceArray = implode("", $dice);
    return $diceArray;
}

function passwordArray($keyValArray) {
    // Traverse the keyValArray to explode the numbers and words into arrays with the 
    // random numbers and vals as elements.
    foreach ($keyValArray as $combinedKeyVals) {
        $breakApart[] = explode("\t", $combinedKeyVals);
    }
    // Traverse the multidimension array to access each key/val pair array
    foreach ($breakApart as $keyValPair) {
        // Assign keys(index 0) and values(index 1) to separate arrays.
        foreach ($keyValPair as $pairKey => $pairVal) {
            if ($pairKey % 2 == 0) {
                $keys[] = $pairVal;
            }
            else {
                $vals[] = $pairVal;
            }
        }
    }
    // combine the keys and vals arrays to create a new associative array 
    $passes = array_combine($keys, $vals);
    return $passes;
}

// Capture the associative array holding diceware numbers as keys and passphrases as values.
$passesArray = passwordArray($keyValArray);

fwrite(STDOUT, "******************************************************" . PHP_EOL);
fwrite(STDOUT, "     Welcome to the Diceware Passphrase Generator." . PHP_EOL);
fwrite(STDOUT, "******************************************************" . PHP_EOL);
fwrite(STDOUT, 'How many words would you like your strong passphrase to contain?: ');

$rolls = getInput();

// Roll the dice to generate the random words
for ($i = 0; $i < $rolls; $i++) {
    $rollKey = rollDice($dice);
    array_push($passphrase, $passesArray[$rollKey]); 
}

// Stringify the random words into a passphrase.
$strongPassphrase = implode(" ", $passphrase);

echo 'Your new passphrase is: "' . $strongPassphrase . '"' . PHP_EOL;


?>
