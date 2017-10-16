<?php
/**
 * Created by PhpStorm.
 * User: 001386538
 * Date: 10/11/2017
 * Time: 9:46 AM
 */
//$submit = isset($_GET['submit']) ? $_GET['submit'] : ""; // if else statement
$dsn = "mysql:host=localhost;dbname=dogs";
$username = "dogs";
$password = "se266";
try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $submit = $_GET['submit'] ?? ""; // null coalesce operator
    if($submit == "Do it") {
        $name = $_GET['name'] ?? "";
        $gender = $_GET['gender'] ?? "";
        $fixed = $_GET['fixed'] ?? false;
        $sql = $db->prepare("INSERT INTO dogs VALUES (null, :name, :gender, :fixed)");
        $sql->bindParam('name', $name);
        $sql->bindParam('gender', $gender);
        $sql->bindParam('fixed', $fixed);
        $sql->execute();
        echo $sql->rowCount() . " rows inserted.";
    }
} catch (PDOException $e) {
    die("There was a problem connecting to the db.");
}


?>
<form method="get" action="#">
    <input type="text" name="name" value="" /> <br />
    <input type="radio" name="gender" value="M" /> <br />
    <input type="radio" name="gender" value="F" /> <br />
    <input type="checkbox" name="fixed" value= "true" /> <br/>
    <input type="submit" id="foo" name="submit" value="Do it" />
</form>
<?php
$sql = $db->prepare("SELECT * FROM dogs");
$sql -> execute();
$results = $sql->fetchAll(PDO::FETCH_ASSOC);
if(count($results) ) {
    foreach($results as $dog) {
        print_r($dog);
    }
}
?>