<a href="/Lab31/View.php">View The Table</a>

<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 10/24/2017
 * Time: 1:52 PM
 */
require_once ("dbconnect.php");
require_once ("assets/Corps.php");
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
include_once ("assets/corpform.php");
?>

