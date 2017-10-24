<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Update</title>
</head>
<body>
<?php

include_once './dbconnect.php';
include_once './functions.php';

$db = dbconnect();

if ( isPostRequest() ) {

    $id = filter_input(INPUT_POST, 'i-d');
    $corp = filter_input(INPUT_POST, 'corp');
    $email = filter_input(INPUT_POST, 'email');
    $zipcode = filter_input(INPUT_POST, 'zipcode');
    $owner = filter_input(INPUT_POST, 'owner');
    $phone = filter_input(INPUT_POST, 'phone');

    $stmt = $db->prepare("UPDATE corps SET corp = :corp, email = :email, zipcode = :zipcode, owner = :owner, phone = :phone WHERE id = :id");

    $binds = array(
        ":id" => $id,
        ":corp" => $corp,
        ":email" => $email,
        ":zipcode" => $email,
        ":owner" => $owner,
        ":phone" => $phone
    );

    $message = 'Update failed';
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $message = 'Update Complete';
    }


} else {
    $id = filter_input(INPUT_GET, 'id');
}

$stmt = $db->prepare("SELECT * FROM corps where id = :id");
$binds = array(
    ":id" => $id
);
$result = array();
if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $corp =  $result['corp'];
    $email =  $result['email'];
    $zipcode =  $result['zipcode'];
    $owner =  $result['owner'];
    $phone =  $result['phone'];

} else {
    header('Location: view.php');
    die('ID not found');

}


?>

<p>
    <?php if ( isset($message) ) { echo $message; } ?>
</p>

<form method="post" action="#">
    Corp: <input type="text" name="corp" value="<?php echo $corp ?>" />
    <br />
    Email: <input type="text" name="email" value="<?php echo $email ?>" />
    <br />
    Zip Code: <input type="text" name="zipcode" value="<?php echo $zipcode ?>" />
    <br />    Owner: <input type="text" name="owner" value="<?php echo $owner ?>" />
    <br />    Phone: <input type="text" name="phone" value="<?php echo $phone ?>" />
    <br />
    <input type="hidden" name="i-d" value="<?php echo $id ?>" />
    <input type="submit" value="Submit" />
</form>

<a href="view.php"> Go back </a>

</body>
</html>