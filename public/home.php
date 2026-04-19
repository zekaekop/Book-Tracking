<?php 

require_once __DIR__ . "/../src/template/base_top.php";

redirect_unauth_users();

$query = $pdo->query("SELECT * FROM books");
$books = $query->fetchAll();

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     if (isset($_POST["book_request_submit"])) {
//         $query = $pdo->prepare("UPDATE books SET requested_user_id = ? WHERE id = ?");
//         $query->execute([$_SESSION["user"]["id"], $_POST["book_request_submit"]]);
//     }
// }

?>

<!-- 
Difference between home and books is, home will be simplistic only showing a certain amount of books or popular ones.
And books.php will allow a more advanced way of using the site with searches filters statistics etc.
-->

<div class="container">
    <h1>Home page</h1>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda distinctio cupiditate quibusdam iste magnam officia in maiores laboriosam obcaecati, quas repellat itaque, optio quidem. Incidunt dolorem cum reiciendis placeat fuga?</p>

    <form action="" method="POST">
        <button type="submit">Im feeling lucky</button>
    </form>

    <!-- use fact api to fetch facts -->
    <small>Fun Fact: <?php htmlspecialchars("fact");?> </small>

    <hr>

    <h2>Available books</h2>

    <form method="POST" action="">
        <ul style="list-style-type: none;">
            <?php foreach($books as $book): ?>
                <li>
                    <?= htmlspecialchars($book["title"]);?> 
                    <button type="submit" name="book_request_submit" value="<?= $book["id"] ?>">Detail</button>
                </li>
            <?php endforeach ?>
        </ul>
    </form>
</div>
<?php require_once __DIR__ . '/../src/template/base_bottom.php' ?>