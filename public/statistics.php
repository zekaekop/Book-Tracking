<?php

require_once __DIR__ . "/../src/template/base_top.php";

$statistics = get_statistics();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["refresh_submit"])) {
        $statistics = get_statistics();
    }
}

function get_statistics() {
    global $pdo;

    $total_books = $pdo->query("SELECT COUNT(*) FROM books;")->fetchColumn();
    $total_books_requested = $pdo->query("SELECT COUNT(*) FROM books WHERE requested_user_id IS NOT NULL;")->fetchColumn();
    $total_users = $pdo->query("SELECT COUNT(*) FROM users;")->fetchColumn();

    return array( "total_users" => $total_users, 
                            "total_books" => $total_books, 
                            "total_books_requested" => $total_books_requested);
}

?>

<div class="container">
    <h1>Site Statistics</h1>

    <ul style="list-style-type: none;">
        <li>Total Book Requests: <span><?= htmlspecialchars($statistics["total_books_requested"]); ?></span></li>
        <li>Total Books Added <span><?= htmlspecialchars($statistics["total_books"]); ?></span></li>
        <li>Total Users <span><?= htmlspecialchars($statistics["total_users"]); ?></span></li>
    </ul>

    <form method="POST" action="">
        <button type="submit" name="refresh_submit">Refresh</button>
    </form>

</div>

<?php require_once __DIR__ . '/../src/template/base_bottom.php' ?>