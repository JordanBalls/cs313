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
<form action="" method="POST">
Restaurant Name: <input type="text" name="restaurant"><br/>
Address: <input type="text" name="address"><br/>
Review: <textarea name="review"></textarea><br/>
<input type="submit" value="Submit Review">
<input type="reset" value="Clear Form">
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