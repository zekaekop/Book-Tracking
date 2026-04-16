<li>
    <?= htmlspecialchars($book["title"]);?> 
    <button type="submit" 
                    name="book_request_submit" 
                    value="<?= $book["id"] ?>">Request</button>
</li>