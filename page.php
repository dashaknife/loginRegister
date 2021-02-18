<?php
  session_start();
  $db=mysqli_connect("localhost","root","","mysite");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<style>
    body {
        display: flex;
        flex-direction: column;
        padding: 16.7vw 44.5vw;
    }
</style>

<body>

<?php
    if(isset($_SESSION['message'])){
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
?>
    <h4>Hello, <?php echo $_SESSION['email'];?></h4>
    <a href="logout.php">Logout</a>

</body>
</html>
