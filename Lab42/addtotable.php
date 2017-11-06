<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add</title>
</head>
</html>
<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 10/24/2017
 * Time: 1:52 PM
 */
require_once ("dbconnect.php");
require_once ("corps.php");
$db = dbconnect(); // ADDS TO TABLE PAGE
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? "";
$corp = filter_input(INPUT_POST, 'corp', FILTER_SANITIZE_STRING) ?? "";
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING) ?? "";
$zipcode = filter_input(INPUT_POST, 'zipcode', FILTER_SANITIZE_STRING) ?? "";
$owner = filter_input(INPUT_POST, 'owner', FILTER_SANITIZE_STRING) ?? "";
$phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING) ?? "";

switch($action) {
    case ("Submit"):
        $label = addCorporation($db, $corp, $email, $zipcode, $owner, $phone); //USES FUNCTION TO ADD USER
        break;
}
include_once ("corpform.php");
echo '<a href="./view.php">View The Table</a>'

?>
