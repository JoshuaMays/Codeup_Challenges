<?php

// function to take user input on STDIN
// performing stringtoupper if $upper is true
function getInput($upper = false) {
    $input = trim(fgets(STDIN));
    return $upper ? strtoupper($input) : $input;
}

// generate an array of 5 dice
// each die should have a random roll between 1 and 6
// sort the dice before returning
function rollDice() {
    $dice = [];
    // Generate 5 random dicerolls.
    for ($i = 1; $i <= 5; $i++) {
        $dice[$i] = (string) mt_rand(1,6);
    }
    asort($dice);
    return $dice;
}

// show the dice array
// output should be in the format...
// Dice: 1 2 3 4 5
function showDice($dice) {
    $rollString = 'Dice: ';
    foreach ($dice as $number) {
        $rollString .= $number . " ";
    }
    return $rollString;
}


// determine the type of roll, the base score, and the bonus
// for a given array of dice
function scoreRoll($dice) {
    $base_score = 0;
    $pair = 0;
    $threeOfKind = 0;
    $fourOfKind = 0;
    $fiveOfKind = 0;
    $resultAdd = 0;
    $dieVals = [ 1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0];
    
    // print_r($dieVals);  // ************** TESTING LINE ****************
    
    // generate a result in the following data structure
    $result = ['type' => '', 'base_score' => 0, 'bonus' => 0];
    
    // Scoring Loop
    foreach($dice as $rollValue) {
        // Add the value of all the roles
        $base_score += $rollValue;
        // Add 1 to each spot in $dieVals array to find pairs, three/four/five of kinds
        switch($rollValue) {
            case 1:
                $dieVals[1]++;
                break;
            case 2:
                $dieVals[2]++;
                break;
            case 3:
                $dieVals[3]++;
                break;
            case 4:
                $dieVals[4]++;
                break;
            case 5:
                $dieVals[5]++;
                break;
            case 6:
                $dieVals[6]++;
                break;
        }
    }
        // print_r($dieVals);  // ************** TESTING LINE ****************
        foreach ($dieVals as $valCount) {
            switch ($valCount) {
                case 5:
                    $fiveOfKind++;
                    break;
                case 4:
                    $fourOfKind++;
                    break;
                case 3:
                    $threeOfKind++;
                    break;
                case 2:
                    $pair++;
                    break;
                case 0:
                case 1:
                    break;
            }
        }
        if ($fiveOfKind == 1) {
            $result['type'] = 'a five of a kind';
            $result['base_score'] = $base_score;
            $result['bonus'] = 100;
        }
        elseif ($fourOfKind == 1) {
            $result['type'] = 'a four of a kind';
            $result['base_score'] = $base_score;
            $result['bonus'] = 75;
        }
        elseif ($threeOfKind == 1 && $pair == 1) {
            $result['type'] = 'a full house';
            $result['base_score'] = $base_score;
            $result['bonus'] = 50;
        }
        elseif ($threeOfKind == 1) {
            $result['type'] = 'a three of a kind';
            $result['base_score'] = $base_score;
            $result['bonus'] = 25;
        }
        elseif ($pair == 2) {
            $result['type'] = 'two pair';
            $result['base_score'] = $base_score;
            $result['bonus'] = 15;
        }
        elseif ($pair == 1) { 
            $result['type'] = 'a pair';
            $result['base_score'] = $base_score;
            $result['bonus'] = 5;
        }
        elseif ($base_score == 15 || $base_score == 20) {
            $result['type'] = 'a straight';
            $result['base_score'] = $base_score;
            $result['bonus'] = 40;
        }
        else {
            $result['type'] = 'nada';
            $result['base_score'] = $base_score;
            $result['bonus'] = 0;
        }

    // hand type and bonus point system
    // five of a kind = 100
    // four of a kind = 75
    // a full house = 50
    // a straight = 40
    // three of a kind = 25
    // two pair = 15
    // a pair = 5
    // nada = 0

    // todo
    
    // return the result
    return $result;
}

// // add an entry to the history log to keep track
// // of how many rolls there have been of a given type
// // sort history with highest occurring type first
function logHistory(&$history, $type) {
    // todo
    $history['rolls']++;
    switch($type) {
        case 'a five of a kind':
        $history['5oK']++;
            break;
        case 'a four of a kind':
            $history['4oK']++;
            break;
        case 'a three of a kind':
            $history['3oK']++;
            break;
        case 'a full house':
            $history['fullHouse']++;
            break;
        case 'a straight':
            $history['straight']++;
            break;
        case 'two pair':
            $history['twoPair']++;
            break;
        case 'a pair':
            $history['pair']++;
            break;
        case 'nada':
            break;
    }
}

// // display stats from history log based on number of rolls
// // desired display format:
// // >> STATS ------------
// // a pair: 47.47 %
// // two pair: 23.67 %
// // three of a kind: 15.43 %
// // a straight: 7.42 %
// // a full house: 3.77 %
// // four of a kind: 2.24 %
// // << STATS -------------
// function showStats($history, $totalRolls) {
//     echo ">> STATS ------------\n";
//     // todo
//     echo "<< STATS -------------\n";
// }

// track the total score
$score = 0;

// track the total rolls
$rolls = 0;

// track the roll type history
$history = ['5oK' => 0, '4oK' => 0, '3oK' => 0, 'straight' => 0, 'fullHouse' => 0, 'twoPair' => 0, 'pair' => 0, 'rolls' => 0];

// welcome the user
echo "Welcome to Poker Dice!\n";
echo "Press enter to get started with your first roll...\n";

$input = getInput(true);

while ($input != 'Q') {
    // roll the dice
    // todo
    $dice = rollDice();
    showDice($dice);
    
    // score the result
    // todo: use scoreRoll function
    $rollResults = scoreRoll($dice);
    // print_r($rollResults);
    
    // add the current roll to the total score
    // todo
    $score += ($rollResults['base_score'] + $rollResults['bonus']);
    // echo $score . PHP_EOL;
    
    // log the roll type history
    // todo: use logHistory function

    // show the dice
    // todo: use showDice function
    echo showDice($dice) . PHP_EOL;
    
    // display roll type, base score, and bonus
    // ex: You rolled a straight for a base score of 20 and a bonus of 40.
    // todo
    echo 'You rolled ' . $rollResults['type'] . ' for a base score of ' . $rollResults['base_score'] 
       . ' and a bonus of ' . $rollResults['bonus'] . '.' . PHP_EOL;
    
    // display total score
    // ex: Total Score: 32306, in 849 rolls.
    // todo
    echo 'Total Score: ' . $score . PHP_EOL;
    // show roll type statistics
    // todo: use showStats function

    // prompt use to roll again or quit
    echo "Press enter to roll again, or Q to quit.\n";
    $input = getInput(true);
}

?>
