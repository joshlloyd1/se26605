<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="icon" href="../images/favicon.png" type="image/gif" sizes="16x16">

</head>
<body>
<h1>Car Shopping!</h1>
<?php // ^^ boot strap
session_start();

include_once 'AdminFunctions.php';

$side = Navigation("Shop") . "\t\t\t\t" . Navigation("Manage") . "\t\t\t\t";// . Navigation('Cart') . Navigation("Log Out"); // outputs the navation buttons
if(isset($_SESSION['cartitems'])) {
    $side .= Navigation('Cart') . "\t\t\t\t";
}
$side .= Navigation('Log Out');
if($_SESSION['access'] == 1) { // checks for access from log in
    $action = filter_input(INPUT_POST, 'action'); // what user wants variable
    echo $side; // outputs navigation
    switch ($action) {
        case 'Shop': // brings to client page
            header('Location: ./client.php');
            break;
        case 'Manage': // brings to manager page
            header('Location: ./AdminPage.php');
            break;
        case 'Cart':
            header('Location: ./cartAdd.php?action=in');
            break;
        case 'Log Out': // logs out and sets access to false
            $_SESSION['access'] = false;
            header('Location: ./index.php');
            break;
        default:
            break;
    }
}
else { // if user is not logged in brings them to index
    header("Location: index.php");
}
session_abort();
?>

</body>
</html>