<?php  include('db_config/connect.php');
session_start();
require "header.php";
if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['action']) && $_POST['action'] == 'delete')
{   $id = $_GET['id'];
    $query = "DELETE FROM rental WHERE rental_id = '$id'";
    $result = mysqli_query($con, $query);
    header("Location: rentalhistory.php");
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

p {
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
    <title>Rental History</title>
</head>
<body>

<h1>Rental History</h1>
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
<?php

$userId = $_SESSION['user_info']['user_id'];

$query = "SELECT rental.rental_id, car.name, rental.rental_start_date, rental.rental_end_date,rental.cost 
          FROM rental 
          INNER JOIN car ON rental.car_id = car.car_id 
          WHERE rental.user_id = '$userId'";

$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
  echo "<table>";
  echo "<tr>
          <th>Car</th>
          <th>Start Date</th>
          <th>End Date</th>
          <th>Cost</th>
          <th>Action</th>
        </tr>";

  while ($row = mysqli_fetch_assoc($result)) {
    $rentalid=$row['rental_id'];
    echo "<tr>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['rental_start_date'] . "</td>";
    echo "<td>" . $row['rental_end_date'] . "</td>";
    echo "<td>" . $row['cost'] . "</td>";
    echo "<td><a href='rentalhistory.php?action=delete&id=" . $rentalid . "'><button>Delete</button></a></td>";
   
    echo "</tr>";
  }

  echo "</table>";
} else {
  echo "<p>No rental history found.</p>";
}


?>
<?php endif;?> 
</body>
</html>