<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Delete</title>
</head>
<body>
<?php

include_once './dbconnect.php'; // DELETE PAGE

$id = filter_input(INPUT_GET, 'id'); // GRABS ID

$db = dbconnect();

$stmt = $db->prepare("DELETE FROM corps where id = :id"); // DELETES USING QUERY

$binds = array(
":id" => $id
);

$isDeleted = false;
if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
$isDeleted = true;
}

?>

<h1> Record <?php echo $id; ?>
    <?php if ( !$isDeleted ): ?>Not<?php endif; ?>
    Deleted
</h1>

<a href="view.php"> Go to Table </a>

</body>
</html>
