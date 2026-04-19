<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["add_book_submit"])) {

        $title = $_POST["title"];
        $desc = $_POST["desc"];

        $query = $pdo->prepare("INSERT INTO books (`title`, `desc`, `status`, `id_category`,`added_by_user_id`) VALUES (?,?,?,?)");
        $query->execute([$title, $desc, "unavailable", 5,$_SESSION["user"]["id"]]);
        # ID 5 category is Unknown/Other/Unspecified
    }
}

?>