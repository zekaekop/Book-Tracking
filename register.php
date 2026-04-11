<?php

include("base.php");

$register_status = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["register_submit"])) {
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
}
?>

<form method="POST">

    <p><?= htmlspecialchars($register_status) ?></p>

    <input type="text" name="username" placeholder="Username" required>
    <input type="text" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="password" name="repeat_password" placeholder="Repeat Password" required>
    <button type="submit" name="register_submit">Register</button>

</form>