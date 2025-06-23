<?php

session_start();
include("database.php");
if (isset($_SESSION['ID'])) {
    $stmt = $conn->prepare("SELECT ID, Name, email from student WHERE ID = ?");
    $stmt->bind_param("i", $_SESSION['ID']);
    
    
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();
    $name = $student['Name'];
    $ID = $student['ID'];
    $Email = $student['email'];
    $stmt->close();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
    <p class="profile" >Your Profile</p> 
    <p class="profile">Name: <?php echo  $name ?> </p>
    <p class="profile">Email: <?php echo $Email ?></p>
    <p class="profile">ID: <?php echo $ID ?> </p>
</body>
</html>

