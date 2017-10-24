<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
/**
 * Created by PhpStorm.
 * User: 001386538
 * Date: 10/23/2017
 * Time: 9:35 AM
 */
require_once ("assets/dbconn.php");
require_once ("assets/Corporations.php");
include_once ("assets/header.php");
$db = dbConn();
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? "";
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING) ?? "";
$corp = filter_input(INPUT_POST, 'corp', FILTER_SANITIZE_STRING) ?? "";
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING) ?? "";
$zipcode = filter_input(INPUT_POST, 'zipcode', FILTER_SANITIZE_STRING) ?? "";
$owner = filter_input(INPUT_POST, 'owner', FILTER_SANITIZE_STRING) ?? "";
$phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING) ?? "";

$stmt = $db->prepare("UPDATE corps SET corp = :corp, email = :email, zipcode = :zipcode, owner = :owner, phone = :phone WHERE id=:id");

$binds = array(
    ":id" => $id,
    ":corp" => $corp,
    ":email" => $email,
    ":zipcode" => $zipcode,
    ":owner" => $owner,
    ":phone" => $phone
    );
$message = 'Update failed';
if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
    $message = 'Update Complete';
} else {
    $id = filter_input(INPUT_GET, 'id');
}
$stmt = $db->prepare("SELECT * FROM corps where id = :id");

$binds = array(
    ":id" => $id
);
$result = array();
if($stmt->execute($binds) && $stmt->rowCount() > 0) {
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $corp = $result['corp'];
    $email = $email['email'];
    $zipcode = $zipcode['zipcode'];
    $owner = $owner['owner'];
    $phone = $phone['phone'];
} else {
    die("ID not found");
}


include_once ("assets/footer.php");




?>
<form>
Corp: <input type='text' name='corp' value="<?php echo $corp ?>"/> <br>;
Email: <input type='text' name='email' value="<?php echo $email ?>"/> <br>
Zip Code: <input type='text' name='zipcode' value="<?php echo $zipcode ?>"/> <br>
Owner: <input type='text' name='owner' value="<?php echo $owner ?>"<br>
Phone number: <input type='text' name='phone' value="<?php echo $phone ?>"/> <br>
<input type='submit' id='foo' name='action' value='Submit' />";
</form>