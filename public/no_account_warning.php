<?php

require_once __DIR__  . "/../src/template/base_top.php";

redirect_auth_users();

?>

<div class="container">
    <div class="book-card mb-4">
        <div class="background-shadow-shade w-100">
            <h2>You must have or create an account or an anonymous account to procced</h2>
            <form action="" method="POST">
                <a href="login.php" class="btn btn-primary-custom">Permanent Regular Account</a>
                <a href="anonymous_register.php" class="btn btn-primary-custom">Temporary Anonymous Account</a>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../src/template/base_bottom.php' ?>