<?php
include 'connection.php';

$login = filter_var(trim($_POST['login']),FILTER_SANITIZE_STRING);
$pass = filter_var(trim($_POST['password']),FILTER_SANITIZE_STRING);

$pass = md5($pass);

$sql = "SELECT * FROM users WHERE `login`='$login' AND `password`='$pass';";
$res = mysqli_query($conn,$sql);

$row = mysqli_fetch_assoc($res);

if ($row == 0){
    echo "Bunday foydalanuvchi topilmadi";
    exit();
}

setcookie('user', $row['login'], time() + 3600*24, "/ ");


header("location: dashboard.php");



?>