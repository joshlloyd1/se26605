<?php
/**
 * Created by PhpStorm.
 * User: 001386538
 * Date: 11/13/2017
 * Time: 9:52 AM
 * LOG IN FUNCTIONS
 */
function LoginForm($email = "", $password = "") { // displays the login form
        $form = "<div style='position:relative; margin:auto; text-align:center; border:1px solid black; width:400px;'><section>
    <form method='post' action='index.php'>
        <h1>Log In</h1>
        <label for='email'>Email: </label><br>
                <input type='text' name='email' id = 'email' style='text-align:center;' value='$email'/><br>
        <label for='password'>Password: </label><br>
        <input type='password' name='password' id = 'password' style='text-align:center;' value='$password'/><br>

        <input type='hidden' name='action' value='submit' />
        <input type='submit' />
    </form></section></div>";
        return $form;

}
function NewUser($newpage) { // brings user to a new page based on what the $newpage variable supplied is
$form = "<div style='float:right'><form method='post' action='index.php' ";
$form .= "<input type='hidden' name='action' value='register' /><input type='submit' name='action' value='$newpage' style='height: 80px; width: 180px; font-size : 20px;'/></form></div>";
return $form;
}
function AddUser2($email = "", $password = "", $passwordRE = "") // Function that allows user to sort data through form
{
    $form = "<div style='position:relative; margin:auto; text-align:center; border:1px solid black; width:400px;'><section><form method='post' action='NewUser.php'>
        <h1>New User</h1>
        <label for='email'>Email: </label><br>
                <input type='text' name='email' id = 'email' style='text-align:center;' value='$email'/><br>
        <label for='password'>Password: </label><br>
        <input type='password' name='password' id = 'password' style='text-align:center;' value='$password'/><br>
        <label for='passwordRE'>Re enter Password: </label><br>
        <input type='password' name='passwordRE' id = 'passwordRE' style='text-align:center;' value='$passwordRE'/><br>

        <input type='hidden' name='action' value='submit' />
        <input type='submit' />
    </form></section></div>";
    return $form;
}
function StoreNewUser($db, $email, $password) { // adds a new user to the db
    $sql = $db->prepare("SELECT email FROM users WHERE email = :email");
    $sql->bindParam('email', $email);
    $sql->execute();
    $rows = $sql->rowCount();
    if($rows == 0) {
        //ADD USER SQL
        try {
            $date = new DateTime('now');
            $created = $date->format('Y-m-d H:i:s');

            $sql = $db->prepare("INSERT INTO users VALUES (null, :email, :password, :created)");
            $sql->bindParam(':email', $email);
            $sql->bindParam(':password', $password);
            $sql->bindParam(':created', $created);

            $sql->execute();

            if ($sql) {
                $str = "User entered successfully";
            }
        }catch (PDOException $e) {
            die("There was a problem adding the user");
        }
    }
    else {
        $str = "Email already has an account";
    }
    return $str;
}
function checkUser($db, $email, $password, $hash) { // checks if user is a real member of the db
     $sql = $db->prepare("SELECT * FROM users WHERE email = :email");
            $binds = array(
                ":email" => $email,
            );
        if($sql->execute($binds)) {
            $results = $sql->fetch(PDO::FETCH_ASSOC);
            $rows = $sql->rowCount();
            if ($rows == 1) {
                if (password_verify($password, $results['password'])) {
                    $user_id = $results['user_id'];
                    $bln = $user_id;
                } else {
                    $bln = -1;
                }
            } else {
                $bln = 0;
            }
        }
        else {
            $bln = -2;
        }
    return $bln;
}
