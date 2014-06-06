<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <link rel="stylesheet" type="text/css" href="styles.css"/>
  <title>Display all in Database</title>
</head>

<body>

<h1> Restaurants in Database </h1>
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

$stmt = $db->prepare("SELECT * FROM restaurant");
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo '<div class="main">';
foreach($rows AS $row)
{
echo '<b> Name: ' . '<a href="display_reviews.php?id=' . $row['id'] . '">' . $row['name'] . '</a>' 
     . "<br/> Address: " . $row['address'] . '</b>';
	 if (isset($_SESSION['username']))
	 echo '<form action="add_review.php" method="POST"><input type="submit" value="Add Review"></form>';
	 echo '<br/>';
}
echo '</div>';
?>

</body>

</html>