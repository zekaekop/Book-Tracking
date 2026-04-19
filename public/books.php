
<?php 

require_once __DIR__ . "/../src/template/base_top.php";

redirect_unauth_users();

$query_popular = $pdo->query("SELECT * FROM books    LIMIT 10");
$books_popular = $query_popular->fetchAll();

$query_recent = $pdo->query("SELECT * FROM books LIMIT 10");
$books_recent = $query_recent->fetchAll();

$query_request = $pdo->query("SELECT * FROM books LIMIT 10");
$books_requests = $query_request->fetchAll();

$books = array(
    "most popular" => $books_popular,
    "most recent" => $books_recent,
    "most requests" => $books_requests,
);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["book_request_submit"])) {
        $query = $pdo->prepare("UPDATE books SET requested_user_id = ? WHERE id = ?");
        $query->execute([$_SESSION["user"]["id"], $_POST["book_request_submit"]]);
    }
}
?>

<!-- 
Difference between home and books is, home will be simplistic only showing a certain amount of books or popular ones.
And books.php will allow a more advanced way of using the site with searches filters statistics etc.
-->

<h1>Book listing page</h1>
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda distinctio cupiditate quibusdam iste magnam officia in maiores laboriosam obcaecati, quas repellat itaque, optio quidem. Incidunt dolorem cum reiciendis placeat fuga?</p>

<hr>

<h2>Available books</h2>

<form method="POST" action="">

    <!-- most popular -->
    <ul style="list-style-type: none;">
        <?php 
        foreach($books["most popular"] as $book) {
            include("book_individual.php");
        }
        ?>
    </ul>

    <!-- most recent -->
    <ul style="list-style-type: none;">
        <?php foreach($books["most recent"] as $book) {
            include("book_individual.php");
        }
        ?>
    </ul>

    <!-- most requests -->
    <ul style="list-style-type: none;">
        <?php foreach($books["most requests"] as $book)  {
            include("book_individual.php");
        }
        ?>
    </ul>
</form>

<?php require_once __DIR__ . '/../src/template/base_bottom.php'; ?>