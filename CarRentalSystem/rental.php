<?php  include('db_config/connect.php');
session_start();
require "header.php";
if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['action']) && $_POST['action'] == 'delete')
{   $id = $_GET['id'];
    $query = "DELETE FROM rental WHERE rental_id = '$id'";
    $result = mysqli_query($con, $query);
    header("Location: rental.php");
}?>
<!DOCTYPE html>
<html lang="en">
<head>
<style>
table {
  border-collapse: collapse;
  width: 100%;
}

table, th, td {
  border: 1px solid black;
  padding: 8px;
}

th {
  background-color: #f2f2f2;
}

h1 {
  text-align: center;
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Page</title>
</head>
<body>
<h1>Rentals</h1>
<?php if(!empty($_GET['action']) && $_GET['action'] == 'delete' && (!empty($_GET['id']))):?>
  <div style="margin-top:15%">
  <h2 style="text-align: center;">Are you sure you want to delete this rental??</h2><div style="margin: auto;max-width: 600px;text-align: center;">
  <form method="post" enctype="multipart/form-data" style="margin: auto;padding:10px;">
  <input type="hidden" name="action" value="delete">
  <button>Delete</button>
  <a href="rental.php"><button type="button">Cancel</button></a>
  </form>
</div>
<?php else:?>
<table>
  <tr>
    <th>User</th>
    <th>Car</th>
    <th>Price</th>
    <th>Start Date</th>
    <th>End Date</th>
    <th>Action</th>
  </tr>
  <?php
  $query = "SELECT rental.rental_id,rental.rental_start_date, rental.rental_end_date, users.username, car.name, car.rental_price 
            FROM rental 
            INNER JOIN users ON rental.user_id = users.user_id 
            INNER JOIN car ON rental.car_id = car.car_id";
  $result = mysqli_query($con, $query);

  while ($row = mysqli_fetch_assoc($result)) {
    $rentalid=$row['rental_id'];
    echo "<tr>";
    echo "<td>" . $row['username'] . "</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['rental_price'] . "</td>";
    echo "<td>" . $row['rental_start_date'] . "</td>";
    echo "<td>" . $row['rental_end_date'] . "</td>";
    echo "<td><a href='rental.php?action=delete&id=" . $rentalid . "'><button>Delete</button></a></td>";
    echo "</tr>";
  }

  mysqli_close($con);
  ?>
</table>
<?php endif;?> 
</body>
</html>
