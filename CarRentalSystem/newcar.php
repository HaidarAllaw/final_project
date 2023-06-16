<!DOCTYPE html>
<html lang="en">
<head>
<style>
form{
    margin-left: 30%;
}        
label {
  display: block;
  margin-bottom: 10px;
}

input[type="text"],
input[type="number"],
input[type="file"]{
  width: 50%;
  padding: 5px;
  margin-bottom: 10px;
  border-radius: 3px;
  border: 1px solid #ccc;
}

 button{
  width: 30%;
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
    <title>Add Car</title>
</head>
<body>
    
 <h2>Add Car</h2>
      <form method="post" action="addcaraction.php" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="modal">Modal:</label>
        <input type="text" id="modal" name="modal" required><br>

        <label for="year">Year:</label>
        <input type="number" id="year" name="year" required><br>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" required><br>

        <label for="image">Image:</label>
        <input type="file" id="image" name="image" accept="image/*" required><br>

        <label for="available">Available:
        <input type="checkbox" id="available" name="available"><br></label>

        <button type="submit">Add Car</button>
        
      </form>
    <a href="home.php" style="margin-left: 30%"><button style="margin-top: 3%;width:21%">Cancel</button></a>
</body>
</html>