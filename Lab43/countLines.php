<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11/5/2017
 * Time: 5:35 PM
 */
function countLines($corps) { // function that counts lines and outputs them
    $count = 0;
    foreach($corps as $corp) {
        $count++;
    }
    $returnString = $count . " record(s) returned";
    return $returnString;
}