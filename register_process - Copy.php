<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');
include 'db_connect.php';

$response = ['status' => 'error', 'message' => 'Something went wrong.'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = isset($_POST['fullName']) ? trim($_POST['fullName']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    if (empty($fullName) || empty($email) || empty($password)) {
        $response = ['status' => 'error', 'message' => 'Please fill in all fields.'];
    } else {
        // Double check database connection and table
        $tableCheck = $conn->query("SHOW TABLES LIKE 'users'");
        if (!$tableCheck || $tableCheck->num_rows == 0) {
            $response = ['status' => 'error', 'message' => 'Database tables not found. Please import database.sql.'];
        } else {
            // Check if email already exists using prepared statement
            $checkStmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
            if ($checkStmt === false) {
                $response = ['status' => 'error', 'message' => 'Database prepare error: ' . $conn->error];
            } else {
                $checkStmt->bind_param("s", $email);
                $checkStmt->execute();
                $checkResult = $checkStmt->get_result();

                if ($checkResult && $checkResult->num_rows > 0) {
                    $response = ['status' => 'error', 'message' => 'This email is already registered.'];
                } else {
                    // Hash the password
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    
                    // Use prepared statement for security
                    $stmt = $conn->prepare("INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)");
                    
                    if ($stmt === false) {
                        $response = ['status' => 'error', 'message' => 'Database prepare error: ' . $conn->error];
                    } else {
                        $stmt->bind_param("sss", $fullName, $email, $hashedPassword);
                        
                        if ($stmt->execute()) {
                            $response = ['status' => 'success', 'message' => 'Account created successfully!'];
                        } else {
                            $response = ['status' => 'error', 'message' => 'Registration failed: ' . $stmt->error];
                        }
                        $stmt->close();
                    }
                }
                $checkStmt->close();
            }
        }
    }
}

echo json_encode($response);
$conn->close();
?>
