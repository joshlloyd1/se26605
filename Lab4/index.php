<?php
/**
 * Created by PhpStorm.
 * User: 001386538
 * Date: 10/30/2017
 * Time: 10:09 AM
 */
require_once ("assets/dbconnect.php");
require_once ("assets/corps.php");
require_once ("assets/viewCorps.php");
$db = dbconnect();

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ?? "";

switch ($action) {
    case "Ascending":
        break;
    default:
        include_once("assets/header.php");
        $cols = getColumnNames($db, 'corps');
        $corps = getCorps($db);
        echo corpForm($cols);
        echo getCorpsAsTable($db, $corps);
}

include_once ("assets/footer.php");