<?php
session_start();
include('db_config/connect.php');

$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
   $row=mysqli_fetch_assoc($result);
  $_SESSION['user_info']=$row;
   header('Location: home.php');
  
  
} else {
  
  header('Location: login.php');
}

mysqli_close($con);
?>
