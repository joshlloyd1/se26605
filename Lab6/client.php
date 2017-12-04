<?php
include_once ('assets/dbconnect.php'); // CLIENT PAGE
include_once ('AdminFunctions.php');
include_once ('assets/header.php');
include_once ('assets/clientfunctions.php');
$db = dbconnect();
$email = $_SESSION['username'];
$email = getEmail($db, $email);
echo "<h1>Welcome " . $email . "!</h1>";


$category = filter_input(INPUT_GET, 'category', FILTER_SANITIZE_STRING) ?? false;
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ?? "";
if(isset($_SESSION['cartitems'])) { // allows user to view cart if cart it in use
    echo "<a href='cartAdd.php?action=in'><button>View Cart</button></a></td>";
}
switch ($action) {
    default: // shows categories and items
        $makes = GetCategories($db);
        echo filterShop($makes);
        echo getProductsAsTable($db);
        break;
    case "search": // if user selects a certain category
        $makes = GetCategories($db);
        echo filterShop($makes);
        echo getProductsAsTable($db, $category);
        break;
    case "Reset": // if user wants to see all the categories again
        $makes = GetCategories($db);
        echo filterShop($makes);
        echo getProductsAsTable($db);
        break;

}

?>
