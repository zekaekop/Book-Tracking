<?php

include("base.php");

$login_status = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["login_submit"])) {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $query = $pdo->prepare("SELECT * FROM users WHERE username = ? AND email =?");
        $query->execute([$username, $email]);
        $user = $query->fetch();

        if (isset($user)){
            if (password_verify($password, $user['password'])) {
                $login_status = "User successfully";
                header("Location: home.php");
                exit();
            } else {
                $login_status = "Username or password does not match";
            }
        } else {
            $login_status = "User does not exist";
        }
    }
}
?>

<form method="POST">

    <p><?= htmlspecialchars($login_status) ?></p>

    <input type="text" name="username" placeholder="Username" required>
    <input type="text" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="login_submit">Login</button>

    <a href=""><small>Don't have an account?</small></a>

</form>