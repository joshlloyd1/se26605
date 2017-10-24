<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 10/23/2017
 * Time: 8:13 PM
 */

include_once './dbconnect.php';
include_once './functions.php';

$db = dbconnect();
/*
$id = filter_input(INPUT_POST, 'i-d');
$corp = filter_input(INPUT_POST, 'corp');
$incorp_dt = filter_input(INPUT_POST, 'incorp_dt');
$email = filter_input(INPUT_POST, 'email');
$zipcode = filter_input(INPUT_POST, 'zipcode');
$owner = filter_input(INPUT_POST, 'owner');
$phone = filter_input(INPUT_POST, 'phone');
*/
$stmt = $db->prepare("SELECT * FROM corp WHERE id = :id");
$results = array();
$stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);


$table = "<table>";
$table .= "<td>" . $results['id'] . "</td><td>" . $results['corp'] ."</td><td>" . $results['incorp_dt'] . "</td><td>" .$results['email'] ."</td><td>" .$results['zipcode'] ."</td><td>" . $results['owner'] ."</td><td>" . $results['phone'] . "</td>";
$table .= "</table>";
?>