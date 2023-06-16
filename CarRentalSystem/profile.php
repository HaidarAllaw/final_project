<?php session_start();
include('db_config/connect.php');
$userid=$_SESSION['user_info']['user_id'];
require "header.php";
if($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['action']) && $_POST['action'] == 'edit' ){
 $image_added = false;
if(!empty($_FILES['image']['name']) && $_FILES['image']['error'] == 0 && $_FILES['image']['type'] == "image/jpeg"
  ){ $folder = "images/";
      if(!file_exists($folder))
      {
        mkdir($folder,0777,true);
      }

      $image = $folder . $_FILES['image']['name'];
      move_uploaded_file($_FILES['image']['tmp_name'], $image);

      if(file_exists($_SESSION['user_info']['image'])){
          unlink($_SESSION['user_info']['image']);
      }

      $image_added = true;
  }

  $username = addslashes($_POST['username']);
  $email = addslashes($_POST['email']);
  $password = addslashes($_POST['password']);

  if($image_added == true){
      $query = "update users set username = '$username',email = '$email',password = '$password',image = '$image' where user_id = '$userid' limit 1";
  }else{
      $query = "update users set username = '$username',email = '$email',password = '$password' where user_id = '$userid' limit 1";
  }

  $result = mysqli_query($con,$query);

  $query = "select * from users where user_id = '$userid' limit 1";
  $result = mysqli_query($con,$query);

  if(mysqli_num_rows($result) > 0){

      $_SESSION['user_info'] = mysqli_fetch_assoc($result);
  }

  header("Location: profile.php");
  die;
  }
elseif($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['action']) && $_POST['action'] == 'delete' )
 {   $id = $_SESSION['user_info']['user_id'];
     $query = "delete from users where user_id = '$id' limit 1";
       $result = mysqli_query($con,$query);
       if(file_exists($_SESSION['user_info']['image'])){
       unlink($_SESSION['user_info']['image']);
       }
       header("Location: login.php");
        die;
     
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        
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
<title>Profile</title>
</head>
<body>
<?php if(!empty($_GET['action']) && $_GET['action'] == 'edit'):?>
 <div  style="margin-top:5%;margin-left:30%">
 <form method="post"  enctype="multipart/form-data">
    <img src="<?php echo $_SESSION['user_info']['image']?>" style="width:40%;height:40%;"><br><br>
    Profile Picture: <input type="file" name="image" accept="image/*"><br>
         <input value="<?php echo $_SESSION['user_info']['username']?>" type="text" name="username" style="margin-top:1%;"required><br>
         <input value="<?php echo $_SESSION['user_info']['email']?>" type="email" name="email" style="margin-top:1%;"required><br>
         <input value="<?php echo $_SESSION['user_info']['contact_number']?>" type="text" name="contact_number" style="margin-top:1%;" required><br>
         <input type="hidden" name="action" value="edit">
         <button style="margin-top:2%;">Save</button>
         
 </form><a href="profile.php"><button>Cancel</button></a>
 </div>
<?php elseif(!empty($_GET['action']) && $_GET['action'] == 'delete'):?>
    <div style="margin-top:5%;margin-left:30%">
    <h2 class="username">Are you sure you want to delete your profile?!</h2>
   <form method="post">
        <input type="hidden" name="action" value="delete">
        <button>Delete</button>
       
        
    </form><a href="profile.php"><button>Cancel</button></a>
 </div>
<?php else:?>
 <div  style="margin-top:5%;margin-left:30%">
    <td><img src="<?php echo $_SESSION['user_info']['image']?>" style="width:40%;height:40%; margin-top:5%;"></td>
         <br><br>
         
    <td ><?php echo $_SESSION['user_info']['username']?></td><br> 
    <td ><?php echo $_SESSION['user_info']['email']?></td><br>
    <td ><?php echo $_SESSION['user_info']['contact_number']?></td><br>
    <br><br>

    <a href="profile.php?action=edit"><button class="<?php echo $cssbutton; ?>">Edit profile</button></a>
    <a href="profile.php?action=delete"><button class="<?php echo $cssbutton; ?>">Delete profile</button></a><br><br>
 </div>


 <?php endif;?> 
  
</body>
</html>