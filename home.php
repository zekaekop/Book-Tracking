<?php 

include("base.php");

$query = $pdo->query("SELECT * FROM books");
$books = $query->fetchAll();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["book_request_submit"])) {
        $query = $pdo->prepare("UPDATE books SET requested_user_id = ? WHERE id = ?");
        $query->execute([$_SESSION["user"]["id"], $_POST["book_request_submit"]]);
    }

    if (isset($_POST["logout_submit"])) {
        logout_account();
    }
}
?>

<h1>Home page</h1>
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda distinctio cupiditate quibusdam iste magnam officia in maiores laboriosam obcaecati, quas repellat itaque, optio quidem. Incidunt dolorem cum reiciendis placeat fuga?</p>

<h2>Available books</h2>

<form method="POST" action="">
    <ul style="list-style-type: none;">
        <?php foreach($books as $book): ?>
            <li>
                <?= htmlspecialchars($book["title"]);?> 
                <button type="submit" name="book_request_submit" value="<?= $book["id"] ?>">Request</button>
            </li>
        <?php endforeach ?>
    </ul>

    <button type="submit" name="logout_submit">Logout</button>

</form>