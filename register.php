<?php
session_start();
//connect to database
$db=mysqli_connect("localhost","root","","mysite");
if(isset($_POST['register_btn'])) {
    $email=mysqli_real_escape_string($db,$_POST['email']);
    $password=mysqli_real_escape_string($db,$_POST['password']);
    $password2=mysqli_real_escape_string($db,$_POST['password2']);  
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result=mysqli_query($db,$query);

    if($result) {
        if( mysqli_num_rows($result) > 0) {
            $_SESSION['message']="Email used";
        }
        else {
            if($password==$password2) {
                //Create User
                $password=md5($password);
                $sql="INSERT INTO users(email, password) VALUES('$email','$password')";
                mysqli_query($db,$sql);
                $_SESSION['email'] = $email;
                header("location:page.php");
            }
            else {
                $_SESSION['message']="Password are different";
            }
        }
    }
}?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Register</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<style>
    body {
        display: flex;
        flex-direction: column;
        padding: 16.7vw 44.5vw;
    }
    .btn1{
            width: 14.5vw;
        }
</style>
<body>

<?php
    if(isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
?>

<!-- Register-->
    <form method="post" action="register.php">
        <table>
            <tr>
                <td><input type="email" name="email" placeholder="email"></td>
            </tr>
            <tr>
                <td><input type="password" name="password" placeholder="password"></td>
            </tr>
            <tr>
                <td><input type="password" name="password2" placeholder="password*"></td>
            </tr>
            <tr>
                <td><input type="submit" name="register_btn" class="btn btn-success btn1 Register"></td>
            </tr>
        </table>
    </form>

    <form method="post" action="login.php">
         <input type="submit" name="login" class="btn btn-success btn1" value="Login" />
    </form>

    <form method="post" action="export.php">
         <input type="submit" name="export" class="btn btn-success btn1" value="Export" />
    </form>

</body>
</html>




