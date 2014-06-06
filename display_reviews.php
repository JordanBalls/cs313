<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <link rel="stylesheet" type="text/css" href="styles.css"/>
  <title>Reviews</title>
</head>

<body>

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
?></h1>
<div class="links">
  <a href="project_home.php">Home</a><br/>
  <a href="all_restaurants.php">Restaurants</a><br/>
  <a href="new_user.php">Create Account</a>
 </div>
 
 <div class="main">
 <?php
$stmt = $db->prepare("SELECT review, user_name FROM review AS r
                      JOIN user AS u ON u.id = r.userID
					  WHERE restaurantID=:id");
$stmt->bindParam(':id', $id);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($rows AS $row)
{
echo '<b>"' . $row['review'] . '" - ' . $row['user_name'] . '</b><br/><br/>';
}

?>
 </div>
 
 
 </body>
 </html>