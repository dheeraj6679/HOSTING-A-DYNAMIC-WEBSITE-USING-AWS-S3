<?php
// Connect to MySQL database
$conn = new mysqli("localhost", "root", "", "travel_db");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Get form input
$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password

// Use prepared statement to prevent SQL injection
$stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $password);

if ($stmt->execute()) {
    echo "Registration successful! <a href='login.html'>Login here</a>.";
} else {
    echo "Error: " . $conn->error;
}
$stmt->close();
$conn->close();
?>
