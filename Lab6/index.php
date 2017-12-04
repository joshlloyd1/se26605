<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LogIn</title>
</head>
<body>
<?php
session_start(); // LOG IN PAGE
$_SESSION['pageload'] = 0; // resets session variables
$_SESSION['currentTotal'] = 0;
$_SESSION['noofins'] = 0;

unset($_SESSION['cartItems']);
include_once('login.php');
include_once('assets/dbconnect.php');

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$passwordPre = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

$db = dbconnect();
switch($action) {
    case 'submit': // if submit button is clicked
        $hash = password_hash($passwordPre, PASSWORD_DEFAULT); // hashes password
        $valid = checkUser($db, $email, $passwordPre, $hash); // function to check user and brings back a number based on if their real of not
       // echo "<script>alert(' . $valid .')</script>";

        if($valid > 0) { // if number is a user id than brings them to admin page
            $_SESSION['username'] = $valid;
            $_SESSION['access'] = true;
            header('Location: AdminPage.php');
        }
        if($valid == -1) { // if -1 is returned then that means incorrect password supplied
            $_SESSION['access'] = false;
            $form = NewUser("Register");
            $form .= LoginForm($email, $passwordPre);
            echo $form;
            echo "<h3 style='text-align: center'>Incorrect Password</h3>";
        }
        if($valid == 0) { // if 0 is returned than that means the user doesn't exist
            $_SESSION['access'] = false;
            $form = NewUser("Register");
            $form .= LoginForm($email, $passwordPre);
            echo $form;
            echo "<h3 style='text-align: center'>User doesn't exist</h3>";
        }
        if($valid == -2) { // is -2 is returned than the problem is there was a problem getting into the db itself
            $_SESSION['access'] = false;
            $form = NewUser("Register");
            $form .= LoginForm($email, $passwordPre);
            echo $form;
            echo "<h3 style='text-align: center'>We had a problem getting into the database</h3>";
        }

        break;
    case 'Register': // if register button is clicked, brings user to the register page
        header('Location: NewUser.php');
        break;
    default: // default page displays login for and register button
        $_SESSION['access'] = false;
        $newpage = "Register";
        $form = NewUser($newpage);
        $form .= LoginForm();
        echo $form;
        break;
}
?>
</body>
</html>