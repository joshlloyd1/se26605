<?php
/**
 * Created by PhpStorm.
 * User: 001386538
 * Date: 11/6/2017
 * Time: 10:16 AM
 */
session_start();
// login varification goes here
$_SESSION['username'] = "Clarkalex";
header('Location: foo.php');