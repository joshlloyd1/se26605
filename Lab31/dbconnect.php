<?php
/**
 * Function to extablish a databse connection
 *
 * @return PDO Object
 */
function dbconnect()
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