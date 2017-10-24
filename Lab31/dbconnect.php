<?php
/**
 * Function to extablish a databse connection
 *
 * @return PDO Object
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
?>