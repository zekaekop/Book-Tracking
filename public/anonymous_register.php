<?php

require_once __DIR__ . "/../src/template/base_top.php";

redirect_auth_users();

require_once __DIR__  . "/../src/auth.php";

$register_status = "";
?>

<div class="container">
    <div class="book-card mb-4">

        <div  class="background-shadow-shade">
            <h1>Register page</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda distinctio cupiditate quibusdam iste magnam officia in maiores laboriosam obcaecati, quas repellat itaque, optio quidem. Incidunt dolorem cum reiciendis placeat fuga?</p>
        </div>
        
        <hr>

        <div class="background-shadow-shade w-100">
            <h3>Anonymous Account Information</h3>
            <ul >
                <li>Display Username</li>
                <li>IP ADDR</li>
                <li>Account ID</li>
                <li>Last seen date and time</li>
                <li>Joined date and time</li>
                <li>Account expiry date</li>
            </ul>
        </div>

        <form method="POST">

            <p><?= htmlspecialchars($register_status) ?></p>

            <input type="text" name="display_username" placeholder="Display Username" required>
            <button type="submit" name="anon_register_submit" class="btn btn-primary-custom">Register</button>

            <br>

            <a href="login.php"><small>Want an permanent account?</small></a>

        </form>

    </div>
</div>

<?php require_once __DIR__ . '/../src/template/base_bottom.php' ?>