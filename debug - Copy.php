<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db_connect.php';

echo "<h3>Database Debug Info:</h3>";

if ($conn->connect_error) {
    die("<p style='color:red;'>Connection failed: " . $conn->connect_error . "</p>");
} else {
    echo "<p style='color:green;'>Connected successfully to the database!</p>";
}

// Check current database
$res = $conn->query("SELECT DATABASE()");
$row = $res->fetch_row();
echo "<p>Current Database: <strong>" . $row[0] . "</strong></p>";

// List all tables
echo "<h4>Tables in this database:</h4>";
$tables = $conn->query("SHOW TABLES");
if ($tables->num_rows > 0) {
    echo "<ul>";
    while($row = $tables->fetch_row()) {
        echo "<li>" . $row[0] . "</li>";
    }
    echo "</ul>";
} else {
    echo "<p style='color:red;'>No tables found in this database! Please Import database.sql.</p>";
}

$conn->close();
?>
