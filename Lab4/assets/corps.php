<?php
/**
 * Created by PhpStorm.
 * User: 001386538
 * Date: 10/30/2017
 * Time: 10:13 AM
 */

function getCorps($db) {
    try {
        $sql = "SELECT * FROM corps";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $corps = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $corps;
    }catch (PDOException $e) {
        die("There was a problem getting the corps");
    }
}
function getCorpsAsTable($db, $corps) {
    $table = "";
    if(count($corps) > 0) {
        $table .= "<table border='1'>" . PHP_EOL;
        foreach ($corps as $corp) {
            $table .= "<tr>";
                $table .= "<td>" . $corp['id'] . "</td>";
                $table .= "<td>" . $corp['corp'] . "</td>";
                $table .= "<td>" . date('m/d/Y', strtotime($corp['incorp_dt'])) . "</td>";
                $table .= "<td>" . $corp['email'] . "</td>";
                $table .= "<td>" . $corp['zipcode'] . "</td>";
                $table .= "<td>" . $corp['owner'] . "</td>";
                $table .= "<td>" . $corp['phone'] . "</td>";
            $table .= "</tr>";
        }
        $table .= "</table>";
        return $table;
    }
    else {
        return "<section>There are no corps to display</section>";
    }
}
/*function CorpForm($depts) {
    $form = "<form>" . PHP_EOL;
    $form .= "<select name='deptID'>" . PHP_EOL;
    foreach ($depts as $dept) {
        $form .= "<option value='" . $dept['dept_id']. "'>";
        $form .= $dept['dept_name'] . "</option>";
    }
    $form .= "</select>";
    $form .= "</form>";
    return $form;
}*/
function  getCorpsAsSortedTable($db, $col, $dir) {
    try {
        //$sql = "SELECT * FROM `employees`";
        $sql = "SELECT `corps`.`id`, `corps`.`corp`, `corps`.`incorp_dt`, `corps`.`email`, `corps`.`zipcode`, `corps`.`owner`, `corps`.`phone` FROM `corps`
        ORDER BY $col $dir";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die ("There was a problem getting the table of employees");
    }
    return $employees;
}