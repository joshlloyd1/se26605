<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11/26/2017
 * Time: 2:32 PM
 */
include_once "assets/clientfunctions.php"; // SHOPPING CART PAGE
include_once 'assets/dbconnect.php';
include_once 'assets/header.php';
$db = dbconnect();
$id = filter_input(INPUT_GET, 'id');
$action = filter_input(INPUT_GET, 'action');
$no_of_items = 0; // initial number of items
session_start();
if($action != "in") { // if not using nav to get to page
    if (!isset($_SESSION['cartitems'])) { // is it users first time?
        $_SESSION['cartitems'][] = $id;
    } else {
        $_SESSION['cartitems'][] .= $id; // if it isnt users first time, adds product to an session variable array
    }
    $no_of_items = 0;

    echo "<h1>Your Cart</h1>";
    if ($_SESSION['cartitems'] > 0) {
        echo "<table cellpadding='10px;'>";
        foreach ($_SESSION['cartitems'] as $cartitem) { // table to display cart items
            if (isset($cartitem)) {
                echo displayCart($db, $cartitem);
                $no_of_items++;
            } else {
                echo "There are no items in your cart.";
            }
        }
        echo "</table>";
    } else {
        echo "There are no items in your cart";
    }
}
switch($action) {
    default: // gets total of items in cart prices
        $_SESSION['currentTotal'] = getTotal($db, $id, $_SESSION['currentTotal']);
        $_SESSION['FormerTotal'] = $_SESSION['currentTotal'];
        break;
    case "Erase": // erases items in cart and 0s out vaiables
        unset($_SESSION['cartitems']);
        $_SESSION['currentTotal'] = 0;
        $_SESSION['noofins'] = 0;
        header("Location: client.php");
        break;
    case "in": // if coming in from nav, just displays items in cart
        $_SESSION['noofins']++;
        $_SESSION['FormerTotal'] = $_SESSION['currentTotal'];
        echo "<h1>Your Cart</h1>";
        if ($_SESSION['cartitems'] > 0) {
            echo "<table cellpadding='10px;'>";
            foreach ($_SESSION['cartitems'] as $cartitem) {
                if (isset($cartitem)) {
                    echo displayCart($db, $cartitem);
                    $no_of_items++;
                } else {
                    echo "There are no items in your cart.";
                }
            }
            echo "</table>";
        } else {
            echo "There are no items in your cart";
        }

        break;

}
echo "____________________________________<br>"; // bottom part of page, displays total, number of items, and allows user to empty cart
echo "Your Total: $" . $_SESSION['currentTotal'] . "<br>Number of items: ". $no_of_items . "<br><br>";
echo EmptyCart();
echo "<a href=client.php>Continue Shopping</a>";