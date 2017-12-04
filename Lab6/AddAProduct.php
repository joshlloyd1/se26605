<?php
include_once ('assets/dbconnect.php');
include_once ('AdminFunctions.php');

$db = dbconnect();
 // NEW PRODUCT PAGE TO ADD A NEW PRODUCT
$max_size = 2097152; //2 mb
$location = 'images/'; //where the file is going
if (isset($_POST['submit'])) { //checking for anything will break the code
    $name = $_FILES['file']['name']; //file name
    $size = $_FILES['file']['size']; //file size
    $type = $_FILES['file']['type']; //file type
    $tmp_name = $_FILES['file']['tmp_name']; //temp location on server
    if(checkType($name, $type) && checkSize($size, $max_size)){
        if (isset($name)) {
            save_file($tmp_name, $name, $location); //call my function
        }
    }
} else {
    echo '<br>Please select a file:';
}
function checkType($name, $type){
    //$extension = strtolower(substr($name, strpos($name, '.') + 1)); //get the extension
    $extension = pathinfo($name, PATHINFO_EXTENSION); //better way to get extension
    if (!empty($name)) {
        if (($extension == 'jpg' || $extension == 'png') && ($type == 'image/jpeg' || $type == 'image/png')) {
            return true;
        } else{
            echo 'That is not a jpg';
            return false;
        }
    }
}
function checkSize($size, $max_size){
    if($size <= $max_size){
        return true;
    } else{
        echo 'File is too large. Max size in 30KB.';
        return false;
    }
}
function fileExists($name){
    $filename = rand(1000,9999).md5($name).rand(1000, 9999);
    echo $filename;
    return false;
}
function save_file($tmp_name, $name, $location){
    $og_name = $name;
    //so long as the name is in existance - loop to check new name after it is generated
    while (file_exists('images/' . $name)) {
        echo 'File already exists. Generating name.<br/>';
        $rand = rand(10000, 99999);
        $name = $rand . '.' . pathinfo($name, PATHINFO_EXTENSION); //create new name
    }
    if (move_uploaded_file($tmp_name, $location . $name)) {

        $category_id = filter_input(INPUT_POST, 'category_id');
        $product = filter_input(INPUT_POST, 'product');
        $price = filter_input(INPUT_POST, 'price');
        $db = dbconnect();
        if(is_numeric($price)) {
            if ($product == "" || $price < 0) {
                echo "must enter in valid price and product name";
            } else {
                echo 'Success! ' . $og_name . ' was uploaded';
                echo AddProduct($db, $category_id, $product, $price, $og_name);
            }
        }
        else {
            echo "must enter in number value for price";
        }
        if(!($og_name==$name)){ //if original name != name
            echo ' and renamed to '.$name.'.<br/>';
        } else{
            echo '.';
        }
    } else {
        echo 'ERROR!';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
</head>
<body>

<h1>Add a new product</h1>
<?php

    $categories = GetCategories($db);

$form = "<form action='' method='POST' enctype='multipart/form-data'>";

    $form .= "Category:";
    $form .= "<select name='category_id' id='category_id'>";
    foreach ($categories as $category) {
    $form .= "<option value =" . $category['category_id'] . ">" . $category['category_id'] . ".  " . $category['category'] . "</option >";
    } // select category based on previously made categories
    $form .= "</select><br><br>
    Product name: <input type='text' name='product'><br>
    Price: $<input type='text' name='price' size='8'><br><br>
    <input type='file' name='file'/> file must be jpg
    <input type='submit' name='submit' value='Submit' />";

    echo $form;
?>

</body>
</html>