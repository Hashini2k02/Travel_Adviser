<?php
header('Content-Type: application/json');
include 'db_connect.php';

$response = ['status' => 'error', 'message' => 'Unable to reset password.'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : '';
    $newPass = isset($_POST['password']) ? mysqli_real_escape_string($conn, $_POST['password']) : '';

    if (empty($email) || empty($newPass)) {
        $response = ['status' => 'error', 'message' => 'Please fill in all fields.'];
    } else {
        // Check if user exists
        $checkUser = "SELECT id FROM users WHERE email = '$email'";
        $result = $conn->query($checkUser);

        if ($result && $result->num_rows > 0) {
            $hashedPass = password_hash($newPass, PASSWORD_DEFAULT);
            $updateSql = "UPDATE users SET password = '$hashedPass' WHERE email = '$email'";

            if ($conn->query($updateSql) === TRUE) {
                $response = ['status' => 'success', 'message' => 'Password reset successfully! Redirecting...'];
            } else {
                $response = ['status' => 'error', 'message' => 'Database error: ' . $conn->error];
            }
        } else {
            $response = ['status' => 'error', 'message' => 'Email not found.'];
        }
    }
}

echo json_encode($response);
$conn->close();
?>
