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

switch($action) {
    case 'sort':
        $sortable = true;
        $corps = getCorpsAsSortedTable($db, $col, $dir);
        $cols = getColumnNames($db, 'corps');
        $linecount = countLines($corps);
        echo CorpForm($cols);
        echo $linecount;
        echo getCorpsAsTable($db, $corps, $cols, $sortable);
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
    case 'reset':
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
