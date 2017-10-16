<?php
/**
 * Created by PhpStorm.
 * User: 001386538
 * Date: 10/16/2017
 * Time: 8:55 AM
 */
function getDogsAsTable($db) { // function for printing out the table of dogs
    try {
        $sql = "SELECT * FROM dogs"; // SQL statement
        $sql = $db->prepare($sql); // sends credentials to database to be accessed
        $sql->execute(); // executes command
        $dogs = $sql->fetchAll(PDO::FETCH_ASSOC); // gathers information and puts it in $dogs variable
        if($sql->rowCount() > 0) {
            $table = "<table>" . PHP_EOL;// PHP_EOL just is "end of line" and makes a table
            foreach ($dogs as $dog) { // runs for as many rows in $dogs
                $table .= "<tr><td>" . $dog['name'] . "</td><td>" . $dog['gender'] . "</td><td>" . $dog['fixed'] . "</td>"; // outputs data to table
                $table .= "<td><form method = 'post' action='#'><input type='hidden' name = 'id' value='". $dog['id'] . "'/><input type='submit' name = 'action' value = 'Edit'/></form></td>";
                $table .= "<td><form method = 'post' action='#'><input type='hidden' name = 'id' value='". $dog['id'] . "'/><input type='submit' name = 'action' value = 'Delete'/></form></td>";
                $table .= "</tr>";
            }
            $table .= "</table>" . PHP_EOL; // closes table
        } else {
            $table = "Life is sad. There are no dogs." . PHP_EOL;
        }
        return $table; // sends table back to be outputted
    } catch (PDOException $e) { // if there was a problem then outputs die line
        die("There was a problem getting the dogs");
    }

}
function addDog($db, $name, $gender, $fixed) {
    try {
    $sql = $db->prepare("INSERT INTO dogs VALUES (null, :name, :gender, :fixed)");
    $sql->bindParam('name', $name);
    $sql->bindParam('gender', $gender);
    $sql->bindParam('fixed', $fixed);
    $sql->execute();
    return $sql->rowCount();
    } catch (PDOException $e) {
        die("There was a problem adding the dog.");
    }

}