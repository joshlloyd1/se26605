<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Read</title>


</head>
<body>
<?php

include_once './dbconnect.php';

$db = dbconnect();

$id = filter_input(INPUT_POST, 'id');

$stmt = $db->prepare("SELECT * FROM corps where id = :id");

$results = array();
if ($stmt->execute()) {
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>


<table border="1">
    <?php foreach ($results as $row): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['corp']; ?></td>
            <td><?php echo $row['incorp_dt']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['zipcode']; ?></td>
            <td><?php echo $row['owner']; ?></td>
            <td><?php echo $row['phone']; ?></td>

        </tr>
    <?php endforeach; ?>
</table>


</body>
</html>