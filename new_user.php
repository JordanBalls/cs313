<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name = "viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href = "css/bootstrap.min.css">
  <title>Create Account</title>
</head>
<body>
<div class = "navbar navbar-inverse navbar-static-top">
   <div class = "container">
   
      <a href="#" class = "navbar-brand">Restaurant Reviews </a>
	  
	  <button class = "navbar-toggle" data-toggle = "collapse" data-target = ".navHeaderCollapse">
	     <span class = "icon-bar"></span>
	     <span class = "icon-bar"></span>
	     <span class = "icon-bar"></span>
	  </button>
      <div class = "collapse navbar-collapse navHeaderCollapse">
	     <ul class = "nav navbar-nav navbar-right">
		   <li><a href="project_home.php">Home</a></li>
		   <li><a href="all_restaurants.php">Restaurants</a></li>
		   <?php
		   
             if(isset($_SESSION['username']))
			 {
               echo '<li class = "active"><a href="add_review.php">Add Review</a></li>';
			   echo '<li><a href="logout.php">Logout</a></li>';
			 }
             else
               echo '<li class = "active"><a href="new_user.php">Create Account</a></li>';
           ?>
		 </ul>
	  </div>
   </div>
</div>

<div class = "container text-center">
  <div class = "jumbotron"> 
  <h1> Account Creation </h1>
  <p>Use the form below to create an account!</p>
  </div>
</div>

<form action="" method="POST">
  <div class = "form-inline form-group text-center">
    <label for="uname">Username</label>
    <input type="text" name="username" class = "form-control" id = "uname"><br/><br/>
  </div>
  <div class = "form-inline form-group text-center">
    <label for="pass">Password</label>
    <input type="password" name="password" class = "form-control" id = "pass"><br/><br/>
  </div>
  <div class = "form-inline form-group text-center">
    <label for="repass">Re-Enter Pass</label>
    <input type="password" name="passwordCheck" class = "form-control" id = "repass"></textarea><br/><br/>
    <input type="submit" value="Submit" class = "btn btn-default">
    <input type="reset" value="Reset" class = "btn btn-default">
  </div>
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