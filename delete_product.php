<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    require 'db/connection.php';

    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header("Location: dashboard.php"); 
    } else {
        echo "Error deleting product.";
    }

    $stmt->close();
    $conn->close();
}
?>
