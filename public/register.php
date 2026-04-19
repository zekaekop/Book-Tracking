<?php

require_once __DIR__ . "/../src/template/base_top.php";

require_once __DIR__  . "/../src/auth.php";

$register_status = "";
?>

<form method="POST">

    <p><?= htmlspecialchars($register_status) ?></p>

    <input type="text" name="username" placeholder="Username" required>
    <br>
    <input type="text" name="email" placeholder="Email" required>
    <br>
    <input type="password" name="password" placeholder="Password" required>
    <br>
    <input type="password" name="repeat_password" placeholder="Repeat Password" required>
    <br>
    <button type="submit" name="register_submit">Register</button>

    <a href="login.php"><small>have an account?</small></a>

</form>