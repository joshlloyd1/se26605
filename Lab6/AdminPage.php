<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Page</title>
</head>
<body>
<?php // ADMIN PAGE
include_once ('assets/dbconnect.php'); // grabs pages it wants to use in page
include_once ('AdminFunctions.php');
include_once ('assets/header.php');

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING); // sets action and grabs it from url when it is being used

session_start(); // starts session to be able to be used
    $db = dbconnect();
    $email = $_SESSION['username']; // gets email to be used in page
    $email = getEmail($db, $email);
    echo "<h1>Welcome " . $email . " to the Admin Page!</h1>"; // outputs welcome message

    $side = AddSomething2("New Catagory") . "\t\t\t\t" . AddSomething2("Adjust Catagory") . "\t\t\t\t" . AddSomething2("New Product") . "\t\t\t\t" .  AddSomething2("Adjust Product");
    // ^^ navagtion bar to let user go through admin page functions
    switch ($action) {
        default:
            echo $side; // "side" is just the navigation from page to page
            break;
        case "New Catagory": // new category adds a new category based on the function
            echo $side;
            echo AddCatagoryFrom();
            break;
        case "Adjust Catagory": // shows the cateories and allows Update and delete
            echo $side;
            echo SeeCategories($db);
            break;
        case "New Product": // new product adds a product
            echo $side;
            include_once 'AddAProduct.php';
            break;
        case "Adjust Product": // allows user to edit a product already added
            echo $side;
            echo seeProducts($db);
            break;


        case "Catagory Add": // add category adds the category to db
            echo $side;
            echo AddCatagoryFrom();
            echo AddCatagory($db);
            break;
    }

?>
</body>
</html>