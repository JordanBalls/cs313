<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name = "viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href = "css/bootstrap.min.css">

  <title>Project Home</title>
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
		   <li class = "active"><a href="#">Home</a></li>
		   <li><a href="all_restaurants.php">Restaurants</a></li>
		   <?php
             if(isset($_SESSION['username']))
			 {
               echo '<li><a href="add_review.php">Add Review</a></li>';
			   echo '<li><a href="logout.php">Logout</a></li>';
			 }
             else
               echo '<li><a href="new_user.php">Create Account</a></li>';
           ?>
		 </ul>
	  </div>
   </div>
</div>

<div class = "container text-center">
  <div class = "jumbotron"> 
  <h1> Hello, You </h1>
  <p>Feel free to browse the site and read the reviews posted. If you wish to add your own review, 
     be sure to create an account! Or, if you already have done so, login below.</p>
  </div>
</div>

 
<div class="main">
<?php
if (isset($_SESSION['username']))
{
echo '<p class="text-center">Welcome back <strong>' . $_SESSION['username'] . 
     '</strong>, you are logged in. Click <a href="logout.php">here</a> to logout.</p>';
}
else
{
echo '


<form class = "text-center" action="checklogin.php" method="POST">
User: <input type="text" name="username"><br/>
Pass: <input type="password" name="password" ><br/>
<input type="checkbox" value="remember">Remember me<br/>
<input type="submit" value="Login" class = "btn btn-default">
<input type="reset" value="Clear" class = "btn btn-default">
</form><br/>

<p class = "text-center">
New User? Click <a href="new_user.php">Here</a> to create an account!
</p>';
}?>
</div>

  <script src="js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</body>
</html>