<?php
include 'db.php';

// Query products
$sql = "SELECT id, name FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<h2>" . $row["name"] . "</h2>";

        // Query average rating for each product
        $productId = $row["id"];
        $avgSql = "SELECT AVG(rating) AS average_rating FROM ratings WHERE product_id = $productId";
        $avgResult = $conn->query($avgSql);
        $avgRow = $avgResult->fetch_assoc();
        $averageRating = round($avgRow["average_rating"], 1);

        echo "Average Rating: " . ($averageRating ? $averageRating : 'No ratings yet');

        // Form to add rating
        echo '
            <form action="addrating.php" method="POST">
                <input type="hidden" name="product_id" value="' . $productId . '">
                <input type="number" name="rating" min="1" max="5" required>
                <input type="submit" value="Rate">
            </form>
        ';
    }
} else {
    echo "No products found.";
}
$conn->close();
?>
