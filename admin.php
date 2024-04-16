<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Page</title>
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
    }
    
    .navbar {
        background-color: #F78CA2;
        height: 100px;
        display: flex;
        align-items: center;
        padding: 0 20px;
    }

    .navbar h2 {
        color: aliceblue;
        margin: 0 auto;
        text-align: center;
        flex: 1;
    }
    .back-img {
        width: 30px;
        height: auto;
        margin-right: 10px;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: calc(100vh - 100px); /* Adjusted height to accommodate navbar */
    }

    .details-container {
        border: 2px solid #F78CA2;
        padding: 20px;
        border-radius: 10px;
        margin: 0 10px;
    }

    .details-container h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .details {
        display: flex;
        flex-direction: column;
        margin-bottom: 20px;
    }

    .details label {
        margin-bottom: 5px;
    }

    .details input {
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .details-container.admin-details {
        width: 300px;
        height:400px;
    }

    .details-container.teacher-details {
        width: 300px;
        height:400px;
    }

    .details-container.admin-details h2 {
        color: #F78CA2;
    }

    .details-container.teacher-details h2 {
        color: #F78CA2;
    }

    .admin-details, .teacher-details {
        margin-right: 20px;
    }

    .admin-details {
        border-color: #F78CA2;
    }

    .teacher-details {
        border-color: #F78CA2;
    } form {
            width: 300px;
            margin: 0 auto;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            background-color: #F78CA2;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #F78CA2;
        }
        .error {
            color: red;
        }
        .success-box {
            display: none;
            width: 50%;
            background-color: #3CB371;
            color: white;
            text-align: center;
            margin-left:24%;
            padding: 10px;
            border-radius: 5px;
            margin-top: 65x;
            
        }
    </style>
</head>


<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Add your database password here if you have one
$dbname = "studinfo"; // Replace "your_database_name" with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define variables and initialize with empty values for student
$sid = $student_name = $dept = $college_name = "";
$sid_err = $student_name_err = $dept_err = $college_name_err = "";

// Define variables and initialize with empty values for teacher
$tid = $tpass = $tsub = "";
$tid_err = $tpass_err = $tsub_err = "";

// Define success message
$success_msg = "";

// Processing form data when form is submitted for student
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_student'])) {

    // Validate SID
    if (empty(trim($_POST["sid"]))) {
        $sid_err = "Please enter SID.";
    } else {
        $sid = trim($_POST["sid"]);
    }

    // Validate student name
    if (empty(trim($_POST["student_name"]))) {
        $student_name_err = "Please enter student name.";
    } else {
        $student_name = trim($_POST["student_name"]);
    }

    // Validate department
    if (empty(trim($_POST["dept"]))) {
        $dept_err = "Please enter department.";
    } else {
        $dept = trim($_POST["dept"]);
    }

    // Validate college name
    if (empty(trim($_POST["college_name"]))) {
        $college_name_err = "Please enter college name.";
    } else {
        $college_name = trim($_POST["college_name"]);
    }

    // Check input errors before inserting into database
    if (empty($sid_err) && empty($student_name_err) && empty($dept_err) && empty($college_name_err)) {

        // Prepare an insert statement
        $sql_student = "INSERT INTO student (sid, name, dept, college_name) VALUES (?, ?, ?, ?)";

        if ($stmt = $conn->prepare($sql_student)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("isss", $param_sid, $param_student_name, $param_dept, $param_college_name);

            // Set parameters
            $param_sid = $sid;
            $param_student_name = $student_name;
            $param_dept = $dept;
            $param_college_name = $college_name;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                $success_msg = "New student record created successfully";
            } else {
                echo "Error: " . $sql_student . "<br>" . $conn->error;
            }

            // Close statement
            $stmt->close();
        }
    }
}

// Processing form data when form is submitted for teacher
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_teacher'])) {

    // Validate TID
    if (empty(trim($_POST["tid"]))) {
        $tid_err = "Please enter TID.";
    } else {
        $tid = trim($_POST["tid"]);
    }

    // Validate teacher password
    if (empty(trim($_POST["tpass"]))) {
        $tpass_err = "Please enter password.";
    } else {
        $tpass = trim($_POST["tpass"]);
    }

    // Validate subject
    if (empty(trim($_POST["tsub"]))) {
        $tsub_err = "Please enter subject.";
    } else {
        $tsub = trim($_POST["tsub"]);

        // Create table for the subject
        $sql_create_table = "CREATE TABLE IF NOT EXISTS $tsub (
            reg_id INT NOT NULL PRIMARY KEY,
            ut1 INT,
            ut2 INT,
            ut3 INT,
            im INT
        )";

        if ($conn->query($sql_create_table) === TRUE) {
            $success_msg = "Table $tsub created successfully";
        } else {
            echo "Error creating table: " . $conn->error;
        }
    }

    // Check input errors before inserting into database
    if (empty($tid_err) && empty($tpass_err) && empty($tsub_err)) {

        // Hash the password
        $hashed_password = password_hash($tpass, PASSWORD_DEFAULT);

        // Prepare an insert statement
        $sql_teacher = "INSERT INTO teacher (tid, tpass, tsub) VALUES (?, ?, ?)";

        if ($stmt = $conn->prepare($sql_teacher)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sss", $param_tid, $param_tpass, $param_tsub);

            // Set parameters
            $param_tid = $tid;
            $param_tpass = $hashed_password;
            $param_tsub = $tsub;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                $success_msg = "New teacher record created successfully";
            } else {
                echo "Error: " . $sql_teacher . "<br>" . $conn->error;
            }

            // Close statement
            $stmt->close();
        }
    }
}

// Close connection
$conn->close();
?>
<body>
    <div class="navbar">
        
        <a href="index.php"><img src="back.png" alt="Back" class="back-img"></a>
        <h2>Internal Mark Management</h2>
    </div>
    <div class="success-box"><?php echo $success_msg; ?></div>
    <div class="container">
        <div class="details-container admin-details">
            <h2>Student Details</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div <?php echo (!empty($sid_err)) ? 'class="error"' : ''; ?>>
                    <label for="sid">SID</label>
                    <input type="text" name="sid" value="<?php echo $sid; ?>">
                    <span class="error"><?php echo $sid_err; ?></span>
                </div>
                <div <?php echo (!empty($student_name_err)) ? 'class="error"' : ''; ?>>
                    <label for="student_name">Student Name</label>
                    <input type="text" name="student_name" value="<?php echo $student_name; ?>">
                    <span class="error"><?php echo $student_name_err; ?></span>
                </div>
                <div <?php echo (!empty($dept_err)) ? 'class="error"' : ''; ?>>
                    <label for="dept">Department</label>
                    <input type="text" name="dept" value="<?php echo $dept; ?>">
                    <span class="error"><?php echo $dept_err; ?></span>
                </div>
                <div <?php echo (!empty($college_name_err)) ? 'class="error"' : ''; ?>>
                    <label for="college_name">College Name</label>
                    <input type="text" name="college_name" value="<?php echo $college_name; ?>">
                    <span class="error"><?php echo $college_name_err; ?></span>
                </div>
                <div>
                    <input type="submit" name="add_student" value="Add Student">
                </div>
            </form>
            
        </div>




<div class="details-container teacher-details">
            <h2>Teacher Details</h2>
            <div class="details">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div <?php echo (!empty($tid_err)) ? 'class="error"' : ''; ?>>
                        <label for="tid">TID</label>
                        <input type="text" name="tid" value="<?php echo $tid; ?>">
                        <span class="error"><?php echo $tid_err; ?></span>
                    </div>
                    <div <?php echo (!empty($tpass_err)) ? 'class="error"' : ''; ?>>
                        <label for="tpass">Password</label>
                        <input type="password" name="tpass" value="<?php echo $tpass; ?>">
                        <span class="error"><?php echo $tpass_err; ?></span>
                    </div>
                    <div <?php echo (!empty($tsub_err)) ? 'class="error"' : ''; ?>>
                        <label for="tsub">Subject</label>
                        <input type="text" name="tsub" value="<?php echo $tsub; ?>">
                        <span class="error"><?php echo $tsub_err; ?></span>
                    </div>
    <div>
        <input type="submit" name="add_teacher" value="Add Teacher">
    </div>
</form>
</div>
</div>

</div>

<script>
    // Display the success box when data is added successfully
    var successBox = document.querySelector('.success-box');
    if (successBox.textContent !== '') {
        successBox.style.display = 'block';
    }
</script>
</body>
</html>
