<?php 

include("base.php");

redirect_unauth_users();

$query = $pdo->query("SELECT * FROM books");
$books = $query->fetchAll();

?>

<h1>Home page</h1>
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda distinctio cupiditate quibusdam iste magnam officia in maiores laboriosam obcaecati, quas repellat itaque, optio quidem. Incidunt dolorem cum reiciendis placeat fuga?</p>

<hr>

<h3>Books</h3>
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus rerum vero blanditiis earum. Quos adipisci nihil dignissimos iste ipsum aliquam aperiam corrupti possimus, quo quam necessitatibus? Minima aspernatur doloremque eveniet!</p>
