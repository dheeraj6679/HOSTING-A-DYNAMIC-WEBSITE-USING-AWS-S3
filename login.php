<?php
session_start();
$conn = new mysqli("localhost", "root", "", "travel_db");
if ($conn->connect_error)
    die("Connection failed: " . $conn->connect_error);

$email = $_POST['email'];
$password = $_POST['password'];

// Prevent SQL Injection
$stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['name'] = $row['name'];
        echo "Login successful. Welcome " . htmlspecialchars($row['name']) . ".";
    } else {
        echo "Invalid password.";
    }
} else {
    echo "User not found.";
}
$stmt->close();
$conn->close();
?>
