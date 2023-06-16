
<!DOCTYPE html>
<html>
<head>
<style>
body{
    background-image:url("images/20-features-in-car-rental-software-in-2020-1.jpg");
}
.container {
  width: 300px;
  margin: 0 auto;
  padding-top: 150px;
}

form {
  background-color: #f2f2f2;
  padding: 20px;
  border-radius: 5px;
}

h2 {
  text-align: center;
}

.form-group {
  margin-bottom: 10px;
}

label {
  display: block;
  font-weight: bold;
}

input[type="email"],
input[type="password"] {
  width: 100%;
  padding: 5px;
  border-radius: 3px;
  border: 1px solid #ccc;
}

button {
  width: 100%;
  padding: 10px;
  background-color: #4CAF50;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

button:hover {
  background-color: #45a049;
}

    </style>
  <title>Login</title>
  
</head>
<body>
  <div class="container">
    <form method="post" action="loginaction.php">
      <h2>Login</h2>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
      </div>
      <button type="submit">Login</button>
    </form>
    <a href="signup.php"><button style="margin-top: 5%;">New Account</button></a>
  </div>
</body>
</html>
