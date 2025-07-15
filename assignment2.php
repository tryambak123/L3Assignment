<?php
/*
 * Removes all special characters from a string except letters, numbers, spaces, hyphens, and underscores.
 * @param string $str The input string.
 * @return string The cleaned string.
 */
function removeAllSpecialChars($str) {
    $result = preg_replace('/[^a-zA-Z0-9\s\-\_]/', '', $str);
    return $result;
}
/*
 * Calculates the average length of strings in an array.
 * @param array $arr The array of strings.
 * @return float The average length, rounded to 2 decimal places.
 */
function getAverageLength($arr) {
    if (empty($arr)) {
        return 0;
    }
    $totalLength = 0;
    foreach ($arr as $str) {
        $totalLength += strlen($str);
    }
    return round($totalLength / count($arr),2);
}

/**
 * Counts the number of characters in a string that appear more than once
 * @param string $str The input string
 * @return int The count of characters that appear more than once
 */
function countRepeatedChars($str) {
    // Count frequency of each character
    $charCount = array_count_values(str_split($str));
    
    // Count how many characters appear more than once
    $repeatedCount = 0;
    foreach ($charCount as $char => $count) {
        if ($count > 1) {
            $repeatedCount++;
        }
    }
    
    return $repeatedCount;
}



$nes_str = removeAllSpecialChars("Hello, (World)! 1-2_3");
//echo "String after removing special characters: " . $nes_str . "\n";

$strings = ["Helloooo", "Worlds", "PHPoooo", "is", "great"];
$averageLength = getAverageLength($strings);
//echo "Average length of strings: " . $averageLength . "\n";

$repeatedCharsCount = countRepeatedChars("Hello World");
echo "Number of characters that appear more than once: " . $repeatedCharsCount . "\n";

// Test the countRepeatedChars function
$testString = "Hello World";
$repeatedCount = countRepeatedChars($testString);
echo "Characters that appear more than once in '$testString': " . $repeatedCount . "\n";

$testString2 = "Programming";
$repeatedCount2 = countRepeatedChars($testString2);
echo "Characters that appear more than once in '$testString2': " . $repeatedCount2 . "\n";