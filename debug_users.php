<?php
include 'db_connect.php';
$result = $conn->query("SELECT id, full_name, email FROM users");
if ($result) {
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "ID: " . $row["id"]. " - Name: " . $row["full_name"]. " - Email: " . $row["email"]. "\n";
        }
    } else {
        echo "0 results";
    }
} else {
    echo "Error: " . $conn->error;
}
$conn->close();
?>
