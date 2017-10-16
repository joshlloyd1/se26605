<?php
/**
 * Created by PhpStorm.
 * User: 001386538
 * Date: 10/16/2017
 * Time: 8:55 AM
 */
function getDogsAsTable($db) {
    try {
        $sql = "SELECT * FROM dogs";
        $sql = $db->prepare($sql);
        $sql->execute();
        $dogs = $sql->fetchAll(PDO::FETCH_ASSOC);
        $table = "<table>" . PHP_EOL;
        foreach($dogs as $dog) {
            $table .= "<tr><td>" . $dog['name'] . "</td><td>" . $dog['gender'] . "</td><td>" . $dog['fixed'] . "</td></tr>";
        }
        $table .= "</table>" . PHP_EOL;
        return $table;
    } catch (PDOException $e) {
        die("There was a problem getting the dogs");
    }

}