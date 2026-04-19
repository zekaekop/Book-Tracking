<?php

require_once __DIR__  . "/../src/template/base_top.php";

?>

<div class="container">
    <div>
        <h1>You must have or create an account or an anonymous account to procced</h1>
        <form action="" method="POST">
            <a href="login.php">Permanent Regular Account</a>
            <a href="anonymous_register.php">Temporary Anonymous Account</a>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../src/template/base_bottom.php' ?>