<?php
/**
 * Created by PhpStorm.
 * User: 001386538
 * Date: 11/15/2017
 * Time: 9:42 AM
 */
include_once ('login.php'); // register page
include_once ('assets/dbconnect.php');

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? null;
$email = filter_input(INPUT_POST,'email', FILTER_SANITIZE_STRING) ?? "";
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING) ?? "";
$passwordRE = filter_input(INPUT_POST, 'passwordRE', FILTER_SANITIZE_STRING) ?? "";

$db = dbconnect();

switch ($action){
    default: // form that allows a user to register
        $newUser = NewUser('Log In');
        $newUser .= AddUser2();
        echo $newUser;
        break;
    case 'Log In': // if the login button is clicked it returns the user to the login page
        header('Location: index.php');
        break;
    case 'submit': // if submitt button is clicked it checks if credentials are real and either makes the new user or it doesn't
        if($password == $passwordRE) {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // checks for valid email
                $emailErr = "<h2>Invalid email format</h2>";
                echo AddUser2($email, $password, $passwordRE); // shows form again with origionally entered info so user doesn't have to start all over again
                echo $emailErr;
                $newUser = NewUser('Log In');
                echo $newUser;
            }
            else { // stores new user :)
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $users = StoreNewUser($db, $email, $hash);
                $newUser = NewUser('Log In');
                echo $newUser;
                echo AddUser2();
                echo "<h1>$users</h1>";
            }
        }
        else {
            echo AddUser2($email, $password, $passwordRE);
            echo "<h2>Passwords must match!</h2>";
        }
}