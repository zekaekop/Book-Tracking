<li class="d-flex <?= flip_compact_book_style($book["id"]) ?>">
    <?= htmlspecialchars($book["title"]);?> 
    <button type="submit" 
                    name="book_detail_submit" 
                    value="<?= $book["id"] ?>"
                    class="ms-auto">Details</button>
</li>