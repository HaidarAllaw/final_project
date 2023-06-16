<?php  include('db_config/connect.php');
session_start();
require "header.php";
if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['action']) && $_POST['action'] == 'delete')
{   $id = $_GET['id'];
    $selquery = "SELECT * FROM car WHERE car_id = '$id' LIMIT 1";
    $result = mysqli_query($con, $selquery);
    if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION['car_info'] = $row;
    }
    $query = "DELETE FROM car WHERE car_id = '$id'";
    $result = mysqli_query($con, $query);
    if (file_exists($_SESSION['car_info']['image'])) {
    unlink($_SESSION['car_info']['image']);
    }
    header("Location: home.php");
    die;
    

}
elseif($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['action']) && $_POST['action'] == 'edit' ){
$id = $_GET['id'];
$selquery = "SELECT * FROM car WHERE car_id = '$id' LIMIT 1";
$result = mysqli_query($con, $selquery);
if (mysqli_num_rows($result) > 0) {
$row = mysqli_fetch_assoc($result);
$_SESSION['car_info'] = $row;
}
$image_added = false;
if(!empty($_FILES['image']['name']) && $_FILES['image']['error'] == 0 && $_FILES['image']['type'] == "image/jpeg"
){
$folder = "car_images/";
if(!file_exists($folder))
{
mkdir($folder,0777,true);
}
$image = $folder . $_FILES['image']['name'];
move_uploaded_file($_FILES['image']['tmp_name'], $image);
if(file_exists($_SESSION['car_info']['image'])){
unlink($_SESSION['car_info']['image']);
}
$image_added = true;
}
$name = addslashes($_POST['name']);
$model = addslashes($_POST['model']);
$year = addslashes($_POST['year']);
$rental_price = addslashes($_POST['rental_price']);
if($image_added == true){
$query = "update car set name = '$name',model = '$model',year = '$year',rental_price='$rental_price',image = '$image' where car_id = '$id' limit 1";
}else{
 $query = "update car set name = '$name',model = '$model',year = '$year',rental_price='$rental_price' where car_id = '$id' limit 1";
}
$result = mysqli_query($con,$query);
header("Location: home.php");
die;
} 
elseif($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['action']) && $_POST['action'] == 'rent' ){
$carid = $_GET['id'];
$selquery = "SELECT * FROM car WHERE car_id = '$carid' LIMIT 1";
$result = mysqli_query($con, $selquery);
if (mysqli_num_rows($result) > 0) {
$row = mysqli_fetch_assoc($result);
$_SESSION['car_info'] = $row;
$cost=$_SESSION['car_info']['rental_price'];
}
$userid=$_SESSION['user_info']['user_id'];
$rental_start_date=$_POST['rental_start_date'];
$rental_end_date=$_POST['rental_end_date'];
$query = "insert into rental(car_id,user_id,rental_start_date,rental_end_date,cost)values('$carid','$userid','$rental_start_date','$rental_end_date','$cost')";
$result = mysqli_query($con, $query);
header("Location: home.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<style>
 .container {
  width: 80%;
  margin: 0 auto;
  padding-top: 30px;
 }

 h2, h3 {
  text-align: center;
 }

 table {
  width: 100%;
  border-collapse: collapse;
 }

 table, th, td {
  border: 1px solid #ccc;
  padding: 8px;
 }

 button {
  background-color: #4CAF50;
  color: #fff;
  border: none;
  border-radius: 5px;
  padding: 10px;
  cursor: pointer;
 }
 button:hover {
    background-color: #45a049;
  }
</style>
     
  <title>Home Page</title>

</head>
<body>
<?php if(!empty($_GET['action']) && $_GET['action'] == 'edit' && (!empty($_GET['id']))):
 $id=$_GET['id'];
 $query = "select * from car where car_id = $id";
 $result= mysqli_query($con,$query);
 if(mysqli_num_rows($result) > 0){ $row=mysqli_fetch_assoc($result);
 $_SESSION['car_info']=$row;}?>
 <div style="margin-top:5%">
  <h2 style="text-align: center;">Edit profile</h2>
<form method="post"  enctype="multipart/form-data" style="margin: auto;padding:10px;width:50%">
 <img src="<?php echo $_SESSION['car_info']['image']?>" style="margin-top:3%;width: 100px;height: 100px;object-fit: cover;margin: auto;display: block;">
  image: <input type="file" name="image" accept="image/*"><br>
  <input value="<?php echo $_SESSION['car_info']['name']?>" style="margin-top:3%" type="text" name="name" required><br>
  <input value="<?php echo $_SESSION['car_info']['model']?>" style="margin-top:3%" type="text" name="model"  required><br>
  <input value="<?php echo $_SESSION['car_info']['year']?>"  style="margin-top:3%" type="text" name="year"  required><br>
  <input value="<?php echo $_SESSION['car_info']['rental_price']?>" style="margin-top:3%"  type="text" name="rental_price"  required><br>
  <input type="hidden" name="action" value="edit">
 <button type="submit" style="margin-top:3%">Save</button>
 <a href="home.php"><button type="button">Cancel</button></a>
</form>
</div>


<?php elseif(!empty($_GET['action']) && $_GET['action'] == 'delete' && (!empty($_GET['id']))):
 $id=$_GET['id'];
 $query = "select * from car where car_id = $id";
 $result= mysqli_query($con,$query);
 if(mysqli_num_rows($result) > 0){ $row=mysqli_fetch_assoc($result);
 $_SESSION['car_info']=$row;}?>
 <div style="margin-top:15%">
  <h2 style="text-align: center;">Are you sure you want to delete the car??</h2><div style="margin: auto;max-width: 600px;text-align: center;">
  <form method="post" enctype="multipart/form-data" style="margin: auto;padding:10px;">
  <img src="<?php echo $_SESSION['car_info']['image']?>" style="width: 100px;height: 100px;object-fit: cover;margin: auto;display: block;">
  <h3><?php echo $_SESSION['car_info']['name']?></h3>
  <input type="hidden" name="action" value="delete">
  <button type="submit">Delete</button>
  <a href="home.php"><button type="button">Cancel</button></a>
  </form>
</div>


<?php elseif(!empty($_GET['action']) && $_GET['action'] == 'rent' && (!empty($_GET['id']))):
 $id=$_GET['id'];
 $query = "select * from car where car_id = $id";
 $result= mysqli_query($con,$query);
 if(mysqli_num_rows($result) > 0){ $row=mysqli_fetch_assoc($result);
 $_SESSION['car_info']=$row;}
 if($_SESSION['car_info']['availability']==0){
  ?>
   <h2 style="text-align: center;">car is not available</h2><div style="margin: auto;max-width: 600px;text-align: center;">
 <?php } else {?>
  <div style="margin-top:10%">
  <h2 style="text-align: center;">Are you sure you want to rent this car??</h2><div style="margin: auto;max-width: 600px;text-align: center;">
  <form method="post" enctype="multipart/form-data" style="margin: auto;padding:10px;">
  <img src="<?php echo $_SESSION['car_info']['image']?>" style="width: 100px;height: 100px;object-fit: cover;margin: auto;display: block;">
  <h3><?php echo $_SESSION['car_info']['name']?></h3>
  Start date:<input type="date" name="rental_start_date">
  End date:<input type="date" name="rental_end_date"><br>
  <input type="hidden" name="action" value="rent">
  <button style="margin-top: 15px;">Save</button>
  <a href="home.php"><button type="button" style="margin-top: 15px;">Cancel</button></a>
  </form>
</div>
<?php } ?>


<?php else:?>
<div class="container">
<?php if($_SESSION['user_info']['role']=='Admin'){?>
<h2>Admin Panel</h2>
<a href="newcar.php"><button>Add Car</button></a>  <a href="rental.php"><button>See Rental</button></a><br><br>
<?php } else {?>
<h2>Car List</h2> 
<a href="rentalhistory.php"><button>Rental History</button></a><br><br>
<?php } ?>
<table>
  <tr>
  <th>Name</th>
  <th>Modal</th>
  <th>Year</th>
  <th>Price</th>
  <th>Image</th>
  <th>Available</th>
  <th>Action</th> 
  </tr>
  <?php
    $query = "SELECT * FROM car";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($result)) {
    $id=$row['car_id'];
    echo "<tr>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['model'] . "</td>";
    echo "<td>" . $row['year'] . "</td>";
    echo "<td>" . $row['rental_price'] . "</td>";
    echo "<td><img src='" . $row['image'] . "' alt='Car Image' width='100'></td>";
    echo "<td>" . ($row['availability'] ? 'Yes' : 'No') . "</td>";
    if($_SESSION['user_info']['role']=='Admin'){
    echo "<td><a href='home.php?action=edit&id=" . $id . "'><button>Edit</button></a> <a href='home.php?action=delete&id=" . $id . "'><button>Delete</button></a></td>";
    }
    else
    {
    echo "<td><a href='home.php?action=rent&id=" . $id . "'><button>Rent</button></a></td>";
    }
    echo "</tr>";
    }
    mysqli_close($con);
    ?>
</table>
</div>
<?php endif;?> 
</body>
</html>
