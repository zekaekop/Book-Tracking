
<?php

include("base.php");

redirect_unauth_users();

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

<button type="submit" name="logout_submit">Logout</button>