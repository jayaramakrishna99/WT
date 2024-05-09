<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method="post">
        <label for="First">First Name:</label>
        <input type="text" name="First" id="First" placeholder="Enter First Name">
        <label for="Last">Last Name:</label>
        <input type="text"  name="last" id="Last" placeholder="Enter Last Name"><br>

        <!-- <label>DOB:</label>
        <input type="date"><br> -->
        <label>Age:</label>
        <input type="number" name="age"><br>

        <label for="Father">Father Name:</label>
        <input type="text" name="father" id="Father" placeholder="Enter Father Name">
        <label for="Mother">Mother Name:</label>
        <input type="text"  name="mother" id="Mother" placeholder="Enter Mother Name"><br> 

        <input type="submit" id="btn">

        
        
        <!-- <label for="address">Address:</label>
        <textarea name="address" id="address" height="35px" width="25px"></textarea> -->


    </form>
    <?php
        $firstname=$_POST['First'];
        $lastname=$_POST['last'];
        $age=$_POST['age'];
        $fathername=$_POST['father'];
        $mothername=$_POST['mother'];

        $conn=new mysqli('localhost','root','','form');
        if($conn->connect_error){
            die("Connection failed: ".$conn->connect_error);
        }
        else{
            $stmt=$conn->prepare("insert into details(firstname,lastname,age,fathername,mothername)values(?,?,?,?,?)") ;
            $stmt->bind_param("ssiss",$firstname,$lastname,$age,$fathername,$mothername);
            $stmt->execute();
            echo "Registration Successfully..";
            $stmt->close();
            $conn->close();
        }
    ?>
</body>
</html>