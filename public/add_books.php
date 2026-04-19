<?php

require_once __DIR__ . "/../src/template/base_top.php";

redirect_unauth_users();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["add_book_submit"])) {

        $title = $_POST["title"];
        $desc = $_POST["desc"];

        $query = $pdo->prepare("INSERT INTO books (`title`, `desc`, `added_by_user_id`) VALUES (?,?,?)");
        $query->execute([$title, $desc, $_SESSION["user"]["id"]]);
    }
}
?>

<form method="POST" action="">

    <input type="text" name="title" placeholder="Title" required>
    <br>
    <textarea name="desc" placeholder="Description" required></textarea>
    <br>
    <button type="submit" name="add_book_submit">Add Book</button>

</form>

<?php require_once __DIR__ . '/../src/template/base_bottom.php'; ?>