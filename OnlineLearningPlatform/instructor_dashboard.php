<?php
session_start();

if (!isset($_SESSION['instructor_id'])) {
    header("Location: login_inst.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Instructor Dashboard</title>
</head>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['instructor_name']); ?>!</h2>
    <p><strong>ID:</strong> <?php echo htmlspecialchars($_SESSION['instructor_id']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['instructor_email']); ?></p>
</body>
</html>
