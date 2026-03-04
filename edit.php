<?php
require 'connect.php';
global $pdo;
//get id from url
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $author = filter_input(INPUT_POST, 'author', FILTER_SANITIZE_STRING);
    $rating = filter_input(INPUT_POST, 'rating', FILTER_SANITIZE_NUMBER_INT);
    $review_text = filter_input(INPUT_POST, 'review_text', FILTER_SANITIZE_STRING);
//update review
    if ($id && $title && $author && $rating && $review_text) {
        $sql = "UPDATE reviews SET title = :title, author = :author, rating = :rating, review_text = :review_text WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':review_text', $review_text);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        header('Location: admin.php');
        exit;
    } else {
        echo "Please fill in all fields.";
    }
}
//get review by id
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$sql = "SELECT * FROM reviews WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
$review = $stmt->fetch();

if (!$review) {
    echo "Review not found!";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Review</title>
</head>
<body>
<h1>Edit Review</h1>

<form action="edit.php" method="POST">
    <!--cant change the id-->
    <input type="hidden" name="id" value="<?php echo $review['id']; ?>">

    <label for="title">Book Title:</label>
    <input type="text" id="title" name="title" value="<?php echo $review['title']; ?>">
    <br>

    <label for="author">Author:</label>
    <input type="text" id="author" name="author" value="<?php echo $review['author']; ?>">
    <br>

    <label for="rating">Rating (1 to 5):</label>
    <input type="number" id="rating" name="rating" min="1" max="5" value="<?php echo $review['rating']; ?>">
    <br>

    <label for="review_text">Review:</label>
    <textarea id="review_text" name="review_text" rows="6" cols="40"><?php echo $review['review_text']; ?></textarea>
    <br>

    <button type="submit">Save Changes</button>
</form>

<p><a href="admin.php">Cancel and go back</a></p>
</body>
</html>