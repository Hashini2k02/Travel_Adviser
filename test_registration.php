<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db_connect.php';

echo "=== Database Test ===\n\n";

// Check if users table exists
echo "1. Checking if 'users' table exists...\n";
$tableCheck = $conn->query("SHOW TABLES LIKE 'users'");
if ($tableCheck && $tableCheck->num_rows > 0) {
    echo "✓ Users table exists\n\n";
    
    // Check table structure
    echo "2. Table structure:\n";
    $columnsCheck = $conn->query("DESCRIBE users");
    while ($row = $columnsCheck->fetch_assoc()) {
        echo "   - " . $row['Field'] . " (" . $row['Type'] . ")\n";
    }
    
    echo "\n3. Current users in database:\n";
    $usersCheck = $conn->query("SELECT id, full_name, email FROM users");
    if ($usersCheck->num_rows > 0) {
        while ($user = $usersCheck->fetch_assoc()) {
            echo "   - ID: " . $user['id'] . ", Name: " . $user['full_name'] . ", Email: " . $user['email'] . "\n";
        }
    } else {
        echo "   (No users found)\n";
    }
} else {
    echo "✗ Users table NOT found\n";
    echo "   Database error: " . $conn->error . "\n";
}

echo "\n4. Database info:\n";
echo "   Database name: " . $conn->select_db('travel_adviser') . " (should be TRUE/1)\n";

$conn->close();
?>
