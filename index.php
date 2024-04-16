<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Page</title>
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        background-image: url("image2.png");
        background-size: cover;
        background-repeat: no-repeat;
    }
    
    .navbar {
        background-color: #F78CA2;
        padding: 1em;
        text-align: center;
    }

    .navbar h2{
        color: aliceblue;
        text-align: center;
    }

    .container {
    text-align: center;
    margin-top: 50px;

    transition: box-shadow 0.3s ease; /* Add transition for smooth effect */
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0); /* Initial shadow effect */
}

/* Add shadow effect to container on hover */
.image-container:hover ~ .container {
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2); /* Add shadow effect */
}



    .image-box {
        width: 80%;
        /* background-color: white; */
        max-width: 600px;
        margin: 0 auto;
        /* border: 4px solid pink; */
        padding: 20px;
        /* border-radius: 30px;
        box-shadow: 10px 10px 5px grey; */
    }

    .image-row {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }

    .image-container {
        margin: 0 10px;
        padding: 50px;
    }

    .image-container img {
        width: 200px;
        height: 200px;
        border-radius: 50%; /* Make images round */
        cursor: pointer;
        transition: transform (0.3s ease); /* Add transition for smooth effect */
    }

    .image-label {
        margin-top: 10px;
        font-size: 18px;
        font-family: "Arial", sans-serif; /* Font style */
        font-weight: bold; /* Font weight */
    }

    /* Add hover effect */
    .image-container img:hover {
        transform: scale(1.1); /* Scale up the image */
    }

    /* Add shadow effect to container on hover */
    .image-container img:hover ~ .container {
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2); /* Add shadow effect */
    }
</style>
</head>
<body>
    <div class="navbar">
        <h2>Internal Mark Management</h2>
    </div>

    <div class="container">
        <div class="image-box">
            <div class="image-row">
                <div class="image-container">
                    <a href="student.php"><img src="Student.png" alt="Student Image"></a>
                    <div class="image-label">Student</div>
                </div>
                <div class="image-container">
                    <a href="teacher.php"><img src="teacher.jpg" alt="Teacher Image"></a>
                    <div class="image-label">Teacher</div>
                </div>
            
            
                <div class="image-container">
                    <a href="admin.php"><img src="admin.webp" alt="Admin Image"></a>
                    <div class="image-label">Admin</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
