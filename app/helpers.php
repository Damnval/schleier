<?php

/**
 * Generates random number
 *
 * @param int $count number of tenths to be placed on 9
 * @return Interger random generated number
 */
function generateRandomNumber($count = 6)
{
    $value = null;

    for ($i=0; $i < $count; $i++) { 
        $value = $value . '9';
    }
    $max = (int)$value;

    return  mt_rand(100000, $max);
}
