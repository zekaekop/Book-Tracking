<?php

require_once __DIR__ . "/../src/template/base_top.php";

redirect_unauth_users();

require_once __DIR__ . "/../src/add_books.php";

?>

<form method="POST" action="">

    <input type="text" name="title" placeholder="Title" required>
    <br>
    <textarea name="desc" placeholder="Description" required></textarea>
    <br>
    <button type="submit" name="add_book_submit">Add Book</button>

</form>

<?php require_once __DIR__ . '/../src/template/base_bottom.php'; ?>