<?php

/**
 * Make hash from order number. Hash will be the same when we use the same order number.
 * @param int $number
 * @return string
 */
function hashOrder(int $number): string
{
    $stringNumber = prepareStringNumber($number);

    shuffleStringNumber($stringNumber, 0,6);
    shuffleStringNumber($stringNumber, 2,3);
    shuffleStringNumber($stringNumber, 4,5);

    return $stringNumber;
}

/**
 * Prepare string number that have 7 digits. If number is shorter than 7 digits add 0's before number.
 * @param int $number
 * @return string
 */
function prepareStringNumber(int $number): string
{
    $stringNumber = (string)$number;
    while (strlen($stringNumber) < 7){
        $stringNumber = '0'.$stringNumber;
    }

    return $stringNumber;
}

/**
 * Shuffle 2 numbers from string.
 * @param string $stringNumber
 * @param int $firstIndex
 * @param int $secondIndex
 * @return void
 */
function shuffleStringNumber(string &$stringNumber, int $firstIndex, int $secondIndex)
{
    $firstIndexNumber = $stringNumber[$firstIndex];
    $secondIndexNumber = $stringNumber[$secondIndex];

    $stringNumber[$firstIndex] = $secondIndexNumber;
    $stringNumber[$secondIndex] = $firstIndexNumber;
}

$unique = [];

echo "Starting test ....".PHP_EOL;
$start = microtime(true);

for ($i=1; $i<=9999999; $i++) {
    $result = hashOrder($i);

    if (!preg_match("/^[0-9]{7}$/", $result)) {
        throw new InvalidArgumentException("Result {$result} does not match regex");
    }

    if (!empty($unique[$result])) {
        throw new InvalidArgumentException("Colision detected for key {$i}:{$unique[$result]} and result {$result}");
    }

    $unique[$result] = $i;
}

$time_elapsed_secs = microtime(true) - $start;

if ($time_elapsed_secs > 60) {
    throw new InvalidArgumentException("Could not finish test in 60 seconds");
}

echo "Finished in {$time_elapsed_secs}";

exit('test');