<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    switch (isset($_POST)) {
        case "login_submit":
            login($pdo);
            break;
        case "register_submit":
            register($pdo);
            break;
    }
}

function login($pdo) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = $pdo->prepare("SELECT * FROM users WHERE username = ? AND email =?");
    $query->execute([$username, $email]);
    $user = $query->fetch();

    if (isset($user)){
        if (password_verify($password, $user['password'])) {
            $login_status = "User successfully";
            $_SESSION["user"] = $user;
            header("Location: home.php");
            exit();
        } else {
            $login_status = "Username or password does not match";
        }
    } else {
        $login_status = "User does not exist";
    }
}

function register($pdo) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $repeat_password = $_POST["repeat_password"];

    $query = $pdo->prepare("SELECT * FROM users WHERE username = ? AND email = ?");
    $query->execute([$username, $email]);
    $user = $query->fetch();

    if (empty($user)) {
        if ($password == $repeat_password) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $query = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?,?,?)");
            $query->execute([$username, $email, $hashed_password]);

            $register_status = "Successfully registered an account";
            header("Location: login.php");
            exit();
        } else {
            $register_status = "Passwords to do not match";
        }
    } else {
        $register_status = "Unavailable username or email";
    }
}

?>