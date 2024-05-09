<?php
    $conn= new mysqli('localhost','root','','login');
    if (!$conn){
        die("connection failed".$conn->connect_error);
    }
?>