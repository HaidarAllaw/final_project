<?php
include('db_config/connect.php');
$name=$_POST ['name'];
$email=$_POST['email'];
$pass=$_POST['password'];
$nbr=$_POST['contact_number'];
$image_name = $_FILES["image"]["name"];
$image_tmp = $_FILES["image"]["tmp_name"];
$uploads_dir = "images/"; 
$image_path = $uploads_dir . $image_name;
move_uploaded_file($image_tmp, $image_path);
$query = "INSERT INTO users (username, password, email, contact_number, image, role, date)
          VALUES ('$name', '$pass', '$email', '$nbr', '$image_path', 'User', NOW())";
mysqli_query($con,$query);
header('location:login.php');
?>
