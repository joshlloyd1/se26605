<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>View</title>


</head>
<body>
<a href="/Lab31/AddToTable.php">Add To Table</a>
<?php // VIEW PAGE TO SEE WHOLE DB

include_once './dbconnect.php';

$db = dbconnect();

$stmt = $db->prepare("SELECT * FROM corps"); // GRABS EVERYTHING FROM DB

$results = array();
if ($stmt->execute() && $stmt->rowCount() > 0) {
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>


<table border="1">
    <thead>
    <tr>
        <th>ID</th>
        <th>Corp</th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($results as $row): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['corp']; ?></td> <!-- OUTPUTS THROUGH LARGE TABLE WITH 3 LINKS TO DELETE, UPDATE, OR VIEW A ROW -->
            <td><a class="btn btn-warning" href="delete.php?id=<?php echo $row['id']; ?>">Delete</a></td>
            <td><a class="btn btn-primary" href="update.php?id=<?php echo $row['id']; ?>">Update</a></td>
            <td><a class="btn btn-primary" href="read2.php?id=<?php echo $row['id']; ?>">Read</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>