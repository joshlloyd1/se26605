<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Read</title>
</head>
<body>
<?php
try {
    $id = filter_input(INPUT_GET, 'id');

    include_once './dbconnect.php';

    $db = dbconnect();

    $stmt = $db->prepare("SELECT * FROM corps WHERE id = :id"); // GRABS  FROM DB

    $binds = array(
        ":id" => $id
    );


    $result = array();
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    $result['incorp_dt'] = date("m/d/y");
} catch(PDOException $e) {
    die("there was a problem getting info for row");
}
?>
<table>
    <tbody>
    <tr>
        <td><b>ID:</b> <?php echo $result['id']; ?></td>
        <td><b>Corporation:</b> <?php echo $result['corp']; ?></td>
        <td><b>Inc.</b> <?php echo $result['incorp_dt']; ?></td>
        <td><b>Email:</b> <?php echo $result['email']; ?></td>
        <td><b>Zip Code:</b><?php echo $result['zipcode']; ?></td>
        <td><b>Owner:</b> <?php echo $result['owner']; ?></td>
        <td><b>Phone number:</b> <?php echo $result['phone']; ?></td>
        <td><a href="delete.php?id=<?php echo $result['id']; ?>">Delete</a></td>
        <td><a href="update.php?id=<?php echo $result['id']; ?>">Update</a></td>
    </tr>
    </tbody>
</table>
<a href="view.php"> Go to Table </a>
</body>
</html>
