
<?php 

require_once __DIR__ . "/../src/template/base_top.php";

redirect_unauth_users();

function flip_compact_book_style($i) {
    return $i % 2 ? "compact_book_gray" : "compact_book_dark_gray";
}

$query = $pdo->query("SELECT * FROM books");
$books = $query->fetchAll();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["book_request_submit"])) {
        $query = $pdo->prepare("UPDATE books SET requested_user_id = ? WHERE id = ?");
        $query->execute([$_SESSION["user"]["id"], $_POST["book_request_submit"]]);
    }
    if (isset($_POST["book_detail_submit"])) {
        $book_id = $_POST["book_detail_submit"];
        header("Location: detail.php?book=$book_id");
        exit();
     }
}
?>

<!-- 
Difference between home and books is, home will be simplistic only showing a certain amount of books or popular ones.
And books.php will allow a more advanced way of using the site with searches filters statistics etc.
-->

<div class="container">
    <div class="book-card mb-4">

        <div class="background-shadow-shade">
            <h1>Browse Books</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda distinctio cupiditate quibusdam iste magnam officia in maiores laboriosam obcaecati, quas repellat itaque, optio quidem. Incidunt dolorem cum reiciendis placeat fuga?</p>
        </div>

        <hr>

        <h2>Available books</h2>

        <hr>

            <form method="POST" action="">
            <ul style="list-style-type: none;" class="p-0">
                <?php 
                foreach($books as $book) {
                    include("book_individual.php");
                }
                ?>
            </ul>
        </form>
        
    </div>
</div>

<?php require_once __DIR__ . '/../src/template/base_bottom.php'; ?>