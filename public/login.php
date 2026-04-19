<?php

require_once __DIR__  . "/../src/template/base_top.php";

require_once __DIR__  . "/../src/auth.php";

$login_status = "";

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
    <h1>Login page</h1>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda distinctio cupiditate quibusdam iste magnam officia in maiores laboriosam obcaecati, quas repellat itaque, optio quidem. Incidunt dolorem cum reiciendis placeat fuga?</p>

    <hr>

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
            <!-- Fetches random books from the db, also this means it can show multiple books since its using rand() for every column, in a real production scenario this is very unlikely to show up. -->
            <div class="d-flex">
            <?php for($i = 0; $i < 5; $i++): 
                $query = $pdo->query("SELECT * FROM books ORDER BY RAND() LIMIT 5");
                $books = $query->fetchAll();
                ?>
                <div class="row ">
                    <ul style="list-style-type: none;">
                        <?php foreach($books as $book): ?>
                            <li class="d-flex <?= flip_compact_book_style($book["id"]) ?>">
                                <p><?= htmlspecialchars($book["title"]);?> </p>
                                <button class="ms-auto" type="submit" name="book_request_submit" value="<?= $book["id"] ?>">Details</button>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php endfor ?>
            </div>
        </form>
    </div>


</div>

<?php require_once __DIR__ . '/../src/template/base_bottom.php' ?>