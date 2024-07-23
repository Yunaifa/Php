<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productId = $_POST["product_id"];
    $rating = $_POST["rating"];

    // Insert rating into database
    $sql = "INSERT INTO ratings (product_id, rating) VALUES ($productId, $rating)";
    if ($conn->query($sql) === TRUE) {
        echo "Rating added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
