<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["login_submit"])) login($pdo);
    if (isset($_POST["register_submit"])) register($pdo);
    if (isset($_POST["anon_register_submit"])) register_anon($pdo);
}

function login($pdo) {
    global $login_status;

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = $pdo->prepare("SELECT * FROM users WHERE username = ? AND email =?");
    $query->execute([$username, $email]);
    $user = $query->fetch();

    if (!empty($user)){
        if (password_verify($password, $user['password'])) {
            $login_status = "User successfully";
            $_SESSION["user"] = $user;
            header("Location: home.php");
            exit();
        } else {
            $login_status = "Username or password does not match";
        }
    } else {
        $login_status = "User or Email does not exist";
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

function register_anon($pdo) {
    $username = $_POST["display_username"];

    // Source - https://stackoverflow.com/a/19189952
    // Posted by Michael
    // Retrieved 2026-04-19, License - CC BY-SA 3.0

    $ip = getenv('HTTP_CLIENT_IP')?:
    getenv('HTTP_X_FORWARDED_FOR')?:
    getenv('HTTP_X_FORWARDED')?:
    getenv('HTTP_FORWARDED_FOR')?:
    getenv('HTTP_FORWARDED')?:
    getenv('REMOTE_ADDR');


    $query = $pdo->prepare("SELECT * FROM users WHERE username = ? AND ip_addr = ?");
    $query->execute([$username]);
    $anon = $query->fetch();

    if (empty($anon)) {
        // this gets the current time
        $current_joined_time = date_default_timezone_set();

        $query = $pdo->prepare("INSERT INTO users (username, joined_datetime) VALUES (?,?)");
        $query->execute([$username, $current_joined_time]);

        $register_status = "Successfully registered an anon account";

        $_SESSION["anon"] = $anon;
        header("Location: home.php");
        exit();
    } else {

        $register_status = "Successfully registered on an existing anon account";

        $_SESSION["anon"] = $anon;
        header("Location: home.php");
        exit();
    }
}

?>