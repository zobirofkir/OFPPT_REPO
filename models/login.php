<?php
include "/home/voodoo/Desktop/user_data/connection/connection.php";



if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $login_user = $database->prepare("SELECT * FROM user WHERE email=:email");
    $login_user->bindParam(":email", $email);
    $login_user->execute();
    $user = $login_user->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password"])) {
        $loginSuccess = true;
        header("Location: home.php");
        } else {
        $loginSuccess = false;
        $errare = "Invalid credentials. Please try again.";
    }
}

// ini_set('display_errors', 1);
// error_reporting(E_ALL);
include "/home/voodoo/Desktop/user_data/views/login.html";
?>



