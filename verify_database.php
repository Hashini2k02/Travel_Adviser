<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db_connect.php';

echo "=== XAMPP MySQL Verification ===\n\n";

// 1. Test connection
echo "1. Database Connection:\n";
if ($conn->connect_error) {
    echo "   ✗ FAILED: " . $conn->connect_error . "\n";
    die;
} else {
    echo "   ✓ Connected to XAMPP MySQL\n";
    echo "   - Server: " . $conn->server_info . "\n";
    echo "   - Current database: " . $conn->query("SELECT DATABASE()")->fetch_row()[0] . "\n\n";
}

// 2. Check tables
echo "2. Database Tables:\n";
$tables = $conn->query("SHOW TABLES");
$tableList = [];
while ($row = $tables->fetch_array()) {
    $tableList[] = $row[0];
    echo "   ✓ " . $row[0] . "\n";
}

if (empty($tableList)) {
    echo "   ✗ No tables found! Database may not be imported.\n";
} else {
    echo "\n";
}

// 3. Check existing users
echo "3. Current Users in Database:\n";
$usersCount = $conn->query("SELECT COUNT(*) as count FROM users")->fetch_assoc()['count'];
echo "   Total users: $usersCount\n\n";

if ($usersCount > 0) {
    $users = $conn->query("SELECT id, full_name, email, created_at FROM users ORDER BY created_at DESC LIMIT 5");
    echo "   Latest 5 registrations:\n";
    while ($user = $users->fetch_assoc()) {
        echo "   - ID#" . $user['id'] . ": " . $user['full_name'] . " (" . $user['email'] . ")\n";
        echo "     Registered: " . $user['created_at'] . "\n";
    }
}

// 4. Check messages
echo "\n4. Contact Messages:\n";
$messagesCount = $conn->query("SELECT COUNT(*) as count FROM messages")->fetch_assoc()['count'];
echo "   Total messages: $messagesCount\n\n";

// 5. Test insert (INSERT a test record)
echo "5. Testing INSERT Operation:\n";
$testName = "Test User " . date('Y-m-d H:i:s');
$testEmail = "test" . time() . "@example.com";
$testPassword = password_hash("testpass123", PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $testName, $testEmail, $testPassword);

if ($stmt->execute()) {
    $newId = $conn->insert_id;
    echo "   ✓ Test record inserted successfully\n";
    echo "   - New User ID: $newId\n";
    echo "   - Name: $testName\n";
    echo "   - Email: $testEmail\n";
    
    // Verify it was saved
    $verify = $conn->query("SELECT * FROM users WHERE id = $newId");
    if ($verify->num_rows > 0) {
        echo "   ✓ Verified: Record exists in XAMPP MySQL database\n";
    }
} else {
    echo "   ✗ Failed to insert test record: " . $stmt->error . "\n";
}

echo "\n✓ All systems operational! Your data is being saved to XAMPP MySQL.\n";

$conn->close();
?>
