<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name = "viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href = "css/bootstrap.min.css">
  <title>Add Review</title>
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
               echo '<li><a href="new_user.php">Create Account</a></li>';
           ?>
		 </ul>
	  </div>
   </div>
</div>
 
<?php
 // Connect to database
if(isset($_GET['id']))
{
require("dbConnect.php");
try
{
  $db = loadDatabase();
}

catch(PDOException $ex)
{
  die("dead");
}
$num = $_GET['id'];

$stmt = $db->prepare("SELECT name, address FROM restaurant WHERE id=:num");
$stmt->bindParam(':num', $num);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
 // If adding a review from the button, generate the name and address
echo
'<form action="" method="POST">
  <div class = "form-inline form-group text-center">
    <label for="rest">Restaurant</label>
    <input type="text" name="restaurant" value="' . $rows[0]['name'] . '" class = "form-control" id = "rest"><br/><br/>
  </div>
  <div class = "form-inline form-group text-center">
    <label for="add">Address</label>
    <input type="text" name="address" value="' . $rows[0]['address'] . '"class = "form-control"><br/><br/>
  </div>
  <div class = "form-inline form-group text-center">
    <label for="rev">Review</label>
    <textarea name="review" class = "form-control" id = "rev"></textarea><br/><br/>
    <input type="submit" value="Submit Review">
    <input type="reset" value="Clear Form">
  </div>
</form>';
}

// Otherwise, let user type it in. 
 else
 {
 echo 
'<form action="" method="POST">
  <div class = "form-inline form-group text-center">
    <label for="rest">Restaurant</label>
    <input type="text" name="restaurant" class = "form-control" id = "rest"><br/><br/>
  </div>
  <div class = "form-inline form-group text-center">
    <label for="add">Address</label>
    <input type="text" name="address" class = "form-control"><br/><br/>
  </div>
  <div class = "form-inline form-group text-center">
    <label for="rev">Review</label>
    <textarea name="review" class = "form-control" id = "rev"></textarea><br/><br/>
    <input type="submit" value="Submit Review">
    <input type="reset" value="Clear Form">
  </div>
</form>';
}

?>

<?php

// If user submitted a value other than "", continue
if (isset($_POST['restaurant']) && $_POST['restaurant'] != "")
{
$restaurant = $_POST['restaurant'];
$address = $_POST['address'];
$review = $_POST['review'];

// Checks to make sure restaurant isn't already in database
$stmt = $db->prepare("SELECT name FROM restaurant WHERE name=:restaurant");
$stmt->bindParam(':restaurant', $restaurant);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$count = $stmt->rowCount();

// If restaurant does not exist, add it to the database
if ($count == 0)
{
$stmt = $db->prepare("INSERT INTO restaurant (name, address) 
                      VALUES (:restaurant, :address)");
$stmt->bindParam(':restaurant', $restaurant);
$stmt->bindParam(':address', $address);
$stmt->execute();
}

// Add review to the review table in database
$stmt = $db->prepare("INSERT INTO review (userID, restaurantID, review) 
                      VALUES ((SELECT id FROM user WHERE user_name=:username),
					          (SELECT id FROM restaurant WHERE name=:restaurant),
							  :review)");
$stmt->bindParam(':username', $_SESSION['username']);
$stmt->bindParam(':restaurant', $restaurant);
$stmt->bindParam(':review', $review);
$stmt->execute();
echo 'Review Successfully Created';
}

?>
</div>

</body>
</html>