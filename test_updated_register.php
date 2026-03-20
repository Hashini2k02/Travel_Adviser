<?php
// Test the updated register_process.php
// Simulate a POST request

$_SERVER["REQUEST_METHOD"] = "POST";
$_POST['fullName'] = 'Test User ' . time();
$_POST['email'] = 'testuser' . time() . '@example.com';
$_POST['password'] = 'TestPass123!';

// Include and run the register process
ob_start();
include 'register_process.php';
$output = ob_get_clean();

echo "=== Registration Test ===\n";
echo "Response: " . $output . "\n";

// Verify the user was created
include 'db_connect.php';
$email = $_POST['email'];
$checkStmt = $conn->prepare("SELECT id, full_name FROM users WHERE email = ?");
$checkStmt->bind_param("s", $email);
$checkStmt->execute();
$result = $checkStmt->get_result();

if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
    echo "\n✓ User verified in database:\n";
    echo "  - ID: " . $user['id'] . "\n";
    echo "  - Name: " . $user['full_name'] . "\n";
    echo "  - Email: " . $email . "\n";
} else {
    echo "\n✗ User NOT found in database\n";
}

$checkStmt->close();
$conn->close();
?>
