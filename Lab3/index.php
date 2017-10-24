<?php
/**
 * Created by PhpStorm.
 * User: 001386538
 * Date: 10/23/2017
 * Time: 8:18 AM
 */
require_once ("assets/dbconn.php");
require_once ("assets/Corporations.php");
include_once ("assets/header.php");
$db = dbConn();
echo getCorporationsAsTable($db);
include_once ("assets/footer.php");
?>