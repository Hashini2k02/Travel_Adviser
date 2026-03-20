<?php
include 'db_connect.php';

echo "USERS:\n";
$res = $conn->query("SELECT * FROM users");
while($row = $res->fetch_assoc()) { print_r($row); }

echo "\nMESSAGES:\n";
$res = $conn->query("SELECT * FROM messages");
while($row = $res->fetch_assoc()) { print_r($row); }

echo "\nBOOKINGS:\n";
$res = $conn->query("SELECT * FROM bookings");
while($row = $res->fetch_assoc()) { print_r($row); }

$conn->close();
?>
