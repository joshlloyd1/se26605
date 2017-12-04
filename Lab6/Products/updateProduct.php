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
include_once '../AdminFunctions.php';

$db = dbconnect(); // UPDATE PAGE TO ALLOW USER TO UPDATE A ROW IN DB
$max_size = 2097152; //2 mb
$location = '../images/'; //where the file is going
    if (isset($_POST['submit'])) //checking for anything will break the code
    {
        if(isset($_POST['new'])) { // if user selected to get a new image
            $name = $_FILES['file']['name']; //file name
            $size = $_FILES['file']['size']; //file size
            $type = $_FILES['file']['type']; //file type
            $tmp_name = $_FILES['file']['tmp_name']; //temp location on server

            if (checkType($name, $type) && checkSize($size, $max_size)) {
                if (isset($name)) {
                    save_file($tmp_name, $name, $location); //call my function
                }
            }
        } else { // if user did not select to get a new image
            $product_id = filter_input(INPUT_POST, 'product_id');
            $category_id = filter_input(INPUT_POST, 'category_id');
            $price = filter_input(INPUT_POST, 'price');
            $product = filter_input(INPUT_POST, 'product');
            if($price < 0 || is_numeric($price) == false) {
                $message = "must enter in valid credentials for price"; // if they entered bad info for the price
            }
            else {
                $stmt = $db->prepare("UPDATE products SET category_id = :category_id, price = :price, product = :product WHERE product_id = :product_id"); // update statement
                // SQL STATMENT ^^
                $binds = array(
                    ":product_id" => $product_id,
                    ":category_id" => $category_id,
                    ":price" => $price,
                    ":product" => $product
                );

                $message = 'Upload failed.';
                if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
                    $message = 'Update Complete';
                }
            }
        }
    } else {
        $product_id = filter_input(INPUT_GET, 'product_id'); // if entering page for the first time with out hitting submit button
    }
        function checkType($name, $type){ // checks file type
            $extension = pathinfo($name, PATHINFO_EXTENSION); //better way to get extension
            if (!empty($name)) {
                if (($extension == 'jpg' || $extension == 'png') && ($type == 'image/jpeg' || $type == 'image/png')) {
                    return true;
                } else{
                    echo 'That is not a jpg or png';
                    return false;
                }
            }
        }
        function checkSize($size, $max_size){ // checks file size to not take up too much space in images file
            if($size <= $max_size){
                return true;
            } else{
                echo 'File is too large. Max size in 2mb.';
                return false;
            }
        }
        function fileExists($name){ // if file already exists it will rename it so php doesn't get comfused
            $filename = rand(1000,9999).md5($name).rand(1000, 9999);
            echo $filename;
            return false;
        }
        function save_file($tmp_name, $name, $location) // saves file and uploads path to sql
        {
            $og_name = $name;
            //so long as the name is in existance - loop to check new name after it is generated
            while (file_exists('../images/' . $name)) {
                echo 'File already exists. Generating name.<br/>';
                $rand = rand(10000, 99999);
                $name = $rand . '.' . pathinfo($name, PATHINFO_EXTENSION); //create new name
            }
            if (move_uploaded_file($tmp_name, $location . $name)) {
                $db = dbconnect();
                $product_id = filter_input(INPUT_POST, 'product_id'); // GRABS INFORMATION
                $product = filter_input(INPUT_POST, 'product');
                $category_id = filter_input(INPUT_POST, 'category_id');
                $price = filter_input(INPUT_POST, 'price');
                $old_image = filter_input(INPUT_POST, 'old_image');
                if($price < 0 || is_numeric($price) == false) {
                    $message = "must enter in valid credentials for product name and price";
                }
                else {

                    $stmt = $db->prepare("UPDATE products SET category_id = :category_id, product = :product, price = :price, image = :image WHERE product_id = :product_id");
                    // SQL STATMENT ^^
                    $binds = array(
                        ":category_id" => $category_id,
                        ":product" => $product,
                        ":price" => $price,
                        ":image" => $name,
                        ":product_id" => $product_id
                    );

                    $message = 'Update failed';
                    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
                        unlink($old_image);
                        $message = 'Update Complete';
                    }
                    if (!($og_name == $name)) { //if original name != name
                        echo ' and renamed to ' . $name . '.<br/>';
                    } else {
                        echo '.';
                    }
                }
            } else {
                echo 'ERROR!';
            }
}
$product_id = filter_input(INPUT_GET, 'product_id');

$stmt = $db->prepare("SELECT products.product_id as product_id, categories.category as category, categories.category_id as category_id, products.product as product, products.price as price, products.image as image 
        FROM products 
        INNER JOIN categories 
        ON categories.category_id = products.category_id 
        WHERE product_id = :product_id"); // initial JOIN sql statement assuring everything is grabbed in a easy to use manner
$binds = array(
    ":product_id" => $product_id
);
$result = array();
if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    echo 'ID not found';

}
$categories = GetCategories($db);
// HTML FOR FORM TO UPDATE A ROW

?>

<p>
    <?php if ( isset($message) ) { echo $message; } ?>
</p><?php

$form = "<h1>Update: " . $result['product'] . "</h1>
<form method='POST' action='#' enctype='multipart/form-data'>
    Category:";
    $form .= "<select name='category_id' id='category_id'>";
    $form .= "<option value =" . $result['category_id'] . ">" . $result['category_id'] . ".  " . $result['category'] . "</option >";
foreach ($categories as $category) {
    $form .= "<option value =" . $category['category_id'] . ">" . $category['category_id'] . ".  " . $category['category'] . "</option >";
    }
    $form .= "</select><br><br>";
    $form .= "Product name: <input type='text' name='product' value='" . $result['product'] . "' /><br>";
    $form .= "Price: $<input type='text' name='price' value='" . $result['price'] . "' /><br>";

    $form .= "New Image?: <input type='checkbox' name='new' value='new'>Yes<br>";
    $form .= "New Image: <input type='file' name='file'/>
    
    <br>Old image:<br>";
    $form .= "<img src='../images/" . $result['image'] . "'  width='300' height='200'/>
    <br />
    <br />
    <input type='hidden' name='old_image' value = '../images/" . $result['image'] . "'/>
    <input type='hidden' name='product_id' value=" . $product_id . "/>
    <input type='submit' name='submit' value='Submit' />
    </form>";

echo $form; ?>
<br><br>
<a href="../AdminPage.php"> Return </a>

</body>
</html>
