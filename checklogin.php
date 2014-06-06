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

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $db->prepare("SELECT * FROM user WHERE user_name=:username AND password=:password");
$stmt->bindParam(':username', $username);
$stmt->bindParam(':password', $password);
$stmt->execute();
$count = $stmt -> rowCount();

//If result matched, table row must be 1 row
if ($count > 0)
{
session_start();
$_SESSION['username'] = $_POST['username'];
header('Location: project_home.php');
}
else
{
echo "Wrong Username or Password";
}

?>