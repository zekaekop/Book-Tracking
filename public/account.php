
<?php

require_once __DIR__ . "/../src/template/base_top.php";

redirect_unauth_users();

// Source - https://stackoverflow.com/a/19189952
// Posted by Michael
// Retrieved 2026-04-15, License - CC BY-SA 3.0

// $ip = getenv('HTTP_CLIENT_IP')?:
// getenv('HTTP_X_FORWARDED_FOR')?:
// getenv('HTTP_X_FORWARDED')?:
// getenv('HTTP_FORWARDED_FOR')?:
// getenv('HTTP_FORWARDED')?:
// getenv('REMOTE_ADDR');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["logout_submit"])) {
        logout_account();
    }
}
?>

<h1>Welcome <?= htmlspecialchars($_SESSION["user"]["username"]); ?></h1>

<hr>

<h3>User Info</h3>

<table>
    <thead>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Password</th>
        </tr>
    </thead>
    <tr>
        <td><?= htmlspecialchars($_SESSION["user"]["username"]); ?></td>
        <td><?= htmlspecialchars($_SESSION["user"]["email"]); ?></td>

        <!-- its best not to display passwords, but its usefull if in the feature email account creation is added -->
        <!-- users could see if they made their account with a password or email sign in -->
        <td>******</td>
    </tr>
</table>

<form method="POST" action="">
<button type="submit" name="logout_submit">Logout</button>
</form>

<?php require_once __DIR__ . '/../src/template/base_bottom.php'; ?>