<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retrieve</title>
</head>
<body>
    <table class="table">
        <thead>
            <tr>
                <th>firstname</th>
                <th>lastname</th>
                <th>age</th>
                <th>fathername</th>
                <th>mothername</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $conn=mysqli_connect('localhost','root','','form');
                if (!$conn){
                    die("Connection is Failed");
                }
                $result=mysqli_query($conn,"select * from details");
                
                while($row=mysqli_fetch_array($result)){
                    $fn=$row['firstname'];
                    $ln=$row['lastname'];
                    $age=$row['age'];
                    $fname=$row['fathername'];
                    $mname=$row['mothername'];
                    echo "<tr>
                            <td>$fn</td>
                            <td>$ln</td>
                            <td>$age</td>
                            <td>$fname</td>
                            <td>$mname</td>
                        </tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>