<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11/26/2017
 * Time: 1:59 PM
 */
function getProductsAsTable($db, $category = false) { // function that shows products as a table and orders by their id, allows for one category
        if($category == false) { // if a category wasn't picked
            $sql=$db->prepare("SELECT products.product_id as product_id, categories.category as category, products.product as product, products.price as price, products.image as image 
            FROM products 
            INNER JOIN categories 
            ON categories.category_id = products.category_id 
            ORDER BY products.product_id");
            $products = array();
            if ($sql->execute() && $sql->rowCount() > 0) {
                $products = $sql->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        if($category != "") { // if one was
            $sql=$db->prepare("SELECT products.product_id as product_id, categories.category as category, products.product as product, products.price as price, products.image as image 
            FROM products 
            INNER JOIN categories 
            ON categories.category_id = products.category_id 
            WHERE categories.category = :category
            ORDER BY products.product_id");
            $binds = array(
                ":category" => $category
            );
            $products = array();
            if ($sql->execute($binds) && $sql->rowCount() > 0) {
                $products = $sql->fetchAll(PDO::FETCH_ASSOC);
            }
        }
    $table = "<h1>List of all Cars</h1>";
    $table .= "<table border='3px;' cellspacing='5px;' class='table table-condensed' style='font-size: 25px;'>";
    foreach($products as $product) { // outputs as a table
        $table .= "<tr>";
        $table .= "<td>" . $product['category'] . "</td>";
        $table .= "<td>" . $product['product'] . "</td>";
        $table .= "<td>$" . $product['price'] . "</td>";
        $table .= "<td><img src='images/" . $product['image'] . "'  width='335' height='200'/></td>";
        $table .= "<td><a href='cartAdd.php?id=" . $product['product_id'] . "'><button>Add To Cart</button></a></td>";
        $table .= "</tr>";
    }
    $table .= "</table>";
    return $table;
}
function EmptyCart() { // function for erase button
    $form = "<form method=get action='cartAdd.php'>";
    $form .= "<input type='hidden' name='action' value='Erase' /><input type=submit value='Erase Cart Items'>";

    return $form;
}
function displayCart($db, $product_id) { // function to just display items in the cart by what was passed into the fuction
    $sql = $db->prepare("SELECT products.product_id as product_id, categories.category as category, products.product as product, products.price as price, products.image as image 
            FROM products 
            INNER JOIN categories 
            ON categories.category_id = products.category_id 
            WHERE products.product_id = :product_id");
    $binds = array(
        ":product_id" => $product_id
    );
    $product=array();
    if ($sql->execute($binds) && $sql->rowCount() > 0) {
        $products = $sql->fetch(PDO::FETCH_ASSOC);


        $table = "<tr>";
        $table .= "<td>" . $products['category'] . "</td>";
        $table .= "<td>" . $products['product'] . "</td>";
        $table .= "<td>$" . $products['price'] . "</td>";
        $table .= "<td><img src='images/" . $products['image'] . "'  width='300' height='200'/></td>";
    } else {
        $table = "";
    }

    return $table;
}
function getTotal($db, $product_id, $previousTotal) { // function to gather total of items in cart
    $sql = $db->prepare("SELECT * FROM products WHERE product_id = :product_id");
    $binds = array(
        ":product_id" => $product_id
    );
    $product=array();
    if ($sql->execute($binds) && $sql->rowCount() > 0) {
        $products = $sql->fetch(PDO::FETCH_ASSOC);
        $newTotal = $products['price'] + $previousTotal;
    }
    else {
        $newTotal = "";
    }
    return $newTotal;
}
function filterShop($categories) { // function for form to filter the items in the cart based on their category
    $form = "<section><form method='get' action='client.php'>
    <label for='col'>Search Brands</label>
    <select name='category' id='category'>";
    foreach ($categories as $category) {
        $form .= "<option value =" .$category['category'] . ">" . $category['category'] . "</option>";
    } $form .= "</select>
    <input type='hidden' name='action' value='search' />
    <input type='submit' />
    <input type='submit' name='action' value='Reset' />
    
    </form></selection>";
    return $form;
}
