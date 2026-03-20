<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');
include 'db_connect.php';

$response = ['status' => 'error', 'message' => 'Invalid email or password.'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    if (empty($email) || empty($password)) {
        $response = ['status' => 'error', 'message' => 'Please fill in all fields.'];
    } else {
        // Table existence check
        $tableCheck = $conn->query("SHOW TABLES LIKE 'users'");
        if (!$tableCheck || $tableCheck->num_rows == 0) {
            $response = ['status' => 'error', 'message' => 'Database tables not found. Please import database.sql.'];
        } else {
            // Find the user using prepared statement
            $stmt = $conn->prepare("SELECT id, full_name, password FROM users WHERE email = ?");
            
            if ($stmt === false) {
                $response = ['status' => 'error', 'message' => 'Database prepare error: ' . $conn->error];
            } else {
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result && $result->num_rows > 0) {
                    $user = $result->fetch_assoc();
                    if (password_verify($password, $user['password'])) {
                        // Start session
                        session_set_cookie_params(86400);
                        session_start();
                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['user_name'] = $user['full_name'];
                        $_SESSION['logged_in'] = true;

                        $response = ['status' => 'success', 'message' => 'Login successful!', 'user_name' => $user['full_name']];
                    }
                }
                $stmt->close();
            }
        }
    }
}

echo json_encode($response);
$conn->close();
?>
