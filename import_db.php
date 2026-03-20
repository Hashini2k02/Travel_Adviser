<?php
$host = "localhost";
$username = "root";
$password = "0416";
$database = "travel_adviser";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "<h3>Importing Database Tables...</h3>";

$sql_file = "database.sql";
if (file_exists($sql_file)) {
    $sql_content = file_get_contents($sql_file);
    
    // Split SQL into individual queries
    $queries = explode(";", $sql_content);
    
    $success_count = 0;
    $error_count = 0;
    
    foreach ($queries as $query) {
        $query = trim($query);
        if ($query != "") {
            if ($conn->query($query)) {
                $success_count++;
            } else {
                echo "<p style='color:red;'>Error executing query: " . $conn->error . "</p>";
                $error_count++;
            }
        }
    }
    
    echo "<p style='color:green;'>Import Finished!</p>";
    echo "Successfully executed queries: $success_count<br>";
    echo "Errors: $error_count<br>";
    
} else {
    echo "<p style='color:red;'>SQL file not found!</p>";
}

echo "<h4>Current Tables in $database:</h4><ul>";
$result = $conn->query("SHOW TABLES");
if ($result) {
    while ($row = $result->fetch_array()) {
        echo "<li>" . $row[0] . "</li>";
    }
} else {
    echo "<li>No tables found.</li>";
}
echo "</ul>";

$conn->close();
?>
