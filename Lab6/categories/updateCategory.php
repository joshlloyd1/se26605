<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Update</title>
</head>
<body>
<?php

include_once '../assets/dbconnect.php';
include_once '../assets/functions.php';


$db = dbconnect(); // UPDATE PAGE TO ALLOW USER TO UPDATE A ROW IN DB

if ( isPostRequest() ) {

    $category_id = filter_input(INPUT_POST, 'category_id'); // GRABS INFORMATION
    $category = filter_input(INPUT_POST, 'category');
    if($category == "") {
        $message = 'Invalid category name.'; // if can't find category name
    }
    else {
        $stmt = $db->prepare("UPDATE categories SET category = :category WHERE category_id = :category_id"); // sql statement
        // SQL STATMENT ^^
        $binds = array(
            ":category_id" => $category_id,
            ":category" => $category
        );

        $message = 'Update failed';
        if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
            $message = 'Update Complete';
        }
    }

} else {
    $category_id = filter_input(INPUT_GET, 'category_id');
}

$stmt = $db->prepare("SELECT * FROM categories where category_id = :category_id");
$binds = array(
    ":category_id" => $category_id
);
$result = array();
if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $category =  $result['category'];
} else {
    echo 'ID not found';

}

// HTML FOR FORM TO UPDATE A ROW
?>

<p>
    <?php if ( isset($message) ) { echo $message; }// message if something went wrong ?>
</p>

<form method="post" action="#">
    Category: <input type="text" name="category" value="<?php echo $category // allows user to change name of the category ?>" />
    <br />
    <br />
    <input type="hidden" name="category_id" value="<?php echo $category_id ?>" />
    <input type="submit" value="Submit" />
</form>
<a href="../AdminPage.php"> Return </a>

</body>
</html>
