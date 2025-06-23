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
$password = trim($_POST['password'] ?? '');


if (empty($Name) || empty($email) || empty($password)   ) {
    http_response_code(400);
    die("All fields are required!");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    die("Invalid email format!");
}

// if (!is_numeric($age) || $age <= 0) {
//     http_response_code(400);
//     die("Age must be a positive integer!");
// }

$hashed_password = $password;

$check_user = $conn->prepare("SELECT ID FROM student WHERE Name = ? OR email = ?");
$check_user->bind_param("ss", $Name, $email);
$check_user->execute();
$check_user->store_result();

if ($check_user->num_rows > 0) {
    http_response_code(400);
    die("Name or email is already in use!");
}

$check_user->close();



$stmt = $conn->prepare("INSERT INTO student (Name, password, email) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $Name, $hashed_password,  $email);

if ($stmt->execute()) {
    echo "User registered successfully!";
    header("Location: student_login.php");
    exit();
} else {
    http_response_code(500);
    echo "Error occurred during registration: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>