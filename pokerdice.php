<?php
// TRACK THE TOTAL SCORE
$score = 0;

// TRACK THE TOTAL ROLLS
$rolls = 0;

// TRACK THE ROLL TYPE HISTORY
$history = ['fiveOfKind' => 0, 'fourOfKind' => 0, 'threeOfKind' => 0, 'straight' => 0, 'fullHouse' => 0, 'twoPair' => 0, 'pair' => 0, 'rolls' => 0];

// FUNCTION TO TAKE USER INPUT ON STDIN
function getInput($upper = false) {
    $input = trim(fgets(STDIN));
    return $upper ? strtoupper($input) : $input;
}

// FUNCTION TO ROLL THE DICE
function rollDice() {
    $dice = [];
    // GENERATE 5 RANDOM DICE ROLLS
    for ($i = 1; $i <= 5; $i++) {
        $dice[$i] = (string) mt_rand(1,6);
    }
    asort($dice);
    return $dice;
}

// FUNCTION TO SHOW THE DICE ROLL VALUES
function showDice($dice) {
    $rollString = 'Dice: ';
    foreach ($dice as $number) {
        $rollString .= $number . " ";
    }
    return $rollString;
}

// FUNCTION TO SCORE THE DICE ROLLS
// DETERMINES THE TYPE OF ROLL, BASE SCORE, AND BONUS POINTS
function scoreRoll($dice) {
    $base_score = 0;
    $pair = 0;
    $threeOfKind = 0;
    $fourOfKind = 0;
    $fiveOfKind = 0;
    $resultAdd = 0;
    $dieVals = [ 1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0];
    
    
    // SAVE THE TYPE, BASE SCORE AND BONUS POINTS AS AN ARRAY
    $result = ['type' => '', 'base_score' => 0, 'bonus' => 0];
    
    foreach($dice as $rollValue) {
        // ADD THE ROLL VALUES TO GET THE BASE SCORE
        $base_score += $rollValue;
        // SAVE VALUES OF EACH DIE TO $dieVals ARRAY 
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

    // LOOP THROUGH $dieVals ARRAY TO DETERMINE TYPE OF ROLL
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
            case 1:
            case 0:
                break;
        }
    }

    // ASSIGN ROLL TYPE, BASE SCORE, AND BONUS TO $result ARRAY
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

    return $result;
}

// FUNCTION TO LOG THE ROLL HISTORY
function logHistory(&$history, $rollType) {
    // DEPENDING ON THE ROLL TYPE, INCREMENT THE NUMBER OF HITS PER ROLL TYPE
    switch($rollType) {
        case 'a five of a kind':
            $history['fiveOfKind']++;
            break;
        case 'a four of a kind':
            $history['fourOfKind']++;
            break;
        case 'a three of a kind':
            $history['threeOfKind']++;
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

// FUNCTION TO DISPLAY THE STATS FROM HISTORY LOG
function showStats($history, $totalRolls) {
    echo ">> STATS ------------" .PHP_EOL;
    echo "a pair: " . number_format(($history['pair'] / $totalRolls)*100, 2) . "%" . PHP_EOL;
    echo "two pair: " . number_format(($history['twoPair'] / $totalRolls)*100, 2) . "%" . PHP_EOL;
    echo "three of a kind: " . number_format(($history['threeOfKind'] / $totalRolls)*100, 2) . "%" . PHP_EOL;
    echo "a straight: " . number_format(($history['straight'] / $totalRolls)*100, 2) . "%" . PHP_EOL;
    echo "a full house: " . number_format(($history['fullHouse'] / $totalRolls)*100, 2) . "%" . PHP_EOL;
    echo "four of a kind: " . number_format(($history['fourOfKind'] / $totalRolls)*100, 2) . "%" . PHP_EOL;
    echo "five of a kind: " . number_format(($history['fiveOfKind'] / $totalRolls)*100, 2) . "%" . PHP_EOL;
    echo "<< STATS -------------" . PHP_EOL;
}

// WELCOME USER
echo "**************************************************" . PHP_EOL;
echo "Welcome to Poker Dice!" . PHP_EOL;
echo "Press enter to get started with your first roll..." . PHP_EOL;
echo "**************************************************" . PHP_EOL;

$input = getInput(true);

while ($input != 'Q') {
    // ROLL THE DICE
    $dice = rollDice();
    $rolls++;
    showDice($dice);
    
    // SCORE THE RESULT
    $rollResults = scoreRoll($dice);
    
    // ADD CURRENT ROLL SCORE TO TOTAL ROLL SCORE
    $score += ($rollResults['base_score'] + $rollResults['bonus']);
    

    // LOG ROLL HISTORY
    logHistory($history, $rollResults['type']);

    // SHOW THE VALUES OF THE DICE ROLLED
    echo showDice($dice) . PHP_EOL;
    
    // DISPLAY ROLL TYPE, BASE SCORE, AND THE BONUS POINTS OF THE ROLL
    echo "~~~~~~~~~~~~~~~" . PHP_EOL;
    echo 'You rolled ' . $rollResults['type'] . ' for a base score of ' . $rollResults['base_score'] 
       . ' and a bonus of ' . $rollResults['bonus'] . '.' . PHP_EOL;
    
    // DISPLAY SCORE OF ALL ROLLS
    echo 'Total Score: ' . $score . ' in ' . $rolls . ' rolls.' . PHP_EOL . PHP_EOL;
    
    // SHOW ROLL STATISTICS
    showStats($history,$rolls);

    // PROMPT USER TO ROLL AGAIN OR QUIT
    echo PHP_EOL . "****************************************" . PHP_EOL;
    echo "Press enter to roll again, or Q to quit." . PHP_EOL;
    echo "****************************************" . PHP_EOL;
    $input = getInput(true);
}

?>
