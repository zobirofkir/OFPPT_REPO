<?php

session_start();
include "/home/voodoo/Desktop/user_data/connection/connection.php";


if (isset($_POST["register"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $retype_password = $_POST["retype_password"];
    $birth = $_POST["birth"];

    $check_email = $database->prepare("SELECT COUNT(*) FROM user WHERE email=:email");
    $check_email->bindParam(":email", $email);
    $check_email->execute();
    $check_count = $check_email->fetchColumn();

    $_SESSION["name"] = $username;

    if ($check_count > 0) {
        $err_email = "This email already exists.";
    } elseif ($password !== $retype_password) {
        $error = "Invalid password.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $create_user = $database->prepare("INSERT INTO user(username, email, password, birth) VALUES (:username, :email, :password, :birth)");
        $create_user->bindParam(":username", $username);
        $create_user->bindParam(":email", $email);
        $create_user->bindParam(":password", $hashedPassword); // Store the hashed password
        $create_user->bindParam(":birth", $birth);
        $create_user->execute();
        header("Location: login.php");
        exit();
    }

}

include "/home/voodoo/Desktop/user_data/views/register.html";
?>
