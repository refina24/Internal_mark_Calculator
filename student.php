<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Login</title>
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
    }
    
   
    .navbar {
        background-color: #F78CA2;
        /* padding: 1em; */
        /* text-align: center; */
        height:100px;
        display: flex;
    }

    .navbar h2{
        color: aliceblue;
        width: 20%;
        margin-left: 34%;
        /* margin-bottom: 80%; */
        text-align: center;
        padding: 20px;
        /* background-color: black; */
    }

    .navbar img{
        margin-top: 30px;
        margin-left: 20px;
    
    }
    .navbar a{
        /* background-color: black; */
    }

    .back-img {
        width: 30px;
        height: auto;
        margin-right: 10px;
    }

    .login-section {
        margin: 50px auto;
        width: 80%;
        max-width: 400px;
    }
    
    .login-section h2 {
        text-align: center;
    }
    
    .login-form {
        background-color: #f2f2f2;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }
    
    .login-form label {
        display: block;
        margin-bottom: 10px;
    }
    
    .login-form input[type="text"],
    .login-form input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }
    
    .login-form button {
        width: 100%;
        padding: 10px;
        background-color: #F78CA2;
        border: none;
        color: white;
        border-radius: 5px;
        cursor: pointer;
    }
</style>
</head>
<?php
session_start();
$name="localhost";
$user="root";
$pass="";
$db="studinfo";
$conn=mysqli_connect($name,$user,$pass,$db);


if(isset($_POST['sid']) && isset($_POST['name'])){
    $_SESSION['sid'] = $_POST['sid'];
    $_SESSION['name'] = $_POST['name'];
    header("Location: slogin.php");
    exit();
}

?>
<body>
    
    <div class="navbar">
        
        <a href="index.php"><img src="back.png" alt="Back" class="back-img"></a>
        <h2>Internal Mark Management</h2>
    </div>

    <div class="login-section">
        <div class="student-login">
            <h2>Student Login</h2>
            <form class="login-form" method="post">
                <label for="student-username">Name:</label>
                <input type="text" id="student-username" name="name" required>
                <label for="student-password">StudentId:</label>
                <input type="text" id="student-password" name="sid" required>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
