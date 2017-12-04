<?php
/**
 * Created by PhpStorm.
 * User: 001386538
 * Date: 11/15/2017
 * Time: 10:14 AM
 */
function dbconnect() // DB CONNECT FUNCTION
{
    $dsn = "mysql:host=localhost;dbname=PHPClassFall2017";
    $username = "root";
    $password = "";
    try {
        $db = new PDO($dsn, $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        return $db;
    } catch (PDOException $e) { // IF THERE WAS A PROBLEM OUTPUTS PROBLEM
        die("There was a problem connecting to the db.");
    }
}
