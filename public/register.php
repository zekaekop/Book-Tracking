<?php

require_once __DIR__ . "/../src/template/base_top.php";

require_once __DIR__  . "/../src/auth.php";

$register_status = "";
?>

<div class="container">

    <h1>Register page</h1>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda distinctio cupiditate quibusdam iste magnam officia in maiores laboriosam obcaecati, quas repellat itaque, optio quidem. Incidunt dolorem cum reiciendis placeat fuga?</p>

    <hr>

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
</div>

<?php require_once __DIR__ . '/../src/template/base_bottom.php' ?>