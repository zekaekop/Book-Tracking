<?php

include("base_top.php");

$login_status = "";

$query = $pdo->query("SELECT * FROM books");
$books = $query->fetchAll();

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
                $_SESSION["user"] = $user;
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

# 5 is the size that fits max container size
$display_size_book_column_limit = 5;

function flip_compact_book_style($i) {
    return $i % 2 ? "compact_book_gray" : "compact_book_dark_gray";
}

// if (empty($_SESSION['token'])) {
//     $_SESSION['token'] = bin2hex(random_bytes(32));
// }
// $token = $_SESSION['token'];

?>

<div class="container">
    <div class="d-flex justify-content-between">
        <div class="row">
            <form method="POST">

                <!-- Status -->
                <p><?= htmlspecialchars($login_status) ?></p>

                <!-- Login -->
                <input type="text" name="username" placeholder="Username" required>
                <br>
                <input type="text" name="email" placeholder="Email" required>
                <br>
                <input type="password" name="password" placeholder="Password" required>
                <br>
                <button type="submit" name="login_submit">Login</button>

                <a href="register.php"><small>Don't have an account?</small></a>

                <a href="info.php"><small>info</small></a>

                <!-- Anon -->
                <div class="container">
                    <div class="">
                        <p>Request a book without an account</p>
                        <button>Request a book</button>
                    </div>
                </div>

            </form>
        </div>
        <form method="POST" action="">
            <div class="d-flex">
            <?php for($i = 0; $i < 5; $i++): ?>
                <div class="row ">
                    <ul style="list-style-type: none;">
                        <?php foreach($books as $book): ?>
                            <li class="d-flex <?= flip_compact_book_style($book["id"]) ?>">
                                <p><?= htmlspecialchars($book["title"]);?> </p>
                                <button class="ms-auto" type="submit" name="book_request_submit" value="<?= $book["id"] ?>">Request</button>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php endfor ?>
            </div>
        </form>
    </div>


</div>

<?php include("base_bottom.php"); ?>