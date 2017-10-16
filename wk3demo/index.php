

<?php // the stuff inside the <section> tags from header and footer
require_once("assets/dbconn.php");
require_once("assets/dogs.php");
include_once("assets/header.php");
$db = dbConn();
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? "";
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING) ?? "";
$gender = filter_input(INPUT_POST, 'gender', FILTER_VALIDATE_REGEXP,
    array(
        "options"=>array("regexp"=>'/^[MF]$/')
    )
    ) ?? "";
$fixed = filter_input(INPUT_POST, 'fixed',  FILTER_VALIDATE_BOOLEAN) ?? false;
switch ($action) {
    case "Add":
        addDog($db, $name, $gender, $fixed);
}
echo getdogsAsTable($db);
include_once ("assets/dogform.php");
include_once("assets/footer.php");
?>

