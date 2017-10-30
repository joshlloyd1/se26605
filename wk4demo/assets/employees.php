<?php
/**
 * Created by PhpStorm.
 * User: calexander
 * Date: 10/29/17
 * Time: 5:36 PM
 */
function getEmployees($db) {
    try {
        $sql = "SELECT * FROM `employees`";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die ("There was a problem getting the table of employees");
    }
    return $employees;
}