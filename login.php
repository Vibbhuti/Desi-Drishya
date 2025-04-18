<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check user credentials
    $stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();
        
        if (password_verify($password, $hashed_password)) {
            echo json_encode(["status" => "success", "message" => "Login successful!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Invalid password."]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "No account found with this email."]);
    }

    $stmt->close();
    $conn->close();
}
?>
