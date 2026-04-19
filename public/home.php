<?php 

require_once __DIR__ . "/../src/template/base_top.php";

redirect_unauth_users();

function flip_compact_book_style($i) {
    return $i % 2 ? "compact_book_gray" : "compact_book_dark_gray";
}

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

<div class="container">
    <h1>Home page</h1>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda distinctio cupiditate quibusdam iste magnam officia in maiores laboriosam obcaecati, quas repellat itaque, optio quidem. Incidunt dolorem cum reiciendis placeat fuga?</p>

    <form action="" method="POST">
        <button type="submit">Im feeling lucky</button>
    </form>

    <!-- use fact api to fetch facts
    <small>Fun Fact:  </small> -->

    <hr>

    <h2>Available books</h2>

    <hr>

    <form method="POST" action="">
        <div class="d-flex">
            <!-- most popular -->
             <div class="row m-3">
                <h3>Most Popular</h3>
                <ul style="list-style-type: none;">
                    <?php 
                    foreach($books["most popular"] as $book) {
                        include("book_individual.php");
                    }
                    ?>
                </ul>
            </div>

            <div class="row m-3">
                <!-- most recent -->
                <h3>Most Recent</h3>
                <ul style="list-style-type: none;">
                    <?php foreach($books["most recent"] as $book) {
                        include("book_individual.php");
                    }
                    ?>
                </ul>
            </div>

            <div class="row m-3">
                <!-- most requests -->
                <h3>Most Requests</h3>
                <ul style="list-style-type: none;">
                    <?php foreach($books["most requests"] as $book)  {
                        include("book_individual.php");
                    }
                    ?>
                </ul>
            </div>

        </div>
    </form>
</div>
<?php require_once __DIR__ . '/../src/template/base_bottom.php' ?>