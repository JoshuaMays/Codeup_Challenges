<?php

define('FILENAME', 'data/states.txt');

class StateData {
    public $filename = '';
    
    public function __construct($filename) {
        $this->filename = $filename;
    }
    
    public function readStateFile() {
        $stateInfo = [];
        $handle = fopen($this->filename, 'r');
        while (!feof($handle)) {
            $row = fgetcsv($handle);
            if (!empty($row)) {
                $stateInfo[] = $row;
            }
        }
        fclose($handle);
        return $stateInfo;
    }
}

$statesObject = new StateData(FILENAME);
$statesArray = $statesObject->readStateFile();

// FUNCTION TO LIST ALL OF THE STATE NAMES
function listStates($statesArray) {
    foreach($statesArray as $key => $stateInfo) {
        echo $statesArray[$key][0] . PHP_EOL;
    }
}

// function searchStates($statesArray, $searchLetter) {
//     $foundStates = [];
//     foreach ($statesArray as $key => $stateInfo) {
//         $searchString = $statesArray[$key][0];
//         $stringFound = strpos($searchString, $searchLetter);
//         if ($stringFound === false) {
//             break;
//         }
//         else if ($stringFound > 0) {
//             break;
//         }
//         else {
//             $foundStates[] = $statesArray[$key][0];
//         }
//     }
//     return $foundStates;
// }

$stateNames = listStates($statesArray);

// $foundStates = searchStates($statesArray, 'b');

// var_dump($foundStates);







// $filepath = "data/states.txt";

// $handle = fopen($filepath, 'r');
// $content = fread($handle, filesize($filepath));
// fclose($handle);

// $stateArray = [];
// $stateArray = explode("\n", $content);

// foreach ($stateArray as $key => $)


// $stateArray[0] = explode(",", $stateArray[0]);

// print_r($stateArray);

// $content = str_replace(array("\n", "\r", " "), ',', $content);
// $content = str_replace(array(",,", ",", $content), multiplier);
// $contentArray = explode(" ", $content);
// // $statesArray = explode("delimiter", string)
// print_r($contentArray);

?>