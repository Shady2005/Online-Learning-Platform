<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = 'localhost';
    $db = 'your_database_name';
    $user = 'your_db_user';
    $pass = 'your_db_password';

    $conn = new mysqli($host, $user, $pass, $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id = $_POST['id'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT Password FROM instructors WHERE ID = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['instructor_id'] = $id;
            echo "Login successful. Welcome, Instructor $id!";
            exit;
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "Instructor ID not found.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Instructor Login</title>
</head>
<body>
    <h2>Instructor Login</h2>

    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <form method="POST" action="">
        ID: <input type="text" name="id" required><br><br>
        Password: <input type="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>