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
function CorpForm($col) // Function that allows user to sort data through form
{
    $form = "<section><form method='get' action='view.php'>
        <label for='col'>Sort Column: </label>
        <select name='col' id='col'>";
        foreach ($col as $cols) {
            $form .= "<option value =" . $cols . ">" . $cols . "</option >";
            }
        $form .= "</select>
        <label for='asc'>Ascending: </label>
        <input type='radio' name='dir' value='ASC' id = 'asc' /> &nbsp;&nbsp;&nbsp;&nbsp;
        <label for='desc'>Descending: </label>
        <input type='radio' name='dir' value='DESC' id = 'desc' />
        <input type='hidden' name='action' value='sort' />
        <input type='submit' />
        <input type='submit' name='action' value='Reset' />
    </form></section>";

    $form .= "<section><form method='get' action='view.php'>
        <label for='col'>Search Column: </label>
        <select name='col' id='col'>";
            foreach ($col as $cols) {
                $form .= "<option value =" . $cols . ">" . $cols . "</option >";
            }

        $form .= "</select>
        <label for='term'>Term: </label>
        <input type='text' name='term' id = 'term' />
        <input type='hidden' name='action' value='search' />
        <input type='submit' />
        <input type='submit' name='action' value='Reset' />
    </form></section>";

    /*


     "<form method='get' action='view.php'>";
        $form .= "<select name='col' id='col'>";
        foreach ($col as $cols) {
            $form .= "<option value='.$cols .' >" . $cols . "</option>";
        }}
        $form .= "</select>";

        $form .= "</form>";*/
    return $form;
}
?>