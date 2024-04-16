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

    .login-section { margin: 50px auto; width: 80%; max-width: 400px; } 
    .login-section h2 { text-align: center; } 
    .login-form { background-color: #f2f2f2; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); } 
    .login-form label { display: block; margin-bottom: 10px; } 
    .login-form input[type="text"], .login-form input[type="password"] { width: 100%; padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box; }
     .login-form button { width: 100%; padding: 10px; background-color: #f78ca2; border: none; color: white; border-radius: 5px; cursor: pointer; }
</style>
</head>
<?php
    session_start();
    $name="localhost";
    $user="root";
    $pass="";
    $db="studinfo";
    $conn=mysqli_connect($name,$user,$pass,$db);
    if($conn->connect_error)
  die("Connection failure").$conn->connect_error;
    else{
    if(isset($_POST['tid']) and isset($_POST['tpass'])){
        $id = $_POST['tid'];
        $pass = $_POST['tpass'];
        $query = "SELECT * FROM `teacher` WHERE tid='$id' and tpass='$pass'";
         $result = $conn->query($query);
        $count = $result->num_rows;
        if ($count == 1){
            $_SESSION['tid'] = $id;
            $_SESSION['tpass']=$pass;
            $_SESSION['tsub']=$_POST['tsub'];
            header('Location: tlogin.php');
        }
        else
        {
            $msg = "Wrong credentials";
        }
    }
    }?>




<body>
    
    <div class="navbar">
        
        <a href="index.php"><img src="back.png" alt="Back" class="back-img"></a>
        <h2>Internal Mark Management</h2>
    </div>

    <div class="login-section">
        <div class="teacher-login">
            <h2>Teacher Login</h2>
            <form class="login-form" method="post">
                <label for="teacher-id">Teacher ID:</label>
                <input type="text" id="teacher-id" name="tid" required>
                <label for="teacher-department">Subject:</label>
                <input type="text" id="teacher-department" name="tsub" required>
                <label for="teacher-password">Password:</label>
                <input type="password" id="teacher-password" name="tpass" required>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
