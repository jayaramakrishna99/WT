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
    <title>Login</title>
</head>
<body>
<div class="container">
        <form action="login.php" method="post">        
            <div class="form-group">
            <input type="text"  name="email" id="formcss" placeholder="jrk@gmail.com"><br>
            </div>
            <div class="form-group">
            <input type="password" name="password" id="formcss" placeholder="password"><br>
            </div>
            <div class="form-group">
            <input type="submit" value="Login" id="formcss" name="login" class="submitbtn">
            </div>
        </form>
        <?php
            if (isset($_POST["login"])) {
                $email=$_POST['email'];
                $password=$_POST['password'];
                // if (empty($email) or empty($password)){
                //     "<div class='alert alert-danger'>All fields are required.</div>";
                // }
                // $conn=new mysqli('localhost','root','','login');
                require_once "database.php";
                $result=mysqli_query($conn,"select * from details where email = '$email'");
                $user=mysqli_fetch_array($result,MYSQLI_ASSOC);
                if ($user){
                    if (password_verify($password,$user["password"])){
                        // if ($password==$user["password"]){
                        session_start();
                        $_SESSION['user']="yes";
                        header("Location: index.php");
                        die();
                    }
                    else{
                        echo "<div class='alert alert-danger'>Password does not match.</div>";
                    }
                }
                else{
                    echo "<div class='alert alert-danger'>Email does not exist.</div>";
                }
            }
        ?>
</body>
</html>