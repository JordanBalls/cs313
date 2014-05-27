<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <link rel="stylesheet" type="text/css" href="styles.css"/>
  <title>Search Database</title>
</head>

<body>

<h1> Review Query for a Specific Restaurant</h1>
<?php

require(dbConnect.php);

try
{
$db = loadDatabase();
}

catch(PDOException $ex)
{
die("dead");
}
$restaurant = $_GET['restaurant'];

//$book = 'Enos';
$stmt = $db->prepare("SELECT review, user_name FROM review as r JOIN restaurant 
as r2 ON r.restaurantID = r2.id JOIN user as u ON r.userID = u.id WHERE r2.name=:restaurant");
$stmt->bindParam(':restaurant', $restaurant);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($rows AS $row)
{
echo '<b>' . "\"" . $row['review'] . "\" " . " From User: " . $row['user_name'] . '</b><br/>';

}
?>

<form action="" method="GET">
<input type="text" name = "restaurant">
<input type="submit">
</form>

</body>

</html>