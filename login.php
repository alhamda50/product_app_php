<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    require 'db/connection.php';

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Verify the password against the hashed password in the database
        if (password_verify($password, $user['password'])) {
            
            header("Location: dashboard.php");
            exit();
        } else {  
            echo "<script>alert('Invalid password.'); window.location.href = 'index.html';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Invalid username.'); window.location.href = 'index.html';</script>";
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
