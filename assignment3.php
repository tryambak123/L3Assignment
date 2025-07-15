<?php
/**
 * Finds all pairs of numbers in an array that sum to a target value
 * @param array $arr The input array of numbers
 * @param int $targetSum The target sum to find pairs for
 * @return array Array of pairs that sum to the target
 */
function getPairs($arr, $targetSum){
    $pairs = [];
    $seen = [];

    // Iterate through each number in the array
    foreach ($arr as $num) {
        $complement = $targetSum - $num; // Calculate what number we need to reach target

        // Check if we've seen the complement before
        if (isset($seen[$complement])) {
            $pairs[] = [$complement, $num]; // Add the pair to results
        }

        $seen[$num] = true; // Mark current number as seen
    }

    return $pairs;
}

/**
 * Counts the number of letters and digits in a string
 * @param string $str The input string
 * @return array An associative array with 'letters' and 'digits' counts
 */
function getCountOfLettersAndDigits($str){
    $letterCount = 0;
    $digitCount = 0;
    
    // Iterate through each character in the string
    for ($i = 0; $i < strlen($str); $i++) {
        $char = $str[$i];
        
        // Check if character is a letter
        if (ctype_alpha($char)) {
            $letterCount++;
        }
        // Check if character is a digit
        elseif (ctype_digit($char)) {
            $digitCount++;
        }
    }
    
    return [
        'letters' => $letterCount,
        'digits' => $digitCount
    ];
}

/**
 * Finds the missing letter from a sequence of consecutive letters
 * @param string $str A string containing consecutive letters with one missing
 * @return string The missing letter, or empty string if no letter is missing
 */
function getMissingLetter($str){
    // Convert string to array of characters
    $chars = str_split($str);
    
    // Sort the characters to ensure they are in order
    sort($chars);
    
    // Find the missing letter by checking ASCII values
    for ($i = 0; $i < count($chars) - 1; $i++) {
        $currentChar = $chars[$i];
        $nextChar = $chars[$i + 1];
        
        // Check if there's a gap between current and next character
        if (ord($nextChar) - ord($currentChar) > 1) {
            // Return the missing character
            return chr(ord($currentChar) + 1);
        }
    }
    
    // No missing letter found
    return '';
}

/**
 * Counts the number of prime numbers up to a given number (inclusive)
 * @param int $n The upper limit to count primes up to
 * @return int The count of prime numbers from 2 to n
 */
function getCountOfPrimes($n){
    if ($n < 2) {
        return 0; // No primes less than 2
    }
    
    $count = 0;
    
    // Check each number from 2 to n
    for ($i = 2; $i <= $n; $i++) {
        if (isPrime($i)) {
            $count++;
        }
    }
    
    return $count;
}

/**
 * Helper function to check if a number is prime
 * @param int $num The number to check
 * @return bool True if the number is prime, false otherwise
 */
function isPrime($num) {
    if ($num < 2) {
        return false; // Numbers less than 2 are not prime
    }
    
    if ($num == 2) {
        return true; // 2 is the only even prime number
    }
    
    if ($num % 2 == 0) {
        return false; // Even numbers (except 2) are not prime
    }
    
    // Check odd divisors up to square root of the number
    for ($i = 3; $i <= sqrt($num); $i += 2) {
        if ($num % $i == 0) {
            return false; // Found a divisor, not prime
        }
    }
    
    return true; // No divisors found, it's prime
}
$pairs = getPairs([1, 2, 3, 4, 5, 6], 7);
echo "Pairs that sum to 7:\n";
foreach ($pairs as $pair) {
    echo "({$pair[0]}, {$pair[1]})\n";
}

// Test the getCountOfLettersAndDigits function
$testString = "Hello123World456!@#";
$counts = getCountOfLettersAndDigits($testString);
echo "\nString: '$testString'\n";
echo "Letters: " . $counts['letters'] . "\n";
echo "Digits: " . $counts['digits'] . "\n";

$testString2 = "PHP2024 is Great!";
$counts2 = getCountOfLettersAndDigits($testString2);
echo "\nString: '$testString2'\n";
echo "Letters: " . $counts2['letters'] . "\n";
echo "Digits: " . $counts2['digits'] . "\n";

// Test the getMissingLetter function
$letterSequence = "abcdfgh";
$missingLetter = getMissingLetter($letterSequence);
echo "\nSequence: '$letterSequence'\n";
echo "Missing letter: '$missingLetter'\n";

$letterSequence2 = "xyzac";
$missingLetter2 = getMissingLetter($letterSequence2);
echo "\nSequence: '$letterSequence2'\n";
echo "Missing letter: '$missingLetter2'\n";

$letterSequence3 = "mnopqst";
$missingLetter3 = getMissingLetter($letterSequence3);
echo "\nSequence: '$letterSequence3'\n";
echo "Missing letter: '$missingLetter3'\n";

// Test the getCountOfPrimes function
$number = 20;
$primeCount = getCountOfPrimes($number);
echo "\nNumber of primes up to $number: $primeCount\n";

$number2 = 50;
$primeCount2 = getCountOfPrimes($number2);
echo "Number of primes up to $number2: $primeCount2\n";

$number3 = 100;
$primeCount3 = getCountOfPrimes($number3);
echo "Number of primes up to $number3: $primeCount3\n";