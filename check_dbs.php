<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";
$username = "root";
$password = "0416";

echo "<h3>Finding your Databases...</h3>";

$conn = new mysqli($host, $username, $password);

if ($conn->connect_error) {
    die("<p style='color:red;'>Connection failed: " . $conn->connect_error . " (Check your password or username)</p>");
} else {
    echo "<p style='color:green;'>Connected to MySQL successfully!</p>";
}

echo "<h4>All Databases on your server:</h4>";
$res = $conn->query("SHOW DATABASES");
echo "<ul>";
while($row = $res->fetch_assoc()) {
    $db = $row['Database'];
    echo "<li><strong>'{$db}'</strong>";
    if ($db === 'travel_adviser') echo " <span style='color:green;'>(Exact Match found!)</span>";
    echo "</li>";
}
echo "</ul>";

$conn->close();
?>
