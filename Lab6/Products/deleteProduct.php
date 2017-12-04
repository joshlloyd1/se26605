<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete a Category</title>
</head>
<body>
<?php
include_once '..\assets\dbconnect.php'; // DELETE PRODUCT PAGE

$product_id = filter_input(INPUT_GET, 'product_id'); // grabs id
$db = dbconnect();
$sql = $db->prepare("SELECT * FROM products WHERE product_id = :product_id"); //delete image first to be deleted
$sql->bindParam('product_id', $product_id);
$sql->execute();
$result = $sql->fetch(PDO::FETCH_ASSOC);
unlink("../images/" . $result['image'] . ""); // ulink deletes a image from the images file

$sql = $db->prepare("DELETE FROM products WHERE product_id = :product_id"); // delete the ramaining row from sql
$sql->bindParam(':product_id', $product_id);
if($sql->execute() && $sql->rowCount() > 0) {
echo "<h1>Record $product_id deleted."; // output message
    }
    else {
    echo "<h1>Record not deleted";
        }
        echo "<br><br><a href='..\AdminPage.php?action=Adjust+Product'>Return</a>;";
        ?>
</body>
</html>