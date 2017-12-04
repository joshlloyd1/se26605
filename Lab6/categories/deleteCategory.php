<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete a Category</title>
</head>
<body>
<?php
include_once '..\assets\dbconnect.php'; // DELETE A CATEGORY FORM

$category_id = filter_input(INPUT_GET, 'category_id'); // grabs id from url
$db = dbconnect();

$sql = $db->prepare("DELETE FROM categories WHERE category_id = :category_id"); // Delete sql statement
$sql->bindParam(':category_id', $category_id);
if($sql->execute() && $sql->rowCount() > 0) {
    echo "<h1>Record $category_id deleted."; // output message to screen
}
else {
    echo "<h1>Record not deleted"; // if sql did not work, than let user know
}
echo "<br><br><a href='..\AdminPage.php?action=Adjust+Catagory'>Return</a>;"; // allows to go back to original screen
?>
</body>
</html>