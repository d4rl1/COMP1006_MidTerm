<?php
global $pdo;
//connect to database
require 'connect.php';
//get all reviews
$sql = "SELECT * FROM reviews";
$stmt = $pdo->query($sql);
$stmt->execute();
$all_reviews = $stmt->fetchAll();
?>
<!--display all reviews-->
<h2>Reviews</h2>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Rating</th>
            <th>Review</th>
        </tr>
        </thead>
        <tbody>
        <!--loop all reviews-->
        <?php foreach ($all_reviews as $review): ?>
        <tr>
            <td><?php echo $review['id']; ?></td>
            <td><?php echo $review['title']; ?></td>
            <td><?php echo $review['author']; ?></td>
            <td><?php echo $review['rating']; ?></td>
            <td><?php echo $review['review_text']; ?></td>
            <td>
                <!-- edit and delete-->
                <a href="delete.php?id=<?php echo $review['id']; ?>">Delete</a>
                <a href="edit.php?id=<?php echo $review['id']; ?>">Edit</a>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<!--go back button-->
<a href="index.php">go back</a>
