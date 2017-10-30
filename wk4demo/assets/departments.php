<?php
/**
 * Created by PhpStorm.
 * User: 001386538
 * Date: 10/30/2017
 * Time: 9:29 AM
 */
function getDept($db) {
    $sql = "SELECT * FROM departments";
    $stmt = $db->prepare($sql);
    $stmt ->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}