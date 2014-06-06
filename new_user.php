<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <link rel="stylesheet" type="text/css" href="styles.css"/>
  <title>Assignment Page</title>
</head>
<body>
<h1> Create User Account </h1>

<div class="links">
  <a href="project_home.php">Home</a><br/>
  <a href="all_restaurants.php">Restaurants</a><br/>
  <a href="new_user.php">Create Account</a>
 </div>


<div class="main">
<form action="" method="POST">
Username: <input type="text" name="username"></br>
Password: <input type="password" name="password"></br>
Re-type Password: <input type="password" name="passwordCheck"></br>
<input type="submit" value="Submit">
</form>

<?php
require("dbConnect.php");
try
{
$db = loadDatabase();
}

catch(PDOException $ex)
{
die("dead");
}
if (isset($_POST['username']) && ($_POST['password'] != $_POST['passwordCheck']))
{
echo '<p style="color:red">Passwords do not match!</p>';
}
else if (isset($_POST['username']) && $_POST['username'] != "")
{
$stmt = $db->prepare("INSERT INTO user (user_name, password) 
                      VALUES (:username, :password)");
$stmt->bindParam(':username', $_POST['username']);
$stmt->bindParam(':password', $_POST['password']);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo 'Account Successfully Created';
}

?>
</div>


</body>
</html>