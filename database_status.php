<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check connection
include 'db_connect.php';

echo "<h2>✓ Your XAMPP MySQL Database is Connected!</h2>\n";
echo "<p style='font-size: 18px; color: green; font-weight: bold;'>Data is being saved to XAMPP MySQL Database</p>\n\n";

echo "<div style='border: 2px solid green; padding: 20px; border-radius: 5px; background: #f0fff0;'>\n";

echo "<h3>📊 Database Summary:</h3>\n";
echo "<ul style='font-size: 16px;'>\n";

// Get database info
$dbName = $conn->query("SELECT DATABASE()")->fetch_row()[0];
echo "<li><strong>Database Name:</strong> $dbName</li>\n";
echo "<li><strong>Server:</strong> " . $conn->server_info . "</li>\n";

// Count users
$userCount = $conn->query("SELECT COUNT(*) as count FROM users")->fetch_assoc()['count'];
echo "<li><strong>Total Registered Users:</strong> $userCount</li>\n";

// Count messages
$messageCount = $conn->query("SELECT COUNT(*) as count FROM messages")->fetch_assoc()['count'];
echo "<li><strong>Contact Messages:</strong> $messageCount</li>\n";

// Count bookings
$bookingCount = $conn->query("SELECT COUNT(*) as count FROM bookings")->fetch_assoc()['count'];
echo "<li><strong>Bookings:</strong> $bookingCount</li>\n";

echo "</ul>\n";

echo "<hr>\n";

echo "<h3>🔗 How to Access Your Data:</h3>\n";
echo "<ol style='font-size: 16px;'>\n";
echo "<li><strong>Open phpMyAdmin:</strong>\n";
echo "   <a href='http://localhost/phpmyadmin/' target='_blank' style='color: blue; text-decoration: underline;'>\n";
echo "   http://localhost/phpmyadmin/\n";
echo "   </a>\n";
echo "</li>\n\n";

echo "<li><strong>Direct Access to Users Table:</strong>\n";
echo "   <a href='http://localhost/phpmyadmin/index.php?route=/sql&db=travel_adviser&table=users&pos=0' target='_blank' style='color: blue; text-decoration: underline;'>\n";
echo "   View Users Database\n";
echo "   </a>\n";
echo "</li>\n\n";

echo "<li><strong>Direct Access to Messages Table:</strong>\n";
echo "   <a href='http://localhost/phpmyadmin/index.php?route=/sql&db=travel_adviser&table=messages&pos=0' target='_blank' style='color: blue; text-decoration: underline;'>\n";
echo "   View Messages Database\n";
echo "   </a>\n";
echo "</li>\n";

echo "</ol>\n";

echo "<hr>\n";

echo "<h3>👥 Latest 5 Registered Users:</h3>\n";
echo "<table border='1' cellpadding='10' style='width: 100%; border-collapse: collapse; font-size: 14px;'>\n";
echo "<tr style='background: #e0f7fa;'>\n";
echo "<th>ID</th><th>Full Name</th><th>Email</th><th>Registered</th>\n";
echo "</tr>\n";

$users = $conn->query("SELECT id, full_name, email, created_at FROM users ORDER BY created_at DESC LIMIT 5");
while ($user = $users->fetch_assoc()) {
    echo "<tr>\n";
    echo "<td>" . $user['id'] . "</td>\n";
    echo "<td>" . htmlspecialchars($user['full_name']) . "</td>\n";
    echo "<td>" . htmlspecialchars($user['email']) . "</td>\n";
    echo "<td>" . $user['created_at'] . "</td>\n";
    echo "</tr>\n";
}

echo "</table>\n";

echo "</div>\n";

echo "<div style='margin-top: 30px; padding: 15px; background: #fff3cd; border: 1px solid #ffc107; border-radius: 5px;'>\n";
echo "<h3>💡 Important Notes:</h3>\n";
echo "<ul>\n";
echo "<li>✓ XAMPP Apache is running</li>\n";
echo "<li>✓ XAMPP MySQL is running</li>\n";
echo "<li>✓ All registration and contact data is saved to XAMPP MySQL database</li>\n";
echo "<li>✓ You can view data in phpMyAdmin anytime</li>\n";
echo "</ul>\n";
echo "</div>\n";

$conn->close();
?>
