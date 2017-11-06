<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>View</title>


</head>
<body>
<a href="/Lab42/AddToTable.php">Add To Table</a>
<?php // VIEW PAGE TO SEE WHOLE DB

include_once './dbconnect.php';
include_once './corptable.php';
include_once './countLines.php';
include_once './corps.php';

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ??
    filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;
$dir = filter_input(INPUT_GET, 'dir', FILTER_SANITIZE_STRING) ?? NULL;
$col = filter_input(INPUT_GET, 'col', FILTER_SANITIZE_STRING) ?? NULL;
$term = filter_input(INPUT_GET, 'term', FILTER_SANITIZE_STRING) ?? NULL;

$db = dbconnect();

switch($action) { // SWITCH statment for all buttons, and default
    case 'sort': // when user clicks for sort
        $sortable = true; // tells function that it will be sorted
        $corps = getCorpsAsSortedTable($db, $col, $dir); // gets table 
        $cols = getColumnNames($db, 'corps'); // gets column names
        $linecount = countLines($corps); // counts line numbers
        echo CorpForm($cols); // outputs corp form
        echo $linecount; // outputs linecount
        echo getCorpsAsTable($db, $corps, $cols, $sortable); // outputs the corp table
        break;
    case 'search':
        $sortable = true;
        $corps = getonerow($db, $col, $term);
        $cols = getColumnNames($db, 'corps');
        $linecount = countLines($corps);
        echo CorpForm($cols);
        echo $linecount;
        echo getCorpsAsTable($db, $corps, $cols, $sortable);
        break;
    case 'reset': // sets everything to defaults
        $corps = getCorps($db);
        $cols = getColumnNames($db, 'corps');
        $linecount = countLines($corps);
        echo CorpForm($cols);
        echo $linecount;
        echo getCorpsAsTable($db, $corps, $cols);
        break;
    default:
        $corps = getCorps($db);
        $cols = getColumnNames($db, 'corps');
        $linecount = countLines($corps);
        echo CorpForm($cols);
        echo $linecount;
        echo getCorpsAsTable($db, $corps, $cols);
        break;
}
?>
