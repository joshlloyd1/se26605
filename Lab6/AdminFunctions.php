<style>
    form {
        display: inline-block;
    }
</style>

<?php // FUNCTIONS FOR ADMIN PAGE
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11/18/2017
 * Time: 4:46 PM
 */
function getEmail($db, $user_id) { //gets email to display when logged in
    $sql = $db->prepare("SELECT email FROM users WHERE user_id = :user_id");
    $binds = array(
        ":user_id" => $user_id
    );
    $sql->execute($binds);
    $results = $sql->fetch(PDO::FETCH_ASSOC);
    $rows = $sql->rowCount();
    if ($rows == 1) {
        $ret = $results['email'];
    } else {
        $ret = "PROBLEM";
    }
    return $ret;
}
function Navigation($adding) { // navigation bar for header
    $form = "<form method='post' action='#'>
    <input type='hidden' name='action' value='$adding' /><input type='submit' value='$adding' style='height: 50px; width: 100px; font-size : 20px;'>
    </form>";
    return $form;
}
function AddSomething2($adding) { // secondary bar for admin page, uses switch statment based on what the user clicks on
    $form = "<form method='get' action='AdminPage.php'>
    <input type='hidden' name='action' value='$adding' /><input type='submit' value='$adding' style='height: 80px; width: 180px; font-size : 20px; background: green; color:white;'>
    </form>";
    return $form;
}
function AddCatagoryFrom() { // form to allow user to add a category
    $form = "<h1>New Catagory!</h1><div><section>
        <form method='get' action='AdminPage.php'>
        Catagory name: <input type='text' name='category' />  <br><br>
        <input type='hidden' name='action' value='Catagory Add' /><input type='submit' value='Add Catagory'>
        </form>
    </section></div>";
    return $form;
}
function AddCatagory($db) { // function that actually adds the category to sql
        $category = filter_input(INPUT_GET, 'category', FILTER_SANITIZE_STRING);
        if($category == "") {
            $ret = "ERROR: must enter in a category name";
        }
        else {
            $sql = $db->prepare("INSERT INTO categories VALUES (null, :category)");
            $sql->bindParam(':category', $category);
            $sql->execute();
            $ret = "Inserted 1 category";
        }
    return $ret;
}
function SeeCategories($db) {// function to see the categories to be read, updated, or deleted
    try {
        $sql = $db->prepare("SELECT * FROM categories ORDER BY category_id");
        $categories = array();
        if ($sql->execute() && $sql->rowCount() > 0) {
            $categories = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        $table = "<h1>List of Categories<br></h1>";
        $table .= "<div style='padding-left: 10px;'><table border='1px;' cellpadding='15px;'>";
        foreach ($categories as $category) {
            $table .= "\t<tr>";
            $table .= "<td>&nbsp;" . $category['category_id'] . "&nbsp;</td>";
            $table .= "<td>" . $category['category'] . "</td>";
            $table .= "<td>" . "<a href='categories/deleteCategory.php?category_id=" . $category['category_id'] . "'>Delete</a></td>";
            $table .= "<td>" . "<a href='categories/updateCategory.php?category_id=" . $category['category_id'] . "'>Update</a></td>";
            $table .= "</tr>";
        }
        $table .= "</table></div>";
        return $table;
    } catch (PDOException $e) {
        die("There was a problem seeing the categories");
    }
}
function GetCategories($db) { // function that grabbs the categories
    $sql = $db->prepare("SELECT * FROM categories ORDER BY category_id");
    $categories = array();
    if ($sql->execute() && $sql->rowCount() > 0) {
        $categories = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    return $categories;
}
function AddProduct($db, $category_id, $product, $price, $image) { // function that adds product to sql db

    $sql = $db->prepare("INSERT INTO products VALUES (null, :category_id, :product, :price, :image)");
    $sql->bindParam(':category_id', $category_id);
    $sql->bindParam(':product', $product);
    $sql->bindParam(':price', $price);
    $sql->bindParam(':image', $image);

    $sql->execute();
    $ret = " and Inserted 1 product";

    return $ret;
}
function seeProducts($db) { // function that allows user to see the products added into sql using join statement to allow optimal viewing
    try {
        $sql = $db->prepare("SELECT products.product_id as product_id, categories.category as category, products.product as product, products.price as price, products.image as image 
        FROM products 
        INNER JOIN categories 
        ON categories.category_id = products.category_id 
        ORDER BY products.product_id");
        $products = array();
        if ($sql->execute() && $sql->rowCount() > 0) {
            $products = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        $table = "<h1>List of Products<br></h1>";
        $table .= "<table border='3px;' cellpadding='5px;'>";
        $table .= "<tr>" . "<th>&nbsp;ID&nbsp;</th><th>Make</th><th>Model</th><th>Price</th><th>Image</th></tr>";
        foreach ($products as $product) {
            $table .= "<tr><td>&nbsp;" . $product['product_id'] . "&nbsp;</td>";
            $table .= "<td>" . $product['category'] . "</td>";
            $table .= "<td>" . $product['product'] . "</td>";
            $table .= "<td>" . "$" .  $product['price'] . ".00</td>";
            $table .= "<td>" . $product['image'] . "</td>";
            $table .= "<td>" . "<a href='Products/deleteProduct.php?product_id=" . $product['product_id'] . "'>Delete</a></td>";
            $table .= "<td>" . "<a href='Products/updateProduct.php?product_id=" . $product['product_id'] . "'>Update</a></td></tr>";
        }
        $table .= "</table>";
        return $table;

    }catch (PDOException $e) {
        die ("We expierenced a problem seeing the products");
    }
}