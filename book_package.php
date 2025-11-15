<?php
session_start();
$conn = new mysqli("localhost", "root", "", "travel_db");
if ($conn->connect_error)
    die("Connection failed: " . $conn->connect_error);

$user_id = $_SESSION['user_id'] ?? $_POST['user_id']; // session or form parameter
$package_id = $_POST['package_id'];
$date = date('Y-m-d');

// Use prepared statement
$stmt = $conn->prepare("INSERT INTO bookings (user_id, package_id, booking_date, status) VALUES (?, ?, ?, 'Confirmed')");
$stmt->bind_param("iis", $user_id, $package_id, $date);

if ($stmt->execute()) {
    echo "Package booked successfully!";
} else {
    echo "Booking failed: " . $conn->error;
}
$stmt->close();
$conn->close();
?>
