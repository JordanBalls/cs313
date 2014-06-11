<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name = "viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href = "css/bootstrap.min.css">
  <title>All Restaurants</title>
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
		   <li class = "active"><a href="all_restaurants.php">Restaurants</a></li>
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
  <h1> Restaurants </h1>
  <p>Below are the restaurants we currently have reviews for, listed alphabetically.</p>
  </div>
</div>
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

$stmt = $db->prepare("SELECT * FROM restaurant ORDER BY 2");
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo '<div class = "container">';
echo '<div class = "row">';
foreach($rows AS $row)
{
echo '<div class = "col-md-3"> <b> Name: ' . '<a href="display_reviews.php?id=' . $row['id'] . '">' . $row['name'] . '</a>' 
     . "<br/> Address: " . $row['address'] . '</b><br/><br/>';
	 if (isset($_SESSION['username']))
	 echo '<form action="add_review.php?id=' . $row['id'] . '" method="POST"><input type = "submit" value="Add Review"></form>';
	 echo '<br/></div>';
}
echo '</div>';
echo '</div>';
?> 
  
 <script src="js/bootstrap.min.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</body>

</html>