<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    require 'db/connection.php';

    $sql = "UPDATE products SET name = ?, price = ?, description = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdsi", $name, $price, $description, $id);
    if ($stmt->execute()) {
        header("Location: dashboard.php");
    } else {
        echo "Error updating product.";
    }

    $stmt->close();
    $conn->close();
}
?>
