<?php
/**
 * Created by PhpStorm.
 * User: 001386538
 * Date: 10/18/2017
 * Time: 10:08 AM
 */
function dbConn() // sets up credentials for database and pits them in variable "$db"
{
    $dsn = "mysql:host=localhost;dbname=PHPClassFall2017";
    $username = "root"; //DB stored in root file w/ no password
    $password = "";
    try {
        $db = new PDO($dsn, $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) { // if program couldn't connect
        die("There was a problem connecting to the db.");
    }
}
?>