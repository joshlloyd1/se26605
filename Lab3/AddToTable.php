<?php
/**
 * Created by PhpStorm.
 * User: 001386538
 * Date: 10/23/2017
 * Time: 8:57 AM
 */
require_once ("assets/dbconn.php");
require_once ("assets/Corporations.php");
include_once ("assets/header.php");
$db = dbConn();
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? "";
$corp = filter_input(INPUT_POST, 'corp', FILTER_SANITIZE_STRING) ?? "";
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING) ?? "";
$zipcode = filter_input(INPUT_POST, 'zipcode', FILTER_SANITIZE_STRING) ?? "";
$owner = filter_input(INPUT_POST, 'owner', FILTER_SANITIZE_STRING) ?? "";
$phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING) ?? "";

switch($action) {
    case ("Submit"):
        $label = addCorporation($db, $corp, $email, $zipcode, $owner, $phone);
        break;
}
include_once ("assets/corpform.php");
include_once ("assets/footer.php");
?>