<?php
include('db_config/connect.php');
$name = $_POST['name'];
$modal = $_POST['modal'];
$year = $_POST['year'];
$price = $_POST['price'];
$image_name = $_FILES["image"]["name"];
$image_tmp = $_FILES["image"]["tmp_name"];
$uploads_dir = "car_images/";
$image_path = $uploads_dir . $image_name;
move_uploaded_file($image_tmp, $image_path);
$available = isset($_POST['available']) ? 1 : 0;
$query = "INSERT INTO car (name, model, year, rental_price, image, availability)
VALUES ('$name', '$modal', '$year', '$price', '$image_path', '$available')";
mysqli_query($con, $query);

mysqli_close($con);
header('Location: home.php');
?>
