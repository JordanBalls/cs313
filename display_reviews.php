<?php
if(!isset($_SESSION))
session_start();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name = "viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href = "css/bootstrap.min.css">
  <title>Reviews</title>
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
  <h1> Reviews for
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
$id = $_GET['id'];

$stmt = $db->prepare("SELECT name FROM restaurant WHERE id=:id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach($rows AS $row)
{
echo $row['name'];
}
?>
  </h1>
  </div>
</div>

 <?php
$stmt = $db->prepare("SELECT review, user_name FROM review AS r
                      JOIN user AS u ON u.id = r.userID
					  WHERE restaurantID=:id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo '<div class = "container">';
echo '<div class = "row">';
foreach($rows AS $row)
{
echo '<div class = "col-md-3"><b>"' . $row['review'] . '"<br/> Provided By: ' . 
      $row['user_name'] . '</b><br/><br/><br/></div>';
}
echo '</div></div>';
?>
 
 <script src="js/bootstrap.min.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
 </body>
 </html>