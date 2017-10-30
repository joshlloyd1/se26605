<?php
/**
 * Created by PhpStorm.
 * User: calexander
 * Date: 10/29/17
 * Time: 5:36 PM
 */
function getEmployees($db) {
    try {
        //$sql = "SELECT * FROM `employees`";
        $sql = "SELECT `employees`.`emp_id`, `departments`.`dept_name`, `employees`.`first_name`, `employees`.`last_name`, `employees`.`hire_date`, `employees`.`term_date`, `employees`.`salary`
FROM `departments`, `employees` WHERE `employees`.`dept_id` = `departments`.`dept_id`";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        die ("There was a problem getting the table of employees");
    }
    return $employees;
}
function  getEmployeesAsSortedTable($db, $col, $dir) {
    try {
        //$sql = "SELECT * FROM `employees`";
        $sql = "SELECT `employees`.`emp_id`, `departments`.`dept_name`, `employees`.`first_name`, `employees`.`last_name`, `employees`.`hire_date`, `employees`.`term_date`, `employees`.`salary`
FROM `departments`, `employees` WHERE `employees`.`dept_id` = `departments`.`dept_id` ORDER BY $col $dir";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        die ("There was a problem getting the table of employees");
    }
    return $employees;
}
