<?php
session_start(); 

include("database.php");

if ($conn->connect_error) {
    die("Failed to connect to the database: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405); 
    die("Invalid request method!");
}

$Name = trim($_POST['Name'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = trim($_POST['Password'] ?? '');

if (empty($Name) || empty($email) || empty($password)) {
    http_response_code(400);
    die("All fields are required!");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    die("Invalid email format!");
}


$hashed_password = password_hash($password, PASSWORD_DEFAULT);


$check_user = $conn->prepare("SELECT ID FROM instructor WHERE Name = ? OR email = ?");
$check_user->bind_param("ss", $Name, $email);
$check_user->execute();
$check_user->store_result();

if ($check_user->num_rows > 0) {
    http_response_code(400);
    die("Name or email is already in use!");
}

$check_user->close();


$stmt = $conn->prepare("INSERT INTO instructor (Name, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $Name, $email, $hashed_password);

if ($stmt->execute()) {
    echo "Instructor registered successfully!";
    header("Location: Home.php");
    exit();
} else {
    http_response_code(500);
    echo "Error occurred during registration: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>