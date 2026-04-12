<?php 

include("base.php");

$query = $pdo->query("SELECT * FROM books");
// $query->execute();
$books = $query->fetchAll();

?>

<h1>Home page</h1>
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda distinctio cupiditate quibusdam iste magnam officia in maiores laboriosam obcaecati, quas repellat itaque, optio quidem. Incidunt dolorem cum reiciendis placeat fuga?</p>

<h2>Available books</h2>

<ul style="list-style-type: none;">
    <?php foreach($books as $book): ?>
        <li>
            <?= htmlspecialchars($book["title"]);?> 
        </li>
    <?php endforeach ?>
</ul>