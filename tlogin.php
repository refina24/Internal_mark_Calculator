<!DOCTYPE html>
<html>
<head>
    <title>Teachers Space</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin-left:10%;
            margin-top:8%;
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

<form method="post">
    <div id="d1">
        REGISTER ID:<input type="text" name="rid" required/>
        UT1:<input type="text" name="ut1" />
        UT2:<input type="text" name="ut2" />
        UT3:<input type="text" name="ut3" />
    </div>
    <br><br>
    <input id="ins" type="submit" name="ins" value="INSERT"/>
    <input type="submit" id="upd" name="upd" value="UPDATE" />
    <input type="submit" id="dele" name="dele" value="DELETE" />
    <input type="submit" id="calc" name="calc" value="CALCULATE INTERNALS" formnovalidate="formnovalidate" />
    <input type="submit" id="list_detail" name="list_detail" value="LIST ALL VALUES" formnovalidate="formnovalidate" />
</form>

</body>
</html>

<?php
session_start();
if(isset($_POST['rid'])){
    $id=$_POST['rid'];
    $u1=$_POST['ut1'];
    $u2=$_POST['ut2'];
    $u3=$_POST['ut3'];
    $_SESSION['rid']=$id;
    $_SESSION['unit1']=$u1;
    $_SESSION['unit2']=$u2;
    $_SESSION['unit3']=$u3;
}
$flag=1;
$username="root";
$servername="localhost";
$dbname="studinfo";
$con=mysqli_connect($servername,$username,"",$dbname);
if($con->connect_error){
    die("Connection failed:".$con->connect_error);
}    
else{
    $table=$_SESSION['tsub'];
    if(isset($_POST['ins']))
    {
        $stmt=$con->prepare("insert into $table (reg_id,ut1,ut2,ut3) values(?,?,?,?)");
        $stmt->bind_param("iiii",$id,$u1,$u2,$u3);
        $id=$_POST['rid'];
        $u1=$_POST['ut1'];
        $u2=$_POST['ut2'];
        $u3=$_POST['ut3'];
        $stmt->execute();
    }
    else if(isset($_POST['upd']))
    {
        $id=$_POST['rid'];

        if(isset($_POST['ut1']))
        {
            $utmark=$_POST['ut1'];

            $sql="update $table set ut1=$utmark where reg_id=$id";

            mysqli_query($con, $sql);
        }

        if(isset($_POST['ut2']))
        {
            $utmark=$_POST['ut2'];

            $sql="update $table set ut2=$utmark where reg_id=$id";
            mysqli_query($con, $sql);
        }
        if(isset($_POST['ut3'])){
            $utmark=$_POST['ut3'];
            $sql="update $table set ut3=$utmark where reg_id=$id";
            mysqli_query($con, $sql);
        }
    }
    else if(isset($_POST['dele'])){
        $id=$_POST['rid'];

        $sql="delete from $table where reg_id=$id";
        mysqli_query($con,$sql);
    }

    if(isset($_POST['calc'])){
        $flag=0;
        $sql="select * from $table";
        $result=$con->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $internal_mark=$row["ut1"]+$row["ut2"]+$row["ut3"];
                $internal_mark=$internal_mark/3;
                $id=$row["reg_id"];
                $internal_mark=intval($internal_mark);

                $sql_query="update $table set im=$internal_mark where reg_id=$id ";
                mysqli_query($con, $sql_query);
            }
        }
    }

    if(isset($_POST['list_detail'])){
        $flag=0;
        $sql="select * from $table";
        $result=$con->query($sql);
        $t2="t2";
        if ($result->num_rows > 0) {
            echo "<table id=$t2>";
            echo "<tr><th>ID</th><th>UT1</th><th>UT2</th><th>UT3</th><th>INTERNAL MARK</th></tr>";
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["reg_id"]."</td><td>".$row["ut1"]."</td><td>".$row["ut2"]."</td><td>".$row["ut3"]."</td><td>".$row["im"]."</td></tr>";
            }
            echo "</table>";
        } 
        else {
            /*echo "0 results";*/
        }
    }

    if($flag==1){
        $sql="select * from $table";
        $result=$con->query($sql);
        $t1="t1";
        if ($result->num_rows > 0) {
            echo "<table id=$t1>";
            echo "<tr><th>ID</th><th>UT1</th><th>UT2</th><th>UT3</th></tr>";
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["reg_id"]."</td><td>".$row["ut1"]."</td><td>".$row["ut2"]."</td><td>".$row["ut3"]."</td></tr>";
            }
            echo "</table>";
        } 
        else {
            /*echo "0 results";*/
        }
    }
}
?>


