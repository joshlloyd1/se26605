<?php
/**
 * Created by PhpStorm.
 * User: 001386538
 * Date: 11/6/2017
 * Time: 7:39 AM
 */
session_start(); // indicates that this script needs access to session vars
if($_SESSION['username'] == NULL || !isset($_SESSION["user"])) {
    header('Location: foo3.php');
}

$file = file_get_contents("http://www.cnn.com");
echo preg_match_all('/Trump/', $file, $matches, PREG_OFFSET_CAPTURE);
print_r($matches);
$greps = preg_grep('/Trump/', $file);
print_r($greps);
/* grabbing a primary key for a record
$db = getmy database
$sql = "INSERT INTO foo VALUES VALUES(null, 'Clark', 'Alexander');
$stmt = $db->prepare($sql);
    bind params here if we had any which we don't
$stmt->execute();
$pk = $db->lastInsertId();  // gets the key of the last inserted row, also works for last updated row, zero if it didn't happen
*/
$pwd = "foo";

$hash = password_hash($pwd, PASSWORD_DEFAULT); // used for storing the pwd
$pwd = "foo";
echo "<p>" . $hash . "</p>";
$pwd = "foo";
echo "<p>" . strlen(password_hash($pwd, PASSWORD_DEFAULT)) . "</p>";
$loginpwd = "foo";
if (password_verify($loginpwd, $hash)) { // is for validation at login
    echo "valid";
}
else {
    echo "invaid";
}