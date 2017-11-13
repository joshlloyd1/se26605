<?php
/**
 * Created by PhpStorm.
 * User: 001386538
 * Date: 11/6/2017
 * Time: 11:06 AM
 */
function siteForm() { // Function to add site, uses method=get to send site url entered into url
    $form = "<section><form method='get' acion='add.php'>
            Site URL: <input type='text' name='url' id='url'>
            <input type='submit' name='action' value='submit'>";
    $form .= "</form></section>";
    return $form;
}
function AddToSitesTable($db){ // function to add site to site table
    $site = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_STRING) ?? ""; // grabs url from url

    $date = new DateTime('now'); // gets date entered as x-xx-xxxx
        $dayAdded = $date->format('Y-m-d H:i:s');
        $sql = $db->prepare("INSERT INTO sites VALUES (null , :site, :dayAdded)"); //adds to the table
        $sql->bindParam(':site', $site);
        $sql->bindParam(':dayAdded', $dayAdded);

        $sql->execute();

        $site_id = $db->lastInsertId(); // grabs the id of site entered to be used at a later date
        return $site_id;
}
function isSiteAlreadyAdded($db, $site) { // checks if site is already entered
    $sql = $db->prepare("SELECT site FROM sites WHERE site = :site");
    $sql->bindParam('site', $site);
    $sql->execute();
    $rows = $sql->rowCount(); // if row count is 0 than site must not be in site, but if it is entered than function returns false
    if($rows == 0) {
        $in = true;
    }
    else {
        $in = false;
    }
    return $in;
}
function addSiteLinks($db, $link, $site_id) { // function to add the site links
    $sql = $db->prepare("SELECT link FROM sitelinks WHERE site_id = :site_id AND link = :link"); // grabs site links to check if link is in db yet or not
    $sql->bindParam('site_id', $site_id);
    $sql->bindParam('link', $link);
    $sql->execute();
    $rows = $sql->rowCount();
    if($rows == 0) { // if not entered in yet... ENTER IT
        $sql = $db->prepare("INSERT INTO sitelinks VALUES (:site_id, :link)");
        $sql->bindParam(':site_id', $site_id);
        $sql->bindParam(':link', $link);

        $sql->execute();
    }
}
function countRows($db, $site_id) {
    $sql= $db->prepare("SELECT * FROM sitelinks WHERE site_id = :site_id"); // function to count rows of info entered in sitelink db
    $sql->bindParam(':site_id', $site_id);
    $sql->execute();
    $rows = $sql->rowCount();

    return $rows;
}
function getSavedSited($db) { // grabs saved sites in db
    require_once ('assets/until.php');


    $sql = $db->prepare("SELECT * FROM sites ORDER BY site_id DESC");
    $sites = array();
    if ($sql->execute() && $sql->rowCount() > 0) {
        $sites = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    $site_id = '';

if( isPostRequest() ) { // when user clicks submit it grabs the postback

    $sql = $db->prepare("SELECT * FROM sitelinks WHERE site_id = :site_id");
    $site_id = filter_input(INPUT_POST, 'site_id');
    $binds = array(
        ":site_id" => $site_id
    );
    if ($sql->execute($binds) && $sql->rowCount() > 0) {
        $results = $sql->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $error = 'No Results found';
    }
}

?>
<?php if( isset($error) ): ?>
    <h1><?php echo $error;?></h1>
<?php endif; ?>

<form method="post" action="#">

    <select name="site_id">
        <?php foreach ($sites as $row): ?>
            <option
                value="<?php echo $row['site_id']; ?>"
                <?php if( intval($site_id) === $row['site_id']) : ?>
                    selected="selected"
                <?php endif; ?>
            >
                <?php
                $time = strtotime($row['date']);
                $newformat = date('m-d-Y',$time); // outputs the sites as a Drop down list and also shows date they were enteed
                echo $row['site'] . "&nbspInserted: " . $newformat; ?>
            </option>
        <?php endforeach; ?>
    </select>

    <input type="submit" value="Submit" />
</form>

<?php if( isset($results) ): ?>

        <h2>Results found: <?php echo count($results); ?> </h2>
    <table border="1">
        <tbody>
        <?php foreach ($results as $row): ?>
            <tr>
                <td><a href=<?php echo $row['link']?> target="popup"><?php echo $row['link']?></td>
            </tr>

        <?php // shows all links entered as a link to a pop up new window in browser.
        endforeach; ?>
        </tbody>
    </table>

<?php endif;
}