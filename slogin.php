<!DOCTYPE html>
<html>
<head>
    <title>Student Details</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin-left: 10%;
            margin-top: 8%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        .center {
            margin-left:40%;
            margin-top:5%;
        }
        .navbar {
            background-color: #F78CA2;
            height: 100px;
            display: flex;
            align-items: center; /* Align items vertically */
            justify-content: space-between; /* Align items horizontally with space between */
            padding: 0 20px; /* Add padding to the navbar */
        }
        .navbar h2 {
            color: aliceblue;
            margin: 0; /* Remove default margin */
        }
        .navbar img {
            width: 30px;
            height: auto;
            margin-right: 10px;
        }
        .navbar a {
            color: aliceblue;
            margin-right: 20px;
            padding: 20px;
            text-decoration: none;
        }
        form {
            width: 80%;
            margin: 50px auto; /* Center the form horizontally */
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        form button {
            padding: 10%;
        }
    </style>
</head>
<body>

<div class="navbar">
    <a href="index.php"><img src="back.png" alt="Back" class="back-img"></a>
    <h2>Internal Mark Management</h2>
    <a href="teacher.php">Logout</a>
</div>

<?php
session_start();
$username = "root";
$servername = "localhost";
$dbname = "studinfo";
$con = mysqli_connect($servername, $username, "", $dbname);
if ($con->connect_error) {
    die("Connection failed:" + $con->connect_error);
} else {
    // Get the student's ID from the session
    $id = $_SESSION['sid'];
    
    // Display student details
    $student_query = "SELECT * FROM student WHERE sid=$id";
    $student_result = mysqli_query($con, $student_query);
    if ($student_result->num_rows > 0) {
        while ($row = $student_result->fetch_assoc()) {
            echo "<div class='center'>";
            echo "<span>ID</span>: " . $row['sid'] . "<br>";
            echo "<span>NAME</span>: " . $row['name'] . "<br>";
            echo "<span>COLLEGE</span>: " . $row['college_name'] . "<br>";
            echo "</div>";
        }
    } else {
        echo "<div class='center'>Student details not found.</div>";
    }
    
    // Display marks for each subject
    echo "<table border='1'>";
    echo "<tr><th>SUBJECT</th><th>UT1</th><th>UT2</th><th>UT3</th><th>INTERNAL MARK</th></tr>";
    
    // Fetch subjects dynamically
    $subject_query = "SELECT * FROM subjects";
    $subject_result = mysqli_query($con, $subject_query);
    if ($subject_result->num_rows > 0) {
        while ($subject_row = $subject_result->fetch_assoc()) {
            $subject_name = $subject_row['subject_name'];
            
            // Fetch marks for the current subject
            $marks_query = "SELECT * FROM $subject_name WHERE reg_id=$id";
            $marks_result = mysqli_query($con, $marks_query);
            if ($marks_result->num_rows > 0) {
                while ($marks_row = $marks_result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>$subject_name</td>";
                    echo "<td>" . $marks_row['ut1'] . "</td>";
                    echo "<td>" . $marks_row['ut2'] . "</td>";
                    echo "<td>" . $marks_row['ut3'] . "</td>";
                    echo "<td>" . $marks_row['im'] . "</td>";
                    echo "</tr>";
                }
            } else {
                // If no marks found for the subject, display empty cells
                echo "<tr><td>$subject_name</td><td></td><td></td><td></td><td></td></tr>";
            }
        }
    } else {
        echo "No subjects found.";
    }
    
    echo "</table>";
}
?>

</body>
</html>
