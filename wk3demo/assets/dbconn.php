<?php
/**
 * Created by PhpStorm.
 * User: 001386538
 * Date: 10/16/2017
 * Time: 8:44 AM
 */
function dbConn() // sets up credentials for database and pits them in variable "$db"
{
    $dsn = "mysql:host=localhost;dbname=dogs";
    $username = "dogs";
    $password = "se266";
    try {
        $db = new PDO($dsn, $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        die("There was a problem connecting to the db.");
    }
}
?>