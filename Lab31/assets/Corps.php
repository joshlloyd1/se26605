<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 10/24/2017
 * Time: 1:54 PM
 */
include_once './dbconnect.php';
include_once './functions.php';

function addCorporation($db, $corp, $email, $zipcode, $owner, $phone) { // Function to allow user to enter data
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
    }catch(PDOException $e) { // if connecting to db and adding was done wrong
        die("There was a problem adding the corp.");
    }
}
function viewarow($db, $id) { // function to view a single row in DB
    try {
        $corp = filter_input(INPUT_POST, 'corp');

        $email = filter_input(INPUT_POST, 'email');
        $zipcode = filter_input(INPUT_POST, 'zipcode');
        $owner = filter_input(INPUT_POST, 'owner');
        $phone = filter_input(INPUT_POST, 'phone');

        $sql = $db->prepare("SELECT * FROM corps where id = :id");
        $binds = array(
            ":id" => $id,
            ":corp" => $corp,
            ":email" => $email,
            ":zipcode" => $zipcode,
            ":owner" => $owner,
            ":phone" => $phone
        );
        $corps = array();
        /*$sql->execute();
        $corps = $sql->fetchAll(PDO::FETCH_ASSOC);*/
        //if($sql->rowCount() > 0) {
            $table = "<table>" . PHP_EOL;
            foreach ($corps as $corp) { // MAKE BUTTONS LINKS

                $table .= "<tr><td>" . "Corporation" . $corp['corp'] . "</td><td>" . "Email" . $corp['email'] . "</td><td>" . "Zip Code" . $corp['zipcode'] . "</td><td>" . "Owner" . $corp['owner'] . "</td><td>" . "Phone" . $corp['phone'] . "</td><td>" . '<a href="delete.php?id=<?php echo "$corp["id"]; ?>>Delete</a></td>' . '<td><a href="update.php?id=<?php echo "$corp["id"]; ?>>Update</a></td>';
                $table .= "</tr>";
            }
            $table .= "</table>" . PHP_EOL;
        //} else {
           // $table = "There are no corporations in the database" . PHP_EOL;
        //}
        return $table;
    }catch(PDOException $e) {
        die("There was a problem getting into the database");
    }
}
?>