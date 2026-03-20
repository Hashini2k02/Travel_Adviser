<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

include 'db_connect.php';

echo "=== Registration Test ===\n";

// Simulate form submission
$_POST['fullName'] = 'Test Registration ' . time();
$_POST['email'] = 'test' . time() . '@example.com';
$_POST['password'] = 'testpass123';

$fullName = isset($_POST['fullName']) ? mysqli_real_escape_string($conn, $_POST['fullName']) : '';
$email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : '';
$password = isset($_POST['password']) ? mysqli_real_escape_string($conn, $_POST['password']) : '';

echo "Full Name: $fullName\n";
echo "Email: $email\n";
echo "Password length: " . strlen($password) . "\n\n";

if (empty($fullName) || empty($email) || empty($password)) {
    echo "ERROR: Some fields are empty\n";
    die;
}

// Check if email already exists
$checkEmail = "SELECT email FROM users WHERE email = '$email'";
$result = $conn->query($checkEmail);

if ($result && $result->num_rows > 0) {
    echo "ERROR: Email already exists\n";
    die;
}

echo "Email is unique\n";

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
echo "Hashed password length: " . strlen($hashedPassword) . "\n";

// Try INSERT
$sql = "INSERT INTO users (full_name, email, password) VALUES ('$fullName', '$email', '$hashedPassword')";
echo "SQL Query: $sql\n\n";

if ($conn->query($sql) === TRUE) {
    echo "✓ Registration successful! User ID: " . $conn->insert_id . "\n";
} else {
    echo "✗ Database error: " . $conn->error . "\n";
}

$conn->close();
?>
