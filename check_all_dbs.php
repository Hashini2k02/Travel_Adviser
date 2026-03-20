<?php
$host = "localhost";
$username = "root";
$password = "0416";

$conn = new mysqli($host, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "<h3>Attempting to fix 'travel_adviser' database...</h3>";

// Try to drop if invisible but exists
echo "Attempting to DROP database 'travel_adviser'... ";
if ($conn->query("DROP DATABASE IF EXISTS travel_adviser")) {
    echo "<span style='color:green;'>SUCCESS (or did not exist)</span><br>";
} else {
    echo "<span style='color:red;'>FAILED: " . $conn->error . "</span><br>";
}

// Try to create fresh
echo "Attempting to CREATE database 'travel_adviser'... ";
if ($conn->query("CREATE DATABASE travel_adviser")) {
    echo "<span style='color:green;'>SUCCESS! Database created successfully.</span><br>";
} else {
    echo "<span style='color:red;'>FAILED: " . $conn->error . "</span><br>";
}

// Check final list
echo "<h4>Current Databases:</h4><ul>";
$result = $conn->query("SHOW DATABASES");
while ($row = $result->fetch_assoc()) {
    echo "<li>" . $row['Database'] . "</li>";
}
echo "</ul>";

$conn->close();
?>
