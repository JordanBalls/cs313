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
<?php

try
{
$user = "php";
$password = "php-pass";
$db = new PDO("mysql:host=127.0.0.1;dbname=project", $user, $password);
}

catch(PDOException $ex)
{
die("dead");
}

$stmt = $db->prepare("SELECT * FROM restaurant");
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach($rows AS $row)
{
echo '<b> Name: ' . $row['name'] . "<br/> Address: " . $row['address'] . '</b>' . '<br/><br/>';
}
?>

</body>

</html>