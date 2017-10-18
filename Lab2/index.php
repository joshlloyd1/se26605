<?php
/**
 * Created by PhpStorm.
 * User: 001386538
 * Date: 10/18/2017
 * Time: 10:07 AM
 */
require_once ("assets/dbconn.php");
require_once ("assets/actors.php");
include_once ("assets/header.php");
$db = dbConn();
echo getActorsAsTable($db); // PAGE TO SHOW ALL ACTORS CURRENTLY RESIDING IN DB
include_once("assets/footer.php");
?>
