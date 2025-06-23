<?php
session_start();
include("database.php");

if (isset($_POST['login'])) {
    $username = $_POST['Name'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM instructor WHERE Name = ? AND Password = ?");
    $stmt->bind_param("ss", $username, $password);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $_SESSION['ID'] = $user['ID'];
        header("Location: student_profile.php");
        exit(); 
    } else {
        echo "Invalid Name or password!";
    }
    
}

?>



<!DOCTYPE html>  
<html lang="en">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <link rel="stylesheet" href="css/student_login.css">  
   
    <title>Login - Online Learning Platform</title>  
</head>  
<body>  
<div class="title">
        <h1>Online Learning Platform</h1><br>  
    </div>
    <div class="title2">
        <h2>For Student</h2>
    </div>
    <div class="login-container">  
    <p class="welcome">Welcome</p>
    <p class="signup">Sign Up</p>
        
          
        <form action="" method="POST">  
            <div class="form-group">  
                <label for="Name">Name</label>  
                <input type="text" id="Name" name="Name" placeholder="Enter your Name" required>  
            </div>  
            <div class="form-group">  
                <label for="password"> Password</label>  
                <input type="password" id="password" name="password" placeholder="Enter your password" required>  
            </div>  
            <div class="form-group">  
            <button type="submit" name="login"> Login</button> 
            </div>  
             
        </form>  
        <p class="signup">Don't have an account? <a href="instructor_signup.php"> Sign up</a> </p>  
    </div>  
</body>
</html>