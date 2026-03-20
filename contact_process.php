<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');
include 'db_connect.php';

$response = ['status' => 'error', 'message' => 'Something went wrong.'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $destination = isset($_POST['destination']) ? trim($_POST['destination']) : '';
    $travel_date = isset($_POST['travelDate']) ? trim($_POST['travelDate']) : '';
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';

    if (empty($name) || empty($email) || empty($message)) {
        $response = ['status' => 'error', 'message' => 'Please fill in required fields.'];
    } else {
        // Use prepared statement for security
        $stmt = $conn->prepare("INSERT INTO messages (name, email, phone, destination, travel_date, message) VALUES (?, ?, ?, ?, ?, ?)");
        
        if ($stmt === false) {
            $response = ['status' => 'error', 'message' => 'Database prepare error: ' . $conn->error];
        } else {
            $stmt->bind_param("ssssss", $name, $email, $phone, $destination, $travel_date, $message);
            
            if ($stmt->execute()) {
                $response = ['status' => 'success', 'message' => 'Message sent successfully!'];
            } else {
                $response = ['status' => 'error', 'message' => 'Database error: ' . $stmt->error];
            }
            $stmt->close();
        }
    }
}

echo json_encode($response);
$conn->close();
?>
