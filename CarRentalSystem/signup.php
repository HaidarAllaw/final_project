<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="css/style.css" >
    <title>registration Form</title>
</head>
<body>
  
  <div style="margin:auto;max-width:600px;text-align:center;">
        <h1>Register:</h1>
        <form method=post action="signupaction.php" enctype="multipart/form-data" >
          <label for="name">Name:</label>
          <input type="text" id="name" name="name" required><br>
          
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required><br>

          <label for="contact_number">Contact number:</label>
          <input type="text" id="contact_number" name="contact_number" required><br>
          
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" required><br>
          <label for="role">Role:</label>
          <select name="role" required>
             <option></option>
             <option>Admin</option>
             <option>User</option>
          </select>

          <label for="image">Choose a profile picture:</label>
          <input type="file" id="image" name="image" accept="image/*"><br>
          <button type="submit">Register</button>
        </form>    
        <a href="login.php"><button style="margin-top: 5%;">RETURN TO LOG IN</button></a>
      </div>
     
</body>
