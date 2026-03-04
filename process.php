<?php
global $pdo;
require_once 'connect.php';
//get data from form
$title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
$author = trim(filter_input(INPUT_POST, 'author', FILTER_SANITIZE_STRING));
$rating = trim(filter_input(INPUT_POST, 'rating', FILTER_SANITIZE_NUMBER_INT));
$review_text = trim(filter_input(INPUT_POST, 'review_text', FILTER_SANITIZE_STRING));
//check if all fields are filled
if (empty($title) || empty($author) || empty($rating) || empty($review_text)) {
    echo 'Please fill in all fields';
    //redirect to index page
    header('Location: index.php');
}
//insert review into database
    else{
    try {
        $sql = "INSERT INTO reviews (title, author, rating, review_text) VALUES (:title, :author, :rating, :review_text)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':review_text', $review_text);
        $stmt->execute();
        echo 'Review added successfully';
        header('Location: index.php');
    }
    catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
