<?php
/**
 * Created by PhpStorm.
 * User: 001386538
 * Date: 10/23/2017
 * Time: 7:54 AM
 */
function getCorporationsAsTable($db) {
    try {
        $sql = "SELECT * FROM corps";
        $sql = $db->prepare($sql);
        $sql->execute();
        $corps = $sql->fetchAll(PDO::FETCH_ASSOC);
        if($sql->rowCount() > 0) {
            $table = "<table>" . PHP_EOL;
            foreach ($corps as $corp) { // MAKE BUTTONS LINKS
                $table .= "<tr><td>" . $corp['id'] . "</td><td>" . $corp['corp'] . "</td><td>" . "<a href='read.php'>Read</a>" . "</td><td>" .  "<a href=\"update.php?id=<?php echo '".$corp['id']."'?>\">Update</a>" . "</td><td>" . "<a href='delete.php'>Delete</a>" . "</td>";
                $table .= "</tr>";
            }
            $table .= "</table>" . PHP_EOL;
        } else {
            $table = "There are no corporations in the database" . PHP_EOL;
        }
        return $table;
    }catch(PDOException $e) {
        die("There was a problem getting into the database");
    }
}
function addCorporation($db, $corp, $email, $zipcode, $owner, $phone) {
    try{
        $date = new DateTime('now');
        $incorp_dt = $date->format('Y-m-d H:i:s');
        $sql = $db->prepare("INSERT INTO corps VALUES (null, :corp, :incorp_dt, :email, :zipcode, :owner, :phone)");
        $sql->bindParam(':corp', $corp);
        $sql->bindParam(':incorp_dt', $incorp_dt);
        $sql->bindParam(':email', $email);
        $sql->bindParam(':zipcode', $zipcode);
        $sql->bindParam(':owner', $owner);
        $sql->bindParam(':phone', $phone);

        $sql->execute();

        if($sql) {
            echo "<script type='text/javascript'>alert('submitted successfully!')</script>";
        }
        return $sql->rowCount();
    }catch(PDOException $e) {
        die("There was a problem adding the corp.");
    }
}
function getCorp($db, $id) {
    try {
        $sql = $db->prepare("SELECT * FROM corps WHERE id = :id");
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $sql->execute();
        $row = $sql->fetchAll(PDO::FETCH_ASSOC);
        $form = "<form>" . PHP_EOL;
        $form .= "Corp: <input type='text' name='corp' value='".$row['corp']."'/> <br>;
                 Email: <input type='text' name='email' value='".$row['email']."' /> <br>
                 Zip Code: <input type='text' name='zipcode' value='".$row['zipcode']."' /> <br>
                 Owner: <input type='text' name='owner' value='".$row['owner']."' /> <br>
                 Phone number: <input type='text' name='phone' value='".$row['phonenumber']."' /> <br> 
                 <input type='submit' id='foo' name='action' value='Submit' />";
        $form .= "</form>";
        return $form;
    }catch (PDOException $e) {
        die("There was a problem getting to that record");
    }
}

function readCorp($db, $id) {
    $sql = "SELECT * FROM corps WHERE id = :id";
    $sql = $db->prepare($sql);
    $sql->execute();
    $corps = $sql->fetchAll(PDO::FETCH_ASSOC);
        $table = "<table>" . PHP_EOL;
            $table .= "<tr><td>" . $corps['id'] . "</td><td>" . $corps['corp'] . "</td><td>" . $corps['incorp_dt'] . "</td><td>". $corps['email'] . "</td><td>". $corps['zipcode'] . "</td><td>". $corps['owner'] . "</td><td>". $corps['phone'];
            $table .= "</tr>";
            $table .= "</table>";
}
?>