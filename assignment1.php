<?php

/**
 * Checks if an array can be partitioned by finding an element 
 * that equals the product of all other elements
 * @param array $arr Input array of numbers
 * @return bool True if such an element exists, false otherwise
 */
function canPartition($arr){
    $result = [];
    $exclude = [];
    
    // Iterate through each element in the array
    foreach($arr as $index => $ele){
        $product = 1;
        
        // Calculate the product of all other elements (excluding current element)
        foreach($arr as $key => $val){
            if($key == $index){
                continue; // Skip the current element
            }else{
                $product = $product * $val;
            }
        }
        
        // Check if current element equals the product of all other elements
        if($product == $ele){
            $result = array_diff_key($arr, array_flip([$key]));
            $exclude = [$ele];
            break; // Found the element, exit loop
        }
    }

    // Return true if we found such an element, false otherwise
    if (empty($result)){
        return false;
    } else{
        return true;
    }
}
/**
 * Calculates the accumulating (running) sum of an array
 * Each element in the result is the sum of all elements up to that position
 * @param array $arr Input array of numbers
 * @return array Array containing the accumulating sums
 */
function accumulatingSum($arr){
    $sum = 0;
    $res = [];
    
    // Iterate through each element and add it to the running sum
    foreach($arr as $ele){
        $sum += $ele;
        $res[] = $sum;
    }
    return $res;
}

/**
 * Finds all factors of a given number
 * @param int $num The number to find factors for
 * @return array Array containing all factors of the number
 */
function factorize($num){
    $factors = [];
    
    // Loop through numbers from 1 to square root of the number
    for ($i = 1; $i <= sqrt($num); $i++) {
        // If i divides num evenly, it's a factor
        if ($num % $i == 0) {
            $factors[] = $i; // Add the factor
            
            // If i is not the square root, add the corresponding factor
            if ($i != $num / $i) {
                $factors[] = $num / $i;
            }
        }
    }
    return $factors;
}

// Test the canPartition function with array [2,3,5,30]
// In this array, 30 = 2 * 3 * 5, so it can be partitioned
$arr = [2,3,5,30];

if(canPartition($arr)){
    echo 'Can partition';
}else{
    echo 'Can not partition';
}

// Test the accumulatingSum function with array [1,2,3,4,5]
// Result should be [1,3,6,10,15]
$arr = [1,2,3,4,5];
$res = accumulatingSum($arr);
echo 'Accumulating sum: ';print_r($res);

// Test the factorize function with number 14
// Factors of 14 are: 1, 2, 7, 14
$num = 14;
$factors = factorize($num);
echo 'Factors of '.$num.': ';print_r($factors);
?>