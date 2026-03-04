<?php
require 'connect.php';
global $pdo;
//get id from url
$id = trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
//delete review
if ($id) {
    $sql = "DELETE FROM reviews WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}
//redirect to admin page after delete
header('Location: admin.php');
exit;