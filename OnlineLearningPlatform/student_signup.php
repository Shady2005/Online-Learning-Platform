<?php
session_start(); 

include("database.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/student_signup.css">
    <title>Sign U</title>
</head>
<body>
    <div class="title">
        <h1>Online Learning Platform</h1><br>  
    </div>
    <div class="title2">
        <h2>For Student</h2>
    </div>
    <div class="content">
        <div class="form">
            <p class="welcome">Welcome</p>
            <p class="signup">Sign Up</p>
            <form action="student_submit_signup.php" method="POST">
                <label for="Name">Name</label><br>
                <input type="text" name="Name" placeholder="Your Name" id="Name" required><br>
                <label for="password">Password</label><br>
                <input type="password" name="password" placeholder="Password" id="password" required><br>
                <label for="email">Email</label><br>
                <input type="email" name="email" placeholder="Email" id="email" required><br>
                
                <button type="submit">Sign Up</button>
            </form>
        </div>
    </div>
</body>
</html>