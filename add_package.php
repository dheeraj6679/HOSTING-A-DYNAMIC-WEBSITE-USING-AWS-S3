<?php
$conn = new mysqli("localhost", "root", "", "travel_db");
if ($conn->connect_error)
    die("Connection failed: " . $conn->connect_error);

$name = $_POST['name'];
$price = $_POST['price'];
$desc = $_POST['description'];

// Use prepared statement
$stmt = $conn->prepare("INSERT INTO packages (name, price, description) VALUES (?, ?, ?)");
$stmt->bind_param("sds", $name, $price, $desc);

if ($stmt->execute()) {
    echo "Package added successfully!";
} else {
    echo "Error: " . $conn->error;
}
$stmt->close();
$conn->close();
?>
