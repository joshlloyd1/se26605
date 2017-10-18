<?php
/**
 * Created by PhpStorm.
 * User: 001386538
 * Date: 10/18/2017
 * Time: 10:08 AM
 */
function getActorsAsTable($db) { // shows the table of actors
    try {
        $sql = "SELECT * FROM actors"; // grabs all rows
        $sql = $db->prepare($sql);
        $sql->execute();
        $actors = $sql->fetchAll(PDO::FETCH_ASSOC); //puts in array
        if ($sql->rowCount() > 0) { // runs for number of rows
            $table = "<table>" . PHP_EOL;
            foreach ($actors as $actor) {
                $table .= "<tr><td>" . $actor['firstname'] . "</td><td>" . $actor['lastname'] . "</td><td>" . $actor['dob'] . "</td><td>" . $actor['height'] . "</td>";
                $table .= "</tr>";
            }
            $table .= "</table>" . PHP_EOL;
        } else { // if there are no rows
            $table = "There are no actors in database" . PHP_EOL;
        }
        return $table;
    }catch (PDOException $e) { // if code failed to enter DB
        die("There was a problem getting into the database");
    }
}
function addActor($db, $firstname, $lastname, $dob, $height) // adds actors to the database
{
    try {
        $sql = $db->prepare("INSERT INTO actors VALUES (null, :firstname, :lastname, :dob, :height)");
        $sql->bindParam(':firstname', $firstname);
        $sql->bindParam(':lastname', $lastname);
        $sql->bindParam(':dob', $dob);
        $sql->bindParam(':height', $height);

        $sql->execute();
        return $sql->rowCount();
    } catch (PDOException $e) {
        die("There was a problem adding the actor.");
    }
}
?>