

<?php
require_once("assets/dbconn.php");
require_once("assets/dogs.php");
include_once("assets/header.php");
$db = dbConn();
echo getdogsAsTable($db);
include_once("assets/footer.php");
?>