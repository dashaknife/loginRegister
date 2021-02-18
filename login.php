<?php
session_start();
if(isset($_SESSION['email'])){
    header("location:page.php");
    die();
}
//connect to database
$db=mysqli_connect("localhost","root","","mysite");
if($db) {
    if(isset($_POST['login_btn'])) {
        $email=mysqli_real_escape_string($db,$_POST['email']);
        $password=mysqli_real_escape_string($db,$_POST['password']);
        $password=md5($password);
        $sql="SELECT * FROM users WHERE email='$email' AND password='$password'";
        $result=mysqli_query($db,$sql);

        if($result){
            if( mysqli_num_rows($result)>=1) {
                $_SESSION['message']="You are now Loggged In";
                $_SESSION['email']=$email;
                header("location:page.php");
            }
            else {
                $_SESSION['message']="Email or password are incorrect";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login</title>
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

    <form method="post" action="login.php">
        <table>
            <tr>
                <td><input type="email" name="email" placeholder="email"></td>
            </tr>
            <tr>
                <td><input type="password" name="password" placeholder="password"></td>
            </tr>
            <tr>
                <td><input type="submit" class="btn btn-success btn1" name="login_btn" class="Log In"></td>
            </tr>
        </table>
    </form>
    <form method="post" action="register.php">
        <input type="submit" name="login" class="btn btn-success btn1" value="Register" />
    </form>

    <form method="post" action="export.php">
         <input type="submit" name="export" class="btn btn-success btn1" value="Export" />
    </form>

</body>
</html>