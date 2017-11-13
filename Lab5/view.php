<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Site Search</title>
</head>

<?php
/**
 * Created by PhpStorm.
 * User: 001386538
 * Date: 11/8/2017
 * Time: 9:41 AM
 */
include_once ('assets/header.php');
include_once ('assets/dbconnect.php');
include_once ('sites.php');
$db = dbconnect(); // view page that shows the previously entered in sites in database

$site = getSavedSited($db);
echo $site;

?>