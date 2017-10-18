<?php
/**
 * Created by PhpStorm.
 * User: 001386538
 * Date: 10/18/2017
 * Time: 10:07 AM
 */
require_once ("assets/dbconn.php"); // PAGE THAT ALLOWS USER TO ADD TO THE DATABASE
require_once ("assets/actors.php");
include_once ("assets/header.php"); // header found on all pages
$db = dbConn(); // sets up connection
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? ""; // brings in variables
$firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING) ?? "";
$lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING) ?? "";
$dob = filter_input(INPUT_POST, 'dob', FILTER_SANITIZE_STRING) ?? "";
$height = filter_input(INPUT_POST, 'height', FILTER_SANITIZE_STRING) ?? "";
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT) ?? null;

switch ($action) { // switch to allow for future buttons to be added
    case "Add Actor": // "Add Actor" comes from button to submit data to be entered
        addActor($db, $firstname, $lastname, $dob, $height); // enters data with args
        break;
}
//echo getActorsAsTable($db);
include_once ("assets/actorform.php"); // adds info
include_once("assets/footer.php"); // footer found on all pages
?>
