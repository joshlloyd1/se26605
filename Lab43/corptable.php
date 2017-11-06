<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11/3/2017
 * Time: 11:29 AM
 */
function getCorpsAsTable($db, $corps, $cols = null, $sortable = false) { // function that allows user to get table from db
    $table = "";
    if ( count($corps) > 0 ):
        $table .= "<table>" . PHP_EOL;
        if ($cols && !$sortable):
            $table .= "\t<tr>";
            foreach ($cols as $col) {
                $table .= "<th>$col</th>"; // build column headers as anchors, indicating sort=asc&col=colname
            }
            $table .= "</tr>" . PHP_EOL;
        endif;
        if ($cols && $sortable):
            $dir = "ASC";
            $table .= "\t<tr>";
            foreach ($cols as $col) {
                $href="?action=sort&col=$col&dir=$dir";
                $table .= "<th><a href='$href'>$col</a></th>"; // build column headers as anchors, indicating sort=asc&col=colname
            }
            $table .= "</tr>" . PHP_EOL;
        endif;
        $delete = "delete";
        $update = "update";
        $read = "read";
        foreach ($corps as $corp):
            $table .= "\t<tr>";
            $table .= "<td>" . $corp['id'] . "</td>";
            $table .= "<td>" . $corp['corp'] . "</td>";
            $table .= "<td>" . date('m/d/Y', strtotime($corp['incorp_dt']) ) . "</td>";
            $table .= "<td>" . $corp['email'] . "</td>";
            $table .= "<td>" . $corp['zipcode'] . "</td>";
            $table .= "<td>" . $corp['owner'] . "</td>";
            $table .= "<td>" . $corp['phone'] . "</td>";
            $table .= "<td>" . "<a href='delete.php?id=". $corp['id'] . "&action=Delete'>Delete</a></td>";
            $table .= "<td>" . "<a href='update.php?id=". $corp["id"] . "&action=Update'>Update</a></td>";
            $table .= "<td>" . "<a href='read2.php?id=". $corp["id"] ."&action=Read'>Read</a></td>";


            $table .= "<td>";
            $table .= "</td>";
            $table .= "</tr>" . PHP_EOL;
        endforeach;
        $table .= "</table>" . PHP_EOL;
        return $table;
    else :
        return "<section>We have no employees to display</section>";
    endif;
}
function getCorps($db) { // gets corps normally
    try {
        $sql = "SELECT * FROM corps";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $corps = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die ("There was a problem getting the table of employees to get employees");
    }
    return $corps;
}
function getonerow($db, $col, $term) { // gets one row from search case
    if($col != "id") {
        $sql = "SELECT * FROM corps WHERE $col LIKE '%$term%'";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $corps = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $corps;
    }
    if($col == "id") {
        $sql = "SELECT * FROM corps WHERE $col =$term";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $corps = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $corps;
    }
}
function getCorpsAsSortedTable($db, $col, $dir){ // sorts corps from sort case
    try {
        $sql = "SELECT * FROM corps ORDER BY $col $dir";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $corps = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die ("There was a problem getting the table of employees to sort employees");
    }
    return $corps;
}
