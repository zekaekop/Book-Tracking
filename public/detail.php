
<?php 

require_once __DIR__ . "/../src/template/base_top.php";

redirect_unauth_users();

$can_request = false;

$query = $pdo->prepare("SELECT 
                                            b.id as book_id,
                                            b.title,
                                            b.desc,
                                            b.status,
                                            b.requested_user_id,
                                            ureq.username AS requested_username,
                                            u.username,
                                            ct.name AS category_name
                                            FROM books b
                                            JOIN users u ON b.added_by_user_id = u.id 
                                            LEFT JOIN users ureq ON b.requested_user_id = ureq.id
                                            LEFT JOIN categories ct ON b.id_category = ct.id
                                            WHERE b.id = ?");

$query->execute([$_GET["book"]]);
$book = $query->fetch(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["book_request_submit"])) {
        $query = $pdo->prepare("UPDATE books SET requested_user_id = ? WHERE id = ?");
        $query->execute([$_SESSION["user"]["id"], $_POST["book_request_submit"]]);

        // Refresh site
        $book_id = $book["book_id"];
        header("Location: detail.php?book=$book_id");
        exit();
    }

    if (isset($_POST["book_unrequest_submit"])) {
        $query = $pdo->prepare("UPDATE books SET requested_user_id = ? WHERE id = ?");
        $query->execute([null, $_POST["book_unrequest_submit"]]);

        // Refresh site
        $book_id = $book["book_id"];
        header("Location: detail.php?book=$book_id");
        exit();
    }

    // Updates category and the status of the book
    if (isset($_POST["book_status_update_submit"])) {

        if ($_POST["status_checkbox"]) {
            $_POST["status_checkbox"] = "available";
        } else {
            $_POST["status_checkbox"] = "unavailable";
        }

        $query_category = $pdo->prepare("UPDATE books SET id_category = ? WHERE id = ?");
        $query_category->execute([$_POST["category_select"], $_POST["book_status_update_submit"]]);

        $query = $pdo->prepare("UPDATE books SET status = ? WHERE id = ?");
        $query->execute([$_POST["status_checkbox"], $_POST["book_status_update_submit"]]);

        // Refresh site
        $book_id = $book["book_id"];
        header("Location: detail.php?book=$book_id");
        exit();
    }

    if (isset($_POST["book_remove_submit"])) {
        $query = $pdo->prepare("DELETE FROM books WHERE id = ?");
        $query->execute([$_POST["book_remove_submit"]]);

        header("Location: books.php");
        exit();
    }
}
?>

<!-- 
Difference between home and books is, home will be simplistic only showing a certain amount of books or popular ones.
And books.php will allow a more advanced way of using the site with searches filters statistics etc.
-->

<div class="container">
    <h1>Browse Books</h1>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda distinctio cupiditate quibusdam iste magnam officia in maiores laboriosam obcaecati, quas repellat itaque, optio quidem. Incidunt dolorem cum reiciendis placeat fuga?</p>

    <hr>

    <h2>Book Information</h2>

    <hr>

    <form method="POST" action="">
        <li class="compact_book_gray mb-3">
            <h3>Title: <?= htmlspecialchars($book["title"]);?></h3>
            <h4>Description: <?= htmlspecialchars($book["desc"]);?></h4>
            <h4>Book ID: <?= htmlspecialchars($book["book_id"]);?></h4>

            <!-- If the book owner is the user -->
            <?php if ($_SESSION["user"]["username"] == $book["username"]): ?>

                <!-- He has access to changing availablity and category -->
                <h4>Status: <input type="checkbox" value="status_check" name="status_checkbox"
                <?php if ($book["status"] == "available"): ?>
                    checked
                <?php endif ?>
                ><?= htmlspecialchars($book["status"]);?></h4>


                <label for="categories_select">Choose a Category:</label>
                <select name="category_select">
                    <?php 
                    $query = $pdo->query("SELECT * FROM categories");
                    $categories = $query->fetchAll();

                    foreach ($categories as $category): ?>

                        <!-- Selected becomes default for the value it has in books -->
                        <option 
                        <?php if ($category["name"] == $book["category_name"]): ?>
                            selected
                        <?php endif ?>
                        
                        value="<?= $category["id"]; ?>"
                        ><?= htmlspecialchars($category["name"]); ?></option>
                    <?php endforeach ?>
                </select> 

            <?php else: ?>
                <h4>Status: <?= htmlspecialchars($book["status"]);?></h4>
            <?php endif ?>

            <h4>Requested By: 
            <?php     
            if ($book["requested_user_id"]) {
                $can_request = false;
                echo htmlspecialchars($book["requested_username"]);
            } else {
                $can_request = true;
                echo "No one";
            } 
            ?>
            </h4>
            
            <h4>Added By: <?= htmlspecialchars($book["username"]);?></h4>

            <h4>Category: <?= htmlspecialchars($book["category_name"]);?></h4>

            <?php if ($book["status"] == "available"): ?>
                <?php if ($can_request && $_SESSION["user"]["username"] != $book["username"]): ?>   
                <button type="submit" 
                                name="book_request_submit" 
                                value="<?= $book["book_id"] ?>"
                                class="ms-auto">Request</button>
                <?php elseif ($_SESSION["user"]["username"] != $book["username"]): ?>
                <button type="submit" 
                                name="book_unrequest_submit" 
                                value="<?= $book["book_id"] ?>"
                                class="ms-auto">Remove Request</button>
                <?php else: ?>
                <button class="ms-auto" value="<?= $book["book_id"] ?>" name="book_remove_submit">Remove Book</button>
                <button class="ms-auto" value="<?= $book["book_id"] ?>" name="book_status_update_submit">Apply Status</button>
                <?php endif ?>
            <?php else: ?>
                                <button type="submit" 
                                name="book_unrequest_submit" 
                                value="<?= $book["book_id"] ?>"
                                class="ms-auto">The book is unavailable</button>
            <?php endif ?>
        </li>
    </form>

</div>

<?php require_once __DIR__ . '/../src/template/base_bottom.php'; ?>