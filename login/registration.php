<?php
    session_start();
    if (isset($_SESSION["user"])){
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Registration</title>
</head>
<body>
    <div class="container">
        <form action="registration.php" method="post">
            <!-- <label for="username">User Name:</label> -->
            <div class="form-group">
            <input type="text" name="user" id="formcss" placeholder="User Name"><br>
            </div>
            <div class="form-group">
            <!-- <label for="email">Email:</label> -->
            <input type="text"  name="email" id="formcss" placeholder="jrk@gmail.com"><br>
            </div>
            <div class="form-group">
            <input type="password" name="password" id="formcss" placeholder="password"><br>
            </div>
            <div class="form-group">
            <input type="password" name="passwordrepeat" id="formcss" placeholder="Repeat Password"><br>
            </div>
            <div class="form-group">
            <input type="submit" value="Register" name="register" id="formcss" class="submitbtn">
            </div>
        </form>
        <?php
            if (isset($_POST["register"])) {
            $username=$_POST['user'];
            $email=$_POST['email'];
            $password=$_POST['password'];
            $passwordrepeat=$_POST['passwordrepeat'];
            $passwordhash=password_hash($password,PASSWORD_DEFAULT);
            $errors=array();
            if (empty($username) or empty($email) or empty($password) or empty($passwordrepeat)){
                array_push($errors,"All fields are required.");
            }
            if (strlen($password)<8){
                array_push($errors,"Password must be at least 8 characters");
            }
            if ($password != $passwordrepeat){
                array_push($errors,"Password not match.");
            }
            if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
                array_push($errors,"Email is not Valid.");
            }
            $conni= new mysqli('localhost','root','','login');
            $result=mysqli_query($conni,"select * from details where email='$email'");
            $rowcount=mysqli_num_rows($result);
            if ($rowcount>0){
                array_push($errors,"Email already exists!");
            }
            if (count($errors)>0){
                foreach($errors as $error){
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            }
            else{
                $conn= new mysqli('localhost','root','','login');
                if (!$conn){
                    die("connection failed".$conn->connect_error);
                }
                else{
                    $stmt=$conn->prepare("insert into details(username,email,password)values(?,?,?)");
                    $stmt->bind_param("sss",$username,$email,$passwordhash);
                    $stmt->execute();
                    echo "Registration Successful.";
                    $stmt->close();
                    $conn->close();
                }
            }
        }
        ?>
        
    </div>
</body>
</html>