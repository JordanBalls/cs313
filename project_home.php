<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <link rel="stylesheet" type="text/css" href="styles.css"/>
  <title>Assignment Page</title>
</head>
<body>
<h1> Rexburg Restaurants </h1>

<div class="links">
  <a href="project_home.php">Home</a><br/>
  <a href="all_restaurants.php">Restaurants</a><br/>
  <?php
  if(isset($_SESSION['username']))
  echo '<a href="add_review.php">Add Review</a>';
  else
  echo '<a href="new_user.php">Create Account</a>';
  ?>

 </div>
 
<div class="main">
<?php
if (isset($_SESSION['username']))
{
echo 'Welcome ' . $_SESSION['username'] . ', you are logged in. Click <a href="logout.php">here</a> to logout.';
}
else
{
echo '
Login!
<form action="checklogin.php" method="POST">
User: <input type="text" name="username"><br/>
Pass: <input type="password" name="password" ><br/>
<input type="checkbox" value="remember">Remember me<br/>
<input type="submit" value="Login">
<input type="reset" value="Clear">
</form><br/>

New User? Click <a href="new_user.php">Here</a> to create an account!';
}?>
</div>

</body>
</html>