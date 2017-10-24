<?php
/**
 * Created by PhpStorm.
 * User: 001386538
 * Date: 10/23/2017
 * Time: 7:50 AM
 */
function dbConn()
{
    $dsn = "mysql:host=localhost;dbname=PHPClassFall2017";
    $username = "root";
    $password = "";
    try {
        $db = new PDO($dsn, $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        die("There was a problem connecting to the db.");
    }
}
?>