<?php

require_once __DIR__ . "/../src/template/base_top.php";

redirect_unauth_users();

require_once __DIR__ . "/../src/add_books.php";

?>

<div class="container">

    <div class="book-card mb-4">

    <div class="background-shadow-shade">
        <h1>Add Books</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda distinctio cupiditate quibusdam iste magnam officia in maiores laboriosam obcaecati, quas repellat itaque, optio quidem. Incidunt dolorem cum reiciendis placeat fuga?</p>
    </div>

    <hr>

    <form method="POST" action="">

        <input type="text" name="title" placeholder="Title" required>
        <br>
        <textarea name="desc" placeholder="Description" required></textarea>
        <br>
        <button class="btn btn-primary-custom" type="submit" name="add_book_submit">Add Book</button>

    </form>

    </div>
</div>

<?php require_once __DIR__ . '/../src/template/base_bottom.php'; ?>