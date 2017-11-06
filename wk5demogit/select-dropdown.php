<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
require './functions/dbconnect.php';
require './functions/until.php';


$db = dbconnect();
$stmt = $db->prepare("SELECT * FROM corps ORDER BY id DESC");
$id = array();
if ($stmt->execute() && $stmt->rowCount() > 0) {
    $id = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
$id = '';
if ( isPostRequest() ) {


    $stmt = $db->prepare("SELECT * FROM corps WHERE id = :id");
    $id = filter_input(INPUT_POST, 'id');
    $binds = array(
        ":id" => $id
    );
    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $error = 'No Results found';
    }



}

?>

<?php if( isset($error) ): ?>
    <h1><?php echo $error;?></h1>
<?php endif; ?>

<form method="post" action="#">

    <select name="id">
        <?php foreach ($ids as $row): ?>
            <option
                value="<?php echo $row['id']; ?>"
                <?php if( intval($_id) === $row['id']) : ?>
                    selected="selected"
                <?php endif; ?>
            >
                <?php echo $row['corp']; ?>
            </option>
        <?php endforeach; ?>
    </select>

    <input type="submit" value="Submit" />
</form>




<?php if( isset($results) ): ?>

    <h2>Results found <?php echo count($results); ?></h2>
    <table border="1">
        <tbody>
        <?php foreach ($results as $row): ?>
            <tr>
                <td><?php echo $row['corp']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?php endif; ?>






</body>
</html>